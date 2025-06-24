<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RentalSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Rental::factory()
            ->count(10)
            ->hasEquipmentItems(2)
            ->create();
    }
}
