<?php

namespace App\Livewire\Admin\Tours;

use App\Models\Tour;
use App\Models\Destination;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditTour extends Component
{
    use WithFileUploads;

    public $tour;
    public $tourId;
    public $name;
    public $destination_id;
    public $price;
    public $duration;
    public $max_people;
    public $status;
    public $newImage;
    public $destinations;

    protected $rules = [
        'name' => 'required|min:3',
        'destination_id' => 'required|exists:destinations,id',
        'price' => 'required|numeric|min:0',
        'duration' => 'required|numeric|min:1',
        'max_people' => 'required|numeric|min:1',
        'status' => 'required|in:active,inactive',
        'newImage' => 'nullable|image|max:1024'
    ];

    public function mount($tourId)
    {
        $this->tourId = $tourId;
        $this->tour = Tour::findOrFail($tourId);
        $this->destinations = Destination::all();

        // Populate form fields
        $this->name = $this->tour->name;
        $this->destination_id = $this->tour->destination_id;
        $this->price = $this->tour->price;
        $this->duration = $this->tour->duration;
        $this->max_people = $this->tour->max_people;
        $this->status = $this->tour->status;
    }

    public function render()
    {
        return view('livewire.admin.tours.edit-tour');
    }

    public function updateTour()
    {
        $this->validate();

        try {
            $this->tour->update([
                'name' => $this->name,
                'destination_id' => $this->destination_id,
                'price' => $this->price,
                'duration' => $this->duration,
                'max_people' => $this->max_people,
                'status' => $this->status,
            ]);

            if ($this->newImage) {
                // Delete old image
                if ($this->tour->image && Storage::exists($this->tour->image)) {
                    Storage::delete($this->tour->image);
                }
                // Store new image
                $this->tour->image = $this->newImage->store('tours', 'public');
                $this->tour->save();
            }

            session()->flash('message', 'Tour đã được cập nhật thành công!');
            return redirect()->route('admin.tours.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra khi cập nhật tour!');
        }
    }
}
