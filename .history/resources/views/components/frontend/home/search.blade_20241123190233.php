<div class="booking-wrapper">
    <div class="container">
        <div class="tour-inner clearfix form-inline justify-content-center">
            <form action="{{ route('frontend.tours.index') }}" class="form1 clearfix" method="GET">
                <div class="col1 c1">
                    <div class="input2_wrapper">
                        <label>Bạn muốn đi đâu?</label>
                        <div class="input2_inner">
                            <input type="text" class="form-control input" 
                                   placeholder="Tìm kiếm tour..." name="search">
                        </div>
                    </div>
                </div>
                <div class="col1 c2">
                    <div class="select1_wrapper">
                        <label>Điểm đến</label>
                        <div class="select1_inner">
                            <select class="select2 select" style="width: 100%" name="destination">
                                <option value="">Chọn điểm đến</option>
                                @foreach($destinations as $destination)
                                    <option value="{{ $destination->id }}" 
                                            {{ request('destination') == $destination->id ? 'selected' : '' }}>
                                        {{ $destination->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col1 c4">
                    <div class="select1_wrapper">
                        <label>Thời gian</label>
                        <div class="select1_inner">
                            <select class="select2 select" style="width: 100%" name="duration">
                                <option value="">Chọn thời gian</option>
                                <option value="1-1">1 Ngày</option>
                                <option value="2-4">2-4 Ngày</option>
                                <option value="5-7">5-7 Ngày</option>
                                <option value="7-+">7+ Ngày</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col1 c5">
                    <button type="submit" class="btn-form1-submit">
                        <i class="ti-search"></i> Tìm kiếm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>