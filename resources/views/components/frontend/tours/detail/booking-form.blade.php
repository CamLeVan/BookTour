<div class="right-sidebar">
    <div class="right-sidebar-item booking-form">
        <!-- Hiển thị giá -->
        <div class="price-section mb-4">
            @if ($tour->sale_price)
                <div class="original-price text-decoration-line-through">
                    {{ number_format($tour->price) }}VND
                </div>
                <h3 class="sale-price">
                    {{ number_format($tour->sale_price) }}VND
                    <span class="badge bg-danger">Giảm {{ round((1 - $tour->sale_price / $tour->price) * 100) }}%</span>
                </h3>
            @else
                <h3 class="regular-price">{{ number_format($tour->price) }}VND</h3>
            @endif
        </div>
 
 
        <form method="POST" action="{{ route('frontend.tours.booking') }}" class="booking-form">
            @csrf
            <input type="hidden" name="tour_id" value="{{ $tour->id }}">
 
 
            <!-- Ngày khởi hành -->
            <div class="form-group mb-3">
                <label class="form-label">Ngày khởi hành <span class="text-danger">*</span></label>
                <input type="date" name="booking_date"
                    class="form-control @error('booking_date') is-invalid @enderror"
                    min="{{ date('Y-m-d', strtotime('+3 days')) }}" value="{{ old('booking_date') }}" required>
                @error('booking_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
 
 
            <!-- Số lượng người -->
            <div class="row mb-3">
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-label">Người lớn <span class="text-danger">*</span></label>
                        <input type="number" name="adults" class="form-control @error('adults') is-invalid @enderror"
                            min="1" value="{{ old('adults', 1) }}" required>
                        @error('adults')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-label">Trẻ em (Giảm 50%)</label>
                        <input type="number" name="children"
                            class="form-control @error('children') is-invalid @enderror" min="0"
                            value="{{ old('children', 0) }}">
                        @error('children')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
 
 
            <!-- Ghi chú -->
            <div class="form-group mb-4">
                <label class="form-label">Ghi chú</label>
                <textarea name="notes" class="form-control" rows="3" placeholder="Yêu cầu đặc biệt...">{{ old('notes') }}</textarea>
            </div>
 
 
            <!-- Hiển thị tổng tiền -->
            <div class="total-section mb-4">
                <div class="d-flex justify-content-between mb-2">
                    <span>Người lớn (<span id="adults-count">1</span> x {{ number_format($tour->price) }}VND)</span>
                    <span id="adults-total">{{ number_format($tour->price) }}đ</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Trẻ em (<span id="children-count">0</span> x
                        {{ number_format($tour->price * 0.5) }}VND)</span>
                    <span id="children-total">0VND</span>
                </div>
                <div class="d-flex justify-content-between fw-bold">
                    <span>Tổng cộng</span>
                    <span id="total-price" data-price="{{ $tour->sale_price ?? $tour->price }}">
                        {{ number_format($tour->price) }}VND
                    </span>
                </div>
            </div>
 
 
            @guest
                <div class="alert alert-warning mb-3">
                    Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để đặt tour
                </div>
            @else
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-shopping-cart me-2"></i>Đặt ngay
                </button>
            @endguest
        </form>
    </div>
 </div>
 
 
 @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pricePerAdult = {{ $tour->sale_price ?? $tour->price }};
            const pricePerChild = pricePerAdult * 0.5;
 
 
            function calculateTotal() {
                const adults = parseInt($('input[name="adults"]').val()) || 0;
                const children = parseInt($('input[name="children"]').val()) || 0;
 
 
                const adultsTotal = adults * pricePerAdult;
                const childrenTotal = children * pricePerChild;
                const total = adultsTotal + childrenTotal;
 
 
                $('#adults-count').text(adults);
                $('#children-count').text(children);
                $('#adults-total').text(formatMoney(adultsTotal) + 'VND');
                $('#children-total').text(formatMoney(childrenTotal) + 'VND');
                $('#total-price').text(formatMoney(total) + 'VND');
            }
 
 
            function formatMoney(amount) {
                return new Intl.NumberFormat('vi-VN').format(amount);
            }
 
 
            $('input[name="adults"], input[name="children"]').on('change', calculateTotal);
            calculateTotal();
        });
    </script>
 @endpush
 
 
 
 
 
 