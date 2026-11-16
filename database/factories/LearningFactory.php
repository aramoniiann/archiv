<?php

namespace Database\Factories;

use App\Enums\LearningStatus;
use App\Models\Learning;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Learning>
 */
class LearningFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'studied_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'status' => fake()->randomElement(LearningStatus::cases()),
        ];
    }
}
