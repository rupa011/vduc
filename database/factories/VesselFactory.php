<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class VesselFactory extends Factory
{
    public function definition()
    {
        return [
            'vessel_name' => $this->faker->unique()->word . ' Vessel',
            'vessel_owner' => $this->faker->unique()->company,
            'vessel_location' => $this->faker->city,
            'imo_on' => $this->faker->unique()->bothify('IMO#####'),
            'home_port' => $this->faker->city,
            'place_of_built' => $this->faker->city,
            'type_of_service' => 'Passenger',
            'length' => $this->faker->numberBetween(30, 100) . ' m',
            'no_screws' => $this->faker->unique()->randomDigit,
            'breadth' => $this->faker->randomFloat(1, 5, 15) . ' m',
            'material' => 'Steel',
            'depth' => $this->faker->randomFloat(1, 3, 10) . ' m',
            'gross_tonnage' => $this->faker->randomNumber(4),
            'engine' => $this->faker->word,
            'net_tonnage' => $this->faker->randomNumber(4),
            'year_built' => $this->faker->date(),
            'launch_date' => $this->faker->date(),
            'horse_power' => $this->faker->numberBetween(1000, 5000) . ' hp',
            'user_id' => User::factory()->state(['role' => 'Survey Client']),
        ];
    }
}
