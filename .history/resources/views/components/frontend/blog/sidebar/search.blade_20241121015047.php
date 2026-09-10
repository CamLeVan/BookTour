<div class="col-md-12">
    <div class="widget search">
        <form action="{{ route('frontend.blog.search') }}" method="GET">
            <input type="text" name="q" placeholder="Type here ..." value="{{ request('q') }}">
            <button type="submit"><i class="ti-search" aria-hidden="true"></i></button>
        </form>
    </div>
</div> 