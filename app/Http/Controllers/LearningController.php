<?php

namespace App\Http\Controllers;

use App\Http\Requests\Learning\StoreLearningRequest;
use App\Http\Requests\Learning\UpdateLearningRequest;
use App\Http\Resources\LearningResource;
use App\Models\Learning;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class LearningController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $learnings = $request->user()->learnings()->latest()->get();

        return LearningResource::collection($learnings);
    }

    public function store(StoreLearningRequest $request): JsonResponse
    {
        $learning = $request->user()->learnings()->create($request->validated());

        return LearningResource::make($learning)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Learning $learning): LearningResource
    {
        $this->ensureIsOwner($learning);

        return LearningResource::make($learning->load('difficulties'));
    }

    public function update(UpdateLearningRequest $request, Learning $learning): LearningResource
    {
        $this->ensureIsOwner($learning);

        $learning->update($request->validated());

        return LearningResource::make($learning);
    }

    public function destroy(Learning $learning): Response
    {
        $this->ensureIsOwner($learning);

        $learning->delete();

        return response()->noContent();
    }
}
