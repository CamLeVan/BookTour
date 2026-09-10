@component('mail::message')
# Xin chào!

@if(isset($message))
{{ $message }}
@endif

@if(isset($actionUrl))
@component('mail::button', ['url' => $actionUrl, 'color' => 'primary'])
Đặt lại mật khẩu
@endcomponent
@endif

@if(isset($actionUrl))
Link đặt lại mật khẩu này sẽ hết hạn sau 60 phút.
@endif

Nếu bạn không yêu cầu đặt lại mật khẩu, bạn có thể bỏ qua email này.

Trân trọng,<br>
{{ config('app.name') }}

@component('mail::subcopy')
@if(isset($actionUrl))
Nếu bạn gặp vấn đề với nút "Đặt lại mật khẩu", copy và paste URL sau vào trình duyệt: {{ $actionUrl }}
@endif
@endcomponent
@endcomponent 