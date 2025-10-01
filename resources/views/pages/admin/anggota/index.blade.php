@extends('layout.admin')

@section('content')
    <h1>Daftar Anggota</h1>

    <a href="/admin/anggota/tambah" class="btn btn-primary">Add</a>

    <table class="table table-striped mt-2">
        <thead>
            <tr class="table-primary text-center">
                <th scope="col">Id Anggota</th>
                <th scope="col">Nama</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Status Pernikahan</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="tableCourse">
            @if (!$anggota->isEmpty())
                @foreach ($anggota as $a)
                    <tr class="text-center">
                        <td>{{ $a->id_anggota }}</td>
                        <td>{{ $a->gelar_depan . ' ' . $a->nama_depan . ' ' . $a->nama_belakang . ' ' . $a->gelar_belakang }}
                        </td>
                        <td>{{ $a->jabatan }}</td>
                        <td>{{ $a->status_pernikahan }}</td>
                        <td>
                            <button class="btn btn-warning">Edit</button>
                            <button class="btn btn-danger">Delete</button>
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
        </tbody>
    </table>
@endsection
