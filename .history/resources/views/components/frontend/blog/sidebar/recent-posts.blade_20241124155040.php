<div class="widget">
    <div class="widget-title">
        <h6>Recent Posts</h6>
    </div>
    <ul class="recent">
        @foreach($recentPosts as $post)
            <li>
                <div class="thum">
                    <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('img/blog/1.jpg') }}" alt="">
                </div>
                <a href="{{ route('frontend.blog.show', $post->slug) }}">{{ $post->title }}</a>
            </li>
        @endforeach
    </ul>
</div>

<style>
    .widget .recent {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .widget .recent li {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eef0f3;
    }

    .widget .recent li:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .widget .recent .thum {
        width: 90px;
        height: 70px;
        overflow: hidden;
        border-radius: 8px;
        margin-right: 15px;
    }

    .widget .recent .thum img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .widget .recent a {
        flex: 1;
        color: #0f2454;
        text-decoration: none;
        font-size: 15px;
        line-height: 1.4;
        transition: color 0.3s ease;
    }

    .widget .recent a:hover {
        color: #2095AE;
    }
</style> 