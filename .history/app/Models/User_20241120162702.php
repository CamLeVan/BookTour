<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Booking;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Booking[] $bookings
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'role',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
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

    public function isSpAdmin() 
    {
        return $this->role === 'spadmin';
    }

    public function isAdmin() 
    {
        return $this->role === 'admin';
    }

    public function isUser() 
    {
        return $this->role === 'user';
    }
}