@extends('layouts.admin')

@section('title', 'Quản Lý Tài Chính & Điều Phối Dòng Tiền')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-0 text-gray-800">Quản Lý Tài Chính & Điều Phối Dòng Tiền</h2>
            <p class="text-muted small mb-0">Mô hình Kế toán Chuẩn OTA: Tạm Thu $\rightarrow$ Thực Nhận $\rightarrow$ Hoa Hồng Sàn & Quyết Toán Đối Tác</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.financial.refunds') }}" class="btn btn-warning text-white fw-bold">
                <i class="ti-reload me-1"></i> Quản Lý Yêu Cầu Hoàn Tiền
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="ti-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Metric Cards Grid -->
    <div class="row g-3 mb-4">
        <!-- 1. Tạm thu -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                📥 Tiền Tạm Thu (Unearned Revenue)
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($unearnedRevenue) }} VNĐ
                            </div>
                            <div class="small text-muted mt-1">Quỹ tiền cọc/vé tour chưa khởi hành</div>
                        </div>
                        <div class="col-auto">
                            <i class="ti-wallet fs-1 text-info opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Doanh thu thực nhận -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                💰 Doanh Thu Thực Nhận (Earned Revenue)
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($earnedRevenue) }} VNĐ
                            </div>
                            <div class="small text-muted mt-1">Doanh thu từ các tour đã hoàn tất</div>
                        </div>
                        <div class="col-auto">
                            <i class="ti-money fs-1 text-success opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Hoa hồng sàn (15%) -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                🏢 Hoa Hồng Sàn (Commission 15%)
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($platformCommission) }} VNĐ
                            </div>
                            <div class="small text-muted mt-1">Lợi nhuận ròng của nền tảng HC Travel</div>
                        </div>
                        <div class="col-auto">
                            <i class="ti-bar-chart fs-1 text-primary opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Quyết toán đối tác (85%) -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                🤝 Quyết Toán Đối Tác (Payout 85%)
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($partnerPayout) }} VNĐ
                            </div>
                            <div class="small text-muted mt-1">Chi trả cho đơn vị tổ chức tour/nhà xe</div>
                        </div>
                        <div class="col-auto">
                            <i class="ti-user fs-1 text-warning opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Metric Row -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="p-3 bg-white rounded shadow-sm border">
                <div class="text-muted small">💰 Tiền Đặt cọc (30%) Đang Giữ</div>
                <div class="h5 fw-bold text-warning mb-0">{{ number_format($depositsHeld) }} VNĐ</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 bg-white rounded shadow-sm border">
                <div class="text-muted small">📌 Dư Nợ 70% Khách Cần Trả Trước Khởi Hành</div>
                <div class="h5 fw-bold text-danger mb-0">{{ number_format($totalRemainingBalance) }} VNĐ</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 bg-white rounded shadow-sm border">
                <div class="text-muted small">🔄 Tổng Tiền Đã Hoàn Trả Khách Hàng</div>
                <div class="h5 fw-bold text-secondary mb-0">{{ number_format($totalRefunded) }} VNĐ</div>
            </div>
        </div>
    </div>

    <!-- Booking Financial Stream Table -->
    <div class="card shadow border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Dòng Tiền Đơn Đặt Tour Gần Đây</h6>
            <span class="badge bg-light text-dark border">Cập nhật thời gian thực</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Mã đơn</th>
                            <th>Khách hàng</th>
                            <th>Tour du lịch</th>
                            <th>Ngày đi</th>
                            <th>Hình thức</th>
                            <th>Tiền đã thu</th>
                            <th>Tiền nợ (70%)</th>
                            <th>Trạng thái tài chính</th>
                            <th>Giả lập Kế toán</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentFinancialBookings as $b)
                            <tr>
                                <td><strong>#{{ $b->id }}</strong></td>
                                <td>
                                    <div>{{ $b->user->name ?? 'N/A' }}</div>
                                    <small class="text-muted">{{ $b->user->email ?? '' }}</small>
                                </td>
                                <td>{{ Str::limit($b->tour->name ?? 'N/A', 25) }}</td>
                                <td>{{ \Carbon\Carbon::parse($b->booking_date)->format('d/m/Y') }}</td>
                                <td>
                                    @if($b->is_deposit)
                                        <span class="badge bg-warning text-dark">Đặt cọc 30%</span>
                                    @else
                                        <span class="badge bg-info text-white">Trả 100%</span>
                                    @endif
                                </td>
                                <td class="fw-bold text-success">
                                    {{ number_format($b->amount_paid) }} VNĐ
                                </td>
                                <td class="text-danger fw-bold">
                                    {{ number_format($b->remaining_amount) }} VNĐ
                                </td>
                                <td>
                                    @if($b->status === 'completed')
                                        <span class="badge bg-success">💰 Doanh Thu Thực</span>
                                    @elseif($b->status === 'cancelled')
                                        <span class="badge bg-danger">Hủy (Hoàn: {{ number_format($b->refund_amount) }}đ)</span>
                                    @elseif($b->payment_status === 'paid' || $b->payment_status === 'deposit_paid')
                                        <span class="badge bg-info">📥 Tạm Thu (Unearned)</span>
                                    @else
                                        <span class="badge bg-secondary">Chưa thanh toán</span>
                                    @endif
                                </td>
                                <td>
                                    @if($b->status !== 'completed' && $b->status !== 'cancelled' && ($b->payment_status === 'paid' || $b->payment_status === 'deposit_paid'))
                                        <form action="{{ route('admin.financial.simulate-complete', $b) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success" onclick="return confirm('Xác nhận giả lập tour hoàn tất & chuyển dòng tiền sang Doanh thu thực?')">
                                                ⚡ Hoàn thành Tour & Quyết toán
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">Chưa có dữ liệu đơn đặt tour.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $recentFinancialBookings->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
