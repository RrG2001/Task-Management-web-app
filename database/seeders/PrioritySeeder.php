<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Priority::create([
            'priority' => 'Low'
        ]);
        Priority::create([
            'priority' => 'Normal'
        ]);

        Priority::create([
            'priority' => 'High'
        ]);

        Priority::create([
            'priority' => 'Urgent'
        ]);
    }
}
