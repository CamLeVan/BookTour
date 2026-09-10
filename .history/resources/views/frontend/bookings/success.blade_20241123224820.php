@extends('layouts.frontend')

@section('content')
<div class="booking-success section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="success-card">
                    <div class="success-header">
                        <div class="check-icon">
                            <i class="ti-check"></i>
                        </div>
                        <h2>Đặt Tour Thành Công!</h2>
                        <p>Cảm ơn bạn đã đặt tour. Chi tiết booking của bạn:</p>
                    </div>

                    <div class="booking-info">
                        <div class="info-item">
                            <span class="label">Mã đặt tour</span>
                            <span class="value">#{{ $booking->id }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Tour</span>
                            <span class="value">{{ $booking->tour->name }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Ngày khởi hành</span>
                            <span class="value">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Số người</span>
                            <span class="value">{{ $booking->adults }} người lớn, {{ $booking->children }} trẻ em</span>
                        </div>
                        <div class="info-item total">
                            <span class="label">Tổng tiền</span>
                            <span class="value">{{ number_format($booking->total_price) }} VNĐ</span>
                        </div>
                    </div>

                    <div class="success-footer">
                        <p>Chúng tôi đã gửi email xác nhận đến địa chỉ của bạn</p>
                        <div class="actions">
                            <a href="{{ route('frontend.tours.index') }}" class="butn-dark">
                                <span>Xem Tour Khác</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.booking-success {
    background: #f8f9fa;
    padding: 80px 0;
}
.success-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 0 30px rgba(0,0,0,0.1);
    overflow: hidden;
}
.success-header {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    color: white;
    padding: 40px;
    text-align: center;
}
.check-icon {
    width: 80px;
    height: 80px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}
.check-icon i {
    font-size: 40px;
}
.booking-info {
    padding: 40px;
}
.info-item {
    display: flex;
    justify-content: space-between;
    padding: 15px 0;
    border-bottom: 1px solid #eee;
}
.info-item:last-child {
    border: none;
}
.info-item.total {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #eee;
    font-weight: bold;
    font-size: 1.2em;
}
.label {
    color: #666;
}
.value {
    font-weight: 500;
    color: #333;
}
.success-footer {
    background: #f8f9fa;
    padding: 30px;
    text-align: center;
}
.success-footer p {
    color: #666;
    margin-bottom: 20px;
}
</style>
@endsection 