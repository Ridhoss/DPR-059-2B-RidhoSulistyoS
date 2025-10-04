@extends('layout.admin')

@section('content')
    <h1 class="font-bold text-3xl uppercase mt-2">Daftar Anggota</h1>

    <a href="/admin/anggota/tambah"
        class="w-20 h-10 flex border-2 border-purple-500 bg-purple-500 text-white hover:bg-purple-300 hover:border-purple-300 rounded-md justify-center items-center mt-8">Tambah</a>
    <table class="mt-5 w-full h-50">
        <tr class="bg-gray-500 text-white h-12">
            <th>ID Anggota</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Status Pernikahan</th>
            <th>Action</th>
        </tr>
        @if (!$anggota->isEmpty())
            @foreach ($anggota as $a)
                <tr class="text-center h-15 border-b-1 border-gray-400">
                    <td>{{ $a->id_anggota }}</td>
                    <td>{{ $a->gelar_depan . ' ' . $a->nama_depan . ' ' . $a->nama_belakang . ' ' . $a->gelar_belakang }}
                    </td>
                    <td>{{ $a->jabatan }}</td>
                    <td>{{ $a->status_pernikahan }}</td>
                    <td class="h-full flex gap-2 justify-center items-center">
                        <a href="/admin/anggota/edit/{{ $a->id_anggota }}" class="flex p-2 border-2 border-green-500 bg-green-500 text-white hover:bg-green-300 hover:border-green-300 rounded-md justify-center items-center">Edit</a>
                        <a href="/admin/anggota/edit/{{ $a->id_anggota }}" class="flex p-2 border-2 border-red-500 bg-red-500 text-white hover:bg-red-300 hover:border-red-300 rounded-md justify-center items-center">Delete</a>
                    </td>
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
