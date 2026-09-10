<div>
    <div class="content-wrapper">
        <div class="content">
            <div class="container-xxl">
                <!-- Thống kê tổng quan -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-white shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Tổng Nhà Cung Cấp</h6>
                                        <h2 class="mb-2 fw-bold">{{ $statistics['total_admins'] }}</h2>
                                        <div class="d-flex align-items-center text-success">
                                            <i class="mdi mdi-account-multiple me-1"></i>
                                            <span>{{ $statistics['active_admins'] }} đang hoạt động</span>
                                        </div>
                                    </div>
                                    <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                                        <i class="mdi mdi-account-group fs-3 text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-white shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Tổng Tour</h6>
                                        <h2 class="mb-2 fw-bold">{{ $statistics['total_tours'] }}</h2>
                                        <div class="d-flex align-items-center text-success">
                                            <i class="mdi mdi-check-circle me-1"></i>
                                            <span>{{ $statistics['active_tours'] }} đang hoạt động</span>
                                        </div>
                                    </div>
                                    <div class="rounded-circle bg-success bg-opacity-10 p-3">
                                        <i class="mdi mdi-map-marker-multiple fs-3 text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Header -->
                <div class="py-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fs-18 fw-semibold mb-0"> Nhà Cung Cấp</h4>
                    </div>

                    <div class="d-flex gap-2 align-items-center">
                        <div class="flex-grow-1">
                            <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                                placeholder="Tìm kiếm...">
                        </div>
                        <div style="width: 200px;">
                            <select wire:model.live="statusFilter" class="form-select">
                                <option value="">Tất cả trạng thái</option>
                                <option value="active">Đang hoạt động</option>
                                <option value="inactive">Tạm khóa</option>
                            </select>
                        </div>
                        <button wire:click="openAddModal" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i> Thêm Admin
                        </button>
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

                <!-- Table Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Trạng thái</th>
                                        <th>Số Tour</th>
                                        <th>Tour Hoạt động</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->phone }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $admin->status === 'active' ? 'success' : 'danger' }}">
                                                    {{ $admin->status === 'active' ? 'Đang hoạt động' : 'Tạm khóa' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ $admin->tours_count }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($admin->active_tours_count > 0)
                                                    <button wire:click="showActiveTours({{ $admin->id }})"
                                                        class="badge bg-success border-0" style="cursor: pointer;">
                                                        {{ $admin->active_tours_count }}
                                                    </button>
                                                @else
                                                    <span class="badge bg-secondary">0</span>
                                                @endif
                                            </td>
                                            <td>{{ $admin->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <button wire:click="openEditModal({{ $admin->id }})"
                                                        class="btn btn-sm btn-info">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    @if ($admin->tours_count == 0)
                                                        <button wire:click="delete({{ $admin->id }})"
                                                            wire:confirm="Bạn có chắc muốn xóa admin này?"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Không có dữ liệu</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $admins->links() }}
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="adminModal" tabindex="-1" wire:ignore.self>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    {{ $editingAdminId ? 'Sửa Admin' : 'Thêm Admin' }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form wire:submit.prevent="saveAdmin">
                                    <div class="mb-3">
                                        <label class="form-label">Tên</label>
                                        <input type="text" class="form-control" wire:model="name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" wire:model="email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            {{ $editingAdminId ? 'Mật khẩu (để trống nếu không đổi)' : 'Mật khẩu' }}
                                        </label>
                                        <input type="password" class="form-control" wire:model="password">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control" wire:model="phone">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Trạng thái</label>
                                        <select class="form-select" wire:model="status">
                                            <option value="active">Đang hoạt động</option>
                                            <option value="inactive">Tạm khóa</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Đóng
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ $editingAdminId ? 'Cập nhật' : 'Thêm mới' }}
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
    @push('styles')
        <style>
            /* Thêm styles nếu cần */
            .card {
                border: none;
                border-radius: 10px;
                transition: transform 0.2s;
            }

            .card:hover {
                transform: translateY(-5px);
            }

            .text-muted {
                font-size: 0.875rem;
            }

            .fw-bold {
                font-size: 2rem;
            }
        </style>
    @endpush
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            const adminModal = new bootstrap.Modal('#adminModal');

            Livewire.on('openAdminModal', () => {
                adminModal.show();
            });

            Livewire.on('closeAdminModal', () => {
                adminModal.hide();
            });

            // Xử lý modal tour hoạt động
            const activeToursModal = new bootstrap.Modal('#activeToursModal');
            Livewire.on('openActiveToursModal', () => {
                activeToursModal.show();
            });
        });
    </script>
@endpush
