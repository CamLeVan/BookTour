@props(['tours', 'destinations'])

<div class="tours3 section-padding">
    <div class="container">
        <div class="row">
            <!-- Tour list -->
            <div class="col-md-8">
                <div class="row">
                    @forelse($tours as $tour)
                    <div class="col-md-6">
                        <div class="square-flip">
                            <a href="{{ route('frontend.tours.show', $tour) }}" class="tour-card-link">
                                <div class="square bg-img" data-background="{{ asset('frontend/img/tours/' . $tour->image) }}">
                                    <span class="category">
                                        <!-- Đã bỏ thẻ <a> ở đây, chỉ giữ lại nội dung -->
                                        <span>{{ $tour->destination->name }}</span>
                                    </span>
                                    <div class="square-container d-flex align-items-end justify-content-end">
                                        <div class="box-title">
                                            <h4>{{ $tour->name }}</h4>
                                            <h6>{{ number_format($tour->price) }}đ / người</h6>
                                        </div>
                                    </div>
                                    <div class="flip-overlay"></div>
                                </div>
                            </a>
                            <div class="square2">
                                <div class="square-container2">
                                    <h4>{{ $tour->name }}</h4>
                                    <h6>{{ number_format($tour->price) }}đ / người</h6>
                                    <p>{{ Str::limit($tour->description, 100) }}</p>
                                    <div class="row tour-list mb-30">
                                        <div class="col col-md-6">
                                            <ul>
                                                <li><i class="ti-time"></i> {{ $tour->duration }} Ngày</li>
                                                <li><i class="ti-user"></i> {{ $tour->group_size }}+</li>
                                            </ul>
                                        </div>
                                        <div class="col col-md-6">
                                            <ul>
                                                <li><i class="ti-location-pin"></i> {{ $tour->destination->name }}</li>
                                                <li><i class="ti-face-smile"></i> {{ number_format($tour->rating, 1) }} Tuyệt vời</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="btn-line">
                                        <a href="{{ route('frontend.tours.show', $tour) }}">Chi tiết tour</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            Không tìm thấy tour nào phù hợp
                        </div>
                    </div>
                    @endforelse
                </div>
                
                {{ $tours->links() }}
            </div>

            <!-- Tour search -->
            <div class="col-md-4">
                <div class="sidebar">
                    <div class="search-box">
                        <div class="search-header">
                            <h3>
                                <i class="ti-search me-2"></i>
                                Tìm Tour
                            </h3>
                        </div>
                        <div class="search-body">
                            <form method="GET" action="{{ route('frontend.tours.index') }}">
                                <div class="form-group mb-4">
                                    <label class="form-label">
                                        <i class="ti-location-pin me-2"></i>Điểm đến
                                    </label>
                                    <select name="destination" class="form-select select2">
                                        <option value="">Chọn điểm đến</option>
                                        @foreach($destinations as $destination)
                                            <option value="{{ $destination->id }}" 
                                                {{ request('destination') == $destination->id ? 'selected' : '' }}>
                                                {{ $destination->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">
                                        <i class="ti-money me-2"></i>Giá tiền
                                    </label>
                                    <div class="price-range">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Từ</span>
                                            <input type="number" name="price_min" class="form-control" placeholder="Giá tối thiểu" value="{{ request('price_min') }}">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text">Đến</span>
                                            <input type="number" name="price_max" class="form-control" placeholder="Giá tối đa" value="{{ request('price_max') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label class="form-label">
                                        <i class="ti-calendar me-2"></i>Thời gian
                                    </label>
                                    <div class="date-inputs">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="ti-calendar"></i></span>
                                            <input type="text" name="start_date" 
                                                   class="form-control datepicker" 
                                                   placeholder="Ngày bắt đầu"
                                                   value="{{ request('start_date') }}">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="ti-calendar"></i></span>
                                            <input type="text" name="end_date" 
                                                   class="form-control datepicker" 
                                                   placeholder="Ngày kết thúc"
                                                   value="{{ request('end_date') }}">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="search-btn">
                                    <i class="ti-search me-2"></i>
                                    <span>Tìm Tour</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

@push('styles')
<style>
/* Search Box Styles */
.search-box {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.search-header {
    background: linear-gradient(45deg, #2095AE, #26B7D4);
    padding: 20px;
    color: white;
}

.search-header h3 {
    margin: 0;
    font-size: 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.search-body {
    padding: 25px;
}

/* Form Controls */
.form-label {
    color: #666;
    font-weight: 500;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
}

.form-select, .form-control {
    border: 1px solid #e5e5e5;
    padding: 12px 15px;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.form-select:focus, .form-control:focus {
    border-color: #2095AE;
    box-shadow: 0 0 0 0.2rem rgba(32, 149, 174, 0.15);
}

/* Date Inputs */
.date-inputs .input-group {
    border-radius: 8px;
    overflow: hidden;
}

.input-group-text {
    background: #f8f9fa;
    border: 1px solid #e5e5e5;
    color: #2095AE;
}

/* Search Button */
.search-btn {
    width: 100%;
    padding: 14px;
    background: linear-gradient(45deg, #2095AE, #26B7D4);
    border: none;
    border-radius: 8px;
    color: white;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.search-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(32, 149, 174, 0.3);
}

/* Select2 Customization */
/* Select2 Customization */
.select2-container--default .select2-selection--single {
    border: 1px solid #e5e5e5;
    height: 45px;
    border-radius: 8px;
    display: flex;
    align-items: center; /* Căn giữa theo chiều dọc */
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: normal; /* Thay đổi từ line-height: 45px */
    padding-left: 15px;
    display: flex;
    align-items: center;
    height: 100%;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 100%;
    display: flex;
    align-items: center;
}

/* Thêm style cho dropdown */
.select2-dropdown {
    border-color: #e5e5e5;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.select2-container--default .select2-search--dropdown .select2-search__field {
    border: 1px solid #e5e5e5;
    border-radius: 4px;
    padding: 8px;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #2095AE;
}
/* Datepicker Customization */
.datepicker {
    border-radius: 8px;
}

.datepicker table tr td.active.active {
    background: #2095AE;
    border-color: #2095AE;
}

/* Responsive */
@media (max-width: 768px) {
    .search-box {
        margin-top: 30px;
    }
}
</style>
@endpush 