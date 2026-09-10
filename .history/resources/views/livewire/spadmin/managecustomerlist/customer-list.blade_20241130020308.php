<div class="content-wrapper" style="padding-top: 2rem;">
    <!-- Stats Cards -->
    <div class="row mb-4 customer-stats">
        <div class="col-lg-4 col-md-6">
            <div class="card bg-white shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-3">Tổng Khách Hàng</h6>
                            <h2 class="display-6 fw-bold mb-3">{{ $statistics['total_customers'] }}</h2>
                            <div class="d-flex align-items-center text-success">
                                <i class="mdi mdi-account-check me-2"></i>
                                <span>{{ $statistics['paid_customers'] }} đã thanh toán</span>
                            </div>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle p-4">
                            <i class="mdi mdi-account-group text-primary fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card bg-white shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-3">Tổng Đơn Đặt Tour</h6>
                            <h2 class="display-6 fw-bold mb-3">{{ $statistics['total_bookings'] }}</h2>
                            <div class="d-flex align-items-center text-info">
                                <i class="mdi mdi-calendar-check me-2"></i>
                                <span>Tổng số đơn đặt tour</span>
                            </div>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded-circle p-4">
                            <i class="mdi mdi-calendar text-info fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card bg-white shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-3">Doanh Thu</h6>
                            <h2 class="display-6 fw-bold mb-3">{{ number_format($statistics['total_revenue']) }}đ</h2>
                            <div class="d-flex align-items-center text-warning">
                                <i class="mdi mdi-currency-usd me-2"></i>
                                <span>Tổng doanh thu</span>
                            </div>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-circle p-4">
                            <i class="mdi mdi-currency-usd text-warning fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="card mb-4 customer-search">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-lg-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0">
                            <i class="mdi mdi-magnify"></i>
                        </span>
                        <input type="text" class="form-control border-0 bg-light"
                            placeholder="Tìm kiếm theo tên, email, số điện thoại..." wire:model.live="search">
                    </div>
                </div>

                <div class="col-lg-4">
                    <select class="form-select border-0 bg-light" wire:model.live="paymentFilter">
                        <option value="">Tất cả trạng thái</option>
                        <option value="paid">Đã thanh toán</option>
                        <option value="unpaid">Chưa thanh toán</option>
                    </select>
                </div>

                <div class="col-lg-4">
                    <select class="form-select border-0 bg-light" wire:model.live="dateFilter">
                        <option value="">Tất cả thời gian</option>
                        <option value="today">Hôm nay</option>
                        <option value="week">Tuần này</option>
                        <option value="month">Tháng này</option>
                    </select>
                </div>

                <div class="col-lg-12 text-end mt-3">
                    <button wire:click="resetFilters" class="btn btn-secondary">
                        <i class="mdi mdi-refresh me-1"></i>Reset Filters
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bảng danh sách khách hàng -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tên khách hàng</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Số tour đã đặt</th>
                            <th>Tổng chi tiêu</th>
                            <th>Trạng thái</th>
                            <th>Ngày tham gia</th>
                            <th>Tuỳ chỉnh</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->bookings_count }}</td>
                                <td>{{ number_format($customer->total_spent) }}đ</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $customer->paidBookings_count > 0 ? 'success' : 'warning' }}">
                                        {{ $customer->paidBookings_count > 0 ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                                    </span>
                                </td>
                                <td>{{ $customer->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <button wire:click="showBookingHistory({{ $customer->id }})"
                                        class="btn btn-sm btn-info">
                                        <i class="mdi mdi-history"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Không có dữ liệu</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Phân trang -->
            <div class="mt-3">
                {{ $customers->links() }}
            </div>
        </div>
    </div>

    <!-- Modal xem lịch sử đặt tour -->
    <div class="modal fade" id="bookingHistoryModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Lịch sử đặt tour - {{ $selectedCustomer->name ?? '' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @if ($bookingHistory && $bookingHistory->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tour</th>
                                        <th>Ngày đặt</th>
                                        <th>Số người</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookingHistory as $booking)
                                        <tr>
                                            <td>{{ $booking->tour->name }}</td>
                                            <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $booking->number_of_people }}</td>
                                            <td>{{ number_format($booking->total_price) }}đ</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $booking->payment_status === 'paid' ? 'success' : 'warning' }}">
                                                    {{ $booking->payment_status === 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center">Chưa có lịch sử đặt tour</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .customer-stats .card {
            transition: transform 0.2s ease-in-out;
            border: none;
            border-radius: 15px;
        }

        .customer-stats .card:hover {
            transform: translateY(-5px);
        }

        .customer-search .form-control,
        .customer-search .form-select {
            height: 45px;
            border-radius: 10px;
        }

        .customer-search .input-group-text {
            border-radius: 10px 0 0 10px;
        }

        .customer-search .form-control:focus,
        .customer-search .form-select:focus {
            box-shadow: none;
            border-color: #e9ecef;
        }

        .customer-stats .display-6 {
            font-size: 2.5rem;
        }

        .customer-stats .rounded-circle {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Modal booking history
            const bookingHistoryModal = new bootstrap.Modal('#bookingHistoryModal');

            Livewire.on('openBookingModal', () => {
                bookingHistoryModal.show();
            });

            // Alert
            Livewire.on('alert', (data) => {
                Swal.fire({
                    icon: data.type,
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });
    </script>
@endpush
