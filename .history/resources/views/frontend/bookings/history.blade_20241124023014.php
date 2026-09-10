@extends('layouts.frontend')

@section('content')
<div class="booking-history section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="history-card">
                    <div class="history-header">
                        <h3>Lịch Sử Đặt Tour</h3>
                        <p class="text-muted">Quản lý các tour bạn đã đặt</p>
                    </div>

                    @if($bookings->isEmpty())
                        <div class="empty-history text-center">
                            <div class="empty-icon">
                                <i class="ti-calendar"></i>
                            </div>
                            <h4>Chưa có tour nào</h4>
                            <p>Bạn chưa đặt tour nào. Hãy khám phá các tour của chúng tôi.</p>
                            <a href="{{ route('frontend.tours.index') }}" class="btn btn-primary">
                                Khám phá tour ngay <i class="ti-arrow-right"></i>
                            </a>
                        </div>
                    @else
                        <div class="booking-list">
                            @foreach($bookings as $booking)
                                <div class="booking-item">
                                    <div class="booking-header">
                                        <div class="booking-meta">
                                            <span class="booking-id">#{{ $booking->id }}</span>
                                            <span class="booking-date">
                                                <i class="ti-calendar"></i>
                                                {{ $booking->created_at->format('d/m/Y H:i') }}
                                            </span>
                                        </div>
                                        <div class="booking-status">
                                            <span class="status-badge {{ $booking->status }}">
                                                @switch($booking->status)
                                                    @case('pending')
                                                        Chờ xác nhận
                                                        @break
                                                    @case('confirmed')
                                                        Đã xác nhận
                                                        @break
                                                    @case('completed')
                                                        Hoàn thành
                                                        @break
                                                    @case('cancelled')
                                                        Đã hủy
                                                        @break
                                                @endswitch
                                            </span>
                                        </div>
                                    </div>

                                    <div class="booking-content">
                                        <div class="tour-info">
                                            <h4>
                                                <a href="{{ route('frontend.tours.show', $booking->tour) }}">
                                                    {{ $booking->tour->name }}
                                                </a>
                                            </h4>
                                            <div class="tour-meta">
                                                <span>
                                                    <i class="ti-time"></i>
                                                    Khởi hành: {{ $booking->booking_date->format('d/m/Y') }}
                                                </span>
                                                <span>
                                                    <i class="ti-user"></i>
                                                    {{ $booking->adults }} người lớn, {{ $booking->children }} trẻ em
                                                </span>
                                            </div>
                                        </div>

                                        <div class="booking-details">
                                            <div class="price-info">
                                                <span class="label">Tổng tiền:</span>
                                                <span class="price">{{ number_format($booking->total_price) }} VNĐ</span>
                                            </div>
                                            <div class="payment-info">
                                                <span class="payment-status {{ $booking->payment_status }}">
                                                    @if($booking->payment_status == 'paid')
                                                        <i class="ti-check"></i> Đã thanh toán
                                                    @else
                                                        <i class="ti-close"></i> Chưa thanh toán
                                                    @endif
                                                </span>
                                                @if($booking->payment_method)
                                                    <span class="payment-method">
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
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if($booking->notes)
                                        <div class="booking-notes">
                                            <i class="ti-notepad"></i>
                                            <span>{{ $booking->notes }}</span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach

                            <div class="pagination-wrapper">
                                {{ $bookings->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.booking-history {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 60px 0;
}

.history-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 0 30px rgba(0,0,0,0.1);
    padding: 40px;
}

.history-header {
    text-align: center;
    margin-bottom: 40px;
}

.empty-history {
    padding: 60px 20px;
}

.empty-icon {
    font-size: 4em;
    color: #dee2e6;
    margin-bottom: 20px;
}

.booking-item {
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.booking-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.booking-meta {
    display: flex;
    flex-direction: column;
}

.booking-id {
    font-weight: 500;
    color: #333;
}

.booking-date {
    color: #6c757d;
}

.booking-status {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.status-badge {
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 500;
    color: white;
}

.booking-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.tour-info {
    flex: 1;
}

.tour-info h4 {
    margin-bottom: 10px;
    color: #333;
}

.tour-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
}

.tour-meta span {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6c757d;
}

.booking-details {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
}

.price-info {
    flex: 1;
}

.price-info .label {
    color: #6c757d;
}

.price-info .price {
    font-weight: 500;
    color: #333;
}

.payment-info {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.payment-status {
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 500;
    color: white;
}

.payment-method {
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 500;
    color: white;
}

.booking-notes {
    margin-top: 20px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.booking-notes i {
    color: #6c757d;
}

.booking-notes span {
    color: #333;
}

.pagination-wrapper {
    margin-top: 40px;
    display: flex;
    justify-content: center;
}

.pagination-wrapper .pagination {
    display: flex;
    gap: 10px;
}

.pagination-wrapper .pagination .page-item {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.pagination-wrapper .pagination .page-item.active {
    background: #aa8453;
    color: white;
}

.pagination-wrapper .pagination .page-item:hover {
    background: #dee2e6;
}
</style>
@endpush 