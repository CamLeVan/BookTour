@if ($paginator->hasPages())
    <div class="hc-pagination-container">
        <nav aria-label="Page navigation">
            <ul class="hc-pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="hc-page-item disabled">
                        <span class="hc-page-link">&laquo;</span>
                    </li>
                @else
                    <li class="hc-page-item">
                        <a class="hc-page-link" href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="hc-page-item disabled">
                            <span class="hc-page-link">{{ $element }}</span>
                        </li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="hc-page-item active">
                                    <span class="hc-page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="hc-page-item">
                                    <a class="hc-page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="hc-page-item">
                        <a class="hc-page-link" href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
                    </li>
                @else
                    <li class="hc-page-item disabled">
                        <span class="hc-page-link">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

    @push('styles')
    <style>
        /* Highly specific selectors to override global styles */
        .blog-section .hc-pagination-container {
            margin: 40px 0;
        }

        .blog-section .hc-pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 5px;
        }

        .blog-section .hc-page-item {
            margin: 0;
            padding: 0;
            display: block;
            background: none;
        }

        .blog-section .hc-page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 12px;
            background: #f5f5f5;
            color: #333;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.3s ease;
            border: none;
            font-family: inherit;
            font-size: inherit;
        }

        .blog-section .hc-page-item.active .hc-page-link {
            background: #2095AE;
            color: #fff;
        }

        .blog-section .hc-page-item:not(.disabled) .hc-page-link:hover {
            background: #2095AE;
            color: #fff;
        }

        .blog-section .hc-page-item.disabled .hc-page-link {
            background: #eee;
            color: #999;
            cursor: not-allowed;
        }

        /* Override any theme styles that might affect the footer */
        .footer .social-icons ul {
            list-style: disc !important;
        }
        
        .footer .usful-links ul {
            list-style: disc !important;
        }
    </style>
    @endpush
@endif 