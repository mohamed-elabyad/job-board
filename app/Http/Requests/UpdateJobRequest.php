<?php

namespace App\Http\Requests;

use App\Enums\OfferedJobsCategoryEnum;
use App\Enums\OfferedJobsExperienceEnum;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Job;
use Illuminate\Validation\Rule;

// To validate the request of creating a new job
class UpdateJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'salary' => ['required', 'numeric', 'min:5000'],
            'description' => ['required', 'string',],
            'experience' => ['required', 'in:' . implode(',', OfferedJobsExperienceEnum::values())],
            'category' => ['required', 'in:' . implode(',', OfferedJobsCategoryEnum::values())],
        ];
    }
}
