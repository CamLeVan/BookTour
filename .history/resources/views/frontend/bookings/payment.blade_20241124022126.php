@extends('layouts.frontend')

@section('content')
<div class="payment-page section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="payment-card">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="payment-header text-center">
                        <h3>Thanh toán</h3>
                        <p class="text-muted">Vui lòng chọn phương thức thanh toán</p>
                        
                        <div class="amount-display">
                            <span class="label">Số tiền cần thanh toán:</span>
                            <span class="amount">{{ number_format($booking->total_amount) }} VNĐ</span>
                        </div>
                    </div>

                    <div class="payment-methods">
                        <form action="{{ route('frontend.bookings.process-payment', $booking) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <select name="payment_method" class="form-control @error('payment_method') is-invalid @enderror" required>
                                    <option value="">Chọn phương thức thanh toán</option>
                                    <option value="cash">Tiền mặt</option>
                                    <option value="transfer">Chuyển khoản</option>
                                    <option value="card">Thẻ tín dụng</option>
                                </select>
                                @error('payment_method')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-4">
                                Xác nhận thanh toán
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
.payment-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 0 30px rgba(0,0,0,0.1);
    padding: 30px;
}

.amount-display {
    margin: 20px 0;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
}

.amount-display .amount {
    display: block;
    color: #aa8453;
    font-size: 1.8em;
    font-weight: 600;
    margin-top: 5px;
}

.payment-methods {
    margin-top: 30px;
}

.form-control {
    height: 50px;
    border-radius: 10px;
}

.btn-primary {
    height: 50px;
    border-radius: 10px;
}
</style>
@endpush 