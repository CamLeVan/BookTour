<div class="sidebar">
    <!-- Search -->
    <x-frontend.blog.sidebar.search />

    <!-- Recent Posts -->
    <x-frontend.blog.sidebar.recent-posts :recentPosts="$recentPosts" />

    <!-- Categories -->
    <x-frontend.blog.sidebar.categories :categories="$categories" />

    <!-- Archives -->
    <x-frontend.blog.sidebar.archives :archives="$archives" />

    <!-- Tags -->
    <x-frontend.blog.sidebar.tags :tags="$tags" />
</div> 