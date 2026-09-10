<div id="app-layout">
    <div class="content">
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                </div>
                <div class="text-end">
                </div>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-xl-12">
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
                                <form wire:submit.prevent="createTour" class="row g-3 was-validated">
                                    <!-- Điểm đến -->
                                    <div class="mb-3">
                                        <label class="form-label">Điểm đến</label>
                                        <select wire:model="destination_id" class="form-control">
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
                                    <div class="col-md-4">
                                        <label for="name" class="form-label">Tên tour</label>
                                        <input type="text" wire:model="name" class="form-control" id="name" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Đường dẫn -->
                                    <div class="col-md-4">
                                        <label for="slug" class="form-label">Đường dẫn</label>
                                        <input type="text" wire:model="slug" class="form-control" id="slug" required>
                                        @error('slug')
                                            <div class="test-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Mô tả -->
                                    <div class="col-md-12">
                                        <label for="description" class="form-label">Mô tả</label>
                                        <textarea wire:model="description" class="form-control" id="description" rows="3" required></textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Giá -->
                                    <div class="col-md-4">
                                        <label for="price" class="form-label">Giá (VNĐ)</label>
                                        <input type="number" wire:model="price" class="form-control" id="price" required>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Thời gian -->
                                    <div class="col-md-4">
                                        <label for="duration" class="form-label">Thời gian (Ngày)</label>
                                        <input type="text" wire:model="duration" class="form-control" id="duration" required>
                                        @error('duration')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Số người tối đa -->
                                    <div class="col-md-4">
                                        <label for="max_people" class="form-label">Số người tối đa</label>
                                        <input type="number" wire:model="max_people" class="form-control" id="max_people" required>
                                        @error('max_people')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Ảnh đại diện -->
                                    <div class="col-md-6">
                                        <label for="image" class="form-label">Ảnh đại diện</label>
                                        @if ($image)
                                            <img width="100" src="{{ $image->temporaryUrl() }}">
                                        @endif
                                        <input type="file" wire:model="image" class="form-control" id="image" required>
                                        @error('image')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Ảnh chi tiết -->
                                    <div class="col-md-6">
                                        <label for="images" class="form-label">Ảnh chi tiết</label>
                                        @if ($images)
                                            @foreach ($images as $item)
                                                <img width="100" src="{{ $item->temporaryUrl() }}">
                                            @endforeach
                                        @endif
                                        <input type="file" wire:model="images" class="form-control" id="images" multiple>
                                        @error('images')
                                            <span class="error">{{ $message }}</span>
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
                                    <!-- Nút tạo tour -->
                                    <div class="col-md-12 text-end">
                                        <button class="btn btn-success" type="submit">Tạo Tour</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
