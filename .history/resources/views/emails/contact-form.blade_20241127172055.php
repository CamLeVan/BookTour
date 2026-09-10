@component('mail::message')
# Thông Báo: Yêu Cầu Liên Hệ Mới

Một khách hàng vừa gửi yêu cầu liên hệ qua website.

@component('mail::panel')
### Thông tin khách hàng:
**Họ tên:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Số điện thoại:** {{ $data['phone'] }}
@endcomponent

@component('mail::panel')
### Nội dung yêu cầu:
**Tiêu đề:** {{ $data['subject'] }}

{{ $data['message'] }}
@endcomponent

@component('mail::button', ['url' => config('app.url').'/admin/contacts'])
Xem trong Admin Panel
@endcomponent

Trân trọng,<br>
{{ config('app.name') }}

<small style="color: #718096">Email này được gửi tự động từ hệ thống {{ config('app.name') }}. Vui lòng không trả lời email này.</small>
@endcomponent 