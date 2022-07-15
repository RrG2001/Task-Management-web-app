<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class ProjectStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'status' => 'Open Backlog'
        ]);

        Status::create([
            'status' => 'Sprint Backlog '
        ]);

        Status::create([
            'status' => 'In Progress'
        ]);

        Status::create([
            'status' => 'Review'
        ]);

        Status::create([
            'status' => 'Test'
        ]);

        Status::create([
            'status' => 'Coding Done'
        ]);

        Status::create([
            'status' => 'Closed'
        ]);
    }
}
