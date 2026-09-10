@component('mail::message')
# Xác nhận đặt tour thành công

Cảm ơn bạn đã đặt tour với chúng tôi. Dưới đây là chi tiết booking của bạn:

**Mã đặt tour:** #{{ $booking->id }}  
**Tour:** {{ $booking->tour->name }}  
**Ngày khởi hành:** {{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}  
**Số người:** {{ $booking->adults }} người lớn, {{ $booking->children }} trẻ em  
**Tổng tiền:** {{ number_format($booking->total_price) }} VNĐ

@component('mail::button', ['url' => route('frontend.tours.show', $booking->tour)])
Xem Chi Tiết Tour
@endcomponent

Cảm ơn bạn,<br>
{{ config('app.name') }}
@endcomponent 