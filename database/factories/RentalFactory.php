<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class RentalFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory()->state(['role' => 'Rental Client']),
            'pick_up_date' => $this->faker->date(),
            'return_date' => $this->faker->date(),
            'penalty' => $this->faker->randomFloat(2, 0, 500),
            'status' => $this->faker->randomElement(['Pending', 'Confirmed', 'Released', 'Returned', 'Cancelled']),
            'remarks' => $this->faker->optional()->sentence,
        ];
    }
}
