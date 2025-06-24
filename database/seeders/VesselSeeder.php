<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VesselSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Vessel::factory()->count(5)->create();
    }
}
