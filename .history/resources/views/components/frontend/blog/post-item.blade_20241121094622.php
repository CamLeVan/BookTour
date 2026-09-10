<div class="col-md-12">
    <div class="item">
        <div class="post-img">
            <a href="{{ route('frontend.blog.show', $post->slug) }}">
                <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('img/blog/1.jpg') }}" alt="{{ $post->title }}">
            </a>
            <div class="date">
                <a href="#">
                    <span>{{ $post->created_at->format('M') }}</span> 
                    <i>{{ $post->created_at->format('d') }}</i>
                </a>
            </div>
        </div>
        <div class="post-cont">
            <h5>
                <a href="{{ route('frontend.blog.show', $post->slug) }}">
                    {{ $post->title }}
                </a>
            </h5>
            <div class="tags">
                <a href="{{ route('frontend.blog.category', $post->category->slug) }}">
                    {{ $post->category->name }}
                </a>
                @foreach($post->tags as $tag)
                    <a href="{{ route('frontend.blog.tag', $tag->slug) }}">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>
            <p>{{ Str::limit($post->content, 200) }}</p>
            <div class="butn-dark">
                <a href="{{ route('frontend.blog.show', $post->slug) }}">
                    <span>Read More</span>
                </a>
            </div>
        </div>
    </div>
</div>