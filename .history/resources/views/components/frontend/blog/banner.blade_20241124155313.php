<section class="blog-banner">
    <style scoped>
        .blog-banner {
            position: relative;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/img/blog-banner.jpg');
            background-size: cover;
            background-position: center;
            padding: 120px 0;
            text-align: center;
            margin-bottom: 60px;
        }

        .banner-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .banner-title {
            color: #fff;
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .banner-subtitle {
            color: #fff;
            font-size: 18px;
            margin-bottom: 0;
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .blog-banner {
                padding: 80px 0;
            }

            .banner-title {
                font-size: 36px;
            }

            .banner-subtitle {
                font-size: 16px;
            }
        }
    </style>

    <div class="banner-content">
        <h1 class="banner-title">Blog</h1>
        <p class="banner-subtitle">Stay updated with our latest news and articles</p>
    </div>
</section> 