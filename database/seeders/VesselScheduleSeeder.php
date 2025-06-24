<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VesselScheduleSeeder extends Seeder
{
    public function run()
    {
        \App\Models\VesselSchedule::factory()
            ->count(5)
            ->hasInspection()
            ->create();
    }
}
