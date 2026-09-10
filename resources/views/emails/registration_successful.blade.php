@component('mail::message')
# Chào {{ $name }},

Cảm ơn bạn đã đăng ký tài khoản với chúng tôi!

Chúng tôi rất vui mừng chào đón bạn đến với cộng đồng của chúng tôi.

Trân trọng,<br>
{{ config('app.name') }}
@endcomponent 