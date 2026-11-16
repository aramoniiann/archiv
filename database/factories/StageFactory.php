<?php

namespace Database\Factories;

use App\Models\Stage;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Stage>
 */
class StageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'task_id' => Task::factory(),
            'name' => fake()->sentence(3),
            'description' => fake()->sentence(),
            'position' => fake()->numberBetween(1, 5),
            'is_completed' => false,
        ];
    }
}
