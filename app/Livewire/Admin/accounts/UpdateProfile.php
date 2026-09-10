<?php

namespace App\Livewire\Admin\Accounts;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Log;


class UpdateProfile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $address;
    public $photo;
    public $currentAvatar;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->currentAvatar = $user->avatar;
    }

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'address' => 'nullable|min:5',
        'photo' => 'nullable|image|max:1024', // max 1MB
    ];

    public function updateProfile()
    {
        $this->validate();

        try {
            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
            ];

            // Xử lý upload ảnh nếu có
            if ($this->photo) {
                // Xóa ảnh cũ nếu có
                if ($this->currentAvatar && Storage::exists('public/avatars/' . $this->currentAvatar)) {
                    Storage::delete('public/avatars/' . $this->currentAvatar);
                }

                // Upload ảnh mới
                $fileName = time() . '_' . $this->photo->getClientOriginalName();
                $this->photo->storeAs('public/avatars', $fileName);
                $data['avatar'] = $fileName;

                // Cập nhật currentAvatar với tên file mới
                $this->currentAvatar = $fileName;
            }

            // Update database
            DB::table('users')
                ->where('id', Auth::id())
                ->update($data);

            // Reset photo để xóa preview
            $this->photo = null;

            session()->flash('success', 'Cập nhật thông tin thành công!');

            // Sử dụng redirect full page để đảm bảo reload đúng
            return redirect()->to(request()->header('Referer'));
        } catch (\Exception $e) {

            session()->flash('error', 'Có lỗi xảy ra khi cập nhật thông tin!');
        }
    }

    // Thêm method để refresh data
    public function refreshData()
    {
        $user = Auth::user();
        $this->currentAvatar = $user->avatar;
    }

    public function render()
    {
        return view('livewire.admin.accounts.updateprofile');
    }
}
