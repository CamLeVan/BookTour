<?php

namespace App\Livewire\Spadmin\Revenue;

use Livewire\Component;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RevenueReport extends Component
{
    public $dateRange = 'today';
    public $chartData = [];
    public $startDate;
    public $endDate;

    public function mount()
    {
        $this->updateDateRange();
        $this->loadData();
    }

    public function updateDateRange()
    {
        switch ($this->dateRange) {
            case 'today':
                $this->startDate = Carbon::today();
                $this->endDate = Carbon::today();
                break;
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
        }
    }

    public function loadData()
    {
        $data = Booking::where('payment_status', 'paid')
            ->whereBetween('created_at', [
                $this->startDate->startOfDay(),
                $this->endDate->endOfDay()
            ])
            ->select(
                DB::raw('HOUR(created_at) as hour'),
                DB::raw('SUM(total_price) as total')
            )
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $this->chartData = $data->toArray();
    }

    private function convertToUSD($vnd)
    {
        return round($vnd / 24500, 2);
    }

    public function render()
    {
        $statistics = [
            'total_revenue' => $this->convertToUSD(
                Booking::where('payment_status', 'paid')->sum('total_price')
            ),
            'total_bookings' => Booking::where('payment_status', 'paid')->count(),
            'avg_booking_value' => $this->convertToUSD(
                Booking::where('payment_status', 'paid')->avg('total_price') ?? 0
            ),
            'period_revenue' => $this->convertToUSD(
                Booking::where('payment_status', 'paid')
                    ->whereBetween('created_at', [
                        $this->startDate->startOfDay(),
                        $this->endDate->endOfDay()
                    ])
                    ->sum('total_price')
            )
        ];

        return view('livewire.spadmin.revenue.revenue-report', [
            'statistics' => $statistics
        ]);
    }

    public function updatedDateRange()
    {
        $this->updateDateRange();
        $this->loadData();
    }
}
