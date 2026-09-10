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
            'booking_date' => ['required', 'date', 'after:today'],
            'adults' => ['required', 'integer', 'min:1'],
            'children' => ['nullable', 'integer', 'min:0'],
            'notes' => ['nullable', 'string', 'max:500'],
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