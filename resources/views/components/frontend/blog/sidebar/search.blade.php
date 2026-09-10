<div class="widget search">
    <form action="{{ route('frontend.blog.search') }}" method="GET">
        <input 
            type="text" 
            name="query" 
            placeholder="Tìm kiếm bài viết..." 
            value="{{ request('query') }}"
        >
        <button type="submit">
            <i class="ti-search"></i>
        </button>
    </form>
</div> 
<style>
    /* Search Widget Styling */
.widget.search {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    margin-bottom: 30px;
}

.widget.search form {
    position: relative;
    display: flex;
    align-items: center;
}

.widget.search input[type="text"] {
    width: 100%;
    height: 54px;
    padding: 0 60px 0 25px;
    border: 2px solid #eef0f3;
    border-radius: 30px;
    font-size: 15px;
    color: #0f2454;
    background: #fff;
    transition: all 0.3s ease;
}

.widget.search input[type="text"]:focus {
    border-color: #2095AE;
    box-shadow: 0 0 0 4px rgba(32, 149, 174, 0.1);
}

.widget.search input[type="text"]::placeholder {
    color: #9aa1b9;
    font-size: 15px;
}

.widget.search button {
    position: absolute;
    right: 6px;
    top: 50%;
    transform: translateY(-50%);
    width: 44px;
    height: 44px;
    border: none;
    border-radius: 50%;
    background: #2095AE;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.widget.search button:hover {
    background: #1a7a8f;
    transform: translateY(-50%) scale(1.05);
}

.widget.search button i {
    font-size: 18px;
    transition: transform 0.3s ease;
}

.widget.search button:hover i {
    transform: scale(1.1);
}

@media (max-width: 767px) {
    .widget.search {
        padding: 20px;
    }
    
    .widget.search input[type="text"] {
        height: 48px;
        font-size: 14px;
    }
    
    .widget.search button {
        width: 38px;
        height: 38px;
    }
    
    .widget.search button i {
        font-size: 16px;
    }
}
</style>