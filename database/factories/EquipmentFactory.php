<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentFactory extends Factory
{
    public function definition()
    {
        $categories = [
            'Personal Diving Gear',
            'Breathing Apparatus',
            'Dive Instruments',
            'Communication & Safety Tools',
            'Specialized Survey Equipment',
        ];

        return [
            'equipment_name' => $this->faker->unique()->word . ' Device', // clearer English
            'quantity' => $this->faker->numberBetween(1, 20),
            'category' => $this->faker->randomElement($categories),
        ];
    }
}
