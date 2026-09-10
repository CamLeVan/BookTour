@extends('layouts.frontend')

@section('content')
<div class="bank-transfer-page section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="transfer-card">
                    <div class="transfer-header">
                        <h4>Thông tin chuyển khoản</h4>
                        <p>Vui lòng chuyển khoản theo thông tin dưới đây</p>
                    </div>

                    <div class="bank-info">
                        <div class="info-item">
                            <span class="label">Ngân hàng</span>
                            <span class="value">{{ $bankInfo['bank_name'] }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Số tài khoản</span>
                            <span class="value copy-text">{{ $bankInfo['account_number'] }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Chủ tài khoản</span>
                            <span class="value">{{ $bankInfo['account_name'] }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Chi nhánh</span>
                            <span class="value">{{ $bankInfo['branch'] }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Số tiền</span>
                            <span class="value highlight">{{ number_format($booking->total_price) }} VNĐ</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Nội dung chuyển khoản</span>
                            <span class="value copy-text">{{ $bankInfo['content'] }}</span>
                        </div>
                    </div>

                    <div class="transfer-note">
                        <p><i class="ti-info-alt"></i> Lưu ý:</p>
                        <ul>
                            <li>Vui lòng chuyển khoản trong vòng 24h</li>
                            <li>Ghi đúng nội dung chuyển khoản</li>
                            <li>Giữ lại biên lai chuyển khoản</li>
                        </ul>
                    </div>

                    <div class="transfer-actions">
                        <a href="{{ route('frontend.tours.index') }}" class="butn">
                            <span>Xem Tour Khác</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bank-transfer-page {
    background: #f8f9fa;
    padding: 60px 0;
}
.transfer-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 0 30px rgba(0,0,0,0.1);
    overflow: hidden;
}
/* ... thêm CSS khác ... */
</style>
@endsection 