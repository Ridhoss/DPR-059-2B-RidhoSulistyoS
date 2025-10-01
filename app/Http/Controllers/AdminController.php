<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index_home()
    {
        return view('pages.admin.home');
    }
}
