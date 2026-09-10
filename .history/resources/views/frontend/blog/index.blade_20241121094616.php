@extends('layouts.frontend')

@section('content')
    <x-frontend.blog.banner />
    
    <section class="blog2 section-padding">
        <div class="container">
            <div class="row">
                <!-- Blog Posts -->
                <div class="col-md-8">
                    @if(request()->has('query'))
                        <div class="col-md-12 mb-30">
                            <h4>Search results for: "{{ request('query') }}"</h4>
                        </div>
                    @endif

                    @foreach($posts as $post)
                        <x-frontend.blog.post-item :post="$post" />
                    @endforeach

                    {{ $posts->links('components.frontend.blog.pagination') }}
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <x-frontend.blog.sidebar 
                        :recentPosts="$recentPosts"
                        :categories="$categories"
                        :archives="$archives"
                        :tags="$tags"
                    />
                </div>
            </div>
        </div>
    </section>
@endsection
