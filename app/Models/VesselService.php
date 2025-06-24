<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VesselService extends Model
{
    use HasFactory;

    protected $fillable = ['service_name', 'description', 'service_charge'];

    public function schedules()
    {
        return $this->hasMany(VesselSchedule::class, 'service_id');
    }
}
