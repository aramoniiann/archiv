<?php

namespace App\Http\Controllers;

use App\Http\Requests\Difficulty\StoreDifficultyRequest;
use App\Http\Requests\Difficulty\UpdateDifficultyRequest;
use App\Http\Resources\DifficultyResource;
use App\Models\Difficulty;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DifficultyController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $difficulties = $request->user()->difficulties()->latest()->get();

        return DifficultyResource::collection($difficulties);
    }

    public function store(StoreDifficultyRequest $request): JsonResponse
    {
        $difficulty = $request->user()->difficulties()->create($request->validated());

        return DifficultyResource::make($difficulty)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Difficulty $difficulty): DifficultyResource
    {
        $this->ensureIsOwner($difficulty);

        return DifficultyResource::make($difficulty->load('learning'));
    }

    public function update(UpdateDifficultyRequest $request, Difficulty $difficulty): DifficultyResource
    {
        $this->ensureIsOwner($difficulty);

        $difficulty->update($request->validated());

        return DifficultyResource::make($difficulty);
    }

    public function destroy(Difficulty $difficulty): Response
    {
        $this->ensureIsOwner($difficulty);

        $difficulty->delete();

        return response()->noContent();
    }
}
