<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VesselServiceFactory extends Factory
{
    public function definition()
    {
        return [
            'service_name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'service_charge' => $this->faker->randomFloat(2, 1000, 10000),
        ];
    }
}
