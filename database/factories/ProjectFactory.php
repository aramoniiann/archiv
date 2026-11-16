<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'repository_url' => fake()->url(),
            'start_date' => fake()->dateTimeBetween('-2 months', 'now'),
            'due_date' => fake()->dateTimeBetween('+1 month', '+3 months'),
        ];
    }
}
