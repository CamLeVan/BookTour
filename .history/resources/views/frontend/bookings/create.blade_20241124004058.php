@extends('layouts.frontend')

@section('content')
<div class="booking-form section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="booking-card">
                    <div class="booking-header">
                        <h3>Đặt Tour</h3>
                        <div class="tour-info">
                            <h4>{{ $tour->name }}</h4>
                            <div class="price">{{ number_format($tour->price) }} VNĐ/người</div>
                        </div>
                    </div>

                    <form action="{{ route('frontend.bookings.store', $tour) }}" method="POST" class="booking-form">
                        @csrf
                        
                        {{-- Ngày khởi hành --}}
                        <div class="form-group">
                            <label>Ngày khởi hành <span class="text-danger">*</span></label>
                            <input type="date" 
                                   name="booking_date" 
                                   class="form-control @error('booking_date') is-invalid @enderror"
                                   value="{{ old('booking_date') }}"
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                            @error('booking_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Số lượng người --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Người lớn <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           name="adults" 
                                           class="form-control @error('adults') is-invalid @enderror"
                                           value="{{ old('adults', 1) }}"
                                           min="1">
                                    @error('adults')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Trẻ em (dưới 12 tuổi)</label>
                                    <input type="number" 
                                           name="children" 
                                           class="form-control @error('children') is-invalid @enderror"
                                           value="{{ old('children', 0) }}"
                                           min="0">
                                    @error('children')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Ghi chú --}}
                        <div class="form-group">
                            <label>Ghi chú</label>
                            <textarea name="notes" 
                                      class="form-control @error('notes') is-invalid @enderror"
                                      rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Hiển thị tổng tiền --}}
                        <div class="price-summary">
                            <div class="price-row">
                                <span>Giá tour/người lớn:</span>
                                <span>{{ number_format($tour->price) }} VNĐ</span>
                            </div>
                            <div class="price-row">
                                <span>Giá tour/trẻ em:</span>
                                <span>{{ number_format($tour->price * 0.5) }} VNĐ</span>
                            </div>
                            <div class="price-total">
                                <span>Tổng tiền:</span>
                                <span id="totalPrice">0 VNĐ</span>
                            </div>
                        </div>

                        <div class="booking-actions">
                            <a href="{{ route('frontend.tours.show', $tour) }}" class="btn btn-outline-secondary">
                                <i class="ti-arrow-left"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Tiếp tục <i class="ti-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.booking-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 0 30px rgba(0,0,0,0.1);
    padding: 30px;
}

.booking-header {
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.tour-info {
    margin-top: 15px;
}

.tour-info .price {
    color: #aa8453;
    font-size: 1.2em;
    font-weight: 600;
}

.form-group {
    margin-bottom: 20px;
}

.booking-actions {
    margin-top: 30px;
    display: flex;
    justify-content: space-between;
}

.btn-primary {
    background: #aa8453;
    border-color: #aa8453;
}

.btn-primary:hover {
    background: #957547;
    border-color: #957547;
}

.price-summary {
    margin-top: 30px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
}

.price-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    color: #666;
}

.price-total {
    display: flex;
    justify-content: space-between;
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #ddd;
    font-weight: 600;
    font-size: 1.2em;
}

#totalPrice {
    color: #aa8453;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Lấy các input số lượng người
    const adultsInput = document.querySelector('input[name="adults"]');
    const childrenInput = document.querySelector('input[name="children"]');
    
    // Lấy giá tour từ PHP
    const pricePerPerson = {{ $tour->price }};
    
    // Hàm tính tổng tiền
    function calculateTotal() {
        // Lấy số người (mặc định 0 nếu input trống)
        const adults = parseInt(adultsInput.value) || 0;
        const children = parseInt(childrenInput.value) || 0;
        
        // Tính tổng (trẻ em = 50% giá người lớn)
        const total = (adults * pricePerPerson) + (children * pricePerPerson * 0.5);
        
        // Hiển thị với format tiền VNĐ
        document.getElementById('totalPrice').textContent = 
            new Intl.NumberFormat('vi-VN').format(total) + ' VNĐ';
    }
    
    // Gọi hàm tính khi thay đổi input
    adultsInput.addEventListener('change', calculateTotal);
});
</script>
@endpush 