@extends('layouts.frontend')

@section('content')
<div class="payment-page section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="payment-card">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="payment-header text-center">
                        <div class="step-indicator">
                            <div class="step completed">
                                <div class="step-icon">
                                    <i class="ti-shopping-cart"></i>
                                </div>
                                <span>Đặt tour</span>
                            </div>
                            <div class="step active">
                                <div class="step-icon">
                                    <i class="ti-credit-card"></i>
                                </div>
                                <span>Thanh toán</span>
                            </div>
                            <div class="step">
                                <div class="step-icon">
                                    <i class="ti-check"></i>
                                </div>
                                <span>Hoàn tất</span>
                            </div>
                        </div>

                        <h3 class="mt-4">Thanh toán</h3>
                        <p class="text-muted">Vui lòng chọn phương thức thanh toán</p>
                        
                        <div class="amount-display">
                            <span class="label">Số tiền cần thanh toán:</span>
                            <span class="amount">{{ number_format($booking->total_price) }} VNĐ</span>
                        </div>
                    </div>

                    <div class="payment-methods">
                        <form action="{{ route('frontend.bookings.process-payment', $booking) }}" method="POST">
                            @csrf
                            <div class="payment-options">
                                <div class="payment-option">
                                    <input type="radio" name="payment_method" id="cash" value="cash" required>
                                    <label for="cash">
                                        <i class="ti-money"></i>
                                        <span>Tiền mặt</span>
                                        <small>Thanh toán trực tiếp tại văn phòng</small>
                                    </label>
                                </div>

                                <div class="payment-option">
                                    <input type="radio" name="payment_method" id="transfer" value="transfer">
                                    <label for="transfer">
                                        <i class="ti-exchange-vertical"></i>
                                        <span>Chuyển khoản</span>
                                        <small>Chuyển khoản qua ngân hàng</small>
                                    </label>
                                </div>

                                <div class="payment-option">
                                    <input type="radio" name="payment_method" id="card" value="card">
                                    <label for="card">
                                        <i class="ti-credit-card"></i>
                                        <span>Thẻ tín dụng</span>
                                        <small>Thanh toán an toàn qua cổng thanh toán</small>
                                    </label>
                                </div>
                            </div>

                            @error('payment_method')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="booking-summary mt-4">
                                <h4>Chi tiết đặt tour</h4>
                                <div class="summary-item">
                                    <span>Tour:</span>
                                    <strong>{{ $booking->tour->name }}</strong>
                                </div>
                                <div class="summary-item">
                                    <span>Ngày khởi hành:</span>
                                    <strong>{{ $booking->booking_date->format('d/m/Y') }}</strong>
                                </div>
                                <div class="summary-item">
                                    <span>Số người:</span>
                                    <strong>{{ $booking->adults }} người lớn, {{ $booking->children }} trẻ em</strong>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-4">
                                Xác nhận thanh toán <i class="ti-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.payment-page {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 60px 0;
}

.payment-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 0 30px rgba(0,0,0,0.1);
    padding: 40px;
}

.step-indicator {
    display: flex;
    justify-content: space-between;
    margin-bottom: 40px;
    position: relative;
}

.step-indicator::before {
    content: '';
    position: absolute;
    top: 30px;
    left: 50px;
    right: 50px;
    height: 2px;
    background: #e9ecef;
    z-index: 1;
}

.step {
    position: relative;
    z-index: 2;
    flex: 1;
    text-align: center;
}

.step-icon {
    width: 60px;
    height: 60px;
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    font-size: 1.5em;
    color: #adb5bd;
    transition: all 0.3s ease;
}

.step.completed .step-icon {
    background: #28a745;
    border-color: #28a745;
    color: white;
}

.step.active .step-icon {
    background: #aa8453;
    border-color: #aa8453;
    color: white;
}

.step span {
    color: #6c757d;
    font-size: 0.9em;
}

.amount-display {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
    margin: 30px 0;
}

.amount-display .amount {
    display: block;
    color: #aa8453;
    font-size: 2em;
    font-weight: 600;
    margin-top: 5px;
}

.payment-options {
    display: grid;
    gap: 15px;
    margin-bottom: 30px;
}

.payment-option {
    position: relative;
}

.payment-option input[type="radio"] {
    position: absolute;
    opacity: 0;
}

.payment-option label {
    display: block;
    padding: 20px;
    background: #fff;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.payment-option input[type="radio"]:checked + label {
    border-color: #aa8453;
    background: #fff9f2;
}

.payment-option label i {
    font-size: 1.5em;
    color: #aa8453;
    margin-right: 10px;
}

.payment-option label span {
    font-weight: 500;
    display: block;
    margin-bottom: 5px;
}

.payment-option label small {
    color: #6c757d;
}

.booking-summary {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
}

.booking-summary h4 {
    margin-bottom: 20px;
    color: #333;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e9ecef;
}

.summary-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.btn-primary {
    background: #aa8453;
    border-color: #aa8453;
    padding: 15px 30px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #96744a;
    border-color: #96744a;
    transform: translateY(-2px);
}

.alert {
    border-radius: 10px;
    margin-bottom: 30px;
}

@media (max-width: 768px) {
    .payment-card {
        padding: 20px;
    }
    
    .step-indicator::before {
        left: 30px;
        right: 30px;
    }
    
    .step-icon {
        width: 50px;
        height: 50px;
        font-size: 1.2em;
    }
    
    .amount-display .amount {
        font-size: 1.5em;
    }
}
</style>
@endpush 