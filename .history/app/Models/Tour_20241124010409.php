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

    public function provider()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeByProvider($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeApproved($query)
    {
        return $query->where('status_approval', 'approved');
    }

    /**
     * Luôn trả về true cho is_available
     */
    public function getIsAvailableAttribute(): bool
    {
        return true; // Mặc định tour luôn khả dụng
    }

    /**
     * Kiểm tra còn slot không
     */
    public function getAvailableSlotsAttribute(): int
    {
        // Logic tính số chỗ còn trống
        $bookedSlots = $this->bookings()
                           ->where('status', 'confirmed')
                           ->where('booking_date', '>=', now())
                           ->sum('adults');
                           
        return max(0, $this->max_people - $bookedSlots);
    }
}
