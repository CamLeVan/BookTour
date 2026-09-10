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