<?php

namespace App\Http\Requests;

use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'tour_id' => [
                'required',
                'exists:tours,id',
                function ($attribute, $value, $fail) {
                    $tour = Tour::find($value);
                    if ($tour && $tour->status !== 'active') {
                        $fail('Tour này hiện không khả dụng.');
                    }
                },
            ],
            'booking_date' => [
                'required',
                'date',
                'after:' . now()->addDays(2),
                function ($attribute, $value, $fail) {
                    $date = Carbon::parse($value);
                    if ($date->isWeekend() && !$this->tour->weekend_available) {
                        $fail('Tour này không hoạt động vào cuối tuần.');
                    }
                },
            ],
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'notes' => 'nullable|string|max:500',
        ];
    }

    public function authorize()
    {
        return true;
    }
} 