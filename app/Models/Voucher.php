<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'type',
        'value',
        'max_discount_amount',
        'min_order_value',
        'usage_limit',
        'used_count',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'value' => 'float',
        'max_discount_amount' => 'float',
        'min_order_value' => 'float',
        'usage_limit' => 'integer',
        'used_count' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Check if the voucher is valid for a given order total.
     * Returns array ['valid' => bool, 'message' => string]
     */
    public function validateForOrder(float $orderTotal): array
    {
        if ($this->status !== 'active') {
            return ['valid' => false, 'message' => 'Mã giảm giá này hiện không hoạt động.'];
        }

        $now = Carbon::now();
        if ($this->start_date && $now->lt($this->start_date)) {
            return ['valid' => false, 'message' => 'Mã giảm giá chưa đến thời gian sử dụng.'];
        }

        if ($this->end_date && $now->gt($this->end_date)) {
            return ['valid' => false, 'message' => 'Mã giảm giá đã hết hạn sử dụng.'];
        }

        if ($this->usage_limit !== null && $this->used_count >= $this->usage_limit) {
            return ['valid' => false, 'message' => 'Mã giảm giá đã hết lượt sử dụng.'];
        }

        if ($orderTotal < $this->min_order_value) {
            return [
                'valid' => false,
                'message' => 'Đơn hàng tối thiểu ' . number_format($this->min_order_value, 0, ',', '.') . 'đ để sử dụng mã này.'
            ];
        }

        return ['valid' => true, 'message' => 'Áp dụng mã giảm giá thành công!'];
    }

    /**
     * Calculate discount amount based on order total.
     */
    public function calculateDiscount(float $orderTotal): float
    {
        if ($this->type === 'fixed') {
            return min($this->value, $orderTotal);
        }

        // Percentage
        $discount = ($orderTotal * $this->value) / 100;
        if ($this->max_discount_amount !== null && $this->max_discount_amount > 0) {
            $discount = min($discount, $this->max_discount_amount);
        }

        return min($discount, $orderTotal);
    }
}
