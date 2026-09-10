@component('mail::message')
# Thông tin liên hệ mới

**Họ tên:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Số điện thoại:** {{ $data['phone'] }}  
**Tiêu đề:** {{ $data['subject'] }}

**Nội dung:**  
{{ $data['message'] }}

Trân trọng,<br>
{{ config('app.name') }}
@endcomponent 