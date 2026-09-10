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

    public function submitForm()
    {
        $this->validate();

        // Gửi email thông báo
        Mail::to('admin@hctravel.com')->send(new ContactFormMail([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message
        ]));

        session()->flash('message', 'Cảm ơn bạn đã liên hệ với chúng tôi!');
        
        $this->reset();
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
} 