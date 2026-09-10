@component('mail::message')
# Thông Báo Hủy Đơn Đặt Tour

Kính gửi {{ $booking->user->name }},

Chúng tôi tiếc phải thông báo rằng đơn đặt tour của bạn đã bị hủy. Dưới đây là thông tin chi tiết:

**Mã đặt tour:** #{{ $booking->id }}  
**Tour:** {{ $booking->tour->name }}  
**Ngày khởi hành:** {{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}  
**Số tiền hoàn trả (nếu có):** {{ number_format($booking->refund_amount ?? 0) }} VNĐ  
**Lý do / Trạng thái:** {{ $booking->refund_reason ?? 'Đơn hàng đã hủy' }}

@component('mail::button', ['url' => route('frontend.tours.index')])
Khám Phá Tour Khác
@endcomponent

Nếu bạn cần hỗ trợ thêm, vui lòng liên hệ với chúng tôi qua hotline hoặc email hỗ trợ.

Trân trọng,<br>
{{ config('app.name') }}
@endcomponent
