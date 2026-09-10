<?php

namespace App\Livewire\Spadmin\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserReport extends Component
{
    public $dateRange = 'month';
    public $chartData = [];
    public $startDate;
    public $endDate;
    public $showUserModal = false;
    public $editUserModal = false;
    public $selectedUser = null;

    public function mount()
    {
        $this->updateDateRange();
        $this->loadData();
    }

    public function updateDateRange()
    {
        switch ($this->dateRange) {
            case 'week':
                $this->startDate = Carbon::now()->startOfWeek();
                $this->endDate = Carbon::now()->endOfWeek();
                break;
            case 'month':
                $this->startDate = Carbon::now()->startOfMonth();
                $this->endDate = Carbon::now()->endOfMonth();
                break;
            case 'year':
                $this->startDate = Carbon::now()->startOfYear();
                $this->endDate = Carbon::now()->endOfYear();
                break;
            case 'all':
                $this->startDate = Carbon::now()->subYears(5);
                $this->endDate = Carbon::now();
                break;
        }
    }

    public function loadData()
    {
        // Thống kê đăng ký người dùng theo thời gian
        $registrations = User::where('role', 'user')
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $this->chartData = $registrations->toArray();
    }

    public function render()
    {
        // Thống kê chung
        $statistics = [
            'total_users' => User::where('role', 'user')->count(),
            'active_users' => Booking::where('created_at', '>=', Carbon::now()->subDays(30))
                ->distinct('user_id')
                ->count('user_id'),
            'new_users' => User::where('role', 'user')
                ->whereBetween('created_at', [$this->startDate, $this->endDate])
                ->count(),
            'avg_booking_per_user' => round(Booking::where('payment_status', 'paid')
                ->count() / User::where('role', 'user')->count(), 2),
            'top_users' => User::where('role', 'user')
                ->withCount(['bookings' => function ($query) {
                    $query->where('payment_status', 'paid');
                }])
                ->withSum(['bookings' => function ($query) {
                    $query->where('payment_status', 'paid');
                }], 'total_price')
                ->orderByDesc('bookings_sum_total_price')
                ->limit(5)
                ->get()
        ];

        return view('livewire.spadmin.users.user-report', [
            'statistics' => $statistics
        ]);
    }

    public function updatedDateRange()
    {
        $this->updateDateRange();
        $this->loadData();
    }

    // Xem chi tiết người dùng
    public function viewUserDetails($userId)
    {
        $this->selectedUser = User::with(['bookings' => function ($query) {
            $query->where('payment_status', 'paid')
                ->orderBy('created_at', 'desc')
                ->limit(5);
        }])->findOrFail($userId);

        $this->dispatch('show-user-modal');
    }

    // Chỉnh sửa thông tin người dùng
    public function editUser($userId)
    {
        $this->selectedUser = User::findOrFail($userId);
        $this->dispatch('show-edit-modal');
    }

    public function updateUser()
    {
        // Validate và update user
        $this->selectedUser->save();
        $this->dispatch('hide-edit-modal');
        $this->dispatch('user-updated');
    }
}
