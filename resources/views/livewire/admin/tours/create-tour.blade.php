<div id="app-layout">
    <div class="content" style="padding-top: 2rem">
        <div class="container-xxl">
            <style>
                .custom-file-upload {
                    position: relative;
                    width: 100%;
                    margin-bottom: 1rem;
                }
 
 
 
 
                .custom-file-upload input[type="file"] {
                    display: none;
                }
 
 
 
 
                .custom-file-button {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    padding: 8px 16px;
                    background-color: #f8f9fa;
                    border: 1px solid #dee2e6;
                    border-radius: 4px;
                    cursor: pointer;
                    transition: all 0.2s ease;
                }
 
 
 
 
                .custom-file-button:hover {
                    background-color: #e9ecef;
                    border-color: #ced4da;
                }
 
 
 
 
                .custom-file-button i {
                    font-size: 1.2rem;
                    color: #6c757d;
                }
 
 
 
 
                .custom-file-label {
                    margin-left: 8px;
                    color: #6c757d;
                    font-size: 0.9rem;
                }
 
 
 
 
                .custom-file-preview {
                    margin-top: 8px;
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    padding: 8px;
                    background-color: #fff;
                    border: 1px solid #dee2e6;
                    border-radius: 4px;
                }
 
 
 
 
                .preview-icon {
                    color: #28a745;
                    font-size: 1.1rem;
                }
 
 
 
 
                .preview-name {
                    flex: 1;
                    color: #212529;
                    font-size: 0.9rem;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }
 
 
 
 
                .preview-remove {
                    color: #dc3545;
                    cursor: pointer;
                    padding: 4px;
                    border-radius: 4px;
                    transition: all 0.2s ease;
                }
 
 
 
 
                .preview-remove:hover {
                    background-color: #f8d7da;
                }
            </style>
            <!-- Thông báo -->
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
 
 
 
 
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tạo Tour Mới</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="createTour" class="was-validated">
                        <div class="row">
                            <!-- Cột trái - Phần preview ảnh -->
                            <div class="col-md-4">
                                <div class="image-preview-section mb-4">
                                    <label class="form-label fw-bold">Ảnh đại diện</label>
                                    <div class="main-image-preview mb-3">
                                        @if ($tempImage)
                                            <div class="image-container"
                                                style="width: 100%; max-height: 400px; min-height: 300px; overflow: hidden;">
                                                <img src="{{ $tempImage }}" class="img-fluid rounded mb-2"
                                                    style="width: 100%; height: 100%; object-fit: contain;">
                                            </div>
                                        @else
                                            <div class="placeholder-image"
                                                style="width: 100%; height: 300px; background: #f8f9fa;
                                                    border: 2px dashed #dee2e6; border-radius: 4px;
                                                    display: flex; align-items: center; justify-content: center;">
                                                <span class="text-muted">Chưa có ảnh đại diện</span>
                                            </div>
                                        @endif
 
 
 
 
                                        <div class="custom-file-upload">
                                            <label for="image" class="custom-file-button">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <span>Chọn ảnh đại diện</span>
                                            </label>
                                            <input type="file" wire:model="image" id="image" class="d-none"
                                                required>
                                            @if ($tempImage)
                                                <div class="custom-file-preview">
                                                    <i class="fas fa-check-circle preview-icon"></i>
                                                    <span
                                                        class="preview-name">{{ $image->getClientOriginalName() }}</span>
                                                    <span class="preview-remove" wire:click="removeImage">
                                                        <i class="fas fa-times"></i>
                                                    </span>
                                                </div>
                                            @endif
                                            @error('image')
                                                <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
 
 
 
 
                                    <label class="form-label fw-bold">Ảnh chi tiết</label>
                                    <div class="gallery-preview">
                                        <div class="row g-2">
                                            @if ($tempGallery)
                                                @foreach ($tempGallery as $index => $url)
                                                    <div class="col-4 position-relative">
                                                        <div style="aspect-ratio: 1; overflow: hidden;">
                                                            <img src="{{ $url }}" class="img-fluid rounded"
                                                                style="width: 100%; height: 100%; object-fit: cover;">
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1"
                                                                wire:click="removeGalleryImage({{ $index }})">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
 
 
 
 
                                        <div class="custom-file-upload mt-3">
                                            <label for="images" class="custom-file-button">
                                                <i class="fas fa-images"></i>
                                                <span>Chọn ảnh chi tiết</span>
                                            </label>
                                            <input type="file" wire:model="images" id="images" class="d-none"
                                                multiple>
                                            @error('images')
                                                <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                            @enderror
                                            @error('images.*')
                                                <span class="text-danger mt-1 d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
 
 
 
 
                            <!-- Cột phải - Form nhập liệu -->
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <!-- Điểm đến -->
                                    <div class="col-12">
                                        <label class="form-label">Điểm đến</label>
                                        <select wire:model="destination_id" class="form-select" required>
                                            <option value="">Chọn điểm đến</option>
                                            @foreach ($destinations as $destination)
                                                <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('destination_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
 
 
 
 
                                    <!-- Tên tour -->
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Tên tour</label>
                                        <input type="text" wire:model="name" class="form-control" id="name"
                                            required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
 
 
 
 
                                    <!-- Đường dẫn -->
                                    <div class="col-md-6">
                                        <label for="slug" class="form-label">Đường dẫn</label>
                                        <input type="text" wire:model="slug" class="form-control" id="slug"
                                            required>
                                        @error('slug')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
 
 
 
 
                                    <!-- Mô tả -->
                                    <div class="col-12">
                                        <label for="description" class="form-label">Mô tả</label>
                                        <textarea wire:model="description" class="form-control" id="description" rows="4" required></textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
 
 
 
 
                                    <!-- Giá -->
                                    <div class="col-md-4">
                                        <label for="price" class="form-label">Giá (VNĐ)</label>
                                        <input type="number" wire:model="price" class="form-control" id="price"
                                            required>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{--
 
 
                                    <!-- Thời gian -->
                                    <div class="col-md-4">
                                        <label for="duration" class="form-label">Thời gian (Ngày)</label>
                                        <input type="number" wire:model="duration" class="form-control"
                                            id="duration" required>
                                        @error('duration')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
 
 
 
 
                                    <!-- Số người tối đa -->
                                    <div class="col-md-4">
                                        <label for="max_people" class="form-label">Số người tối đa</label>
                                        <input type="number" wire:model="max_people" class="form-control"
                                            id="max_people" required>
                                        @error('max_people')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
 
 
 
 
                                    <!-- Trạng thái -->
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">Trạng thái</label>
                                        <select wire:model="status" class="form-select" id="status" required>
                                            <option value="">Chọn trạng thái...</option>
                                            <option value="active">Hoạt động</option>
                                            <option value="inactive">Tạm ngưng</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
 
 
                                    <!-- Phần nhập thời gian -->
                                    <div class="col-md-4">
                                        <label for="duration" class="form-label">Thời gian (Ngày)</label>
                                        <input type="number" wire:model.live="duration" class="form-control"
                                            id="duration" required>
                                        @error('duration')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
 
 
                                    <!-- Phần lịch trình tour -->
                                    <div class="col-12 mt-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Lịch trình Tour</h5>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($schedules as $index => $schedule)
                                                    <div class="schedule-item border rounded p-3 mb-3">
                                                        <div class="row g-3">
                                                            <div class="col-md-2">
                                                                <label class="form-label">Ngày thứ</label>
                                                                <input type="number" class="form-control"
                                                                    wire:model="schedules.{{ $index }}.day"
                                                                    readonly>
                                                            </div>
 
 
                                                            <div class="col-md-10">
                                                                <label class="form-label">Tiêu đề</label>
                                                                <input type="text" class="form-control"
                                                                    wire:model="schedules.{{ $index }}.title"
                                                                    placeholder="Nhập tiêu đề cho ngày này">
                                                                @error("schedules.$index.title")
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
 
 
                                                            <div class="col-12">
                                                                <label class="form-label">Mô tả chi tiết</label>
                                                                <textarea class="form-control" rows="3" wire:model="schedules.{{ $index }}.description"
                                                                    placeholder="Nhập mô tả chi tiết cho ngày này"></textarea>
                                                                @error("schedules.$index.description")
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Nút tạo tour -->
                                    <div class="col-12 text-end mt-4">
                                        <button class="btn btn-success" type="submit">Tạo Tour</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
 
 
 
 
 
 