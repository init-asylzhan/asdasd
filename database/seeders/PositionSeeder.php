<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    private array $positions = [
        ['name' => 'Developer', 'slug' => 'developer'],
        ['name' => 'Designer', 'slug' => 'designer'],
        ['name' => 'Project Manager', 'slug' => 'project-manager'],
        ['name' => 'Tester', 'slug' => 'tester'],
    ];

    public function run(): void
    {
        foreach ($this->positions as $position) {
            \App\Models\Position::create($position);
        }
    }
}
