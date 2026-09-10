<?php

namespace App\Livewire\Spadmin\Tours;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tour;
use Illuminate\Support\Facades\Storage;

class TourListSp extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';

    public function render()
    {
        $query = Tour::with(['admin', 'destination']);

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $tours = $query->latest()->paginate(10);

        return view('livewire.spadmin.tours.tour-list-sp', [
            'tours' => $tours
        ]);
    }

    public function viewTour($id)
    {
        return redirect()->route('spadmin.tours.show', $id);
    }
    public function deleteTour($id)
    {
        try {
            $tour = Tour::findOrFail($id);

            // Xóa ảnh tour nếu có
            if ($tour->image && Storage::exists($tour->image)) {
                Storage::delete($tour->image);
            }

            // Xóa tour
            $tour->delete();

            // Thông báo thành công
            session()->flash('message', 'Xóa tour thành công!');
        } catch (\Exception $e) {
            // Thông báo lỗi
            session()->flash('error', 'Có lỗi xảy ra khi xóa tour!');
        }
    }
}
