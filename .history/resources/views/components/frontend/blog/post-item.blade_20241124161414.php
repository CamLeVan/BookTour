<div class="blog-post-item">
    <style scoped>
        .blog-post-item {
            margin-bottom: 30px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        }
        .post-img {
            position: relative;
            overflow: hidden;
            border-radius: 5px 5px 0 0;
        }
        .post-img img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease;
        }
        .post-img:hover img {
            transform: scale(1.1);
        }
        .date {
            position: absolute;
            bottom: 15px;
            right: 15px;
            padding: 10px 15px;
            background: #fff;
            border-radius: 5px;
        }
        .post-content {
            padding: 20px;
        }
        .post-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #333;
        }
        .post-meta {
            margin-bottom: 15px;
            color: #777;
        }
        .post-meta a {
            color: #777;
            margin-right: 15px;
            text-decoration: none;
        }
        .post-meta a:hover {
            color: #333;
        }
        .post-excerpt {
            color: #666;
            line-height: 1.6;
        }
    </style>

    <div class="post-img">
        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
            <div class="date">
                <span>{{ $post->created_at->format('M') }}</span>
                <i>{{ $post->created_at->format('d') }}</i>
            </div>
        @endif
    </div>
    
    <div class="post-content">
        <h3 class="post-title">
            <a href="{{ route('frontend.blog.show', $post->slug) }}">{{ $post->title }}</a>
        </h3>
        
        <div class="post-meta">
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
        <p class="post-excerpt">{{ Str::limit(strip_tags($post->content), 200) }}</p>
        <div class="butn-dark">
            <a href="{{ route('frontend.blog.show', $post->slug) }}">
                <span>Read More</span>
            </a>
        </div>
    </div>
</div>