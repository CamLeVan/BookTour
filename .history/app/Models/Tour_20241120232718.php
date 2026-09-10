<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'status'
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
}