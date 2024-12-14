<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/projects', [\App\Http\Controllers\ProjectController::class, 'store']);
        Route::put('/projects/{project:id}', [\App\Http\Controllers\ProjectController::class, 'update']);
        Route::delete('projects/{project:id}', [\App\Http\Controllers\ProjectController::class, 'destroy']);

        Route::get('/projects', function () {
            return auth()->user()->projects()->with(['tasks', 'users', 'manager'])->get();
        });
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);

        Route::get('/projects/{project:id}/tasks', function (App\Models\Project $project) {
            return $project->tasks->load('assignedTo');
        });
        Route::post('/projects/{project:id}/tasks', [\App\Http\Controllers\TaskController::class, 'store']);
        Route::put('/projects/tasks/{task:id}', [\App\Http\Controllers\TaskController::class, 'update']);
        Route::delete('/projects/tasks/{task:id}', [\App\Http\Controllers\TaskController::class, 'destroy']);

        Route::get('/team', function () {
            return App\Models\User::with(['position', 'projects'])->get();
        });
    });
});
