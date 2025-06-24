<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VesselInspectionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'vessel_inspection_id',
        'title',
        'description',
        'remarks',
        'marine_growth',
        'corrosion',
        'paint_coating',
    ];

    public function inspection()
    {
        return $this->belongsTo(VesselInspection::class, 'vessel_inspection_id');
    }
}
