<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DivingApplicationSeeder extends Seeder
{
    public function run()
    {
        \App\Models\DivingApplication::factory()
            ->count(10)
            ->hasLogs(2)
            ->create();
    }
}
