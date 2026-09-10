<?php

namespace App\View\Components\Frontend\Blog;

use Illuminate\View\Component;

class Pagination extends Component
{
    public $paginator;

    public function __construct($paginator)
    {
        $this->paginator = $paginator;
    }

    public function render()
    {
        return view('components.frontend.blog.pagination');
    }
}
