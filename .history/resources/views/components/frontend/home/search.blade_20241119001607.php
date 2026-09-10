<div class="booking-wrapper">
    <div class="container">
        <div class="tour-inner clearfix form-inline justify-content-center">
            <form action="{{ route('tours.search') }}" class="form1 clearfix">
                <div class="col1 c1">
                    <div class="input2_wrapper">
                        <label>Bạn muốn đi đâu?</label>
                        <div class="input2_inner">
                            <input type="text" class="form-control input" placeholder="Nhập điểm đến...">
                        </div>
                    </div>
                </div>
                <div class="col1 c2">
                    <div class="select1_wrapper">
                        <label>Điểm đến</label>
                        <div class="select1_inner">
                            <select class="select2 select" name="destination">
                                <option value="">Chọn điểm đến</option>
                                <option value="hanoi">Hà Nội</option>
                                <option value="danang">Đà Nẵng</option>
                                <option value="hoian">Hội An</option>
                                <option value="saigon">Sài Gòn</option>
                                <option value="phuquoc">Phú Quốc</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col1 c4">
                    <div class="select1_wrapper">
                        <label>Thời gian</label>
                        <div class="select1_inner">
                            <select class="select2 select" name="duration">
                                <option value="">Chọn thời gian</option>
                                <option value="1">Tour 1 ngày</option>
                                <option value="2-3">Tour 2-3 ngày</option>
                                <option value="4-7">Tour 4-7 ngày</option>
                                <option value="8+">Tour trên 7 ngày</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col1 c5">
                    <button type="submit" class="btn-form1-submit">
                        <i class="ti-search"></i> Tìm Kiếm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>