<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\komponen_gaji;
use App\Models\penggajian;
use Illuminate\Http\Request;

class CitizenController extends Controller
{
    public function index_home()
    {
        return view('pages.citizen.home');
    }

    public function index_anggota()
    {
        $anggota = anggota::all();

        $data = [
            'anggota' => $anggota,
        ];

        return view('pages.citizen.anggota.index', $data);
    }

    public function action_cari_anggota(Request $request)
    {
        $keyword = $request->input('cari');
        if (!empty($keyword)) {
            $anggota = anggota::where(function ($q) use ($keyword) {
                $q->where('id_anggota', 'like', "%{$keyword}%")
                    ->orWhere('nama_depan', 'like', "%{$keyword}%")
                    ->orWhere('nama_belakang', 'like', "%{$keyword}%")
                    ->orWhere('gelar_depan', 'like', "%{$keyword}%")
                    ->orWhere('gelar_belakang', 'like', "%{$keyword}%")
                    ->orWhere('jabatan', 'like', "%{$keyword}%");
            })->get();
        } else {
            $anggota = anggota::all();
        }

        $data = [
            'anggota' => $anggota,
            'keyword' => $keyword,
        ];

        return view('pages.citizen.anggota.index', $data);
    }

    public function index_penggajian()
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

        return view('pages.citizen.penggajian.index', $data);
    }

    public function action_cari_penggajian(Request $request)
    {
        $keyword = $request->input('cari');

        $komponen = penggajian::with(['anggota', 'komponen_gaji'])->get();
        $komponenGrouped = $komponen->groupBy('id_anggota');

        $gaji = $komponenGrouped
            ->map(function ($items) {
                $first = $items->first();
                return [
                    'anggota' => $first->anggota,
                    'total_gaji' => $items->sum(function ($item) {
                        return $item->komponen_gaji->nominal;
                    })
                ];
            });

        if (!empty($keyword)) {
            $penggajian = $gaji->filter(function ($item) use ($keyword) {
                $anggota = $item['anggota'];
                $searchable = ['id_anggota', 'nama_depan', 'nama_belakang', 'gelar_depan', 'gelar_belakang', 'jabatan'];
                foreach ($searchable as $col) {
                    if (stripos($anggota->$col, $keyword) !== false) {
                        return true;
                    }
                }
                return false;
            });
        } else {
            $penggajian = $gaji;
        }

        $data = [
            'gaji' => $penggajian,
        ];

        return view('pages.citizen.penggajian.index', $data);
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


        return view('pages.citizen.penggajian.detail', $data);
    }
}
