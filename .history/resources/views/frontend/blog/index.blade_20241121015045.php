@extends('layouts.frontend')

@section('content')
    <x-frontend.blog.banner />
    
    <section class="blog2 section-padding">
        <div class="container">
            <div class="row">
                <!-- Blog Posts -->
                <div class="col-md-8">
                    <div class="row">
                        <x-frontend.blog.post-list :posts="$posts" />
                        
                        <!-- Pagination -->
                        <div class="col-md-12 mb-60">
                            {{ $posts->links('components.frontend.pagination') }}
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
