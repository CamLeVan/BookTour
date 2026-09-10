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

                        <form wire:submit.prevent="submit">
                            {{-- Ngày khởi hành --}}
                            <div class="form-group mb-4">
                                <label>Ngày khởi hành <span class="text-danger">*</span></label>
                                <input type="date" 
                                       wire:model="bookingDate"
                                       class="form-control @error('bookingDate') is-invalid @enderror"
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                       required>
                                @error('bookingDate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Số lượng người --}}
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Người lớn <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <button type="button" class="btn btn-outline-secondary" wire:click="updateQuantity('adults', -1)">-</button>
                                            <input type="number" 
                                                   wire:model="adults"
                                                   class="form-control text-center @error('adults') is-invalid @enderror"
                                                   min="1"
                                                   max="10"
                                                   required>
                                            <button type="button" class="btn btn-outline-secondary" wire:click="updateQuantity('adults', 1)">+</button>
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
                                            <button type="button" class="btn btn-outline-secondary" wire:click="updateQuantity('children', -1)">-</button>
                                            <input type="number" 
                                                   wire:model="children"
                                                   class="form-control text-center @error('children') is-invalid @enderror"
                                                   min="0"
                                                   max="5">
                                            <button type="button" class="btn btn-outline-secondary" wire:click="updateQuantity('children', 1)">+</button>
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
                                    <div class="col-8">Người lớn ({{ $adults }} × {{ number_format($tour->price) }}đ)</div>
                                    <div class="col-4 text-end">{{ number_format($this->adultTotal) }}đ</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-8">Trẻ em ({{ $children }} × {{ number_format($tour->price * 0.5) }}đ)</div>
                                    <div class="col-4 text-end">{{ number_format($this->childrenTotal) }}đ</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-8"><strong>Tổng tiền</strong></div>
                                    <div class="col-4 text-end">
                                        <strong class="text-primary">{{ number_format($this->totalAmount) }}đ</strong>
                                    </div>
                                </div>
                            </div>

                            {{-- Ghi chú --}}
                            <div class="form-group mb-4">
                                <label>Ghi chú</label>
                                <textarea wire:model="notes" 
                                          class="form-control @error('notes') is-invalid @enderror"
                                          rows="3"></textarea>
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

<style>
/* Main Container */
.booking-form {
    padding: 80px 0;
    background: linear-gradient(rgba(255,255,255,.9), rgba(255,255,255,.9)), url('/images/pattern.png');
}

/* Card Styling */
.card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(170,132,83,0.15);
}

.card-body {
    padding: 40px;
}

/* Tour Info Section */
.tour-info {
    background: linear-gradient(45deg, #f8f9fa, #fff);
    padding: 25px;
    border-radius: 15px;
    border: 1px solid rgba(170,132,83,0.1);
    margin-bottom: 30px;
}

.tour-info h4 {
    color: #aa8453;
    font-size: 1.5em;
    margin-bottom: 15px;
    font-weight: 600;
}

.price {
    color: #666;
    font-size: 1.1em;
    margin-bottom: 8px;
}

/* Form Controls */
.form-group {
    margin-bottom: 25px;
}

.form-control {
    padding: 12px 15px;
    border: 2px solid #eee;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #aa8453;
    box-shadow: 0 0 0 0.2rem rgba(170,132,83,0.15);
}

/* Quantity Input Group */
.input-group {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
}

.input-group .btn {
    padding: 12px 20px;
    background: #f8f9fa;
    border: 1px solid #eee;
    color: #aa8453;
    font-weight: 600;
    transition: all 0.3s ease;
}

.input-group .btn:hover {
    background: #aa8453;
    color: white;
    border-color: #aa8453;
}

.input-group input {
    border: 1px solid #eee;
    text-align: center;
    font-weight: 600;
    color: #444;
}

/* Price Details Section */
.price-details {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 15px;
    border: 1px solid rgba(170,132,83,0.1);
    margin: 30px 0;
}

.price-details .row {
    margin-bottom: 12px;
    color: #666;
}

.price-details hr {
    margin: 20px 0;
    border-color: rgba(170,132,83,0.1);
}

.text-primary {
    color: #aa8453 !important;
    font-size: 1.4em;
    font-weight: 700;
}

/* Submit Button */
.btn-primary {
    padding: 15px 30px;
    background: linear-gradient(45deg, #aa8453, #c69c6d);
    border: none;
    border-radius: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.4s ease;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #c69c6d, #aa8453);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(170,132,83,0.3);
}

/* Error States */
.is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.85em;
    margin-top: 5px;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .card-body {
        padding: 25px;
    }
    
    .tour-info, .price-details {
        padding: 20px;
    }
    
    .btn-primary {
        padding: 12px 25px;
    }
}

/* Remove number input arrows */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Custom date input styling */
input[type="date"] {
    position: relative;
    padding-right: 35px;
}

input[type="date"]::-webkit-calendar-picker-indicator {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    filter: invert(60%) sepia(11%) saturate(1103%) hue-rotate(355deg) brightness(89%) contrast(86%);
}

/* Textarea styling */
textarea {
    resize: vertical;
    min-height: 100px;
}

/* Label styling */
label {
    color: #555;
    font-weight: 500;
    margin-bottom: 8px;
}

/* Required field indicator */
.text-danger {
    color: #dc3545;
    font-weight: bold;
}

/* Hover effects */
.input-group:hover {
    box-shadow: 0 5px 15px rgba(170,132,83,0.1);
}

.price-details:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}
</style>