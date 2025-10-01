<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitizenController extends Controller
{
    public function index_home()
    {
        return view('pages.citizen.home');
    }
}
