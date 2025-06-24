<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pick_up_date',
        'return_date',
        'penalty',
        'status',
        'remarks',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function equipmentItems()
    {
        return $this->hasMany(EquipmentRentalItem::class);
    }

    public function equipment()
    {
        return $this->belongsToMany(Equipment::class, 'equipment_rental_items')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function rentalStatuses()
    {
        return $this->hasMany(RentalItemStatus::class);
    }
}
