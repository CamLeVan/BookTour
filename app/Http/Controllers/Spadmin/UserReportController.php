<?php

namespace App\Http\Controllers\Spadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserReportController extends Controller
{
    public function index()
    {
        return view('spadmin.users.report');
    }
}
