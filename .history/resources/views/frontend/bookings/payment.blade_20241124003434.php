@extends('layouts.frontend')

@section('content')
<div class="payment-page section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="payment-card">
                    <div class="payment-header text-center">
                        <h3>Thanh toán</h3>
                        <p class="text-muted">Vui lòng quét mã QR để thanh toán</p>
                        
                        <div class="amount-display">
                            <span class="label">Số tiền cần thanh toán:</span>
                            <span class="amount">{{ $pendingBooking->formatted_amount }}</span>
                        </div>
                    </div>

                    <div class="qr-container text-center">
                        <img src="{{ $qrCode }}" alt="QR Code" class="qr-code">
                        <div class="bank-info">
                            <p><strong>Ngân hàng:</strong> Vietcombank</p>
                            <p><strong>Số tài khoản:</strong> 1039398990</p>
                            <p><strong>Chủ tài khoản:</strong> LE VAN CAM</p>
                            <p><strong>Nội dung CK:</strong> {{ $pendingBooking->reference_code }}</p>
                        </div>
                    </div>

                    <div class="payment-note">
                        <div class="alert alert-info">
                            <i class="ti-info-alt"></i>
                            <ul class="mb-0">
                                <li>Vui lòng thanh toán trong vòng {{ config('payment.expire_after', 60) }} phút</li>
                                <li>Ghi đúng nội dung chuyển khoản</li>
                                <li>Đơn hàng sẽ tự động xác nhận sau khi thanh toán thành công</li>
                            </ul>
                        </div>
                    </div>

                    <div id="paymentStatus" class="payment-status">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Đang kiểm tra...</span>
                        </div>
                        <p>Đang chờ thanh toán...</p>
                    </div>

                    <div class="payment-actions">
                        <!-- Chỉ hiển thị trong môi trường development -->
                        @if(config('app.env') === 'local')
                            <form action="{{ route('frontend.bookings.simulate-payment', $pendingBooking) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    Giả lập thanh toán thành công
                                </button>
                            </form>
                        @endif
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

.qr-container {
    margin: 30px 0;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 15px;
}

.qr-code {
    max-width: 300px;
    margin-bottom: 20px;
}

.bank-info {
    text-align: left;
    max-width: 300px;
    margin: 0 auto;
}

.bank-info p {
    margin-bottom: 8px;
}

.payment-note {
    margin: 30px 0;
}

.payment-note .alert {
    display: flex;
    gap: 15px;
}

.payment-note ul {
    padding-left: 0;
    list-style: none;
}

.payment-status {
    text-align: center;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkPaymentStatus = async () => {
        try {
            const response = await fetch('{{ route("frontend.bookings.check-status", $pendingBooking) }}');
            const data = await response.json();

            if (data.status === 'completed') {
                window.location.href = data.redirect_url;
            } else if (data.status === 'expired') {
                document.getElementById('paymentStatus').innerHTML = `
                    <div class="alert alert-danger">
                        ${data.message}
                    </div>
                `;
                clearInterval(statusCheck);
            }
        } catch (error) {
            console.error('Error checking payment status:', error);
        }
    };

    // Check every 5 seconds
    const statusCheck = setInterval(checkPaymentStatus, 5000);
});
</script>
@endpush 