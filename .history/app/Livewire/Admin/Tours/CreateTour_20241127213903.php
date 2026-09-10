<?php

namespace App\Livewire\Admin\Tours;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Tour;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

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
    #[Validate('required|image|max:2048', message: ['required' => 'File ảnh bắt buộc', 'image' => 'File không đúng định dạng'])]
    public $image;

    #[Validate(['images.*' => 'image|max:1024'])]
    public $images = [];
    public $images_arr = [];

    // Quy tắc validation
    protected $rules = [
        'name' => 'required|min:3',
        'slug' => 'required|unique:tours',
        'description' => 'required',
        'price' => 'required|numeric',
        'duration' => 'required',
        'max_people' => 'required|numeric',
        'image' => 'required|image|max:2048',
        'images.*' => 'image|max:2048',
        'status' => 'required',
        'destination_id' => 'required'
    ];

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

        // Xử lý upload ảnh
        $imageName = $this->image->storeAs(path: 'public/tours/', name: $this->image->getClientOriginalName());
        $path = 'public/tours/' . $this->image->getClientOriginalName();
        // xử lý upload nhiều ảnh
        foreach ($this->images as $item) {
            $item->storeAs(path: 'public/tours/', name: $item->getClientOriginalName());
            $path = 'public/tours/' . $item->getClientOriginalName();
            array_push($this->images_arr, $path);
            $paths = implode('#', $this->images_arr);
        }


        // Tạo tour mới
        Tour::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'duration' => $this->duration,
            'max_people' => $this->max_people,
            'image' => $path,
            'images' => $paths,
            'status' => $this->status,
            'destination_id' => $this->destination_id,
            'user_id' => $this->user_id
        ]);

        session()->flash('message', 'Tour created successfully!');
        return redirect()->route('admin.tours.index');
    }

    public function render()
    {
        $destinations = \App\Models\Destination::where('status', 'active')->get();
        return view('livewire.admin.tours.create-tour', [
            'destinations' => $destinations
        ]);
    }
}
