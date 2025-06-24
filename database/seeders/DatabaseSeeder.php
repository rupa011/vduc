<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            EquipmentSeeder::class,
            DivingLessonSeeder::class,
            VesselSeeder::class,
            RentalSeeder::class,
            DivingApplicationSeeder::class,
            // VesselScheduleSeeder::class,
        ]);
    }
}
