@if ($paginator->hasPages())
    <nav class="blog-pagination" aria-label="Blog Pagination">
        <ul class="pagination-list">
            {{-- Previous Page --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-item disabled">
                    <span class="pagination-link">
                        <i class="ti-angle-left"></i>
                    </span>
                </li>
            @else
                <li class="pagination-item">
                    <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link">
                        <i class="ti-angle-left"></i>
                    </a>
                </li>
            @endif

            {{-- Numbered Pages --}}
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <li class="pagination-item {{ ($paginator->currentPage() == $i) ? 'active' : '' }}">
                    <a href="{{ $paginator->url($i) }}" class="pagination-link">{{ $i }}</a>
                </li>
            @endfor

            {{-- Next Page --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="pagination-link">
                        <i class="ti-angle-right"></i>
                    </a>
                </li>
            @else
                <li class="pagination-item disabled">
                    <span class="pagination-link">
                        <i class="ti-angle-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif

<style>
    .blog-pagination {
        display: flex;
        justify-content: center;
        margin: 40px 0;
    }

    .pagination-list {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .pagination-item {
        margin: 0;
        padding: 0;
    }

    .pagination-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: #fff;
        color: #0f2454;
        font-size: 16px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 3px 15px rgba(0,0,0,0.05);
    }

    .pagination-link:hover {
        background: #2095AE;
        color: #fff;
        transform: translateY(-2px);
    }

    .pagination-item.active .pagination-link {
        background: #2095AE;
        color: #fff;
        box-shadow: 0 5px 20px rgba(32, 149, 174, 0.3);
    }

    .pagination-item.disabled .pagination-link {
        background: #f5f5f5;
        color: #999;
        cursor: not-allowed;
        pointer-events: none;
    }

    .pagination-link i {
        font-size: 14px;
    }

    /* Hover Effects */
    .pagination-item:not(.disabled):not(.active) .pagination-link:hover {
        background: #2095AE;
        color: #fff;
        box-shadow: 0 5px 20px rgba(32, 149, 174, 0.2);
    }

    /* Active state press effect */
    .pagination-item:not(.disabled) .pagination-link:active {
        transform: translateY(0);
    }

    @media (max-width: 767px) {
        .pagination-link {
            width: 40px;
            height: 40px;
            font-size: 14px;
        }
    }
</style>