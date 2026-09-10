<?php

namespace App\Http\Controllers\Spadmin;

use App\Http\Controllers\Controller;

class RevenueReportController extends Controller
{
    public function index()
    {
        return view('spadmin.revenue.revenuereport');
    }
}
