<?php

namespace Database\Factories;

use App\Enums\OfferedJobsCategoryEnum;
use App\Enums\OfferedJobsExperienceEnum;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraphs(3, true),
            'salary' => fake()->numberBetween(50_000, 150_000),
            'location' => fake()->city(),
            'category' => fake()->randomElement(OfferedJobsCategoryEnum::values()),
            'experience' => fake()->randomElement(OfferedJobsExperienceEnum::values()),
        ];
    }
}
