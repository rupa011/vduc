<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentRentalItem extends Model
{
    use HasFactory;

    protected $fillable = ['equipment_id', 'rental_id', 'quantity'];

    public function equipment() {
        return $this->belongsTo(Equipment::class);
    }

    public function rental() {
        return $this->belongsTo(Rental::class);
    }
}
