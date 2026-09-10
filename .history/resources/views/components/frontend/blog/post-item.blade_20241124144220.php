<div class="item mb-4 blog-card">
    <div class="post-img">
        @if($post->image)
            <a href="{{ route('frontend.blog.show', $post->slug) }}">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
            </a>
        @endif
        <div class="date">
            <span>{{ $post->created_at->format('M') }}</span> 
            <i>{{ $post->created_at->format('d') }}</i>
        </div>
    </div>
    <div class="post-cont">
        <h5>
            <a href="{{ route('frontend.blog.show', $post->slug) }}">
                {{ $post->title }}
            </a>
        </h5>
        <div class="info">
            @if($post->category)
                <a href="{{ route('frontend.blog.category', $post->category->slug) }}">
                    <i class="ti-folder"></i> {{ $post->category->name }}
                </a>
            @endif
            @foreach($post->tags as $tag)
                <a href="{{ route('frontend.blog.tag', $tag->slug) }}">
                    <i class="ti-tag"></i> {{ $tag->name }}
                </a>
            @endforeach
        </div>
        <p>{{ Str::limit(strip_tags($post->content), 200) }}</p>
        <div class="butn-dark">
            <a href="{{ route('frontend.blog.show', $post->slug) }}">
                <span>Read More</span>
            </a>
        </div>
    </div>
</div>