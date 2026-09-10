@extends('layouts.frontend')

@section('content')
<div class="booking-failed section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="icon mb-4">
                    <i class="ti-close text-danger" style="font-size: 48px;"></i>
                </div>
                <h2 class="mb-4">Đặt Tour Thất Bại!</h2>
                <p class="mb-4">{{ session('error') ?? 'Có lỗi xảy ra trong quá trình thanh toán.' }}</p>
                <div class="mt-4">
                    <a href="{{ url()->previous() }}" class="butn-dark">
                        <span>Thử Lại</span>
                    </a>
                    <a href="{{ route('frontend.tours.index') }}" class="butn-dark">
                        <span>Xem Tour Khác</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 