@extends('layouts.frontend')

@section('content')
<div class="booking-review section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="review-card">
                    <div class="review-header">
                        <h3>Xác nhận đặt tour</h3>
                        <p class="text-muted">Vui lòng kiểm tra lại thông tin trước khi thanh toán</p>
                    </div>

                    <div class="tour-details">
                        <h4>{{ $pendingBooking->tour->name }}</h4>
                        <div class="details-grid">
                            <div class="detail-item">
                                <i class="ti-calendar"></i>
                                <div>
                                    <span class="label">Ngày khởi hành</span>
                                    <span class="value">{{ $pendingBooking->booking_date->format('d/m/Y') }}</span>
                                </div>
                            </div>

                            <div class="detail-item">
                                <i class="ti-user"></i>
                                <div>
                                    <span class="label">Số người</span>
                                    <span class="value">{{ $pendingBooking->adults }} người lớn, {{ $pendingBooking->children }} trẻ em</span>
                                </div>
                            </div>

                            @if($pendingBooking->notes)
                            <div class="detail-item full-width">
                                <i class="ti-notepad"></i>
                                <div>
                                    <span class="label">Ghi chú</span>
                                    <span class="value">{{ $pendingBooking->notes }}</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="price-summary">
                        <div class="price-row">
                            <span>Người lớn ({{ $pendingBooking->adults }} x {{ number_format($pendingBooking->tour->price) }}đ)</span>
                            <span>{{ number_format($pendingBooking->adults * $pendingBooking->tour->price) }}đ</span>
                        </div>
                        @if($pendingBooking->children > 0)
                        <div class="price-row">
                            <span>Trẻ em ({{ $pendingBooking->children }} x {{ number_format($pendingBooking->tour->price * 0.5) }}đ)</span>
                            <span>{{ number_format($pendingBooking->children * $pendingBooking->tour->price * 0.5) }}đ</span>
                        </div>
                        @endif
                        <div class="price-total">
                            <span>Tổng tiền</span>
                            <span class="total-amount">{{ $pendingBooking->formatted_amount }}</span>
                        </div>
                    </div>

                    <form action="{{ route('frontend.bookings.confirm', $pendingBooking) }}" method="POST" class="review-actions">
                        @csrf
                        <a href="{{ route('frontend.bookings.create', $pendingBooking->tour) }}" class="btn btn-outline-secondary">
                            <i class="ti-arrow-left"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Tiến hành thanh toán <i class="ti-credit-card"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.review-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 0 30px rgba(0,0,0,0.1);
    padding: 30px;
}

.review-header {
    text-align: center;
    margin-bottom: 30px;
}

.details-grid {
    display: grid;
    gap: 20px;
    margin: 20px 0;
}

.detail-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.detail-item i {
    color: #aa8453;
    font-size: 1.2em;
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

.full-width {
    grid-column: 1 / -1;
}
</style>
@endpush 