<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalItemStatus extends Model
{
    use HasFactory;

    protected $fillable = ['rental_id', 'equipment_id', 'status', 'quantity'];

    public function rental() {
        return $this->belongsTo(Rental::class);
    }

    public function equipment() {
        return $this->belongsTo(Equipment::class);
    }
}
