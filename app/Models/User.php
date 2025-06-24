<?php

namespace App\Models;

use App\Traits\HasFullName;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasFactory, HasFullName;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'extension_name',
        'email',
        'password',
        'contact',
        'role',
        'status',
    ];

    protected $appends = ['full_name'];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function vessels()
    {
        return $this->hasMany(Vessel::class);
    }

    public function divingApplications()
    {
        return $this->hasMany(DivingApplication::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
