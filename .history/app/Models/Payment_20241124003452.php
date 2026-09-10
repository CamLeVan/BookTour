<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    /**
     * Các trường có thể được gán hàng loạt
     */
    protected $fillable = [
        'booking_id',      // ID của booking
        'amount',          // Số tiền thanh toán
        'transaction_id',  // Mã giao dịch từ ngân hàng
        'payment_method',  // Phương thức thanh toán (vietqr)
        'status',         // Trạng thái: pending, completed, failed
        'paid_at',        // Thời gian thanh toán thành công
        'payment_data'    // Dữ liệu bổ sung dạng JSON
    ];

    /**
     * Các trường cần cast kiểu dữ liệu
     */
    protected $casts = [
        'paid_at' => 'datetime',
        'payment_data' => 'array',
        'amount' => 'decimal:2'
    ];

    /**
     * Quan hệ với model Booking
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Đánh dấu thanh toán thành công
     */
    public function markAsCompleted(string $transactionId = null): bool
    {
        return $this->update([
            'status' => 'completed',
            'transaction_id' => $transactionId,
            'paid_at' => now()
        ]);
    }

    /**
     * Đánh dấu thanh toán thất bại
     */
    public function markAsFailed(): bool
    {
        return $this->update([
            'status' => 'failed'
        ]);
    }

    /**
     * Kiểm tra trạng thái thanh toán
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    /**
     * Format số tiền thanh toán
     */
    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount) . ' VNĐ';
    }
}