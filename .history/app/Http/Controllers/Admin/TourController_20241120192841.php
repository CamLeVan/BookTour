<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TourController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        // Logic hiển thị danh sách tour
    }

    public function create()
    {
        // Logic tạo tour mới
    }

    public function store(Request $request)
    {
        // Logic lưu tour
    }

    // ... các methods khác
}
