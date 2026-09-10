<?php

namespace App\Livewire\Spadmin\ManageCustomerList;

use App\Models\Booking;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerList extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $paymentFilter = '';
    public $dateFilter = '';
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
                if ($this->paymentFilter === 'paid') {
                    $q->whereHas('bookings', function ($query) {
                        $query->where('payment_status', 'paid');
                    });
                } else if ($this->paymentFilter === 'unpaid') {
                    $q->whereDoesntHave('bookings', function ($query) {
                        $query->where('payment_status', 'paid');
                    });
                }
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
            });

        $customers = $query->withCount(['bookings', 'paidBookings'])
            ->withSum('bookings as total_spent', 'total_price')
            ->latest()
            ->paginate(10);

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

    public function showBookingHistory($customerId)
    {
        $this->selectedCustomer = User::find($customerId);
        $this->bookingHistory = Booking::where('user_id', $customerId)
            ->with(['tour'])
            ->latest()
            ->get();

        $this->dispatch('openBookingModal');
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->paymentFilter = '';
        $this->dateFilter = '';
    }
}
