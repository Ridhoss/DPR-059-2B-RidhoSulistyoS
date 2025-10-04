@extends('layout.citizen')

@section('content')
    <h1 class="font-bold text-3xl uppercase mt-2">Penggajian Anggota DPR</h1>


    <div class="flex items-center justify-between mt-8">
        <form action="/citizen/penggajian/cari" method="GET" class="h-10 flex gap-2">
            <input type="text" class="border border-gray-500 h-10 rounded-lg ps-2" id="cari" name="cari"
                placeholder="Pencarian" value="{{ request('cari') }}">
            <button type="submit"
                class="w-20 h-10 flex border-2 border-purple-500 bg-purple-500 text-white hover:bg-purple-300 hover:border-purple-300 rounded-md justify-center items-center ">Cari</button>
        </form>
    </div>
    <table class="mt-5 w-full h-50">
        <tr class="bg-gray-500 text-white h-12">
            <th>Id Anggota</th>
            <th>Nama Anggota</th>
            <th>Jabatan</th>
            <th>Total Gaji</th>
            <th>Action</th>
        </tr>
        @if (!$gaji->isEmpty())
            @foreach ($gaji as $g)
                <tr class="text-center h-15 border-b-1 border-gray-400">
                    <td>{{ $g['anggota']->id_anggota }}</td>
                    <td>{{ $g['anggota']->gelar_depan . ' ' . $g['anggota']->nama_depan . ' ' . $g['anggota']->nama_belakang . ' ' . $g['anggota']->gelar_belakang }}
                    </td>
                    <td>{{ $g['anggota']->jabatan }}</td>
                    <td>Rp. {{ number_format($g['total_gaji'], 2, ',', '.') }}</td>
                    <td class="h-full flex gap-2 justify-center items-center">
                        <a href="/citizen/penggajian/detail/{{ $g['anggota']->id_anggota }}"
                            class="flex p-2 border-2 border-cyan-500 bg-cyan-500 text-white hover:bg-cyan-300 hover:border-cyan-300 rounded-md justify-center items-center">Detail</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-center text-danger">
                    Data tidak ditemukan / Kosong!
                </td>
            </tr>
        @endif
    </table>
@endsection
