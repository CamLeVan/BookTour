@extends('layouts.admin')

@section('title', 'Quản Lý Yêu Cầu Hoàn Tiền (Refund Management)')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-0 text-gray-800">Quản Lý Yêu Cầu Hoàn Tiền</h2>
            <p class="text-muted small mb-0">Xem danh sách khách hàng gửi yêu cầu hủy tour & giả lập chuyển hoàn tiền qua VNPay / Ngân hàng</p>
        </div>
        <a href="{{ route('admin.financial.index') }}" class="btn btn-outline-secondary">
            <i class="ti-arrow-left me-1"></i> Quay lại Dashboard Tài chính
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="ti-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow border-0">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-warning"><i class="ti-reload me-2"></i> Danh Sách Yêu Cầu Hoàn Tiền Hủy Tour</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Mã đơn</th>
                            <th>Khách hàng</th>
                            <th>Tour</th>
                            <th>Ngày đi</th>
                            <th>Số tiền đã trả</th>
                            <th>Số tiền hoàn lại</th>
                            <th>Lý do hủy</th>
                            <th>Trạng thái hoàn</th>
                            <th>Thao tác Giả lập</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($refundRequests as $b)
                            <tr>
                                <td><strong>#{{ $b->id }}</strong></td>
                                <td>
                                    <div>{{ $b->user->name ?? 'N/A' }}</div>
                                    <small class="text-muted">{{ $b->user->email ?? '' }}</small>
                                </td>
                                <td>{{ Str::limit($b->tour->name ?? 'N/A', 25) }}</td>
                                <td>{{ \Carbon\Carbon::parse($b->booking_date)->format('d/m/Y') }}</td>
                                <td>{{ number_format($b->amount_paid) }} VNĐ</td>
                                <td class="fw-bold text-danger">
                                    {{ number_format($b->refund_amount) }} VNĐ
                                </td>
                                <td>
                                    <small class="text-wrap d-block max-w-200">{{ $b->refund_reason ?? 'Không có ghi chú' }}</small>
                                </td>
                                <td>
                                    @if($b->refund_status === 'refunded')
                                        <span class="badge bg-success">✅ Đã hoàn tiền</span>
                                    @elseif($b->refund_status === 'requested')
                                        <span class="badge bg-warning text-dark">⏳ Chờ duyệt hoàn tiền</span>
                                    @elseif($b->refund_status === 'rejected')
                                        <span class="badge bg-secondary">Từ chối hoàn</span>
                                    @else
                                        <span class="badge bg-light text-dark">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($b->refund_status === 'requested')
                                        <div class="d-flex gap-1">
                                            <form action="{{ route('admin.financial.approve-refund', $b) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success text-nowrap" onclick="return confirm('Xác nhận giả lập duyệt hoàn ' + '{{ number_format($b->refund_amount) }}' + ' VNĐ về ngân hàng cho khách?')">
                                                    ⚡ Duyệt Hoàn VNPay
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.financial.reject-refund', $b) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Từ chối yêu cầu hoàn tiền này?')">
                                                    Từ chối
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-muted small">Đã xử lý</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">Chưa có yêu cầu hoàn tiền nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $refundRequests->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
