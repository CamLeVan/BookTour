<div class="booking-wrapper">
    <div class="container">
        <div class="tour-inner clearfix form-inline justify-content-center">
            <form action="{{ route('frontend.tours.index') }}" class="form1 clearfix">
                <div class="col1 c1">
                    <div class="input2_wrapper">
                        <label>Where to?</label>
                        <div class="input2_inner">
                            <input type="text" class="form-control input" placeholder="Where to?" name="destination">
                        </div>
                    </div>
                </div>
                <div class="col1 c2">
                    <div class="select1_wrapper">
                        <label>Destinations</label>
                        <div class="select1_inner">
                            <select class="select2 select" style="width: 100%" name="category">
                                <option value="">All Destinations</option>
                                <option value="1">Greece</option>
                                <option value="2">London</option>
                                <option value="3">Maldives</option>
                                <option value="4">Paris</option>
                                <option value="5">Rome</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col1 c4">
                    <div class="select1_wrapper">
                        <label>Duration</label>
                        <div class="select1_inner">
                            <select class="select2 select" style="width: 100%" name="duration">
                                <option value="">Duration</option>
                                <option value="1">1 Day Tour</option>
                                <option value="2">2-4 Days Tour</option>
                                <option value="3">5-7 Days Tour</option>
                                <option value="4">7+ Days Tour</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col1 c5">
                    <button type="submit" class="btn-form1-submit"><i class="ti-search"></i> Find Now</button>
                </div>
            </form>
        </div>
    </div>
</div>