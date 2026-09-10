<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentSuccessNotification extends Notification
{
    use Queueable;

    protected $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Thanh toán thành công')
            ->greeting('Xin chào ' . $notifiable->name)
            ->line('Chúng tôi đã nhận được thanh toán của bạn.')
            ->line('Chi tiết thanh toán:')
            ->line('- Mã giao dịch: ' . $this->payment->transaction_id)
            ->line('- Số tiền: ' . number_format($this->payment->amount) . ' VNĐ')
            ->line('- Thời gian: ' . $this->payment->paid_at->format('H:i d/m/Y'))
            ->action('Xem chi tiết', route('frontend.booking.history'))
            ->line('Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.');
    }
} 