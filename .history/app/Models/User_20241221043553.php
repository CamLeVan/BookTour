<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Booking[] $bookings
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'phone',
        'address',
        'role',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function paidBookings()
    {
        return $this->hasMany(Booking::class)->where('payment_status', 'paid');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }
    // Quan hệ (Admin) quản lý nhiều Tour
    public function tours()
    {
        return $this->hasMany(Tour::class, 'user_id');
    }
    //trả về danh sách các booking đã hoàn tất (completed) do người dùng đó thực hiện.
    public function completedBookings()
    {
        return $this->hasMany(Booking::class)->where('status', 'completed');
    }
}
