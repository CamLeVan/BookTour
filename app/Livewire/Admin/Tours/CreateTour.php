<?php




namespace App\Livewire\Admin\Tours;




use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Tour;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;




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
   #[Validate('required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', message: [
       'required' => 'File ảnh bắt buộc',
       'image' => 'File không đúng định dạng',
       'mimes' => 'Chỉ chấp nhận các định dạng: jpeg, png, jpg, gif, webp',
       'max' => 'Kích thước file không được vượt quá 2MB'
   ])]
   public $image;




   #[Validate(['images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:1024'], message: [
       'images.*.image' => 'File không đúng định dạng',
       'images.*.mimes' => 'Chỉ chấp nhận các định dạng: jpeg, png, jpg, gif, webp',
       'images.*.max' => 'Kích thước mỗi file không được vượt quá 1MB'
   ])]
   public $images = [];
   public $images_arr = [];




   //  properties   theo dõi trạng thái upload
   public $tempImage = null;
   public $tempGallery = [];
   //  property để lưu schedules
   public $schedules = [];




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
       'destination_id' => 'required',
       'schedules.*.day' => 'required|integer|min:1',
       'schedules.*.title' => 'required|min:3',
       'schedules.*.description' => 'required'
   ];
   protected $messages = [
       'schedules.*.day.required' => 'Vui lòng nhập ngày',
       'schedules.*.day.integer' => 'Ngày phải là số',
       'schedules.*.day.min' => 'Ngày phải lớn hơn 0',
       'schedules.*.title.required' => 'Vui lòng nhập tiêu đề',
       'schedules.*.title.min' => 'Tiêu đề phải có ít nhất 3 ký tự',
       'schedules.*.description.required' => 'Vui lòng nhập mô tả chi tiết',
   ];




   // Tự động generate slug từ name
   public function updatedName($value)
   {
       $this->slug = Str::slug($value);
   }




   //  mount method để set user_id khi component được khởi tạo
   public function mount()
   {
       $this->user_id = Auth::id();
       //  khởi tạo schedule đầu tiên
       $this->schedules = [
           [
               'day' => 1,
               'title' => '',
               'description' => ''
           ]
       ];
   }




   public function createTour()
   {
       try {
           Log::info('=== BẮT ĐẦU TẠO TOUR MỚI ===');
           $this->validate();




           // 1. Xử lý ảnh chính
           $imageName = null;
           if ($this->image) {
               try {
                   $imageName = time() . '-' . Str::slug(pathinfo($this->image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $this->image->getClientOriginalExtension();




                   // Sử dụng File facade
                   File::ensureDirectoryExists(public_path('frontend/img/tours'), 0777);
                   File::copy(
                       $this->image->getRealPath(),
                       public_path('frontend/img/tours/' . $imageName)
                   );




                   Log::info('Ảnh chính đã được lưu: ' . $imageName);
               } catch (\Exception $e) {
                   Log::error('Lỗi xử lý ảnh chính: ' . $e->getMessage());
                   throw new \Exception('Không thể lưu ảnh chính: ' . $e->getMessage());
               }
           }




           // 2. Xử lý gallery
           $galleryPaths = [];
           if (!empty($this->images)) {
               File::ensureDirectoryExists(public_path('frontend/img/gallery'), 0777);




               foreach ($this->images as $image) {
                   try {
                       $galleryName = time() . '-' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();




                       File::copy(
                           $image->getRealPath(),
                           public_path('frontend/img/gallery/' . $galleryName)
                       );




                       $galleryPaths[] = $galleryName;
                       Log::info('Ảnh gallery đã được lưu: ' . $galleryName);
                   } catch (\Exception $e) {
                       Log::error('Lỗi xử lý ảnh gallery: ' . $e->getMessage());
                       continue;
                   }
               }
           }




           // 3. Tạo tour
           $tour = Tour::create([
               'name' => $this->name,
               'slug' => $this->slug,
               'description' => $this->description,
               'price' => $this->price,
               'duration' => $this->duration,
               'max_people' => $this->max_people,
               'image' => $imageName,
               'gallery' => json_encode($galleryPaths),
               'status' => $this->status,
               'status_approval' => 'pending',
               'destination_id' => $this->destination_id,
               'user_id' => $this->user_id
           ]);


           // Thêm lịch trình
           foreach ($this->schedules as $schedule) {
               $tour->schedules()->create([
                   'day' => $schedule['day'],
                   'title' => $schedule['title'],
                   'description' => $schedule['description']
               ]);
           }




           Log::info('Tour đã được tạo thành công với ID: ' . $tour->id);
           session()->flash('message', 'Tour đã được tạo thành công!');
           return redirect()->route('admin.tours.index');
       } catch (\Exception $e) {
           Log::error('Lỗi: ' . $e->getMessage());
           session()->flash('error', $e->getMessage());
           return null;
       }
   }


   public function updatedDuration($value)
   {
       // Xóa tất cả schedules hiện tại
       $this->schedules = [];


       // Tạo mới schedules dựa trên số ngày
       for ($i = 1; $i <= $value; $i++) {
           $this->schedules[] = [
               'day' => $i,
               'title' => "Ngày $i - ",  // Tiêu đề mặc định
               'description' => ''
           ];
       }
   }




   public function render()
   {
       $destinations = \App\Models\Destination::where('status', 'active')->get();
       return view('livewire.admin.tours.create-tour', [
           'destinations' => $destinations
       ]);
   }




   // xử lý ảnh
   public function removeImage()
   {
       $this->image = null;
       $this->tempImage = null;
   }




   public function removeGalleryImage($index)
   {
       unset($this->images[$index]);
       unset($this->tempGallery[$index]);
       $this->images = array_values($this->images);
       $this->tempGallery = array_values($this->tempGallery);
   }




   public function updatedImage()
   {
       try {
           $this->validate([
               'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
           ]);
           $this->tempImage = $this->image->temporaryUrl();
       } catch (\Exception $e) {
           $this->image = null;
           $this->addError('image', 'Có lỗi khi tải ảnh. Vui lòng thử lại.');
       }
   }




   public function updatedImages()
   {
       try {
           $this->validate([
               'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:1024'
           ]);




           foreach ($this->images as $key => $image) {
               $this->tempGallery[$key] = $image->temporaryUrl();
           }
       } catch (\Exception $e) {
           $this->images = [];
           $this->tempGallery = [];
           $this->addError('images', 'Có lỗi khi tải ảnh. Vui lòng thử lại.');
       }
   }
}



