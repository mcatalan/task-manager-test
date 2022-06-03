<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'priority' => $this->faker->randomElement([Task::PRIORITY_HIGH, Task::PRIORITY_LOW, Task::PRIORITY_MEDIUM]),
            'state' => $this->faker->randomElement([Task::STATE_OPEN, Task::STATE_CLOSE, Task::STATE_REJECTED, Task::STATE_TO_DO, Task::STATE_IN_PROGRESS, Task::STATE_TESTING, Task::STATE_DONE]),
        ];
    }
}
