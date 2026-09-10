<div>
    <div class="content">
        <div class="container-xxl">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <a href="{{ route('admin.tours.index') }}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Quay Lại
                            </a>
                        </div>
                        <h4 class="page-title">Chỉnh Sửa Tour</h4>
                    </div>
                </div>
            </div>

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form wire:submit.prevent="updateTour">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tên Tour</label>
                                            <input type="text" class="form-control" wire:model="name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Điểm Đến</label>
                                            <select class="form-select" wire:model="destination_id">
                                                <option value="">Chọn điểm đến</option>
                                                @foreach ($destinations as $destination)
                                                    <option value="{{ $destination->id }}">{{ $destination->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('destination_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Giá</label>
                                            <input type="number" class="form-control" wire:model="price">
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Thời Gian (ngày)</label>
                                            <input type="number" class="form-control" wire:model="duration">
                                            @error('duration')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Số Người Tối Đa</label>
                                            <input type="number" class="form-control" wire:model="max_people">
                                            @error('max_people')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Trạng Thái</label>
                                            <select class="form-select" wire:model="status">
                                                <option value="active">Hoạt động</option>
                                                <option value="inactive">Tạm dừng</option>
                                            </select>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Hình Ảnh Mới</label>
                                            <input type="file" class="form-control" wire:model="newImage">
                                            @error('newImage')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            @if ($tour->image)
                                                <div class="mt-2">
                                                    <img src="{{ Storage::url($tour->image) }}" alt="Current Image"
                                                        class="img-thumbnail" style="max-height: 100px">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-content-save me-1"></i> Lưu Thay Đổi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
