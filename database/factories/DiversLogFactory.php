<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DivingApplication;

class DiversLogFactory extends Factory
{
    public function definition()
    {
        return [
            'application_id' => DivingApplication::factory(),
            'dive_no' => $this->faker->numberBetween(1, 50),
            'location' => $this->faker->city,
            'depth' => $this->faker->randomFloat(2, 10, 50),
            'bottom_time' => $this->faker->numberBetween(10, 60),
            'mins_stop' => $this->faker->optional()->numberBetween(1, 10),
            'time_in' => $this->faker->dateTime(),
            'time_out' => $this->faker->dateTime(),
            'tank_start' => $this->faker->numberBetween(150, 220),
            'tank_end' => $this->faker->numberBetween(30, 100),
            'visibility' => $this->faker->optional()->numberBetween(1, 10),
            'current' => $this->faker->optional()->numberBetween(1, 5),
            'weight' => $this->faker->optional()->randomFloat(2, 2, 10),
            'temperature' => $this->faker->randomFloat(2, 20, 35),
            'date' => $this->faker->date(),
        ];
    }
}
