<?php

namespace Database\Factories;

use App\Enums\DifficultyStatus;
use App\Models\Difficulty;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Difficulty>
 */
class DifficultyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'subject' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'level' => fake()->numberBetween(1, 5),
            'status' => DifficultyStatus::Unresolved,
        ];
    }
}
