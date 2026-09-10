@component('mail::message')
# Xác Nhận Đặt Tour Thành Công

Xin chào {{ $booking->user->name }},

Cảm ơn bạn đã đặt tour với chúng tôi. Dưới đây là chi tiết đơn đặt tour của bạn:

**Thông tin tour:**
- Tour: {{ $booking->tour->name }}
- Ngày khởi hành: {{ $booking->booking_date->format('d/m/Y') }}
- Số lượng: {{ $booking->adults }} người lớn, {{ $booking->children }} trẻ em
- Tổng tiền: {{ number_format($booking->total_price) }} VNĐ

**Trạng thái thanh toán:** Đã thanh toán
**Phương thức thanh toán:** {{ strtoupper($booking->payment_method) }}
**Mã giao dịch:** {{ $booking->payment_id }}

@component('mail::button', ['url' => route('frontend.bookings.show', $booking->id)])
Xem Chi Tiết Đặt Tour
@endcomponent

Nếu bạn có bất kỳ thắc mắc nào, vui lòng liên hệ với chúng tôi.

Trân trọng,<br>
{{ config('app.name') }}
@endcomponent 