<?php

namespace App\Livewire\Admin\Bookings;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $selectedBooking = null;
    public $newStatus = '';
    public $showDetailsModal = false;
    public $showStatusModal = false;

    public function render()
    {
        $query = Booking::query()
            ->whereHas('tour', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->with(['tour' => function ($query) {
                $query->select('id', 'name');
            }, 'user']);

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->whereHas('tour', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        // Apply status filter
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        // Get paginated results
        $bookings = $query->latest()
            ->paginate(10);

        // Calculate statistics
        $baseQuery = Booking::query()->whereHas('tour', function ($q) {
            $q->where('user_id', Auth::id());
        });

        return view('livewire.admin.bookings.booking-list', [
            'bookings' => $bookings,
            'totalBookings' => $baseQuery->count(),
            'completedBookings' => (clone $baseQuery)->where('status', Booking::STATUS_COMPLETED)->count(),
            'pendingBookings' => (clone $baseQuery)->where('status', Booking::STATUS_PENDING)->count(),
            'cancelledBookings' => (clone $baseQuery)->where('status', Booking::STATUS_CANCELLED)->count(),
        ]);
    }

    public function openStatusModal($bookingId)
    {
        $this->selectedBooking = Booking::find($bookingId);
        $this->newStatus = $this->selectedBooking->status;
        $this->showStatusModal = true;
        $this->dispatch('openStatusModal');
    }

    public function closeModal()
    {
        $this->selectedBooking = null;
        $this->newStatus = '';
    }

    public function updateStatus()
    {
        $this->validate([
            'newStatus' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $this->selectedBooking->update([
            'status' => $this->newStatus
        ]);

        session()->flash('message', 'Cập nhật trạng thái thành công!');
        $this->showStatusModal = false;
        $this->dispatch('closeStatusModal');
    }

    public function viewDetails($bookingId)
    {
        $this->selectedBooking = Booking::with(['tour', 'user'])->find($bookingId);
        $this->showDetailsModal = true;
        $this->dispatch('openDetailsModal');
    }

    public function confirmDelete($bookingId)
    {
        $this->selectedBooking = Booking::with(['tour', 'user'])->find($bookingId);
        $this->dispatch('openDeleteModal');
    }

    public function deleteBooking()
    {
        if ($this->selectedBooking) {
            // Kiểm tra quyền xóa
            if ($this->selectedBooking->tour->user_id !== Auth::id()) {
                session()->flash('error', 'Bạn không có quyền xóa đơn đặt tour này!');
                return;
            }

            $this->selectedBooking->delete();
            session()->flash('message', 'Xóa đơn đặt tour thành công!');
            $this->selectedBooking = null;
            $this->dispatch('closeDeleteModal');
        }
    }
}
