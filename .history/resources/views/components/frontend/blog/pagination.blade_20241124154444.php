@if ($paginator->hasPages())
    <div class="blog-pagination">
        <style scoped>
            .blog-pagination {
                margin-top: 40px;
            }
            .pagination {
                display: flex;
                justify-content: center;
                gap: 5px;
                list-style: none;
                padding: 0;
            }
            .page-item {
                margin: 0 2px;
            }
            .page-link {
                padding: 8px 16px;
                background: #f5f5f5;
                color: #333;
                border-radius: 3px;
                text-decoration: none;
                transition: all 0.3s ease;
            }
            .page-item.active .page-link {
                background: #333;
                color: #fff;
            }
            .page-link:hover {
                background: #333;
                color: #fff;
            }
            .page-item.disabled .page-link {
                background: #eee;
                color: #999;
                cursor: not-allowed;
            }
        </style>

        {{ $paginator->links() }}
    </div>
@endif