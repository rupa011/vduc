<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    use HasFactory;

    protected $fillable = [
        'vessel_name',
        'vessel_owner',
        'vessel_location',
        'imo_on',
        'home_port',
        'place_of_built',
        'type_of_service',
        'length',
        'no_screws',
        'breadth',
        'material',
        'depth',
        'gross_tonnage',
        'engine',
        'net_tonnage',
        'year_built',
        'launch_date',
        'horse_power',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedules()
    {
        return $this->hasMany(VesselSchedule::class);
    }

    public function inspections()
    {
        return $this->hasMany(VesselInspection::class);
    }
}
