<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VesselSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'vessel_id', 'schedule_date', 'status'];

    public function service()
    {
        return $this->belongsTo(VesselService::class);
    }

    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }

    public function inspection()
    {
        return $this->hasOne(VesselInspection::class, 'schedule_id');
    }
}
