<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact.index');
    }

    public function store(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'subject' => 'required|min:5',
            'message' => 'required|min:10'
        ], [
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
        ]);

        try {
            // Lưu vào database
            $contact = Contact::create($validated);
            
            Log::info('Contact created successfully', ['contact_id' => $contact->id]);

            // Gửi email
            Mail::to(config('mail.from.address'))
                ->queue(new ContactFormMail($validated));
                
            Log::info('Email queued successfully');

            return back()->with('success', 'Cảm ơn bạn đã liên hệ. Chúng tôi sẽ phản hồi sớm nhất có thể!');
        } catch (\Exception $e) {
            Log::error('Contact Form Error: ' . $e->getMessage());
            return back()
                ->with('error', 'Có lỗi xảy ra. Vui lòng thử lại sau!')
                ->withInput();
        }
    }
}
