@props(['destinations'])

<style>
    .destination1 .item {
        position: relative;
        overflow: hidden;
    }
    
    .destination1 .position-re {
        width: 100%;
        height: 600px; /* Chiều cao cố định cho container ảnh */
        overflow: hidden;
    }
    
    .destination1 .position-re img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Đảm bảo ảnh lấp đầy không gian và giữ tỷ lệ */
        transition: transform 0.3s ease;
    }
    
    .destination1 .item:hover img {
        transform: scale(1.1); /* Hiệu ứng zoom khi hover */
    }
    
    .destination1 .con {
        padding: 20px;
        background: #fff;
    }
    
    .destination1 .con h5 {
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 10px;
    }
    
    .destination1 .con .line {
        width: 50px;
        height: 1px;
        background: #ccc;
        margin: 10px 0;
    }
    
    .destination1 .facilities {
        margin-top: 15px;
    }
    
    .destination1 .permalink a {
        font-size: 14px;
        font-weight: 400;
        color: #666;
        transition: all 0.3s ease;
    }
    
    .destination1 .permalink a:hover {
        color: #000;
    }
</style>

<section class="destination1 section-padding bg-lightnav">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-subtitle">Điểm Đến Hàng Đầu</div>
                <div class="section-title">Điểm Đến <span>Nổi Bật</span></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    @foreach($destinations as $destination)
                    <div class="item">
                        <div class="position-re o-hidden">
                            <img src="{{ asset('frontend/img/destination/' . $destination->image) }}" 
                                 alt="{{ $destination->name }}">
                        </div>
                        <div class="con">
                            <h5>
                                <a href="{{ route('frontend.destinations.show', $destination) }}">
                                    <i class="ti-location-pin"></i> {{ $destination->name }}
                                </a>
                            </h5>
                            <div class="line"></div>
                            <div class="row facilities">
                                <div class="col col-md-8">
                                    <p>{{ $destination->tours_count }} Tour Du Lịch</p>
                                </div>
                                <div class="col col-md-4 text-right">
                                    <div class="permalink">
                                        <a href="{{ route('frontend.destinations.show', $destination) }}">
                                            Khám Phá <i class="ti-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });
});
</script>