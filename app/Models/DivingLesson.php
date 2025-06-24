<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivingLesson extends Model
   {
       use HasFactory;

       protected $fillable = ['lesson_name', 'description', 'duration_minutes', 'price', 'prerequisite'];

       public function applications()
       {
           return $this->hasMany(DivingApplication::class, 'lesson_id');
       }

       public function prerequisiteLesson()
       {
           return $this->belongsTo(DivingLesson::class, 'prerequisite');
       }
   }
