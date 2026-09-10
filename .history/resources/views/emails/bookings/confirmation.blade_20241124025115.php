@component('mail::message')
# Xác nhận đặt tour thành công

Kính gửi {{ $booking->user->name }},

Cảm ơn bạn đã đặt tour tại HC Travel. Dưới đây là chi tiết đặt tour của bạn:

@component('mail::panel')
**Thông tin tour:**
- Tour: {{ $booking->tour->name }}
- Mã đặt tour: #{{ $booking->id }}
- Ngày khởi hành: {{ $booking->booking_date->format('d/m/Y') }}
- Số người: {{ $booking->adults }} người lớn, {{ $booking->children }} trẻ em
- Tổng tiền: {{ number_format($booking->total_price) }} VNĐ
@endcomponent

@component('mail::table')
| Chi tiết thanh toán ||
| -------------------- | ---- |
| Phương thức | {{ ucfirst($booking->payment_method) }} |
| Trạng thái | {{ $booking->payment_status === 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }} |
| Mã giao dịch | {{ $booking->transaction_id ?? 'N/A' }} |
@endcomponent

@if($booking->notes)
**Ghi chú:**
{{ $booking->notes }}
@endif

@component('mail::button', ['url' => route('frontend.bookings.history')])
Xem lịch sử đặt tour
@endcomponent

Nếu bạn có bất kỳ thắc mắc nào, vui lòng liên hệ với chúng tôi:
- Email: support@hctravel.com
- Hotline: 1900 xxxx

Trân trọng,<br>
{{ config('app.name') }}
@endcomponent 