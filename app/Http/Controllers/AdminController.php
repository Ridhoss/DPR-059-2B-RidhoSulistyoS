<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\komponen_gaji;
use App\Models\penggajian;
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
            'jumlah_anak' => 'required|min:0',
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
            'jumlah_anak' => $request->jumlah_anak,
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
            'id_anggota' => 'required',
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'jabatan' => 'required',
            'status_pernikahan' => 'required',
            'jumlah_anak' => 'required|min:0',
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
            'jumlah_anak' => $request->jumlah_anak
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
        $validator = Validator::make($request->all(), [
            'nama_komponen' => 'required|unique:komponen_gajis,nama_komponen',
            'kategori' => 'required',
            'jabatan' => 'required',
            'nominal' => 'required',
            'satuan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/komponen/tambah')
                ->withErrors($validator)
                ->withInput();
        }

        komponen_gaji::create([
            'nama_komponen' => $request->nama_komponen,
            'kategori' => $request->kategori,
            'jabatan' => $request->jabatan,
            'nominal' => $request->nominal,
            'satuan' => $request->satuan,
        ]);

        return redirect('/admin/komponen');
    }

    public function index_edit_komponen($id)
    {
        $komponen = komponen_gaji::where('id_komponen_gaji', $id)->first();
        $data = [
            'komponen' => $komponen,
        ];

        return view('pages.admin.komponen_gaji.edit', $data);
    }

    public function action_edit_komponen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_komponen_gaji' => 'required',
            'nama_komponen' => 'required',
            'kategori' => 'required',
            'jabatan' => 'required',
            'nominal' => 'required',
            'satuan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/komponen/edit/' . $request->id_komponen_gaji)
                ->withErrors($validator)
                ->withInput();
        }

        $komponen = komponen_gaji::where('id_komponen_gaji', $request->id_komponen_gaji)->first();

        $komponen->update([
            'nama_komponen' => $request->nama_komponen,
            'kategori' => $request->kategori,
            'jabatan' => $request->jabatan,
            'nominal' => $request->nominal,
            'satuan' => $request->satuan,
        ]);

        return redirect('/admin/komponen');
    }

    public function action_delete_komponen(Request $request)
    {
        $id = $request->input('id');

        $komponen = komponen_gaji::where('id_komponen_gaji', $id)->first();

        if ($komponen) {
            $komponen->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }




    // penggajian
    public function index_gaji()
    {
        $komponen = penggajian::with(['anggota', 'komponen_gaji'])->get();
        $komponenGrouped = $komponen->groupBy('id_anggota');

        $penggajian = $komponenGrouped
            ->map(function ($items) {
                $first = $items->first();
                return [
                    'anggota' => $first->anggota,
                    'total_gaji' => $items->sum(function ($item) {
                        return $item->komponen_gaji->nominal;
                    })
                ];
            });

        $data = [
            'gaji' => $penggajian,
        ];

        return view('pages.admin.penggajian.index', $data);
    }

    public function index_tambah_gaji()
    {
        $anggota = Anggota::whereNotIn('id_anggota', function ($query) {
            $query->select('id_anggota')->from('penggajians');
        })->get();
        $komponen = komponen_gaji::all();

        $data = [
            'anggota' => $anggota,
            'komponen' => $komponen,
        ];

        return view('pages.admin.penggajian.tambah', $data);
    }

    public function action_tambah_gaji(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'anggota' => 'required',
            'pilihGaji' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/penggajian/tambah')
                ->withErrors($validator)
                ->withInput();
        }

        foreach ($request->pilihGaji as $p) {
            penggajian::create([
                'id_anggota' => $request->anggota,
                'id_komponen_gaji' => $p,
            ]);
        }

        return redirect('/admin/penggajian');
    }

    public function index_ubah_gaji($id)
    {
        $anggota = Anggota::where('id_anggota', $id)->first();
        $id = $anggota->id_anggota;
        $jabatan = $anggota->jabatan;
        $komponenReady = komponen_gaji::whereIn('id_komponen_gaji', function ($query) use ($id) {
            $query->select('id_komponen_gaji')
                ->from('penggajians')
                ->where('id_anggota', $id);
        })->get();

        $komponen = komponen_gaji::where('jabatan', $jabatan)->orWhere('jabatan', 'Semua')->get();

        $data = [
            'anggota' => $anggota,
            'komponen' => $komponen,
            'komponenReady' => $komponenReady,
        ];

        return view('pages.admin.penggajian.edit', $data);
    }

    public function action_ubah_gaji(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'anggota' => 'required',
            'pilihGaji' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/penggajian')
                ->withErrors($validator)
                ->withInput();
        }

        $anggotaId = $request->anggota;
        $komponenDipilih = $request->pilihGaji;

        $komponenLama = Penggajian::where('id_anggota', $anggotaId)
            ->pluck('id_komponen_gaji')
            ->toArray();

        $komponenHapus = array_diff($komponenLama, $komponenDipilih);
        $komponenTambah = array_diff($komponenDipilih, $komponenLama);

        if (!empty($komponenHapus)) {
            Penggajian::where('id_anggota', $anggotaId)
                ->whereIn('id_komponen_gaji', $komponenHapus)
                ->delete();
        }

        foreach ($komponenTambah as $idKomponen) {
            Penggajian::create([
                'id_anggota' => $anggotaId,
                'id_komponen_gaji' => $idKomponen,
            ]);
        }

        return redirect('/admin/penggajian');
    }

    public function action_delete_penggajian(Request $request)
    {
        $id = $request->input('id');

        $komponen = penggajian::where('id_anggota', $id)->get();

        if ($komponen) {
            foreach ($komponen as $k) {
                $k->delete();
            }
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function index_detail_penggajian($ids)
    {
        $anggota = Anggota::where('id_anggota', $ids)->first();
        $id = $anggota->id_anggota;
        $komponenReady = komponen_gaji::whereIn('id_komponen_gaji', function ($query) use ($id) {
            $query->select('id_komponen_gaji')
                ->from('penggajians')
                ->where('id_anggota', $id);
        })->get();

        $data = [
            'anggota' => $anggota,
            'komponen' => $komponenReady,
        ];

        return view('pages.admin.penggajian.detail', $data);
    }
}
