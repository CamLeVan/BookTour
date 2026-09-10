<div class="info">
    <span class="post-date">
        <i class="ti-calendar"></i> {{ $post->created_at->format('d M, Y') }}
    </span>
    
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

@pushOnce('styles')
<style>
    .info {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 30px;
        padding: 15px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.05);
    }
    /* ... các style khác cho meta ... */
</style>
@endPushOnce 