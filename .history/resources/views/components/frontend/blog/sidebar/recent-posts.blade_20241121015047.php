<div class="col-md-12">
    <div class="widget">
        <div class="widget-title">
            <h6>Recent Posts</h6>
        </div>
        <ul class="recent">
            @foreach($recentPosts as $post)
            <li>
                <div class="thum">
                    <img src="{{ asset('storage/posts/' . $post->image) }}" alt="">
                </div>
                <a href="{{ route('frontend.blog.show', $post->slug) }}">{{ $post->title }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</div> 