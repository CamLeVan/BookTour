@extends('layouts.admin')

@section('title', 'Tạo Mã Giảm Giá Mới - HC Travel')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Tạo Mã Giảm Giá / Khuyến Mãi Mới</h4>
            <div class="page-title-right">
                <a href="{{ route('admin.vouchers.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.vouchers.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Mã Voucher <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="VD: SUMMER2026, HC100K" value="{{ old('code') }}" required>
                            @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tên Chương Trình Ưu Đãi <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="VD: Ưu đãi chào hè giảm 100K" value="{{ old('name') }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Loại Giảm Giá <span class="text-danger">*</span></label>
                            <select name="type" class="form-select @error('type') is-invalid @enderror" id="voucherTypeSelect" required>
                                <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Số tiền cố định (VND)</option>
                                <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Phần trăm (%)</option>
                            </select>
                            @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Giá Trị Giảm <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="value" class="form-control @error('value') is-invalid @enderror" placeholder="VD: 100000 hoặc 10" value="{{ old('value') }}" required>
                            @error('value') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Số Tiền Giảm Tối Đa (Dành cho loại %)</label>
                            <input type="number" step="0.01" name="max_discount_amount" class="form-control @error('max_discount_amount') is-invalid @enderror" placeholder="VD: 200000 (để trống nếu không giới hạn)" value="{{ old('max_discount_amount') }}">
                            @error('max_discount_amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Giá Trị Đơn Hàng Tối Thiểu</label>
                            <input type="number" step="0.01" name="min_order_value" class="form-control @error('min_order_value') is-invalid @enderror" placeholder="VD: 500000 (mặc định 0)" value="{{ old('min_order_value', 0) }}">
                            @error('min_order_value') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Số Lượt Sử Dụng Tối Đa</label>
                            <input type="number" name="usage_limit" class="form-control @error('usage_limit') is-invalid @enderror" placeholder="Để trống nếu không giới hạn lượt dùng" value="{{ old('usage_limit') }}">
                            @error('usage_limit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Trạng Thái <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Kích hoạt (Hoạt động)</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tạm ngưng</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Ngày Bắt Đầu</label>
                            <input type="datetime-local" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}">
                            @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Ngày Kết Thúc</label>
                            <input type="datetime-local" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                            @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <a href="{{ route('admin.vouchers.index') }}" class="btn btn-light me-2">Hủy bỏ</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Lưu Mã Giảm Giá</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
