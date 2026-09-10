<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tour;
use App\Models\Destination;

class TourSearch extends Component
{
    use WithPagination;

    public $searchTerm = '';
    public $destination = '';
    public $duration = '';
    
    protected $queryString = ['searchTerm', 'destination', 'duration'];

    public function updatingSearchTerm() { $this->resetPage(); }
    public function updatingDestination() { $this->resetPage(); }
    public function updatingDuration() { $this->resetPage(); }

    public function search()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Tour::with(['destination', 'reviews'])
            ->where('status', 'active');

        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->searchTerm . '%')
                  ->orWhereHas('destination', function($q) {
                      $q->where('name', 'like', '%' . $this->searchTerm . '%');
                  });
            });
        }

        if ($this->destination) {
            $query->where('destination_id', $this->destination);
        }

        if ($this->duration) {
            [$min, $max] = explode('-', $this->duration);
            if ($max == '+') {
                $query->where('duration', '>=', $min);
            } else {
                $query->whereBetween('duration', [$min, $max]);
            }
        }

        return view('livewire.tour-search', [
            'tours' => $query->paginate(9),
            'destinations' => Destination::all()
        ]);
    }
}
