<div class="col-md-12">
    <div class="widget">
        <div class="widget-title">
            <h6>Tags</h6>
        </div>
        <ul class="tags">
            @foreach($tags as $tag)
            <li>
                <a href="{{ route('frontend.blog.tag', $tag->slug) }}">{{ $tag->name }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</div> 