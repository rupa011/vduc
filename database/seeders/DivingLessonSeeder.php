<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DivingLessonSeeder extends Seeder
{
    public function run()
    {
        \App\Models\DivingLesson::factory()->count(5)->create();
    }
}
