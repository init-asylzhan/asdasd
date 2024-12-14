<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $project->tasks()->create($request->validate([
                'title' => 'required',
                'description' => 'required',
                'due_date' => 'required|date',
            ]) + ['assigned_to' => auth()->guard('sanctum')->user()->id, 'status' => 'pending',]);
    }

    public function update(Request $request, Task $task)
    {
        $task->update([
                'title' => 'required',
                'project_id' => 1,
                'description' => 'required',
                'due_date' => 'required|date',
            ] + ['assigned_to' => auth()->guard('sanctum')->user()->id, 'status' => 'pending',]);
    }

    public function destroy(Task $task)
    {
        $task->delete();
    }
}
