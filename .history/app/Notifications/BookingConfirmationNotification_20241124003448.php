<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingConfirmationNotification extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Xác nhận đặt tour thành công')
            ->greeting('Xin chào ' . $notifiable->name)
            ->line('Cảm ơn bạn đã đặt tour của chúng tôi.')
            ->line('Chi tiết đặt tour:')
            ->line('- Tour: ' . $this->booking->tour->name)
            ->line('- Ngày khởi hành: ' . $this->booking->booking_date->format('d/m/Y'))
            ->line('- Số người: ' . $this->booking->adults . ' người lớn, ' . $this->booking->children . ' trẻ em')
            ->line('- Tổng tiền: ' . number_format($this->booking->total_price) . ' VNĐ')
            ->action('Xem chi tiết', route('frontend.booking.history'))
            ->line('Chúng tôi sẽ liên hệ với bạn sớm nhất.');
    }
} 