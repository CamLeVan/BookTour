<?php

namespace App\Livewire\Admin\Tours;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Tour;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CreateTour extends Component
{
    use WithFileUploads;

    // Định nghĩa các properties
    public $name;
    public $slug;
    public $description;
    public $price;
    public $duration;
    public $max_people;
    public $destination_id;
    public $user_id;

    public $status;
    //image
    #[Validate('required|image|max:2048', message: [
        'required' => 'Ảnh chính là bắt buộc',
        'image' => 'File không đúng định dạng',
        'max' => 'Ảnh không được vượt quá 2MB'
    ])]
    public $image;

    // 3 Ảnh phụ
    public $images = [];
    public $images_arr = [];

    // Quy tắc validation
    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'slug' => 'required|unique:tours',
            'description' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required',
            'max_people' => 'required|numeric',
            'image' => 'required|image|max:2048',
            'images' => 'required|array|min:3|max:3', // Bắt buộc đúng 3 ảnh
            'images.*' => 'image|max:1024',
            'status' => 'required',
            'destination_id' => 'required'
        ];
    }

    protected function messages()
    {
        return [
            'images.required' => 'Vui lòng chọn 3 ảnh phụ',
            'images.min' => 'Vui lòng chọn đủ 3 ảnh phụ',
            'images.max' => 'Chỉ được chọn tối đa 3 ảnh phụ',
            'images.*.image' => 'File không đúng định dạng',
            'images.*.max' => 'Mỗi ảnh không được vượt quá 1MB'
        ];
    }

    // Tự động generate slug từ name
    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    // Thêm mount method để set user_id khi component được khởi tạo
    public function mount()
    {
        $this->user_id = Auth::id();
    }

    public function createTour()
    {
        $this->validate();

        try {
            // Xử lý ảnh chính - lưu vào public/frontend/img/tours
            $mainImageName = 'main_' . time() . '_' . $this->image->getClientOriginalName();
            $mainImagePath = 'frontend/img/tours/' . $mainImageName;
            
            // Resize và lưu ảnh chính
            $img = Image::make($this->image->getRealPath());
            $img->fit(800, 600);
            $img->save(public_path($mainImagePath));

            // Xử lý 3 ảnh phụ - lưu vào public/frontend/img/gallery
            $subImagePaths = [];
            foreach ($this->images as $index => $image) {
                $subImageName = 'sub_' . time() . '_' . ($index + 1) . '_' . $image->getClientOriginalName();
                $subImagePath = 'frontend/img/gallery/' . $subImageName;
                
                // Resize và lưu ảnh phụ
                $img = Image::make($image->getRealPath());
                $img->fit(400, 300);
                $img->save(public_path($subImagePath));
                
                $subImagePaths[] = $subImagePath;
            }

            // Tạo tour với ảnh
            Tour::create([
                'name' => $this->name,
                'slug' => $this->slug,
                'description' => $this->description,
                'price' => $this->price,
                'duration' => $this->duration,
                'max_people' => $this->max_people,
                'image' => $mainImagePath,
                'images' => implode('#', $subImagePaths),
                'status' => $this->status,
                'destination_id' => $this->destination_id,
                'user_id' => $this->user_id
            ]);

            session()->flash('message', 'Tour được tạo thành công!');
            return redirect()->route('admin.tours.index');

        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $destinations = \App\Models\Destination::where('status', 'active')->get();
        return view('livewire.admin.tours.create-tour', [
            'destinations' => $destinations
        ]);
    }
}
