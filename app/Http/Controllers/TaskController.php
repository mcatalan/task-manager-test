<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function __construct(
        private TaskService $taskService
    ) {}

    public function index(): JsonResponse
    {
        $tasks = $this->taskService->list();
        return response()->json($tasks);
    }

    public function show(Task $task): JsonResponse
    {
        return response()->json($task);
    }

    public function store(TaskStoreRequest $request): JsonResponse
    {
        $task = Task::create($request->toArray());
        return response()->json(true, 201);
    }

    public function update(Task $task, TaskUpdateRequest $request): JsonResponse
    {
        $category = $request->get('category_id');
        $task->category_id = $category ? $category : $task->category_id;

        $task->title = $request->get('title');
        $task->description = $request->get('description');
        $task->priority = $request->get('priority');
        $task->state = $request->get('state');
        $task->due_date = $request->get('due_date');
        $task->save();

        // $task->update($request->toArray());

        return response()->json($task);
    }

    public function destroy(Task $task): JsonResponse
    {
        return response()->json($task->delete());
    }
}
