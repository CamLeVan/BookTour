<section class="blog section-padding bg-navy">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-subtitle"><span>Blog Du lịch</span></div>
                <div class="section-title"><span>Trải nghiệm</span> Du lịch</div>
            </div>
        </div>
        <div class="owl-carousel owl-theme">
            @foreach($posts as $post)
            <div class="item">
                <div class="position-re o-hidden" style="height: 240px;">
                    <img src="{{ asset('frontend/' . $post->image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                    <div class="date">
                        <a href="{{ route('frontend.blog.show', $post->slug) }}"> 
                            <span>Th{{ $post->created_at->format('m') }}</span> 
                            <i>{{ $post->created_at->format('d') }}</i> 
                        </a>
                    </div>
                </div>
                <div class="con" style="height: 150px;">
                    <span class="category">
                        <a href="{{ route('frontend.blog.category', $post->category->slug) }}">
                            {{ $post->category->name }}
                        </a>
                    </span>
                    <h5>
                        <a href="{{ route('frontend.blog.show', $post->slug) }}" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $post->title }}
                        </a>
                    </h5>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section> 