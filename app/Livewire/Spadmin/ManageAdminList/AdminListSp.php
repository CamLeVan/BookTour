<?php

namespace App\Livewire\Spadmin\ManageAdminList;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Tour;

class AdminListSp extends Component
{
    use WithPagination;

    public $activeTours = [];

    // Biến tìm kiếm và lọc
    public $search = '';
    public $statusFilter = '';

    // Biến cho form
    public $editingAdminId = null;
    public $name = '';
    public $email = '';
    public $password = '';
    public $phone = '';
    public $status = 'active';

    public function mount()
    {
        // Add JavaScript for modal
        $this->dispatch('addModalListener');
    }

    // Rules validate
    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => $this->editingAdminId
                ? 'required|email|unique:users,email,' . $this->editingAdminId
                : 'required|email|unique:users,email',
            'password' => $this->editingAdminId ? 'nullable|min:6' : 'required|min:6',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'status' => 'required|in:active,inactive'
        ];
    }
    // lấy danh sách nhà cung cấp
    public function render()
    {
        $query = User::query()
            ->where('role', 'admin')
            ->withCount('tours')
            ->withSum('tours', 'price')
            ->withCount(['tours as active_tours_count' => function ($query) {
                $query->where('status', 'active');
            }]);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $statistics = [
            'total_admins' => User::where('role', 'admin')->count(),
            'active_admins' => User::where('role', 'admin')->where('status', 'active')->count(),
            'total_tours' => Tour::count(),
            'active_tours' => Tour::where('status', 'active')->count(),
        ];

        return view('livewire.spadmin.manageadminlist.admin-list-sp', [
            'admins' => $query->latest()->paginate(10),
            'statistics' => $statistics
        ]);
    }

    public function create()
    {
        $this->resetValidation();
        $this->reset(['editingAdminId', 'name', 'email', 'password', 'phone', 'status']);
        $this->dispatch('showModal');
    }

    public function store()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
            'status' => $this->status,
            'role' => 'admin'
        ]);

        session()->flash('message', 'Admin đã được thêm thành công!');
        $this->dispatch('hideModal');
        $this->reset(['name', 'email', 'password', 'phone', 'status']);
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        $this->editingAdminId = $id;
        $this->name = $admin->name;
        $this->email = $admin->email;
        $this->phone = $admin->phone;
        $this->status = $admin->status;
        $this->password = '';

        $this->dispatch('showModal');
    }

    public function update()
    {
        $this->validate();

        $admin = User::findOrFail($this->editingAdminId);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        $admin->update($data);

        session()->flash('message', 'Admin đã được cập nhật thành công!');
        $this->dispatch('hideModal');
        $this->reset(['editingAdminId', 'name', 'email', 'password', 'phone', 'status']);
    }

    public function delete($id)
    {
        $admin = User::findOrFail($id);

        // Kiểm tra xem admin có tour nào không
        if ($admin->tours()->exists()) {
            session()->flash('error', 'Không thể xóa admin này vì đang có tour liên quan!');
            return;
        }

        $admin->delete();
        session()->flash('message', 'Admin đã được xóa thành công!');
    }

    public function showActiveTours($adminId)
    {
        $this->activeTours = Tour::where('user_id', $adminId)
            ->where('status', 'active')
            ->select([
                'id',
                'name',
                'description',
                'price',
                'duration',
                'max_people',
                'image',
                'images',
                'status',
                'created_at'
            ])
            ->get();

        $this->dispatch('openActiveToursModal');
    }

    // Mở modal thêm admin
    public function openAddModal()
    {
        $this->resetForm();
        $this->dispatch('openAdminModal');
    }

    // Mở modal sửa admin
    public function openEditModal($adminId)
    {
        $this->editingAdminId = $adminId;
        $admin = User::find($adminId);

        $this->name = $admin->name;
        $this->email = $admin->email;
        $this->phone = $admin->phone;
        $this->status = $admin->status;
        $this->password = ''; // Clear password field for security

        $this->dispatch('openAdminModal');
    }

    // Reset form
    private function resetForm()
    {
        $this->editingAdminId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->phone = '';
        $this->status = 'active';
    }

    // Lưu admin (thêm/sửa)
    public function saveAdmin()
    {
        if ($this->editingAdminId) {
            // Update existing admin
            $this->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $this->editingAdminId,
                'phone' => 'required',
                'status' => 'required'
            ]);

            $admin = User::find($this->editingAdminId);
            $admin->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'status' => $this->status,
            ]);

            if ($this->password) {
                $admin->update(['password' => bcrypt($this->password)]);
            }
        } else {
            // Create new admin
            $this->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'phone' => 'required',
                'status' => 'required'
            ]);

            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'phone' => $this->phone,
                'status' => $this->status,
                'role' => 'admin'
            ]);
        }

        $this->dispatch('closeAdminModal');
        $this->resetForm();
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => $this->editingAdminId ? 'Cập nhật admin thành công!' : 'Thêm admin thành công!'
        ]);
    }
}
