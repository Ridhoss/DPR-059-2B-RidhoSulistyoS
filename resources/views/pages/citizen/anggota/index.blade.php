@extends('layout.citizen')

@section('content')
    <h1 class="font-bold text-3xl uppercase mt-2">Daftar Anggota</h1>

    <div class="flex items-center justify-between mt-8">
        <form action="/citizen/anggota/cari" method="GET" class="h-10 flex gap-2">
            <input type="text" class="border border-gray-500 h-10 rounded-lg ps-2" id="cari" name="cari"
                placeholder="Pencarian" value="{{ request('cari') }}" >
            <button type="submit"
                class="w-20 h-10 flex border-2 border-purple-500 bg-purple-500 text-white hover:bg-purple-300 hover:border-purple-300 rounded-md justify-center items-center ">Cari</button>
        </form>
    </div>
    <table class="mt-5 w-full h-50">
        <tr class="bg-gray-500 text-white h-12">
            <th>ID Anggota</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Status Pernikahan</th>
            <th>Jumlah Anak</th>
        </tr>
        @if (!$anggota->isEmpty())
            @foreach ($anggota as $a)
                <tr class="text-center h-15 border-b-1 border-gray-400">
                    <td>{{ $a->id_anggota }}</td>
                    <td>{{ $a->gelar_depan . ' ' . $a->nama_depan . ' ' . $a->nama_belakang . ' ' . $a->gelar_belakang }}
                    </td>
                    <td>{{ $a->jabatan }}</td>
                    <td>{{ $a->status_pernikahan }}</td>
                    <td>{{ $a->jumlah_anak }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5" class="text-center text-danger">
                    Data tidak ditemukan / Kosong!
                </td>
            </tr>
        @endif
    </table>
@endsection
