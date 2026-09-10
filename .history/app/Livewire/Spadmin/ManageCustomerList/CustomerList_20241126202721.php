<?php

namespace App\Livewire\Spadmin\ManageCustomerList;

use App\Models\Booking;
use App\Models\User;
use Livewire\Component;

class CustomerList extends Component
{
    // Properties cho form và filter
    public $search = '';
    public $paymentFilter = '';
    public $dateFilter = '';

    // Properties cho booking history modal
    public $selectedCustomer;
    public $bookingHistory = [];

    public function render()
    {
        $query = User::where('role', 'customer')
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('phone', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->paymentFilter, function ($q) {
                $q->whereHas('bookings', function ($query) {
                    $query->where('payment_status', $this->paymentFilter);
                });
            })
            ->when($this->dateFilter, function ($q) {
                switch ($this->dateFilter) {
                    case 'today':
                        $q->whereDate('created_at', today());
                        break;
                    case 'week':
                        $q->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                        break;
                    case 'month':
                        $q->whereMonth('created_at', now()->month);
                        break;
                }
            })
            ->withCount([
                'bookings',
                'paidBookings'
            ])
            ->withSum('paidBookings as total_spent', 'total_price');

        $customers = $query->paginate(10);

        $statistics = [
            'total_customers' => User::where('role', 'customer')->count(),
            'paid_customers' => User::whereHas('bookings', function ($q) {
                $q->where('payment_status', 'paid');
            })->count(),
            'total_bookings' => Booking::count(),
            'total_revenue' => Booking::where('payment_status', 'paid')->sum('total_price'),
        ];

        return view('livewire.spadmin.managecustomerlist.customer-list', [
            'customers' => $customers,
            'statistics' => $statistics
        ]);
    }

    // Xem lịch sử đặt tour
    public function showBookingHistory($customerId)
    {
        $this->selectedCustomer = User::find($customerId);
        $this->bookingHistory = Booking::where('user_id', $customerId)
            ->with(['tour'])
            ->latest()
            ->get();

        $this->dispatch('openBookingModal');
    }

    // Cập nhật trạng thái khách hàng
    public function updateStatus($customerId, $status)
    {
        $customer = User::find($customerId);
        $customer->update(['status' => $status]);

        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Cập nhật trạng thái thành công!'
        ]);
    }
}
