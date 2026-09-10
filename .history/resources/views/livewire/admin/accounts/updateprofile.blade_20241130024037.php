<div id="app-layout">
    <div class="content">
        <div class="container-xxl">
            <!-- Thêm phần hiển thị thông báo -->
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Profile Header Section -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="position-relative" style="width: 100px; height: 100px;">
                            @if ($photo)
                                <!-- Preview ảnh mới upload -->
                                <img src="{{ $photo->temporaryUrl() }}" class="rounded-circle img-thumbnail"
                                    style="width: 100px; height: 100px; object-fit: cover;"
                                    alt="Profile photo preview" />
                            @elseif ($currentAvatar)
                                <!-- Hiển thị avatar hiện tại -->
                                <img src="{{ asset('storage/avatars/' . $currentAvatar) }}"
                                    class="rounded-circle img-thumbnail"
                                    style="width: 100px; height: 100px; object-fit: cover;"
                                    alt="{{ Auth::user()->name }}'s profile photo" />
                            @else
                                <!-- Ảnh mặc định -->
                                <img src="{{ asset( (Auth::user()->avatar ?? 'default-avatar.jpg')) }}" 
                                alt="user-image"
                                class="rounded-circle" />
                            @endif

                            <label for="photo-upload" class="position-absolute bottom-0 end-0 mb-1 me-1">
                                <span class="btn btn-sm btn-primary rounded-circle">
                                    <i class="mdi mdi-camera"></i>
                                </span>
                                <input type="file" id="photo-upload" wire:model="photo" class="d-none"
                                    accept="image/*">
                            </label>
                        </div>

                        <div class="ms-4">
                            <h4 class="m-0 text-dark fs-20">
                                <span class="badge bg-primary-subtle text-primary px-2 py-1 fs-13 fw-normal">
                                    {{ Auth::user()->name }}
                                </span>
                            </h4>
                            <p class="my-1 text-muted fs-16">
                                {{ Auth::user()->email }}
                            </p>
                            <span>
                                <i class="mdi mdi-map-marker"></i>
                                <span class="badge bg-primary-subtle text-primary px-2 py-1 fs-13 fw-normal">
                                    {{ Auth::user()->address ?: 'Chưa cập nhật địa chỉ' }}
                                </span>
                            </span>
                        </div>
                    </div>
                    @error('photo')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Update Profile Form Section -->
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="card border">
                        <div class="card-header bg-light">
                            <h4 class="card-title mb-0">
                                <i class="mdi mdi-account-edit me-2"></i>Cập nhật thông tin
                            </h4>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="updateProfile">
                                <div class="form-group mb-3">
                                    <label class="form-label">Họ và tên</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-account"></i>
                                        </span>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            wire:model="name" placeholder="Nhập họ và tên" />
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Số điện thoại</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-phone-outline"></i>
                                        </span>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                            wire:model="phone" placeholder="Nhập số điện thoại" />
                                    </div>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-email"></i>
                                        </span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            wire:model="email" placeholder="Nhập địa chỉ email" />
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Địa chỉ</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-map-marker"></i>
                                        </span>
                                        <input type="text"
                                            class="form-control @error('address') is-invalid @enderror"
                                            wire:model="address" placeholder="Nhập địa chỉ" />
                                    </div>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-content-save me-1"></i>Lưu thay đổi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Decorative Video Section -->
                <div class="col-lg-6">
                    <div class="card border h-100" style="position: relative; overflow: hidden;">
                        <video autoplay muted loop playsinline
                            style="position: absolute; width: 100%; height: 100%; object-fit: cover;">
                            <source src="{{ asset('assets/videoo.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
