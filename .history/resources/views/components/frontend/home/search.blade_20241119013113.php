<div class="booking-wrapper">
    <div class="container">
        <div class="tour-inner clearfix form-inline justify-content-center">
            <form action="{{ route('frontend.tours.index') }}" class="form1 clearfix">
                <div class="col1 c1">
                    <div class="select1_wrapper">
                        <label>Điểm đến</label>
                        <div class="select1_inner">
                            <select class="select2 select" style="width: 100%" name="destination">
                                <option value="">Tất cả điểm đến</option>
                                @foreach(\App\Models\Destination::all() as $destination)
                                    <option value="{{ $destination->id }}">
                                        {{ $destination->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col1 c2">
                    <div class="select1_wrapper">
                        <label>Thời gian</label>
                        <div class="select1_inner">
                            <select class="select2 select" style="width: 100%" name="duration">
                                <option value="">Tất cả thời gian</option>
                                <option value="1-3">1-3 ngày</option>
                                <option value="4-7">4-7 ngày</option>
                                <option value="8+">Trên 8 ngày</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col1 c3">
                    <div class="select1_wrapper">
                        <label>Giá tour</label>
                        <div class="select1_inner">
                            <select class="select2 select" style="width: 100%" name="price">
                                <option value="">Tất cả giá</option>
                                <option value="0-1000000">Dưới 1 triệu</option>
                                <option value="1000000-3000000">1-3 triệu</option>
                                <option value="3000000-5000000">3-5 triệu</option>
                                <option value="5000000+">Trên 5 triệu</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col1 c4">
                    <div class="select1_wrapper">
                        <label>Sắp xếp</label>
                        <div class="select1_inner">
                            <select class="select2 select" style="width: 100%" name="sort">
                                <option value="latest">Mới nhất</option>
                                <option value="price_asc">Giá tăng dần</option>
                                <option value="price_desc">Giá giảm dần</option>
                                <option value="rating">Đánh giá cao</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col1 c5">
                    <button type="submit" class="btn-form1-submit">
                        <i class="ti-search"></i> Tìm Tour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>