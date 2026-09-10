@component('mail::message')
# Xác nhận thanh toán thành công

Cảm ơn bạn đã thanh toán. Dưới đây là chi tiết thanh toán của bạn:

**Mã đặt tour:** #{{ $booking->id }}  
**Tour:** {{ $booking->tour->name }}  
**Ngày khởi hành:** {{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}  
**Số người:** {{ $booking->adults }} người lớn, {{ $booking->children }} trẻ em  
**Tổng tiền đã thanh toán:** {{ number_format($booking->total_amount) }} VNĐ  
**Phương thức thanh toán:** {{ $booking->payment_method }}  
**Mã giao dịch:** {{ $booking->transaction_id }}

@component('mail::button', ['url' => route('frontend.bookings.success', $booking)])
Xem Chi Tiết Đặt Tour
@endcomponent

Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!<br>
{{ config('app.name') }}
@endcomponent 