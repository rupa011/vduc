<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Equipment::factory()->count(15)->create();
    }
}
