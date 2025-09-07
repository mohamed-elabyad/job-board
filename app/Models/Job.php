<?php

namespace App\Models;

use App\Enums\OfferedJobsCategoryEnum;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder as eBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as qBuilder;
use App\Enums\OfferedJobsExperienceEnum;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory, SoftDeletes;

    protected function casts(): array
    {
        return [
            'experience' => OfferedJobsExperienceEnum::class,
            'category' => OfferedJobsCategoryEnum::class,
        ];
    }

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }
    // the table name in the database
    protected $table = 'offered_jobs';

    protected $fillable = ['title', 'location', 'salary', 'description', 'experience', 'category'];

    public static array $category = ['It', 'Finance', 'Sales', 'Marketing'];
    public static array $experience = ['entry', 'intermediate', 'senior'];


    // a filter scope to filter jobs by name or description, or by salary From min to To max
    //or by experience or category
    public static function scopeFilter(eBuilder | qBuilder $query, array $filters): eBuilder | qBuilder
    {
        return $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('employer', function ($query) use ($search) {
                        $query->where('company_name', $search);
                    });
            });
        })
            ->when($filters['min_salary'] ?? null, function ($query, $minSalary) {
                $query->where('salary', '>=', $minSalary);
            })
            ->when($filters['max_salary'] ?? null, function ($query, $maxSalary) {
                $query->where('salary', '<=', $maxSalary);
            })
            ->when($filters['experience'] ?? null, function ($query, $experience) {
                $query->where('experience', $experience);
            })
            ->when($filters['category'] ?? null, function ($query, $category) {
                $query->where('category', $category);
            });
    }



    // to make sure that the user has already applied for a specific jjob and cant apply to it again
    public function hasUserApplied(Authenticatable|User|int $user): bool
    {
        $userId = $user instanceof User ? $user->id : $user;

        return $this->jobApplications()
            ->where('user_id', $userId)
            ->where('job_id', $this->id)

            ->exists();
    }
}
