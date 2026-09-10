<div class="blog-search-widget">
    <form action="{{ route('frontend.blog.search') }}" method="GET" class="blog-search-form">
        <div class="search-input-wrapper">
            <input 
                type="text" 
                name="query" 
                placeholder="Tìm kiếm bài viết..." 
                value="{{ request('query') }}"
                class="search-input"
            >
            <span class="search-focus-border"></span>
            <i class="ti-close clear-search"></i>
        </div>
        <button type="submit" class="search-button">
            <i class="ti-search search-icon"></i>
            <span class="search-button-circle"></span>
        </button>
    </form>
</div>

<style>
    .blog-search-widget {
        background: #fff;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .blog-search-widget:hover {
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    .blog-search-form {
        position: relative;
        display: flex;
        align-items: center;
    }

    .search-input-wrapper {
        position: relative;
        flex: 1;
    }

    .search-input {
        width: 100%;
        height: 56px;
        padding: 0 50px 0 25px;
        border: 2px solid #eef0f3;
        border-radius: 28px;
        font-size: 15px;
        font-weight: 500;
        color: #0f2454;
        background: #fff;
        transition: all 0.3s ease;
        letter-spacing: 0.3px;
    }

    .search-input:focus {
        border-color: #2095AE;
        box-shadow: 0 0 0 4px rgba(32, 149, 174, 0.1);
    }

    .search-focus-border {
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: #2095AE;
        transition: all 0.3s ease;
        transform: translateX(-50%);
        opacity: 0;
    }

    .search-input:focus ~ .search-focus-border {
        width: calc(100% - 40px);
        opacity: 1;
    }

    .search-input::placeholder {
        color: #9aa1b9;
        font-size: 15px;
        font-weight: 400;
        transition: all 0.3s ease;
    }

    .search-input:focus::placeholder {
        opacity: 0.7;
        transform: translateX(5px);
    }

    .clear-search {
        position: absolute;
        right: 65px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 14px;
        color: #9aa1b9;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .search-input:valid ~ .clear-search {
        opacity: 1;
        visibility: visible;
    }

    .clear-search:hover {
        color: #2095AE;
        transform: translateY(-50%) rotate(90deg);
    }

    .search-button {
        position: absolute;
        right: 6px;
        width: 44px;
        height: 44px;
        border: none;
        border-radius: 50%;
        background: #2095AE;
        color: #fff;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        overflow: hidden;
    }

    .search-button:hover {
        background: #1a7a8f;
        transform: scale(1.05);
    }

    .search-icon {
        position: relative;
        z-index: 2;
        font-size: 18px;
        transition: all 0.3s ease;
    }

    .search-button:hover .search-icon {
        transform: scale(1.1) rotate(-10deg);
    }

    .search-button-circle {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        width: 150%;
        height: 150%;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .search-button:hover .search-button-circle {
        transform: translate(-50%, -50%) scale(1);
    }

    /* Hiệu ứng loading khi submit */
    .blog-search-form.searching .search-button {
        animation: searchPulse 1.5s infinite;
    }

    @keyframes searchPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    /* Responsive */
    @media (max-width: 767px) {
        .blog-search-widget {
            padding: 20px;
        }
        
        .search-input {
            height: 50px;
            font-size: 14px;
        }
        
        .search-button {
            width: 38px;
            height: 38px;
        }
        
        .search-icon {
            font-size: 16px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.blog-search-form');
    const input = form.querySelector('.search-input');
    const clearBtn = form.querySelector('.clear-search');

    // Clear input
    if (clearBtn) {
        clearBtn.addEventListener('click', () => {
            input.value = '';
            input.focus();
        });
    }

    // Add loading state on submit
    form.addEventListener('submit', () => {
        form.classList.add('searching');
    });
});
</script>