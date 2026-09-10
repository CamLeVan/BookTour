@foreach($posts as $post)
<div class="col-md-12">
    <div class="item">
        <div class="post-img">
            <a href="{{ route('frontend.blog.show', $post->slug) }}">
                <img src="{{ asset('storage/posts/' . $post->image) }}" alt="">
            </a>
            <div class="date">
                <a href="#">
                    <span>{{ $post->created_at->format('M') }}</span>
                    <i>{{ $post->created_at->format('d') }}</i>
                </a>
            </div>
        </div>
        <div class="post-cont">
            <a href="{{ route('frontend.blog.category', $post->category->slug) }}">
                <span class="tag">{{ $post->category->name }}</span>
            </a>
            <h5>
                <a href="{{ route('frontend.blog.show', $post->slug) }}">{{ $post->title }}</a>
            </h5>
            <p>{{ Str::limit($post->content, 200) }}</p>
            <div class="butn-dark">
                <a href="{{ route('frontend.blog.show', $post->slug) }}"><span>Read More</span></a>
            </div>
        </div>
    </div>
</div>
@endforeach 