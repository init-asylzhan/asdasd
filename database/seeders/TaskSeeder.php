<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    private array $tasks = [
        [
            'title' => 'qwe',
        ], [
            'title' => 'asfdsfd',
        ], [
            'title' => 'avcxsd',
        ], [
            'title' => 'asasdd',
        ], [
            'title' => 'asbfdd',
        ], [
            'title' => 'aszxczd',
        ], [
            'title' => 'atghdfsd',
        ], [
            'title' => 'afsdfdssd',
        ], [
            'title' => 'acxzsd',
        ],

    ];

    public function run(): void
    {
        foreach ($this->tasks as $task) {
            \App\Models\Task::create($task + [
                    'project_id' => \App\Models\Project::inRandomOrder()->first()->id,
                    'due_date' => \Carbon\Carbon::now()->addDay(),
                    'assigned_to' => \App\Models\User::inRandomOrder()->first()->id
                ]);
        }
    }
}
