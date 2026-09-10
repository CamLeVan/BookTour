<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationSuccessful extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Đăng ký thành công')
                    ->view('vendor.notifications.email')
                    ->with([
                        'actionUrl' => null, // Không cần URL cho thông báo này
                        'message' => "Chào {$this->user->name}, bạn đã đăng ký thành công!",
                    ]);
    }
}
