<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vessel;
use App\Models\VesselService;

class VesselScheduleFactory extends Factory
{
    public function definition()
    {
        return [
            'vessel_id' => Vessel::factory(),
            'service_id' => VesselService::factory(),
            'schedule_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['Pending', 'Approved', 'Decline', 'Completed']),
        ];
    }
}
