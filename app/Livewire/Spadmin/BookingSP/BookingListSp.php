<?php

namespace App\Livewire\Spadmin\BookingSp;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Booking;

class BookingListSp extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $adminFilter = '';

    public function render()
    {
        $query = Booking::query()
            ->with(['tour', 'tour.admin', 'user']) // Eager load relationships
            ->join('tours', 'bookings.tour_id', '=', 'tours.id')
            ->join('users', 'tours.user_id', '=', 'users.id')
            ->select('bookings.*');

        // Tìm kiếm
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('bookings.id', 'like', '%' . $this->search . '%')
                    ->orWhere('users.name', 'like', '%' . $this->search . '%')
                    ->orWhere('tours.name', 'like', '%' . $this->search . '%');
            });
        }

        // Lọc theo trạng thái
        if ($this->statusFilter) {
            $query->where('bookings.status', $this->statusFilter);
        }

        // Lọc theo admin
        if ($this->adminFilter) {
            $query->where('tours.user_id', $this->adminFilter);
        }

        $bookings = $query->latest()->paginate(10);

        return view('livewire.spadmin.bookingSp.booking-list-sp', [
            'bookings' => $bookings
        ]);
    }

    public function viewBooking($id)
    {
        return redirect()->route('spadmin.bookings.show', $id);
    }

    public function updateStatus($id, $status)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $status]);
        session()->flash('message', 'Cập nhật trạng thái thành công!');
    }
}
