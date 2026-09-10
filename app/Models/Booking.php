<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'tour_id',
        'user_id',
        'booking_date',
        'adults',
        'children',
        'total_price',
        'notes',
        'total_amount',
        'status',
        'payment_status',
        'payment_method',
        'transaction_id',
        'voucher_id',
        'discount_amount',
        'is_deposit',
        'deposit_amount',
        'remaining_amount',
        'hold_expires_at',
        'refund_amount',
        'refund_status',
        'refund_reason',
        'completed_at',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'paid_at' => 'datetime',
        'hold_expires_at' => 'datetime',
        'completed_at' => 'datetime',
        'adults' => 'integer',
        'children' => 'integer',
        'total_price' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
        'refund_amount' => 'decimal:2',
        'is_deposit' => 'boolean',
    ];

    // Định nghĩa các trạng thái
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_EXPIRED = 'expired';

    const PAYMENT_UNPAID = 'unpaid';
    const PAYMENT_DEPOSIT_PAID = 'deposit_paid';
    const PAYMENT_PAID = 'paid';
    const PAYMENT_REFUNDED = 'refunded';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    // Accessors & Mutators
    public function getStatusColorAttribute(): string
    {
        return [
            self::STATUS_PENDING => 'warning',
            self::STATUS_CONFIRMED => 'info',
            self::STATUS_COMPLETED => 'success',
            self::STATUS_CANCELLED => 'danger',
        ][$this->status] ?? 'secondary';
    }

    public function getStatusLabelAttribute(): string
    {
        return [
            self::STATUS_PENDING => 'Chờ xác nhận',
            self::STATUS_CONFIRMED => 'Đã xác nhận',
            self::STATUS_COMPLETED => 'Hoàn thành',
            self::STATUS_CANCELLED => 'Đã hủy',
        ][$this->status] ?? 'Không xác định';
    }

    public function getTotalPeopleAttribute(): int
    {
        return $this->adults + $this->children;
    }

    public function getAmountPaidAttribute(): float
    {
        if ($this->payment_status === self::PAYMENT_UNPAID) {
            return 0.0;
        }
        if ($this->is_deposit) {
            return (float) $this->deposit_amount;
        }
        return (float) ($this->total_amount ?? $this->total_price);
    }

    public function isHoldExpired(): bool
    {
        if ($this->status !== self::STATUS_PENDING) {
            return false;
        }
        return $this->hold_expires_at && \Carbon\Carbon::now()->gt($this->hold_expires_at);
    }

    public function calculateRefundAmount(): float
    {
        $paid = $this->getAmountPaidAttribute();
        if ($paid <= 0) {
            return 0.0;
        }

        $bookingDate = \Carbon\Carbon::parse($this->booking_date)->startOfDay();
        $today = \Carbon\Carbon::now()->startOfDay();
        $daysUntilTour = $today->diffInDays($bookingDate, false);

        if ($daysUntilTour >= 7) {
            return $paid; // 100% refund
        } elseif ($daysUntilTour >= 3) {
            return round($paid * 0.50); // 50% refund
        }

        return 0.0; // 0% refund
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', self::STATUS_CONFIRMED);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', self::STATUS_CANCELLED);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
