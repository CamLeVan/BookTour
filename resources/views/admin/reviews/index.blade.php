@extends('layouts.admin')

@section('title', 'Quản lý Đánh Giá & Nhận Xét - HC Travel')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">⭐ Quản lý Đánh Giá & Nhận Xét Tour</h4>
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
                <form action="{{ route('admin.reviews.index') }}" method="GET" class="row g-3 mb-4">
                    <div class="col-md-5">
                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm tên khách, tên tour, nội dung..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">-- Tất cả trạng thái --</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Đã duyệt (Hiển thị)</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Đã ẩn / Từ chối</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-info text-white"><i class="fas fa-search me-1"></i> Lọc đánh giá</button>
                        <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">Đặt lại</a>
                    </div>
                </form>

                <!-- Reviews Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Khách Hàng</th>
                                <th>Tour & Đơn Hàng</th>
                                <th>Đánh Giá</th>
                                <th>Nội Dung Nhận Xét</th>
                                <th>Ngày Tạo</th>
                                <th>Trạng Thái</th>
                                <th class="text-center">Thao Tác Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reviews as $review)
                                <tr>
                                    <td>{{ $loop->iteration + ($reviews->currentPage() - 1) * $reviews->perPage() }}</td>
                                    <td>
                                        <strong>{{ $review->user->name ?? 'Khách hàng' }}</strong><br>
                                        <small class="text-muted">{{ $review->user->email ?? '' }}</small>
                                    </td>
                                    <td>
                                        <span class="fw-semibold text-primary">{{ $review->tour->name ?? 'Tour' }}</span><br>
                                        <small class="text-muted">Mã đơn: #{{ $review->booking_id ?? 'N/A' }}</small>
                                    </td>
                                    <td>
                                        <span class="text-warning fw-bold fs-6">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                                            @endfor
                                        </span>
                                        <div class="badge bg-light text-dark border">{{ $review->rating }} / 5 sao</div>
                                    </td>
                                    <td style="max-width: 300px;">
                                        <p class="mb-0 text-wrap">{{ $review->comment ?? $review->content }}</p>
                                    </td>
                                    <td>
                                        <small>{{ $review->created_at ? $review->created_at->format('d/m/Y H:i') : '' }}</small>
                                    </td>
                                    <td>
                                        @if($review->status === 'approved')
                                            <span class="badge bg-success">Đã Duyệt</span>
                                        @elseif($review->status === 'rejected')
                                            <span class="badge bg-danger">Đã Ẩn</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Chờ Duyệt</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            @if($review->status !== 'approved')
                                                <form action="{{ route('admin.reviews.approve', $review) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-success" title="Duyệt cho hiển thị">
                                                        <i class="fas fa-check"></i> Duyệt
                                                    </button>
                                                </form>
                                            @endif
                                            @if($review->status !== 'rejected')
                                                <form action="{{ route('admin.reviews.reject', $review) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-warning" title="Ẩn/Từ chối">
                                                        <i class="fas fa-eye-slash"></i> Ẩn
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa đánh giá này vĩnh viễn?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa">
                                                    <i class="fas fa-trash"></i> Xóa
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="fas fa-star fa-2x mb-2 text-warning"></i><br>
                                        Chưa có đánh giá nào.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-3">
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
