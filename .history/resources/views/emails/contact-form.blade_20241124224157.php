@component('mail::message')
# Tin nhắn mới từ form liên hệ

**Họ tên:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Số điện thoại:** {{ $data['phone'] }}  
**Tiêu đề:** {{ $data['subject'] }}  

**Nội dung:**  
{{ $data['message'] }}

Trân trọng,<br>
{{ config('app.name') }}
@endcomponent 