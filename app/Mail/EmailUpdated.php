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
                ->view('vendor.notifications.email-updated')  // Chỉnh sửa tên view ở đây
                ->with([
                    'newEmail' => $this->newEmail,
                ]);
}

}
