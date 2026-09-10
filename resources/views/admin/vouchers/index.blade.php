@extends('layouts.admin')

@section('title', 'Quản lý Mã Giảm Giá - HC Travel')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Quản lý Mã Giảm Giá / Khuyến Mãi</h4>
            <div class="page-title-right">
                <a href="{{ route('admin.vouchers.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Tạo Mã Giảm Giá Mới
                </a>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Search & Filter Form -->
                <form action="{{ route('admin.vouchers.index') }}" method="GET" class="row g-3 mb-4">
                    <div class="col-md-5">
                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo Mã hoặc Tên ưu đãi..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">-- Tất cả trạng thái --</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Đang hoạt động</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tạm ngưng</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-info text-white"><i class="fas fa-search me-1"></i> Tìm kiếm</button>
                        <a href="{{ route('admin.vouchers.index') }}" class="btn btn-secondary">Đặt lại</a>
                    </div>
                </form>

                <!-- Vouchers Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Mã Voucher</th>
                                <th>Tên Chương Trình</th>
                                <th>Giá Trị Giảm</th>
                                <th>Đơn Tối Thiểu</th>
                                <th>Lượt Dùng</th>
                                <th>Thời Hạn</th>
                                <th>Trạng Thái</th>
                                <th class="text-center">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($vouchers as $voucher)
                                <tr>
                                    <td>{{ $loop->iteration + ($vouchers->currentPage() - 1) * $vouchers->perPage() }}</td>
                                    <td>
                                        <span class="badge bg-primary fs-6 font-monospace">{{ $voucher->code }}</span>
                                    </td>
                                    <td><strong>{{ $voucher->name }}</strong></td>
                                    <td>
                                        @if($voucher->type == 'fixed')
                                            <span class="text-success fw-bold">-{{ number_format($voucher->value, 0, ',', '.') }}đ</span>
                                        @else
                                            <span class="text-success fw-bold">-{{ $voucher->value }}%</span>
                                            @if($voucher->max_discount_amount)
                                                <br><small class="text-muted">(Tối đa {{ number_format($voucher->max_discount_amount, 0, ',', '.') }}đ)</small>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ number_format($voucher->min_order_value, 0, ',', '.') }}đ</td>
                                    <td>
                                        <span class="fw-bold">{{ $voucher->used_count }}</span> / 
                                        {{ $voucher->usage_limit ? $voucher->usage_limit : '∞' }}
                                    </td>
                                    <td>
                                        <small>
                                            Từ: {{ $voucher->start_date ? $voucher->start_date->format('d/m/Y H:i') : 'K.Giới hạn' }}<br>
                                            Đến: {{ $voucher->end_date ? $voucher->end_date->format('d/m/Y H:i') : 'K.Giới hạn' }}
                                        </small>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.vouchers.toggle-status', $voucher) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm {{ $voucher->status == 'active' ? 'btn-success' : 'btn-warning' }}" onclick="return confirm('Bạn có muốn đổi trạng thái voucher này?')">
                                                {{ $voucher->status == 'active' ? 'Hoạt động' : 'Tạm ngưng' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.vouchers.edit', $voucher) }}" class="btn btn-outline-primary" title="Sửa">
                                                <i class="fas fa-edit"></i> Sửa
                                            </a>
                                            <form action="{{ route('admin.vouchers.destroy', $voucher) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa voucher này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Xóa">
                                                    <i class="fas fa-trash"></i> Xóa
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4 text-muted">
                                        <i class="fas fa-ticket-alt fa-2x mb-2"></i><br>
                                        Chưa có mã giảm giá nào được tạo.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-3">
                    {{ $vouchers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
