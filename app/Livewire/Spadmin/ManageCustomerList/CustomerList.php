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
        $query = User::where('role', 'user')
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('phone', 'like', '%' . $this->search . '%');
                });
            });

        $customers = $query->withCount([
                'bookings',
                'bookings as paidBookings_count' => function ($query) {
                    $query->where('payment_status', 'paid');
                }
            ])
            ->withSum('bookings as total_spent', 'total_amount')
            ->latest()
            ->paginate(10);

        $statistics = [
            'total_customers' => User::where('role', 'user')->count(),
            'active_customers' => User::where('role', 'user')
                ->whereHas('bookings', function($q) {
                    $q->where('payment_status', 'paid');
                })->count(),
            'total_bookings' => Booking::count(),
            'total_revenue' => Booking::where('payment_status', 'paid')->sum('total_amount')
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
