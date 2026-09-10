<?php

namespace App\Http\Controllers\Spadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminSpController extends Controller
{
    public function index()
    {
        return view('spadmin.manageadminlist.adminlistsp');
    }
}
