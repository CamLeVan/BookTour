<div class="col-md-12">
    <div class="widget search">
        <form action="{{ route('frontend.blog.search') }}" method="GET">
            <input type="text" name="query" placeholder="Search" value="{{ request('query') }}">
            <button type="submit"><i class="ti-search"></i></button>
        </form>
    </div>
</div> 