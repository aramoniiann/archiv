<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index(Project $project): AnonymousResourceCollection
    {
        $this->ensureIsOwner($project);

        $tasks = $project->tasks()->latest()->get();

        return TaskResource::collection($tasks);
    }

    public function store(StoreTaskRequest $request, Project $project): JsonResponse
    {
        $this->ensureIsOwner($project);

        $task = $project->tasks()->create($request->validated());

        return TaskResource::make($task)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Task $task): TaskResource
    {
        $this->ensureIsOwner($task);

        return TaskResource::make($task->load('stages'));
    }

    public function update(UpdateTaskRequest $request, Task $task): TaskResource
    {
        $this->ensureIsOwner($task);

        $task->update($request->validated());

        return TaskResource::make($task);
    }

    public function destroy(Task $task): Response
    {
        $this->ensureIsOwner($task);

        $task->delete();

        return response()->noContent();
    }
}
