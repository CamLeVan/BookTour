<div class="banner-header section-padding valign bg-img bg-fixed" 
     data-overlay-dark="4" 
     data-background="{{ asset('frontend/img/slider/3.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center caption mt-90">
                <h1 class="fade-in">{{ $title ?? 'Our Blog' }}</h1>
                @if(isset($subtitle))
                    <p class="lead text-white mt-3">{{ $subtitle }}</p>
                @endif
            </div>
        </div>
    </div>
</div> 