<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vessel;
use App\Models\VesselSchedule;

class VesselInspectionFactory extends Factory
{
    public function definition()
    {
        return [
            'vessel_id' => Vessel::factory(),
            'schedule_id' => VesselSchedule::factory(),
        ];
    }
}
