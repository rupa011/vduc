<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivingApplication extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'lesson_id', 'status', 'schedule_date', 'schedule_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(DivingLesson::class, 'lesson_id');
    }

    public function logs()
    {
        return $this->hasMany(DiversLog::class, 'application_id');
    }
}
