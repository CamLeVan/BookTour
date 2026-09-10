<div>
    <div class="content-wrapper p-4">
        <!-- Header Section với animation -->
        <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeIn">
            <div>
                <h3 class="fw-bold mb-1">Phân Tích Người Dùng</h3>
                <p class="text-muted">Cập nhật lần cuối: {{ now()->format('H:i, d/m/Y') }}</p>
            </div>
            <select class="form-select w-auto border-0 shadow-sm" wire:model.live="dateRange">
                <option value="week">7 ngày qua</option>
                <option value="month">30 ngày qua</option>
                <option value="year">365 ngày qua</option>
                <option value="all">Tất cả thời gian</option>
            </select>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <!-- Tổng Người Dùng -->
            <div class="col-md-6 col-xl-3 animate__animated animate__fadeInUp">
                <div class="card border-0 shadow-sm hover-lift"
                    style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-box rounded-3 me-3">
                                <i class="mdi mdi-account-multiple text-white fs-3"></i>
                            </div>
                            <div>
                                <h6 class="text-white text-opacity-75 mb-1">Tổng Người Dùng</h6>
                                <h3 class="text-white mb-0 fw-bold">{{ number_format($statistics['total_users']) }}</h3>
                            </div>
                        </div>
                        <div class="mt-4 pt-2">
                            <div class="d-flex align-items-center text-white text-opacity-75">
                                <i class="mdi mdi-trending-up me-2"></i>
                                <span>Tăng 12% so với tháng trước</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Đang Hoạt Động -->
            <div class="col-md-6 col-xl-3 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                <div class="card border-0 shadow-sm hover-lift"
                    style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-box rounded-3 me-3">
                                <i class="mdi mdi-account-check text-white fs-3"></i>
                            </div>
                            <div>
                                <h6 class="text-white text-opacity-75 mb-1">Đang Hoạt Động</h6>
                                <h3 class="text-white mb-0 fw-bold">{{ number_format($statistics['active_users']) }}
                                </h3>
                            </div>
                        </div>
                        <div class="mt-4 pt-2">
                            <div class="d-flex align-items-center text-white text-opacity-75">
                                <i class="mdi mdi-clock-outline me-2"></i>
                                <span>30 ngày gần đây</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tỷ Lệ Tương Tác -->
            <div class="col-md-6 col-xl-3 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                <div class="card border-0 shadow-sm hover-lift"
                    style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-box rounded-3 me-3">
                                <i class="mdi mdi-chart-arc text-white fs-3"></i>
                            </div>
                            <div>
                                <h6 class="text-white text-opacity-75 mb-1">Tỷ Lệ Tương Tác</h6>
                                <h3 class="text-white mb-0 fw-bold">75%</h3>
                            </div>
                        </div>
                        <div class="mt-4 pt-2">
                            <div class="d-flex align-items-center text-white text-opacity-75">
                                <i class="mdi mdi-trending-up me-2"></i>
                                <span>Tăng 5% so với tuần trước</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Đánh Giá Trung Bình -->
            <div class="col-md-6 col-xl-3 animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
                <div class="card border-0 shadow-sm hover-lift"
                    style="background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-box rounded-3 me-3">
                                <i class="mdi mdi-star text-white fs-3"></i>
                            </div>
                            <div>
                                <h6 class="text-white text-opacity-75 mb-1">Đánh Giá TB</h6>
                                <h3 class="text-white mb-0 fw-bold">4.8</h3>
                            </div>
                        </div>
                        <div class="mt-4 pt-2">
                            <div class="d-flex align-items-center text-white text-opacity-75">
                                <i class="mdi mdi-star me-2"></i>
                                <span>Dựa trên 150 đánh giá</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart & Activity Section -->
        <div class="row g-4 mb-4">
            <!-- Chart -->
            <div class="col-xl-8 animate__animated animate__fadeIn" style="animation-delay: 0.4s">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="fw-bold mb-1">Tăng Trưởng Người Dùng</h5>
                                <p class="text-muted mb-0">Biểu đồ thể hiện số lượng người dùng mới theo thời gian</p>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-soft-primary btn-sm">Ngày</button>
                                <button class="btn btn-primary btn-sm">Tuần</button>
                                <button class="btn btn-soft-primary btn-sm">Tháng</button>
                            </div>
                        </div>
                        <div id="userChart" style="height: 350px;"></div>
                    </div>
                </div>
            </div>

            <!-- Activity -->
            <div class="col-xl-4 animate__animated animate__fadeIn" style="animation-delay: 0.5s">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Hoạt Động Người Dùng</h5>

                        <div class="activity-item mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Tỷ lệ đặt tour</h6>
                                <span class="badge bg-soft-primary text-primary">75%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"></div>
                            </div>
                        </div>

                        <div class="activity-item mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Tỷ lệ quay lại</h6>
                                <span class="badge bg-soft-success text-success">65%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 65%"></div>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Tỷ lệ hài lòng</h6>
                                <span class="badge bg-soft-warning text-warning">85%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Users Table -->
        <div class="animate__animated animate__fadeIn" style="animation-delay: 0.6s">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="fw-bold mb-1">Top Người Dùng Tích Cực</h5>
                            <p class="text-muted mb-0">Danh sách người dùng có nhiều hoạt động nhất</p>
                        </div>
                        <a href="#" class="btn btn-soft-primary btn-sm">
                            <i class="mdi mdi-eye me-1"></i> Xem tất cả
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0">Người Dùng</th>
                                    <th class="border-0">Tours</th>
                                    <th class="border-0">Chi Tiêu</th>
                                    <th class="border-0">Trạng Thái</th>
                                    <th class="border-0">Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statistics['top_users'] as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-soft-primary rounded-circle me-3">
                                                    <i class="mdi mdi-account text-primary"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $user->name }}</h6>
                                                    <small class="text-muted">{{ $user->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">
                                                {{ $user->bookings_count }} tours
                                            </span>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">
                                                ${{ number_format($user->bookings_sum_total_price / 24500, 2) }}</h6>
                                        </td>
                                        <td>
                                            <span class="badge bg-soft-success text-success px-3">Active</span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <button type="button" class="btn btn-icon btn-soft-primary btn-sm"
                                                    wire:click="viewUserDetails({{ $user->id }})"
                                                    title="Xem chi tiết">
                                                    <i class="mdi mdi-eye"></i>
                                                </button>

                                                <button type="button" class="btn btn-icon btn-soft-info btn-sm"
                                                    wire:click="editUser({{ $user->id }})"
                                                    title="Chỉnh sửa thông tin">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
        }

        .icon-box {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
        }

        .avatar-sm {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bg-soft-primary {
            background-color: rgba(99, 102, 241, 0.1) !important;
        }

        .bg-soft-success {
            background-color: rgba(16, 185, 129, 0.1) !important;
        }

        .bg-soft-warning {
            background-color: rgba(245, 158, 11, 0.1) !important;
        }

        .bg-soft-info {
            background-color: rgba(59, 130, 246, 0.1) !important;
        }

        .text-primary {
            color: #6366f1 !important;
        }

        .text-success {
            color: #10b981 !important;
        }

        .text-warning {
            color: #f59e0b !important;
        }

        .btn-soft-primary {
            background-color: rgba(99, 102, 241, 0.1);
            color: #6366f1;
            border: none;
        }

        .btn-soft-primary:hover {
            background-color: #6366f1;
            color: white;
        }

        .progress {
            background-color: #f3f4f6;
            overflow: visible;
        }

        .progress-bar {
            position: relative;
            border-radius: 4px;
        }
    </style>

    @push('scripts')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const chartData = @json($chartData);

                const options = {
                    series: [{
                        name: 'Người dùng mới',
                        data: chartData.map(item => item.total)
                    }],
                    chart: {
                        type: 'area',
                        height: 350,
                        toolbar: {
                            show: false
                        },
                        fontFamily: 'inherit'
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },
                    xaxis: {
                        categories: chartData.map(item => item.date),
                        labels: {
                            style: {
                                fontSize: '12px',
                                fontFamily: 'inherit'
                            }
                        },
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                fontSize: '12px',
                                fontFamily: 'inherit'
                            },
                            formatter: function(value) {
                                return Math.round(value);
                            }
                        }
                    },
                    grid: {
                        borderColor: '#f3f4f6',
                        strokeDashArray: 4,
                        xaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    tooltip: {
                        theme: 'dark',
                        y: {
                            formatter: function(value) {
                                return value + ' người dùng';
                            }
                        }
                    },
                    colors: ['#6366f1'],
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.7,
                            opacityTo: 0.3,
                            stops: [0, 90, 100]
                        }
                    }
                };

                const chart = new ApexCharts(document.querySelector("#userChart"), options);
                chart.render();

                Livewire.on('chartDataUpdated', (event) => {
                    chart.updateSeries([{
                        data: event.chartData.map(item => item.total)
                    }]);
                    chart.updateOptions({
                        xaxis: {
                            categories: event.chartData.map(item => item.date)
                        }
                    });
                });
            });
        </script>
    @endpush

    <!-- User Details Modal -->
    <div class="modal" id="userDetailsModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Chi Tiết Người Dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($selectedUser)
                        <!-- Modal content here -->
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal" id="editUserModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Chỉnh Sửa Thông Tin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($selectedUser)
                        <!-- Modal content here -->
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Khởi tạo các modal
            let userModal = null;
            let editModal = null;

            document.addEventListener('DOMContentLoaded', function() {
                userModal = new bootstrap.Modal(document.getElementById('userDetailsModal'));
                editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
            });

            // Lắng nghe các events từ Livewire
            Livewire.on('show-user-modal', () => {
                userModal.show();
            });

            Livewire.on('show-edit-modal', () => {
                editModal.show();
            });

            Livewire.on('hide-edit-modal', () => {
                editModal.hide();
            });

            Livewire.on('user-updated', () => {
                // Có thể thêm thông báo success ở đây
                Swal.fire({
                    title: 'Thành công!',
                    text: 'Đã cập nhật thông tin người dùng',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        </script>
    @endpush
</div>
