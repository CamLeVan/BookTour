@component('mail::message')
# Xin chào!

Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn tại HC Travel.

@component('mail::button', ['url' => $actionUrl, 'color' => 'primary'])
Đặt lại mật khẩu
@endcomponent

Link đặt lại mật khẩu này sẽ hết hạn sau 60 phút.

Nếu bạn không yêu cầu đặt lại mật khẩu, bạn có thể bỏ qua email này.

Trân trọng,<br>
{{ config('app.name') }}

@component('mail::subcopy')
Nếu bạn gặp vấn đề với nút "Đặt lại mật khẩu", copy và paste URL sau vào trình duyệt: {{ $actionUrl }}
@endcomponent
@endcomponent 