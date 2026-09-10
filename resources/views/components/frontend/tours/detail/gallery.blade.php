<h6 class="mb-0">Tour Gallery</h6>
<div class="row">
    @foreach($tour->gallery_images as $image)
    <div class="col-md-4 gallery-item">
        <a href="{{ asset($image->path) }}" title="" class="img-zoom">
            <div class="gallery-box">
                <div class="gallery-img">
                    <img src="{{ asset($image->path) }}" 
                         class="img-fluid mx-auto d-block" 
                         alt="{{ $tour->name }}">
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div> 