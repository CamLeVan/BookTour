<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination; 
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingHistory extends Component
{
    use WithPagination;

    public $statusFilters = []; // Bộ lọc trạng thái
    public $timeFilter; // Bộ lọc thời gian (upcoming hoặc past)
    public $paymentFilter; // Bộ lọc trạng thái thanh toán (paid hoặc unpaid)
    public $searchQuery = ''; // Bộ lọc tìm kiếm theo tên, email, hoặc mã đặt chỗ

    protected $queryString = [
        'statusFilters' => ['except' => []],
        'timeFilter' => ['except' => null],
        'paymentFilter' => ['except' => null],
        'searchQuery' => ['except' => ''],
    ];

    public function mount()
    {
        // Thiết lập giá trị mặc định
        $this->statusFilters = $this->statusFilters ?? [];
        $this->timeFilter = $this->timeFilter ?? null;
        $this->paymentFilter = $this->paymentFilter ?? null;
        $this->searchQuery = $this->searchQuery ?? '';
    }

    public function cancelBooking($bookingId)
    {
        // Tìm booking theo ID
        $booking = Booking::find($bookingId);

        if (!$booking) {
            session()->flash('error', 'Không tìm thấy đơn đặt chỗ.');
            return;
        }

        if ($booking->status === 'cancelled') {
            session()->flash('error', 'Đơn đặt chỗ đã bị hủy trước đó.');
            return;
        }

        if ($booking->status === 'completed') {
            session()->flash('error', 'Không thể hủy đơn đặt chỗ đã hoàn thành.');
            return;
        }

        $booking->status = 'cancelled';
        $booking->save();

        session()->flash('success', 'Đơn đặt chỗ đã được hủy thành công.');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'statusFilters' => 'array',
            'timeFilter' => 'nullable|in:upcoming,past',
            'paymentFilter' => 'nullable|in:paid,unpaid',
            'searchQuery' => 'nullable|string|max:255',
        ]);

        $this->resetPage(); // Reset về trang đầu tiên khi có sự thay đổi bộ lọc
    }

    public function getBookings()
    {
        $query = Booking::where('user_id', Auth::id());

        // Bộ lọc trạng thái
        if (!empty($this->statusFilters)) {
            $query->whereIn('status', $this->statusFilters);
        }

        // Bộ lọc thời gian
        if ($this->timeFilter) {
            if ($this->timeFilter === 'upcoming') {
                $query->where('booking_date', '>=', now());
            } elseif ($this->timeFilter === 'past') {
                $query->where('booking_date', '<', now());
            }
        }

        // Bộ lọc trạng thái thanh toán
        if ($this->paymentFilter) {
            $query->where('payment_status', $this->paymentFilter);
        }

        // Bộ lọc tìm kiếm
        if (!empty($this->searchQuery)) {
            $query->whereHas('tour', function ($tourQuery) {
                $tourQuery->where('name', 'like', '%' . $this->searchQuery . '%');
            });
        }

        return $query->orderBy('booking_date', 'desc')->paginate(10);
    }

    public function render()
    {
        return view('livewire.booking-history', [
            'bookings' => $this->getBookings(),
        ]);
    }
}
