@extends('layouts.frontend')

@section('content')
<div class="booking-review section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="review-card">
                    <div class="review-header text-center">
                        <div class="step-indicator">
                            <div class="step completed">
                                <div class="step-icon">
                                    <i class="ti-shopping-cart"></i>
                                </div>
                                <span>Chọn tour</span>
                            </div>
                            <div class="step active">
                                <div class="step-icon">
                                    <i class="ti-clipboard"></i>
                                </div>
                                <span>Xác nhận</span>
                            </div>
                            <div class="step">
                                <div class="step-icon">
                                    <i class="ti-credit-card"></i>
                                </div>
                                <span>Thanh toán</span>
                            </div>
                        </div>

                        <h3 class="mt-4">Xác nhận đặt tour</h3>
                        <p class="text-muted">Vui lòng kiểm tra lại thông tin đặt tour của bạn</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success mt-3 mb-3">
                            <i class="ti-check"></i> {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger mt-3 mb-3">
                            <i class="ti-close"></i> {{ session('error') }}
                        </div>
                    @endif

                    <div class="review-content">
                        <div class="tour-summary">
                            <div class="tour-image">
                                <img src="{{ asset('frontend/img/tours/' . $tour->image) }}" alt="{{ $tour->name }}">
                            </div>
                            <div class="tour-info">
                                <h4>{{ $tour->name }}</h4>
                                <div class="tour-meta">
                                    <span><i class="ti-location-pin"></i> {{ $tour->destination->name }}</span>
                                    <span><i class="ti-timer"></i> {{ $tour->duration }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Hold Slot Notice -->
                        <div class="alert alert-warning mb-4 d-flex align-items-center justify-content-between">
                            <div>
                                <i class="ti-timer me-2 fs-5"></i> <strong>Thời gian giữ chỗ:</strong> Đơn đặt tour sẽ được hệ thống giữ chỗ trong <strong>15 phút</strong>.
                            </div>
                            <span class="badge bg-danger p-2 fs-6" id="holdCountdownTimer">⏱ 15:00</span>
                        </div>

                        <!-- Mã Khuyến Mãi Section -->
                        <div class="voucher-box p-3 mb-4 rounded border bg-light">
                            <h6 class="mb-3"><i class="ti-ticket"></i> Mã giảm giá / Ưu đãi</h6>
                            @if(!empty($bookingData['voucher_code']))
                                <div class="d-flex justify-content-between align-items-center bg-white p-2 px-3 rounded border border-success">
                                    <div>
                                        <span class="badge bg-success me-2">{{ $bookingData['voucher_code'] }}</span>
                                        <span class="text-success fw-bold">Đã giảm -{{ number_format($bookingData['discount_amount']) }} VNĐ</span>
                                    </div>
                                    <form action="{{ route('frontend.bookings.remove-voucher', $tour) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hủy mã</button>
                                    </form>
                                </div>
                            @else
                                <form action="{{ route('frontend.bookings.apply-voucher', $tour) }}" method="POST" class="d-flex gap-2">
                                    @csrf
                                    <input type="text" name="voucher_code" class="form-control" placeholder="Nhập mã giảm giá (VD: SUMMER2026)..." required>
                                    <button type="submit" class="btn btn-dark text-nowrap">Áp dụng</button>
                                </form>
                            @endif
                        </div>

                        @php
                            $orig = (float) ($bookingData['original_amount'] ?? $bookingData['total_amount']);
                            $disc = (float) ($bookingData['discount_amount'] ?? 0);
                            $net = max(0, $orig - $disc);
                            $isDep = !empty($bookingData['is_deposit']);
                            $depAmt = round($net * 0.30);
                            $remAmt = max(0, $net - $depAmt);
                        @endphp

                        <!-- Form Chọn Tùy Chọn Thanh Toán (Cọc 30% vs Trả 100%) -->
                        <div class="payment-options-box p-3 mb-4 rounded border bg-white shadow-sm">
                            <h6 class="mb-3 text-dark fw-bold"><i class="ti-wallet text-primary"></i> Chọn phương thức điều phối dòng tiền:</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <a href="{{ route('frontend.bookings.review', ['tour' => $tour, 'payment_option' => 'full']) }}" class="text-decoration-none">
                                        <div class="p-3 border rounded text-center cursor-pointer {{ !$isDep ? 'border-primary bg-light' : 'border-secondary' }}">
                                            <div class="form-check d-inline-block">
                                                <input class="form-check-input" type="radio" name="pay_opt" id="opt_full" {{ !$isDep ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold text-dark" for="opt_full">💳 Thanh toán 100%</label>
                                            </div>
                                            <p class="small text-muted mb-0 mt-1">Trừ thẳng voucher, hoàn tất 100% đơn hàng.</p>
                                            <div class="fw-bold text-primary fs-5 mt-2">{{ number_format($net) }} VNĐ</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('frontend.bookings.review', ['tour' => $tour, 'payment_option' => 'deposit']) }}" class="text-decoration-none">
                                        <div class="p-3 border rounded text-center cursor-pointer {{ $isDep ? 'border-primary bg-light' : 'border-secondary' }}">
                                            <div class="form-check d-inline-block">
                                                <input class="form-check-input" type="radio" name="pay_opt" id="opt_deposit" {{ $isDep ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold text-dark" for="opt_deposit">💰 Đặt cọc 30% giữ chỗ</label>
                                            </div>
                                            <p class="small text-muted mb-0 mt-1">Trả trước 30%, 70% còn lại trả trước ngày đi.</p>
                                            <div class="fw-bold text-warning fs-5 mt-2">{{ number_format($depAmt) }} VNĐ</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="booking-details">
                            <h5>Chi tiết đặt tour</h5>
                            <div class="detail-item">
                                <span class="label">Ngày khởi hành:</span>
                                <span class="value">{{ \Carbon\Carbon::parse($bookingData['booking_date'])->format('d/m/Y') }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Số người lớn:</span>
                                <span class="value">{{ $bookingData['adults'] }} x {{ number_format($tour->price) }} VNĐ</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Số trẻ em:</span>
                                <span class="value">{{ $bookingData['children'] }} x {{ number_format($tour->price_children) }} VNĐ</span>
                            </div>
                            @if(!empty($bookingData['notes']))
                                <div class="detail-item">
                                    <span class="label">Ghi chú:</span>
                                    <span class="value">{{ $bookingData['notes'] }}</span>
                                </div>
                            @endif

                            @if($disc > 0)
                                <div class="detail-item">
                                    <span class="label">Tạm tính gốc:</span>
                                    <span class="value">{{ number_format($orig) }} VNĐ</span>
                                </div>
                                <div class="detail-item text-success">
                                    <span class="label text-success">Giảm giá (Mã {{ $bookingData['voucher_code'] }}):</span>
                                    <span class="value">-{{ number_format($disc) }} VNĐ</span>
                                </div>
                            @endif

                            <div class="detail-item">
                                <span class="label">Tổng giá trị tour ròng:</span>
                                <span class="value text-dark fw-bold">{{ number_format($net) }} VNĐ</span>
                            </div>

                            @if($isDep)
                                <div class="detail-item bg-light p-2 rounded text-warning">
                                    <span class="label text-dark fw-bold">💰 Số tiền Đặt cọc (30%) trả ngay:</span>
                                    <span class="value text-warning fw-bold fs-5">{{ number_format($depAmt) }} VNĐ</span>
                                </div>
                                <div class="detail-item">
                                    <span class="label">Số tiền nợ còn lại (70%):</span>
                                    <span class="value text-danger">{{ number_format($remAmt) }} VNĐ</span>
                                </div>
                            @endif

                            <div class="detail-item total">
                                <span class="label">Số tiền phải thanh toán ngay:</span>
                                <span class="value text-primary fs-4">{{ number_format($isDep ? $depAmt : $net) }} VNĐ</span>
                            </div>
                        </div>

                        <div class="review-actions">
                            <form action="{{ route('frontend.bookings.store', ['tour' => $tour]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-block">
                                    Xác nhận đặt tour <i class="ti-arrow-right"></i>
                                </button>
                            </form>
                            <a href="{{ route('frontend.tours.show', $tour) }}" class="btn btn-outline-secondary btn-block mt-3">
                                <i class="ti-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.booking-review {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 60px 0;
}

.review-card {
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

.tour-summary {
    display: flex;
    gap: 20px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
    margin-bottom: 30px;
}

.tour-image {
    width: 200px;
    height: 150px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
}

.tour-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.tour-info h4 {
    margin-bottom: 10px;
}

.tour-meta {
    display: flex;
    gap: 15px;
    color: #6c757d;
}

.booking-details {
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 30px;
}

.booking-details h5 {
    margin-bottom: 20px;
    color: #333;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
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
}

.detail-item.total .value {
    color: #aa8453;
    font-size: 1.2em;
}

.btn {
    padding: 15px 30px;
    border-radius: 8px;
    font-weight: 500;
}

.btn-primary {
    background: #aa8453;
    border-color: #aa8453;
}

.btn-primary:hover {
    background: #96744a;
    border-color: #96744a;
}

.btn-outline-secondary {
    color: #6c757d;
    border-color: #6c757d;
}

.btn-outline-secondary:hover {
    background: #6c757d;
    color: white;
}

@media (max-width: 768px) {
    .review-card {
        padding: 20px;
    }

    .tour-summary {
        flex-direction: column;
    }

    .tour-image {
        width: 100%;
        height: 200px;
    }

    .tour-meta {
        flex-direction: column;
        gap: 5px;
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
}
</style>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var totalSeconds = 15 * 60;
    var timerDisplay = document.getElementById('holdCountdownTimer');
    if (!timerDisplay) return;

    var interval = setInterval(function() {
        if (totalSeconds <= 0) {
            clearInterval(interval);
            timerDisplay.innerHTML = "00:00 - Hết giờ";
            timerDisplay.classList.remove('bg-danger');
            timerDisplay.classList.add('bg-dark');
            return;
        }
        totalSeconds--;
        var minutes = Math.floor(totalSeconds / 60);
        var seconds = totalSeconds % 60;
        var minStr = minutes < 10 ? '0' + minutes : minutes;
        var secStr = seconds < 10 ? '0' + seconds : seconds;
        timerDisplay.innerHTML = '⏱ ' + minStr + ':' + secStr;
    }, 1000);
});
</script>
@endpush
@endpush 