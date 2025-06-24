<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiversLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'dive_no',
        'location',
        'depth',
        'bottom_time',
        'mins_stop',
        'time_in',
        'time_out',
        'tank_start',
        'tank_end',
        'visibility',
        'current',
        'weight',
        'temperature',
        'date',
    ];

    public function application()
    {
        return $this->belongsTo(DivingApplication::class);
    }
}
