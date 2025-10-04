<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\komponen_gaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index_home()
    {
        return view('pages.admin.home');
    }


    // anggota

    public function index_anggota()
    {
        $anggota = anggota::all();

        $data = [
            'anggota' => $anggota,
        ];

        return view('pages.admin.anggota.index', $data);
    }

    public function index_tambah_anggota()
    {
        return view('pages.admin.anggota.tambah');
    }

    public function action_tambah_anggota(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'jabatan' => 'required',
            'status_pernikahan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/anggota/tambah')
                ->withErrors($validator)
                ->withInput();
        }

        $anggota = anggota::create([
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'gelar_depan' => $request->gelar_depan,
            'gelar_belakang' => $request->gelar_belakang,
            'jabatan' => $request->jabatan,
            'status_pernikahan' => $request->status_pernikahan,
        ]);

        return redirect('/admin/anggota');
    }

    public function index_edit_anggota($id)
    {
        $anggota = anggota::where('id_anggota', $id)->first();

        $data = [
            'anggota' => $anggota,
        ];

        return view('pages.admin.anggota.edit', $data);
    }

    public function action_edit_anggota(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'jabatan' => 'required',
            'status_pernikahan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/anggota/edit/' . $request->id_anggota)
                ->withErrors($validator)
                ->withInput();
        }

        $anggota = anggota::where('id_anggota', $request->id_anggota)->first();

        $anggota->update([
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'gelar_depan' => $request->gelar_depan,
            'gelar_belakang' => $request->gelar_belakang,
            'jabatan' => $request->jabatan,
            'status_pernikahan' => $request->status_pernikahan,
        ]);

        return redirect('/admin/anggota');
    }

    public function action_delete_anggota(Request $request)
    {
        $id = $request->input('id');

        $anggota = anggota::where('id_anggota', $id)->first();

        if ($anggota) {
            $anggota->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }





    // komponen gaji
    public function index_komponen()
    {
        $komponen = komponen_gaji::all();

        $data = [
            'komponen' => $komponen,
        ];

        return view('pages.admin.komponen_gaji.index', $data);
    }

    public function index_tambah_komponen()
    {
        return view('pages.admin.komponen_gaji.tambah');
    }

    public function action_tambah_komponen(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'nama_depan' => 'required',
        //     'nama_belakang' => 'required',
        //     'jabatan' => 'required',
        //     'status_pernikahan' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return redirect('/admin/anggota/tambah')
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        // $anggota = anggota::create([
        //     'nama_depan' => $request->nama_depan,
        //     'nama_belakang' => $request->nama_belakang,
        //     'gelar_depan' => $request->gelar_depan,
        //     'gelar_belakang' => $request->gelar_belakang,
        //     'jabatan' => $request->jabatan,
        //     'status_pernikahan' => $request->status_pernikahan,
        // ]);

        // return redirect('/admin/anggota');
    }
}
