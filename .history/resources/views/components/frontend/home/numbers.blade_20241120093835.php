<section class="numbers">
    <div class="section-padding bg-img bg-fixed back-position-center" data-background="{{ asset('storage/img/slider/15.jpg') }}" data-overlay-dark="6">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="item text-center">
                        <span class="icon">
                            <i class="front flaticon-air-freight"></i>
                            <i class="back flaticon-air-freight"></i>
                        </span>
                        <h3 class="count">{{ $totalBookings ?? 600 }}</h3>
                        <h6>Tour Bookings</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="item text-center">
                        <span class="icon">
                            <i class="front flaticon-house"></i>
                            <i class="back flaticon-house"></i>
                        </span>
                        <h3 class="count">{{ $totalTours ?? 250 }}</h3>
                        <h6>Amazing Tours</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="item text-center">
                        <span class="icon">
                            <i class="front ti-user"></i>
                            <i class="back ti-user"></i>
                        </span>
                        <h3 class="count">{{ $totalCustomers ?? 100 }}</h3>
                        <h6>Happy Customers</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="item text-center">
                        <span class="icon">
                            <i class="front flaticon-tag"></i>
                            <i class="back flaticon-tag"></i>
                        </span>
                        <h3 class="count">{{ $totalDestinations ?? 100 }}</h3>
                        <h6>Destinations</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 