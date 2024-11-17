<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    private array $projects = [
        ['name' => 'asd'],
        ['name' => 'asd'],
        ['name' => 'asd'],
        ['name' => 'asd'],
        ['name' => 'asd'],
        ['name' => 'asd'],
        ['name' => 'asd'],
        ['name' => 'asd'],
    ];

    public function run(): void
    {
        foreach ($this->projects as $project) {
            $project = \App\Models\Project::create($project + ['manager_id' => User::inRandomOrder()->first()->id, 'start_date' => Carbon::now()->addDay(), 'deadline' => Carbon::now()->addMonth()]);
            $project->users()->attach(User::inRandomOrder()->first()->id);
        }
    }
}
