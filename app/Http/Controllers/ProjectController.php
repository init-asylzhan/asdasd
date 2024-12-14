<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        auth()->user()->project()->create($request->validate([
                'deadline' => 'required|date',
                'name' => 'required',
                'description' => 'required',
            ]) + ['status' => 'not_started', 'start_date' => now()]);
    }

    public function update(Request $request, Project $project)
    {
        return $project->update($request->all());
    }

    public function destroy(Project $project)
    {
        $project->delete();
    }
}
