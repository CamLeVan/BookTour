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
                    
                    <h2>Đặt Tour Thành Công!</h2>
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
                            <span class="label">Tổng tiền:</span>
                            <span class="value">{{ number_format($booking->total_amount) }} VNĐ</span>
                        </div>
                    </div>

                    <div class="success-actions">
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
    width: 80px;
    height: 80px;
    background: #28a745;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    margin: 0 auto 30px;
}

.booking-details {
    margin: 30px 0;
    text-align: left;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #eee;
}

.detail-item.total {
    border-top: 2px solid #eee;
    border-bottom: none;
    margin-top: 10px;
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
    display: flex;
    justify-content: space-between;
}
</style>
@endpush 