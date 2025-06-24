<?php

namespace Database\Factories;

use App\Models\DivingLesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class DivingLessonFactory extends Factory
{
    protected $model = DivingLesson::class;

    public function definition()
    {
        return [
            'lesson_name' => 'Lesson ' . $this->faker->unique()->word, // "Lesson" + unique word
            'description' => $this->faker->sentence,
            'duration_minutes' => $this->faker->randomElement([60, 120, 720, 1440]), // realistic durations in minutes
            'price' => $this->faker->randomFloat(2, 500, 5000), // 500 to 5000 with 2 decimal places
            'prerequisite' => null, // no prerequisite by default
        ];
    }
}
