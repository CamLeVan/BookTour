@extends('layouts.frontend')

@section('content')
<div class="booking-success section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="success-card text-center">
                    <div class="success-icon">
                        <i class="ti-check"></i>
                    </div>
                    
                    <h2>Thanh toán thành công!</h2>
                    <p class="lead">Cảm ơn bạn đã đặt tour. Chúng tôi đã gửi email xác nhận cho bạn.</p>

                    <div class="booking-details">
                        <div class="detail-item">
                            <span class="label">Mã đặt tour:</span>
                            <span class="value">#{{ $booking->id }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="label">Tour:</span>
                            <span class="value">{{ $booking->tour->name }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="label">Ngày khởi hành:</span>
                            <span class="value">{{ $booking->booking_date->format('d/m/Y') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="label">Số người:</span>
                            <span class="value">{{ $booking->adults }} người lớn, {{ $booking->children }} trẻ em</span>
                        </div>
                        <div class="detail-item total">
                            <span class="label">Tổng tiền đã thanh toán:</span>
                            <span class="value">{{ number_format($booking->total_price) }} VNĐ</span>
                        </div>
                    </div>

                    <div class="success-actions mt-4">
                        <a href="{{ route('frontend.bookings.history') }}" class="btn btn-outline-primary">
                            <i class="ti-receipt"></i> Xem lịch sử đặt tour
                        </a>
                        <a href="{{ route('frontend.tours.index') }}" class="btn btn-primary">
                            <i class="ti-search"></i> Xem tour khác
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.success-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 0 30px rgba(0,0,0,0.1);
    padding: 40px;
}

.success-icon {
    color: #28a745;
    font-size: 3em;
    margin-bottom: 20px;
}

.booking-details {
    margin-top: 30px;
    text-align: left;
}

.detail-item {
    margin: 15px 0;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
}

.detail-item.total {
    border-top: 2px solid #ddd;
    margin-top: 20px;
    padding-top: 20px;
}

.detail-item .label {
    color: #666;
    display: block;
    font-size: 0.9em;
}

.detail-item .value {
    color: #333;
    font-weight: 500;
}

.success-actions {
    margin-top: 30px;
}

.success-actions .btn {
    margin: 0 10px;
}
</style>
@endpush 