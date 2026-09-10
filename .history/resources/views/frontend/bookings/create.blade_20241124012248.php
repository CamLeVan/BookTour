@extends('layouts.frontend')

@section('content')
<div class="booking-form section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3>Đặt Tour</h3>
                        <div class="tour-info mb-4">
                            <h4>{{ $tour->name }}</h4>
                            <p class="price">Giá: {{ number_format($tour->price) }}đ/người lớn</p>
                            <p class="price">Giá trẻ em: {{ number_format($tour->price * 0.5) }}đ/trẻ em</p>
                        </div>

                        <form action="{{ route('frontend.bookings.store', $tour) }}" method="POST">
                            @csrf
                            
                            {{-- Ngày khởi hành --}}
                            <div class="form-group mb-4">
                                <label>Ngày khởi hành <span class="text-danger">*</span></label>
                                <input type="date" 
                                       name="booking_date" 
                                       class="form-control @error('booking_date') is-invalid @enderror"
                                       value="{{ old('booking_date') }}"
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                       required>
                                @error('booking_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Số lượng người --}}
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Người lớn <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <button type="button" class="btn btn-outline-secondary" onclick="updateQuantity('adults', -1)">-</button>
                                            <input type="number" 
                                                   name="adults" 
                                                   id="adults"
                                                   class="form-control text-center @error('adults') is-invalid @enderror"
                                                   value="{{ old('adults', 1) }}"
                                                   min="1"
                                                   required>
                                            <button type="button" class="btn btn-outline-secondary" onclick="updateQuantity('adults', 1)">+</button>
                                        </div>
                                        @error('adults')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Trẻ em (dưới 12 tuổi)</label>
                                        <div class="input-group">
                                            <button type="button" class="btn btn-outline-secondary" onclick="updateQuantity('children', -1)">-</button>
                                            <input type="number" 
                                                   name="children" 
                                                   id="children"
                                                   class="form-control text-center @error('children') is-invalid @enderror"
                                                   value="{{ old('children', 0) }}"
                                                   min="0">
                                            <button type="button" class="btn btn-outline-secondary" onclick="updateQuantity('children', 1)">+</button>
                                        </div>
                                        @error('children')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Chi tiết giá --}}
                            <div class="price-details mb-4">
                                <div class="row mb-2">
                                    <div class="col-8">Người lớn (<span id="adultCount">1</span> × {{ number_format($tour->price) }}đ)</div>
                                    <div class="col-4 text-end" id="adultTotal">{{ number_format($tour->price) }}đ</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-8">Trẻ em (<span id="childCount">0</span> × {{ number_format($tour->price * 0.5) }}đ)</div>
                                    <div class="col-4 text-end" id="childTotal">0đ</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-8">
                                        <strong>Tổng tiền</strong>
                                    </div>
                                    <div class="col-4 text-end">
                                        <strong id="totalAmount" class="text-primary">{{ number_format($tour->price) }}đ</strong>
                                    </div>
                                </div>
                            </div>

                            {{-- Ghi chú --}}
                            <div class="form-group mb-4">
                                <label>Ghi chú</label>
                                <textarea name="notes" 
                                          class="form-control @error('notes') is-invalid @enderror"
                                          rows="3">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Tiếp tục <i class="ti-arrow-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.booking-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 0 30px rgba(0,0,0,0.1);
    padding: 30px;
}

.booking-header {
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.tour-info {
    margin-top: 15px;
}

.tour-info .price {
    color: #aa8453;
    font-size: 1.2em;
    font-weight: 600;
}

.form-group {
    margin-bottom: 20px;
}

.booking-actions {
    margin-top: 30px;
    display: flex;
    justify-content: space-between;
}

.btn-primary {
    background: #aa8453;
    border-color: #aa8453;
}

.btn-primary:hover {
    background: #957547;
    border-color: #957547;
}

.price-summary {
    margin-top: 30px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
}

.price-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    color: #666;
}

.price-total {
    display: flex;
    justify-content: space-between;
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #ddd;
    font-weight: 600;
    font-size: 1.2em;
}

#totalPrice {
    color: #aa8453;
}

/* Thêm style cho input number và buttons */
.input-group .btn {
    padding: 8px 15px;
    background: #f8f9fa;
    border: 1px solid #ddd;
    color: #666;
    font-weight: bold;
    transition: all 0.3s ease;
}

.input-group .btn:hover {
    background: #aa8453;
    border-color: #aa8453;
    color: white;
}

.input-group input[type="number"] {
    text-align: center;
    font-weight: 500;
    border-left: none;
    border-right: none;
}

/* Ẩn mũi tên mặc định của input number */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Style cho price details */
.price-details {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    border: 1px solid rgba(170, 132, 83, 0.1);
}

.price-details hr {
    border-color: rgba(170, 132, 83, 0.1);
    margin: 15px 0;
}

.text-primary {
    color: #aa8453 !important;
    font-size: 1.2em;
}

/* Card styles */
.card {
    border: none;
    box-shadow: 0 0 30px rgba(0,0,0,0.1);
    border-radius: 15px;
}

.tour-info {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 30px;
    border: 1px solid rgba(170, 132, 83, 0.1);
}

.tour-info h4 {
    color: #aa8453;
    margin-bottom: 15px;
}

/* Button styles */
.btn-primary {
    background: linear-gradient(45deg, #aa8453, #c69c6d);
    border: none;
    padding: 12px 25px;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #c69c6d, #aa8453);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(170, 132, 83, 0.3);
}
</style>
@endpush

@push('scripts')
<script>
// Thêm hàm updateQuantity để xử lý nút +/-
function updateQuantity(type, change) {
    const input = document.getElementById(type);
    let value = parseInt(input.value) || 0;
    
    if (type === 'adults') {
        value = Math.max(1, Math.min(10, value + change)); // Min 1, Max 10 adults
    } else {
        value = Math.max(0, Math.min(5, value + change));  // Min 0, Max 5 children
    }
    
    input.value = value;
    calculateTotal();
}

document.addEventListener('DOMContentLoaded', function() {
    const tourPrice = {{ $tour->price }};
    const childPrice = tourPrice * 0.5;
    
    const adultsInput = document.querySelector('input[name="adults"]');
    const childrenInput = document.querySelector('input[name="children"]');
    
    const adultCount = document.getElementById('adultCount');
    const childCount = document.getElementById('childCount');
    const adultTotal = document.getElementById('adultTotal');
    const childTotal = document.getElementById('childTotal');
    const totalAmount = document.getElementById('totalAmount');

    function calculateTotal() {
        const adults = parseInt(adultsInput.value) || 0;
        const children = parseInt(childrenInput.value) || 0;

        // Cập nhật số lượng
        adultCount.textContent = adults;
        childCount.textContent = children;

        // Tính tiền chi tiết
        const adultTotalAmount = adults * tourPrice;
        const childTotalAmount = children * childPrice;
        const total = adultTotalAmount + childTotalAmount;

        // Debug
        console.log({
            adults, children,
            adultTotalAmount, childTotalAmount,
            total
        });

        // Cập nhật hiển thị
        adultTotal.textContent = `${new Intl.NumberFormat('vi-VN').format(adultTotalAmount)}đ`;
        childTotal.textContent = `${new Intl.NumberFormat('vi-VN').format(childTotalAmount)}đ`;
        totalAmount.textContent = `${new Intl.NumberFormat('vi-VN').format(total)}đ`;
    }

    // Tính khi thay đổi input
    adultsInput.addEventListener('input', calculateTotal);
    childrenInput.addEventListener('input', calculateTotal);

    // Tính lần đầu khi load trang
    calculateTotal();
});
</script>
@endpush 