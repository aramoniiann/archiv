<?php

namespace App\Http\Controllers;

use App\Http\Requests\Stage\StoreStageRequest;
use App\Http\Requests\Stage\UpdateStageRequest;
use App\Http\Resources\StageResource;
use App\Models\Stage;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class StageController extends Controller
{
    public function index(Task $task): AnonymousResourceCollection
    {
        $this->ensureIsOwner($task);

        $stages = $task->stages()->get();

        return StageResource::collection($stages);
    }

    public function store(StoreStageRequest $request, Task $task): JsonResponse
    {
        $this->ensureIsOwner($task);

        $data = $request->validated();

        $data['position'] ??= $task->stages()->max('position') + 1;

        $stage = $task->stages()->create($data);

        return StageResource::make($stage)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Stage $stage): StageResource
    {
        $this->ensureIsOwner($stage);

        return StageResource::make($stage);
    }

    public function update(UpdateStageRequest $request, Stage $stage): StageResource
    {
        $this->ensureIsOwner($stage);

        $stage->update($request->validated());

        return StageResource::make($stage);
    }

    public function destroy(Stage $stage): Response
    {
        $this->ensureIsOwner($stage);

        $stage->delete();

        return response()->noContent();
    }
}
