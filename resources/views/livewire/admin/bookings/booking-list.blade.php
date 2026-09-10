<div>
    <div class="content">
        <div class="container-xxl">
            <div class="container-fluid">
                <!-- Header -->
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Danh sách đặt tour</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end gap-2">
                        <!-- Search -->
                        <div class="w-50">
                            <input type="text" wire:model.debounce.300ms="search" class="form-control"
                                placeholder="Tìm kiếm theo mã, tên khách hàng...">
                        </div>

                        <!-- Filter -->
                        <select wire:model="statusFilter" class="form-select w-auto">
                            <option value="">Tất cả trạng thái</option>
                            <option value="{{ App\Models\Booking::STATUS_PENDING }}">Chờ xác nhận</option>
                            <option value="{{ App\Models\Booking::STATUS_CONFIRMED }}">Đã xác nhận</option>
                            <option value="{{ App\Models\Booking::STATUS_COMPLETED }}">Hoàn thành</option>
                            <option value="{{ App\Models\Booking::STATUS_CANCELLED }}">Đã hủy</option>
                        </select>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-primary bg-opacity-10">
                            <div class="card-body">
                                <h6 class="card-title">Tổng đơn đặt tour</h6>
                                <h3 class="mb-0">{{ $totalBookings }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success bg-opacity-10">
                            <div class="card-body">
                                <h6 class="card-title">Đơn thành công</h6>
                                <h3 class="mb-0">{{ $completedBookings }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning bg-opacity-10">
                            <div class="card-body">
                                <h6 class="card-title">Đơn chờ xử lý</h6>
                                <h3 class="mb-0">{{ $pendingBookings }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-danger bg-opacity-10">
                            <div class="card-body">
                                <h6 class="card-title">Đơn đã hủy</h6>
                                <h3 class="mb-0">{{ $cancelledBookings }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Table -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Mã đặt tour</th>
                                        <th>Tên tour</th>
                                        <th>Khách hàng</th>
                                        <th>Ngày đặt</th>
                                        <th>Số người</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Thanh toán</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($bookings as $booking)
                                        <tr>
                                            <td>#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</td>
                                            <td>
                                                <strong>{{ $booking->tour->name }}</strong>
                                            </td>
                                            <td>
                                                <strong>{{ $booking->user->name }}</strong><br>
                                                <small class="text-muted">{{ $booking->user->email }}</small>
                                            </td>
                                            <td>
                                                {{ $booking->booking_date->format('d/m/Y') }}<br>
                                                <small
                                                    class="text-muted">{{ $booking->booking_date->diffForHumans() }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ $booking->number_of_people ?? 'N/A' }} người
                                                </span>
                                            </td>
                                            <td>
                                                <strong>{{ number_format($booking->total_price) }} VNĐ</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $booking->status_color }}">
                                                    {{ $booking->status_label }}
                                                </span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $booking->payment_status === 'paid' ? 'success' : 'warning' }}">
                                                    {{ $booking->payment_status === 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <button wire:click="viewDetails({{ $booking->id }})"
                                                        class="btn btn-info btn-sm" data-bs-toggle="tooltip"
                                                        title="Xem chi tiết">
                                                        <i class="mdi mdi-eye"></i>
                                                    </button>
                                                    <button wire:click="openStatusModal({{ $booking->id }})"
                                                        class="btn btn-info btn-sm" data-bs-toggle="tooltip"
                                                        title="Cập nhật trạng thái">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        wire:click="confirmDelete({{ $booking->id }})"
                                                        data-bs-toggle="tooltip"
                                                        title="{{ $booking->status === 'completed' ? 'Đơn đã hoàn thành không thể xóa' : 'Xóa đơn đặt tour' }}"
                                                        {{ $booking->status === 'completed' ? 'disabled' : '' }}>
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4">
                                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                                <p class="text-muted">Không có dữ liệu đặt tour</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $bookings->links('livewire::bootstrap') }}
                        </div>
                    </div>
                </div>

                <!-- Modals -->
                @include('livewire.admin.bookings.partials.confirm-delete-modal')
                @include('livewire.admin.bookings.partials.status-modal')
                @include('livewire.admin.bookings.partials.details-modal')
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            window.addEventListener('openDeleteModal', event => {
                $('#confirmDeleteModal').modal('show');
            });

            window.addEventListener('closeDeleteModal', event => {
                $('#confirmDeleteModal').modal('hide');
            });

            window.addEventListener('openStatusModal', event => {
                $('#statusModal').modal('show');
            });

            window.addEventListener('closeStatusModal', event => {
                $('#statusModal').modal('hide');
            });

            window.addEventListener('openDetailsModal', event => {
                $('#detailsModal').modal('show');
            });

            window.addEventListener('closeDetailsModal', event => {
                $('#detailsModal').modal('hide');
            });

            // Khởi tạo tooltip
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>
    @endpush
</div>
