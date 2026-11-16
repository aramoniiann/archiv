<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DifficultyController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/me', [AuthController::class, 'me']);

    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('projects.tasks', TaskController::class)->shallow();
    Route::apiResource('tasks.stages', StageController::class)->shallow();
    Route::apiResource('learnings', LearningController::class);
    Route::apiResource('difficulties', DifficultyController::class);
});
