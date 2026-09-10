@extends('layouts.frontend')

@section('content')
<div class="booking-failed section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="icon mb-4">
                    <i class="ti-close text-danger" style="font-size: 48px;"></i>
                </div>
                <h2 class="mb-4">Thanh Toán Không Thành Công!</h2>
                <p class="text-muted mb-4">Rất tiếc, giao dịch của bạn không thể hoàn thành. Vui lòng thử lại sau.</p>
                <div class="actions">
                    <a href="{{ url()->previous() }}" class="butn-dark">
                        <span>Thử Lại</span>
                    </a>
                    <a href="{{ route('frontend.tours.index') }}" class="butn">
                        <span>Xem Tour Khác</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.booking-failed {
    background: #f8f9fa;
    padding: 80px 0;
}
.icon {
    margin-bottom: 30px;
}
.actions {
    display: flex;
    gap: 15px;
    justify-content: center;
}
.actions a {
    min-width: 150px;
}
</style>
@endsection 