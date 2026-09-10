@extends('layouts.frontend')

@section('content')
    <!-- Banner -->
    <x-frontend.blog.banner />
    
    <section class="blog2 section-padding">
        <div class="container">
            <div class="row">
                <!-- Blog Post -->
                <div class="col-md-8">
                    <div class="item">
                        @if($post->image)
                            <div class="post-img">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                                <div class="date">
                                    <span>{{ $post->created_at->format('M') }}</span> 
                                    <i>{{ $post->created_at->format('d') }}</i>
                                </div>
                            </div>
                        @endif
                        
                        <div class="post-cont">
                            <h5>{{ $post->title }}</h5>
                            
                            <div class="info">
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
                            
                            <div class="post-content">
                                {!! $post->content !!}
                            </div>
                            
                            <!-- Tags -->
                            @if($post->tags->count() > 0)
                                <div class="tags-section mt-30">
                                    <h6>Tags:</h6>
                                    @foreach($post->tags as $tag)
                                        <a href="{{ route('frontend.blog.tag', $tag->slug) }}" class="tag">
                                            {{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
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