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
                'before:' . now()->addMonths(6)->format('Y-m-d')  // Không cho đặt quá xa
            ],
            'adults' => [
                'required', 
                'integer', 
                'min:1',
                'max:10'  // Giới hạn số người
            ],
            'children' => [
                'nullable', 
                'integer', 
                'min:0',
                'max:5'   // Giới hạn số trẻ em
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
            'adults.required' => 'Vui lòng nhập số người lớn',
            'adults.min' => 'Số người lớn phải ít nhất 1 người',
            'children.min' => 'Số trẻ em không thể âm',
        ];
    }
} 