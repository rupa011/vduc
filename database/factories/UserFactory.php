<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->optional()->firstName,
            'last_name' => $this->faker->lastName,
            'extension_name' => $this->faker->optional()->suffix,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'contact' => $this->faker->unique()->phoneNumber,
            'role' => $this->faker->randomElement(['Employee', 'Survey Client', 'Student', 'Rental Client', 'Admin']),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
