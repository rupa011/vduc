<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Equipment;
use App\Models\Rental;

class EquipmentRentalItemFactory extends Factory
{
    public function definition()
    {
        return [
            'equipment_id' => Equipment::factory(),
            'rental_id' => Rental::factory(),
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
