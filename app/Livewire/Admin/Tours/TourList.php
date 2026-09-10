<?php

namespace App\Livewire\Admin\Tours;

use App\Models\Tour;
use App\Models\Destination;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ToursExport;

class TourList extends Component
{
    use WithFileUploads, WithPagination;

    public $showEditModal = false;
    public $editingTour;
    public $tourId;

    // Fields for editing
    public $name;

    public $price;
    public $duration;
    public $max_people;

    public $newImage;

    public $destinations;

    public $search = '';
    public $status = '';
    public $destination_id = '';
    public $dateRange = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
        'destination_id' => ['except' => ''],
        'dateRange' => ['except' => '']
    ];

    public function mount()
    {
        $this->destinations = Destination::all();
    }
    protected $rules = [
        'name' => 'required|min:3',
        'destination_id' => 'required|exists:destinations,id',
        'price' => 'required|numeric|min:0',
        'duration' => 'required|numeric|min:1',
        'max_people' => 'required|numeric|min:1',
        'status' => 'required|in:active,inactive',
        'newImage' => 'nullable|image|max:1024'
    ];

    public function render()
    {
        $query = Tour::query()
            ->where('user_id', Auth::id())
            ->with('destination');

        // Tìm kiếm theo tên
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // Lọc theo trạng thái
        if ($this->status) {
            $query->where('status', $this->status);
        }

        // Lọc theo điểm đến
        if ($this->destination_id) {
            $query->where('destination_id', $this->destination_id);
        }

        // Lọc theo ngày
        if ($this->dateRange) {
            $dates = explode(' to ', $this->dateRange);
            if (count($dates) == 2) {
                $query->whereBetween('created_at', [
                    Carbon::parse($dates[0])->startOfDay(),
                    Carbon::parse($dates[1])->endOfDay()
                ]);
            }
        }

        $tours = $query->latest()->paginate($this->perPage);

        return view('livewire.admin.tours.tour-list', [
            'tours' => $tours,
            'destinations' => Destination::all()
        ]);
    }

    public function editTour($id)
    {
        $tour = Tour::findOrFail($id);
        $this->name = $tour->name;
        $this->destination_id = $tour->destination_id;
        $this->price = $tour->price;
        $this->duration = $tour->duration;
        $this->max_people = $tour->max_people;
        $this->status = $tour->status;

        $this->dispatch('show-edit-modal');
    }
    public function updateTour()
    {
        $this->validate();

        try {
            $tour = Tour::findOrFail($this->editingTourId);

            $tour->update([
                'name' => $this->name,
                'destination_id' => $this->destination_id,
                'price' => $this->price,
                'duration' => $this->duration,
                'max_people' => $this->max_people,
                'status' => $this->status,
            ]);

            if ($this->newImage) {
                // Xóa ảnh cũ nếu có
                if ($tour->image && Storage::exists($tour->image)) {
                    Storage::delete($tour->image);
                }
                // Lưu ảnh mới
                $tour->image = $this->newImage->store('tours', 'public');
                $tour->save();
            }

            $this->showEditModal = false;
            $this->reset(['newImage']);
            session()->flash('message', 'Tour đã được cập nhật thành công!');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra khi cập nhật tour!');
        }
    }

    public function confirmDelete($id)
    {
        $tour = Tour::find($id);

        if (!$tour) {
            $this->dispatch('swal:error', [
                'type' => 'error',
                'title' => 'Lỗi!',
                'text' => 'Không tìm thấy tour.',
            ]);
            return;
        }

        $this->dispatch('swal:confirm', [
            'type' => 'warning',
            'title' => 'Xác nhận xóa?',
            'html' => "
                <div class='text-start'>
                    <p>Trước khi xóa tour, hãy đảm bảo:</p>
                    <ul>
                        <li>Tour không có đơn đặt tour nào</li>
                        <li>Tour đã được tạm dừng</li>
                        <li>Đã đợi 24 giờ sau khi tạm dừng</li>
                    </ul>
                    <p class='text-danger'>Lưu ý: Hành động này không thể hoàn tác!</p>
                </div>
            ",
            'id' => $id,
            'showCancelButton' => true,
            'confirmButtonText' => 'Có, xóa tour!',
            'cancelButtonText' => 'Hủy',
            'confirmButtonColor' => '#d33',
            'cancelButtonColor' => '#3085d6'
        ]);
    }

    public function deleteTour($id)
    {
        try {
            $tour = Tour::where('user_id', Auth::id())->findOrFail($id);

            // 1. Kiểm tra tour có đơn đặt tour không
            if ($tour->bookings()->exists()) {
                $this->dispatch('swal:error', [
                    'type' => 'error',
                    'title' => 'Không thể xóa!',
                    'text' => 'Tour đã có người đặt. Không thể xóa tour này.',
                ]);
                return;
            }

            // 2. Kiểm tra trạng thái tour
            if ($tour->status === 'active') {
                $this->dispatch('swal:error', [
                    'type' => 'warning',
                    'title' => 'Tour đang hoạt động!',
                    'text' => 'Bạn cần tạm dừng tour trước khi xóa.',
                ]);
                return;
            }

            // 3. Kiểm tra thời gian chờ sau khi tạm dừng (ví dụ: 24h)
            $waitingTime = now()->diffInHours($tour->updated_at);
            if ($waitingTime < 24) {
                $this->dispatch('swal:error', [
                    'type' => 'warning',
                    'title' => 'Chưa thể xóa!',
                    'text' => 'Vui lòng đợi 24 giờ sau khi tạm dừng tour để xóa.',
                ]);
                return;
            }

            // 4. Tiến hành xóa nếu thỏa mãn điều kiện
            if ($tour->image && Storage::exists('public/' . $tour->image)) {
                Storage::delete('public/' . $tour->image);
            }

            $tour->delete();

            $this->dispatch('swal:success', [
                'type' => 'success',
                'title' => 'Đã xóa!',
                'text' => 'Tour đã được xóa thành công.',
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting tour: ' . $e->getMessage());
            $this->dispatch('swal:error', [
                'type' => 'error',
                'title' => 'Lỗi!',
                'text' => 'Có lỗi xảy ra khi xóa tour.',
            ]);
        }
    }

    public function closeModal()
    {
        $this->showEditModal = false;
        $this->reset();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function export($type)
    {
        $filename = 'danh-sach-tour-' . date('Y-m-d') . '.xlsx';

        return Excel::download(
            new ToursExport(
                $this->search,
                $this->status,
                $this->destination_id,
                $this->dateRange
            ),
            $filename
        );
    }
}
