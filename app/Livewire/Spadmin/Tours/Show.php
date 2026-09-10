<?php

namespace App\Livewire\Spadmin\Tours;

use Livewire\Component;
use App\Models\Tour;

class Show extends Component
{
    public Tour $tour;

    public function mount(Tour $tour)
    {
        $this->tour = $tour->load(['admin', 'destination']);
    }

    public function render()
    {
        return view('livewire.spadmin.tours.show');
    }
}
