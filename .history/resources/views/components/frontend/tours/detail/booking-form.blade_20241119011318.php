<div class="right-sidebar">
    <div class="right-sidebar item">
        <h3>
            @if($tour->sale_price)
            <span class="right-sidebar item__from">From</span>
            <span class="right-sidebar item__sale">{{ number_format($tour->price) }}đ</span>
            {{ number_format($tour->sale_price) }}đ
            @else
            {{ number_format($tour->price) }}đ
            @endif
        </h3>

        <form method="POST" class="right-sidebar item-form" 
              action="{{ route('frontend.bookings.store') }}">
            @csrf
            <input type="hidden" name="tour_id" value="{{ $tour->id }}">
            
            <div class="row">
                <div class="col-md-12 form-group">
                    <input name="name" type="text" 
                           placeholder="Họ và tên" required>
                </div>

                <div class="col-md-12 form-group">
                    <input name="email" type="email" 
                           placeholder="Email" required>
                </div>

                <div class="col-md-12 form-group">
                    <input name="phone" type="text" 
                           placeholder="Số điện thoại" required>
                </div>

                <div class="col-md-12 form-group input1_inner">
                    <input type="text" class="form-control input datepicker" 
                           name="travel_date"
                           placeholder="Ngày khởi hành" required>
                </div>

                <div class="col-md-12 form-group">
                    <input name="number_of_people" type="number" 
                           placeholder="Số người" required>
                </div>

                <div class="col-md-12 form-group">
                    <textarea name="note" rows="4" 
                              placeholder="Ghi chú"></textarea>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="butn-dark">
                        <span>Đặt ngay</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div> 