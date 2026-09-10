<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tour;

class BookingForm extends Component
{
    public Tour $tour;
    public $bookingDate;
    public $adults = 1;
    public $children = 0;
    public $notes;

    public function mount(Tour $tour)
    {
        $this->tour = $tour;
        $this->bookingDate = now()->addDay()->format('Y-m-d');
    }

    public function updateQuantity($type, $change)
    {
        if ($type === 'adults') {
            $this->adults = max(1, min(10, $this->adults + $change));
        } else {
            $this->children = max(0, min(5, $this->children + $change));
        }
    }

    public function getAdultTotalProperty()
    {
        return $this->adults * $this->tour->price;
    }

    public function getChildrenTotalProperty()
    {
        return $this->children * ($this->tour->price * 0.5);
    }

    public function getTotalAmountProperty()
    {
        return $this->adultTotal + $this->childrenTotal;
    }

    public function submit()
    {
        $this->validate([
            'bookingDate' => 'required|date|after:today|before:' . now()->addMonths(6)->format('Y-m-d'),
            'adults' => 'required|integer|min:1|max:10',
            'children' => 'nullable|integer|min:0|max:5',
            'notes' => 'nullable|string|max:500'
        ]);

        return redirect()->route('frontend.bookings.store', [
            'tour' => $this->tour,
            'booking_date' => $this->bookingDate,
            'adults' => $this->adults,
            'children' => $this->children,
            'notes' => $this->notes
        ]);
    }

    public function render()
    {
        return view('livewire.booking-form');
    }
}