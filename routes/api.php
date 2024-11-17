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
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
        Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');
    });


    Route::get('/projects', function () {
        return App\Models\Project::with(['tasks','users','manager'])->get();
    });

    Route::get('/projects/{project:id}/tasks', function (App\Models\Project $project) {
        return $project->tasks->load('assignedTo');
    });

    Route::get('/team', function () {
        return App\Models\User::with(['position','projects'])->get();
    });
});
