<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VesselInspection extends Model
{
    use HasFactory;

    protected $fillable = ['vessel_id', 'schedule_id'];

    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }

    public function schedule()
    {
        return $this->belongsTo(VesselSchedule::class, 'schedule_id');
    }

    public function details()
    {
        return $this->hasMany(VesselInspectionDetail::class);
    }
}
