<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index_home()
    {
        return view('pages.admin.home');
    }

    public function index_anggota()
    {
        $anggota = anggota::all();

        $data = [
            'anggota' => $anggota,
        ];

        return view('pages.admin.anggota.index', $data);
    }

}
