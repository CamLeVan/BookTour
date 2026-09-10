<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $newEmail;

    public function __construct($newEmail)
    {
        $this->newEmail = $newEmail;
    }

    public function build()
    {
        return $this->subject('Cập nhật email thành công')
                    ->view('vendor.notifications.email')
                    ->with([
                        'actionUrl' => null, // Không cần URL cho thông báo này
                        'message' => "Email của bạn đã được cập nhật thành công thành: {$this->newEmail}.",
                    ]);
    }
}
