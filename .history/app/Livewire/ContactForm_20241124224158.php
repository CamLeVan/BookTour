<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $message;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'subject' => 'required|min:5',
        'message' => 'required|min:10'
    ];

    protected $messages = [
        'name.required' => 'Vui lòng nhập họ tên',
        'name.min' => 'Họ tên phải có ít nhất 3 ký tự',
        'email.required' => 'Vui lòng nhập email',
        'email.email' => 'Email không hợp lệ',
        'phone.required' => 'Vui lòng nhập số điện thoại',
        'phone.regex' => 'Số điện thoại không hợp lệ',
        'phone.min' => 'Số điện thoại phải có ít nhất 10 số',
        'subject.required' => 'Vui lòng nhập tiêu đề',
        'subject.min' => 'Tiêu đề phải có ít nhất 5 ký tự',
        'message.required' => 'Vui lòng nhập nội dung',
        'message.min' => 'Nội dung phải có ít nhất 10 ký tự'
    ];

    public function submitForm()
{
    $this->validate();

    try {
        // Gửi email thông báo
        Mail::to('admin@hctravel.com')->send(new ContactFormMail([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message
        ]));

        session()->flash('success', 'Cảm ơn bạn đã liên hệ. Chúng tôi sẽ phản hồi sớm nhất có thể!');
        $this->reset();

    } catch (\Exception $e) {
        session()->flash('error', 'Có lỗi xảy ra khi gửi tin nhắn. Vui lòng thử lại sau!');
        // \Log::error('Contact Form Error: ' . $e->getMessage());
    }
}

    public function render()
    {
        return view('livewire.contact-form');
    }
} 