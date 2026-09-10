<?php

namespace App\Http\Controllers\Spadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Spadmin\CustomerListSpController;

class CustomerListController extends Controller
{
    public function index()
    {
        return view('spadmin.managecustomerlist.customerlistsp');
    }
}
