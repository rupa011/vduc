<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Equipment extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['equipment_name', 'quantity', 'category'];

    public function rentalItems()
    {
        return $this->hasMany(EquipmentRentalItem::class);
    }

    public function rentalStatuses()
    {
        return $this->hasMany(RentalItemStatus::class);
    }

    public function getAvailableQuantityAttribute()
    {
        $rented = $this->rentalItems()
            ->whereHas('rental', function ($query) {
                $query->whereNotIn('status', ['Returned', 'Cancelled']);
            })
            ->sum('quantity');

        return $this->quantity - $rented;
    }

    public function getRentedQuantityAttribute()
    {
        return $this->rentalItems()
            ->whereHas('rental', function ($query) {
                $query->whereNotIn('status', ['Returned', 'Cancelled']);
            })
            ->sum('quantity');
    }

    public function getStatusAttribute()
    {
        return $this->available_quantity > 0 ? 'Available' : 'Not Available';
    }

    public function rentals()
    {
        return $this->belongsToMany(Rental::class, 'equipment_rental_items')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
             ->useDisk('public_folder')            // or 's3', 'local', etc.
             ->singleFile();                // Optional: only one image per model
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10)
            ->nonQueued();

        $this->addMediaConversion('preview')
            ->width(800)
            ->height(600)
            ->nonQueued();
    }
}
