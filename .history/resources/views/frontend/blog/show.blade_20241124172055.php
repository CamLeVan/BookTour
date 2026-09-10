@extends('layouts.frontend')

@push('styles')
<style>
    /* Smooth Scroll */
    html {
        scroll-behavior: smooth;
    }

    /* Blog Post Container */
    .blog2 {
        padding: 80px 0;
        background: #fff;
    }

    /* Post Item */
    .item {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 30px rgba(0,0,0,0.06);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Post Image */
    .post-img {
        position: relative;
        overflow: hidden;
        border-radius: 16px 16px 0 0;
        height: 500px;
    }

    .post-img::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            to bottom,
            rgba(0,0,0,0) 0%,
            rgba(0,0,0,0.2) 50%,
            rgba(0,0,0,0.4) 100%
        );
        pointer-events: none;
    }

    .post-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transform: scale(1);
        transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .item:hover .post-img img {
        transform: scale(1.05);
    }

    /* Date Badge */
    .date {
        position: absolute;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #2095AE, #26A7C2);
        color: #fff;
        padding: 10px 15px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(32, 149, 174, 0.2);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255,255,255,0.1);
        z-index: 1;
        transform: translateY(0);
        transition: all 0.3s ease;
    }

    .item:hover .date {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(32, 149, 174, 0.3);
    }

    .date span {
        display: block;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        line-height: 1;
    }

    .date i {
        display: block;
        font-size: 22px;
        font-weight: 600;
        font-style: normal;
        line-height: 1.2;
    }

    /* Post Content */
    .post-cont {
        position: relative;
        padding: 40px;
        background: linear-gradient(to bottom, #fff 0%, #fafafa 100%);
    }

    .post-cont h5 {
        position: relative;
        font-size: 32px;
        font-weight: 700;
        color: #0f2454;
        margin-bottom: 20px;
        line-height: 1.4;
        padding-bottom: 15px;
    }

    .post-cont h5::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80px;
        height: 3px;
        background: linear-gradient(to right, #2095AE, #26A7C2);
        border-radius: 3px;
    }

    /* Meta Info */
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

    .info a {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: #f8f9fa;
        border-radius: 25px;
        color: #666;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .info a:hover {
        background: #2095AE;
        color: #fff;
        transform: translateY(-2px);
    }

    .info a i {
        font-size: 12px;
        color: #2095AE;
        transition: color 0.3s ease;
    }

    .info a:hover i {
        color: #fff;
    }

    /* Post Content */
    .post-content {
        color: #666;
        line-height: 1.8;
        font-size: 17px;
        letter-spacing: 0.3px;
    }

    .post-content p:first-of-type {
        font-size: 19px;
        color: #444;
        line-height: 1.9;
    }

    .post-content p {
        margin-bottom: 20px;
    }

    .post-content img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 30px 0;
    }

    .post-content h1, 
    .post-content h2, 
    .post-content h3, 
    .post-content h4, 
    .post-content h5, 
    .post-content h6 {
        color: #0f2454;
        margin: 30px 0 20px;
        font-weight: 600;
    }

    /* Blockquote */
    .post-content blockquote {
        position: relative;
        padding: 30px 30px 30px 85px;
        background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
        box-shadow: 0 3px 15px rgba(0,0,0,0.05);
        border-left: 4px solid #2095AE;
        margin: 30px 0;
        border-radius: 0 12px 12px 0;
        font-style: italic;
        color: #0f2454;
    }

    .post-content blockquote::before {
        content: '"';
        position: absolute;
        left: 30px;
        top: 20px;
        font-size: 60px;
        color: #2095AE;
        font-family: Georgia, serif;
        opacity: 0.5;
    }

    /* Tags Section */
    .tags-section {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 15px;
        margin-top: 50px;
    }

    .tags-section h6 {
        font-size: 18px;
        color: #0f2454;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .tag {
        position: relative;
        display: inline-block;
        padding: 8px 16px;
        margin: 5px;
        background: #f8f9fa;
        border-radius: 25px;
        color: #666;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
        overflow: hidden;
        z-index: 1;
    }

    .tag::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #2095AE;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
        z-index: -1;
    }

    .tag:hover {
        color: #fff;
        transform: translateY(-2px);
    }

    .tag:hover::before {
        transform: translateX(0);
    }

    /* Reading Progress Bar */
    .reading-progress {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: #eef0f3;
        z-index: 1000;
    }

    .reading-progress-bar {
        height: 100%;
        background: linear-gradient(to right, #2095AE, #26A7C2);
        width: 0;
        transition: width 0.1s ease;
    }

    /* Responsive */
    @media (max-width: 767px) {
        .post-img {
            height: 300px;
        }

        .post-cont {
            padding: 25px;
        }

        .post-cont h5 {
            font-size: 24px;
        }

        .date {
            padding: 8px 12px;
            top: 15px;
            right: 15px;
        }

        .info {
            gap: 8px;
        }

        .info a {
            padding: 6px 12px;
            font-size: 13px;
        }

        .post-content {
            font-size: 16px;
        }

        .post-content p:first-of-type {
            font-size: 17px;
        }

        .post-content blockquote {
            padding: 25px 25px 25px 65px;
        }

        .post-content blockquote::before {
            left: 20px;
            font-size: 50px;
        }
    }

    /* Print Styles */
    @media print {
        .blog2 {
            padding: 0;
        }

        .item {
            box-shadow: none;
        }

        .post-content {
            font-size: 12pt;
        }

        .tags-section,
        .info a {
            display: none;
        }
    }
</style>
@endpush

@section('content')
    <!-- Reading Progress Bar -->
    <div class="reading-progress">
        <div class="reading-progress-bar"></div>
    </div>

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
                                <img src="{{ asset('frontend/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const progressBar = document.querySelector('.reading-progress-bar');
        window.addEventListener('scroll', () => {
            const winScroll = document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            progressBar.style.width = scrolled + '%';
        });
    });
</script>
@endpush 