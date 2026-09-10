@extends('layouts.frontend')

@section('content')
<div class="booking-success section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="success-card">
                    <div class="success-header text-center">
                        <div class="success-icon">
                            <i class="ti-check-box"></i>
                        </div>
                        <h2>Đặt tour thành công!</h2>
                        <p class="lead">Cảm ơn bạn đã đặt tour. Chúng tôi đã gửi email xác nhận cho bạn.</p>
                    </div>

                    <div class="booking-details">
                        <h4>Chi tiết đặt tour</h4>
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
                        <div class="detail-item">
                            <span class="label">Phương thức thanh toán:</span>
                            <span class="value">
                                @switch($booking->payment_method)
                                    @case('cash')
                                        <i class="ti-money"></i> Tiền mặt
                                        @break
                                    @case('transfer')
                                        <i class="ti-exchange-vertical"></i> Chuyển khoản
                                        @break
                                    @case('card')
                                        <i class="ti-credit-card"></i> Thẻ tín dụng
                                        @break
                                @endswitch
                            </span>
                        </div>
                        <div class="detail-item total">
                            <span class="label">Tổng tiền:</span>
                            <span class="value">{{ number_format($booking->total_price) }} VNĐ</span>
                        </div>
                    </div>

                    <div class="next-steps">
                        <h4>Các bước tiếp theo</h4>
                        <div class="step-list">
                            <div class="step-item">
                                <div class="step-icon">
                                    <i class="ti-email"></i>
                                </div>
                                <div class="step-content">
                                    <h5>Kiểm tra email</h5>
                                    <p>Chúng tôi đã gửi chi tiết đặt tour vào email của bạn</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-icon">
                                    <i class="ti-calendar"></i>
                                </div>
                                <div class="step-content">
                                    <h5>Lưu lịch trình</h5>
                                    <p>Đảm bảo bạn đã lưu ngày khởi hành tour</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-icon">
                                    <i class="ti-mobile"></i>
                                </div>
                                <div class="step-content">
                                    <h5>Liên hệ</h5>
                                    <p>Chúng tôi sẽ liên hệ với bạn trước ngày khởi hành</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="success-actions">
                        <a href="{{ route('frontend.bookings.history') }}" class="btn btn-outline-primary">
                            <i class="ti-receipt"></i> Xem lịch sử đặt tour
                        </a>
                        <a href="{{ route('frontend.tours.index') }}" class="btn btn-primary">
                            <i class="ti-search"></i> Khám phá thêm tour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.booking-success {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 60px 0;
}

.success-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 0 30px rgba(0,0,0,0.1);
    padding: 40px;
}

.success-header {
    margin-bottom: 40px;
}

.success-icon {
    width: 100px;
    height: 100px;
    background: #28a745;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    color: white;
    font-size: 2.5em;
}

.success-header h2 {
    color: #28a745;
    margin-bottom: 15px;
}

.booking-details {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 30px;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #e9ecef;
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-item.total {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 2px solid #dee2e6;
}

.detail-item .label {
    color: #6c757d;
}

.detail-item .value {
    font-weight: 500;
    color: #333;
}

.detail-item.total .value {
    color: #aa8453;
    font-size: 1.2em;
}

.next-steps {
    margin: 40px 0;
}

.step-list {
    display: grid;
    gap: 20px;
    margin-top: 20px;
}

.step-item {
    display: flex;
    align-items: start;
    gap: 20px;
}

.step-icon {
    width: 50px;
    height: 50px;
    background: #fff9f2;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #aa8453;
    font-size: 1.5em;
    flex-shrink: 0;
}

.step-content h5 {
    margin-bottom: 5px;
    color: #333;
}

.step-content p {
    color: #6c757d;
    margin: 0;
}

.success-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 40px;
}

.btn {
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary {
    background: #aa8453;
    border-color: #aa8453;
}

.btn-outline-primary {
    color: #aa8453;
    border-color: #aa8453;
}

.btn-outline-primary:hover {
    background: #aa8453;
    color: white;
}

@media (max-width: 768px) {
    .success-card {
        padding: 20px;
    }

    .success-actions {
        flex-direction: column;
    }

    .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endpush 