<div>
    <div class="content">
        <div class="container-xxl">
            <!-- Header -->
            <div class="py-3 d-flex align-items-center justify-content-between">
                <h4 class="fs-18 fw-semibold mb-0">Danh sách đặt tour</h4>
                <div class="d-flex gap-2">
                    <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                        placeholder="Tìm kiếm...">
                    <select wire:model.live="statusFilter" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending">Chờ xác nhận</option>
                        <option value="confirmed">Đã xác nhận</option>
                        <option value="cancelled">Đã hủy</option>
                    </select>
                </div>
            </div>

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Mã đặt tour</th>
                                    <th>Tour</th>
                                    <th>Người tạo tour</th>
                                    <th>Khách hàng</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->id }}</td>
                                        <td>{{ '#'. $booking->tour->name }}</td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $booking->tour->admin->name }}
                                            </span>
                                        </td>
                                        <td>{{ $booking->user->name }}</td>
                                        <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ number_format($booking->total_amount, 0, ',', '.') }} VND</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'pending' ? 'warning' : 'danger') }}">
                                                {{ $booking->status === 'confirmed'
                                                    ? 'Đã xác nhận'
                                                    : ($booking->status === 'pending'
                                                        ? 'Chờ xác nhận'
                                                        : 'Đã hủy') }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <button wire:click="viewBooking({{ $booking->id }})"
                                                    class="btn btn-info btn-sm">
                                                    <i class="mdi mdi-eye"></i>
                                                </button>
                                                @if ($booking->status === 'pending')
                                                    <button wire:click="updateStatus({{ $booking->id }}, 'confirmed')"
                                                        class="btn btn-success btn-sm">
                                                        <i class="mdi mdi-check"></i>
                                                    </button>
                                                    <button wire:click="updateStatus({{ $booking->id }}, 'cancelled')"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="mdi mdi-close"></i>
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
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
