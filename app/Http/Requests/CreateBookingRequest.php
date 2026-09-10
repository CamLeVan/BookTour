<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'booking_date' => [
                'required', 
                'date', 
                'after:today',
                'before:' . now()->addMonths(6)->format('Y-m-d')
            ],
            'adults' => [
                'required', 
                'integer', 
                'min:1',
                'max:10'
            ],
            'children' => [
                'nullable', 
                'integer', 
                'min:0',
                'max:5'
            ],
            'notes' => [
                'nullable', 
                'string', 
                'max:500'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'booking_date.required' => 'Vui lòng chọn ngày khởi hành',
            'booking_date.after' => 'Ngày khởi hành phải sau ngày hôm nay',
            'booking_date.before' => 'Không thể đặt tour quá 6 tháng trước',
            'adults.required' => 'Vui lòng nhập số người lớn',
            'adults.min' => 'Số người lớn phải ít nhất 1 người',
            'adults.max' => 'Số người lớn không được quá 10 người',
            'children.min' => 'Số trẻ em không thể âm',
            'children.max' => 'Số trẻ em không được quá 5 người',
            'notes.max' => 'Ghi chú không được quá 500 ký tự'
        ];
    }
} 