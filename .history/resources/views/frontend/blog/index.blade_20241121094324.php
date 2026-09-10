@extends('layouts.frontend')

@section('content')
    <x-frontend.blog.banner />
    
    <section class="blog2 section-padding">
        <div class="container">
            <div class="row">
                <!-- Blog Posts -->
                <div class="col-md-8">
                    <div class="row">
                        @if(request()->has('query'))
                            <div class="col-md-12 mb-30">
                                <h4>Search results for: "{{ request('query') }}"</h4>
                            </div>
                        @endif

                        @if($posts->isEmpty())
                            <div class="col-md-12">
                                <p>No posts found.</p>
                            </div>
                        @else
                            @foreach($posts as $post)
                                <x-frontend.blog.post-item :post="$post" />
                            @endforeach
                        @endif
                        
                        <!-- Pagination -->
                        <div class="col-md-12 mb-60">
                            {{ $posts->links('components.frontend.blog.pagination') }}
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <div class="blog2-sidebar row">
                        <x-frontend.blog.sidebar.search />
                        <x-frontend.blog.sidebar.recent-posts :recentPosts="$recentPosts" />
                        <x-frontend.blog.sidebar.archives :archives="$archives" />
                        <x-frontend.blog.sidebar.categories :categories="$categories" />
                        <x-frontend.blog.sidebar.tags :tags="$tags" />
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
