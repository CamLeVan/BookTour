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
                <div class="position-re o-hidden">
                    <img src="{{ asset($post->image) }}" alt="{{ $post->title }}">
                    <div class="date">
                        <a href="{{ route('frontend.blog.show', $post->slug) }}"> 
                            <span>{{ $post->created_at->formatLocalized('%b') }}</span> 
                            <i>{{ $post->created_at->format('d') }}</i> 
                        </a>
                    </div>
                </div>
                <div class="con">
                    <span class="category">
                        <a href="{{ route('frontend.blog.category', $post->category->slug) }}">
                            {{ $post->category->name }}
                        </a>
                    </span>
                    <h5>
                        <a href="{{ route('frontend.blog.show', $post->slug) }}">
                            {{ $post->title }}
                        </a>
                    </h5>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section> 