<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Task;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * @test
     */
    public function task_index_works()
    {
        $category = Category::factory()->create();
        Task::factory()->count(12)->create([
            'category_id' => $category->id
        ]);

        $response = $this->get(route('task.index'));
        $response->assertStatus(200);
        $response->assertJsonCount(12);
    }

    /**
     * @test
     */
    public function task_show_works()
    {
        $category = Category::factory()->create();
        $task = Task::factory()->create([
            'category_id' => $category->id
        ]);

        $response = $this->get(route('task.show', $task->id));
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'category_id' => $task->category_id,
            'title' => $task->title,
            'description' => $task->description,
            'priority' => $task->priority,
            'state' => $task->state,
            'due_date' => $task->due_date,
        ]);
    }

    /**
     * @test
     */
    public function task_store_works()
    {
        $category = Category::factory()->create();
        $task = Task::factory()->make([
            'category_id' => $category->id
        ]);

        $this->assertEquals(0, Task::count());

        $response = $this->post(route('task.store'), [
            'category_id' => $category->id,
            'title' => $task->title,
            'priority' => $task->priority,
            'state' => $task->state,
        ]);
        $response->assertStatus(201);

        $this->assertEquals(1, Task::count());
    }

    /**
     * @test
     */
    public function task_update_works()
    {
        $category = Category::factory()->create();
        $task = Task::factory()->create([
            'category_id' => $category->id,
            'priority' => Task::PRIORITY_LOW,
            'state' => Task::STATE_OPEN,
        ]);

        $response = $this->put(route('task.update', $task->id), [
            'category_id' => $task->category_id,
            'title' => $task->title . '111',
            'priority' => Task::PRIORITY_MEDIUM,
            'state' => Task::STATE_CLOSE,
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'category_id' => $task->category_id,
            'title' => $task->title . '111',
            'description' => $task->description,
            'priority' => Task::PRIORITY_MEDIUM,
            'state' => Task::STATE_CLOSE,
            'due_date' => $task->due_date,
        ]);
    }

    /**
     * @test
     */
    public function task_destroy_works()
    {
        $category = Category::factory()->create();
        $task = Task::factory()->create([
            'category_id' => $category->id
        ]);

        $this->assertEquals(1, Task::count());

        $response = $this->delete(route('task.destroy', $task->id));
        $response->assertStatus(200);

        $this->assertEquals(0, Task::count());
    }
}
