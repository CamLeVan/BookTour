<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Tour extends Model
{
    protected $fillable = [
        'destination_id',
        'name',
        'slug',
        'description',
        'price',
        'duration',
        'max_people',
        'image',
        'images',
        'status'
    ];
    protected $casts = [
        'gallery' => 'array'
    ];
    /**
     * Scope a query to only include active tours.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class)->orderBy('day');
    }

    public function getImageAttribute($value)
    {
        return $value ?? 'default.jpg';
    }

    public function getRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }

    public function getGalleryUrlsAttribute()
    {
        return collect($this->gallery)->map(function ($image) {
            return Storage::url($image);
        });
    }
}
