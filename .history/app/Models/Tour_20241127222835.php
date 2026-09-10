<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'gallery',
        'status',
        'user_id'
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
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
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
        return true;
    }

    /**
     * Mặc định số chỗ còn trống là max_people
     */
    public function getAvailableSlotsAttribute(): int
    {
        // Nếu chưa có max_people, mặc định là 20
        $maxPeople = $this->max_people ?? 20;
        
        // Tạm thời return luôn max_people
        return $maxPeople;

        // Sau này có thể thêm logic tính toán thực tế:
        /*
        $bookedSlots = $this->bookings()
                           ->where('status', 'confirmed')
                           ->where('booking_date', '>=', now())
                           ->sum('adults');
                           
        return max(0, $maxPeople - $bookedSlots);
        */
    }

    /**
     * Format giá tour
     */
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price) . ' VNĐ';
    }
}
