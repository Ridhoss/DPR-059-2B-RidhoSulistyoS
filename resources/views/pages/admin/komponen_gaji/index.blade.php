@extends('layout.admin')

@section('content')
    <h1>Komponen Gaji</h1>

    <a href="/admin/komponen/tambah" class="btn btn-primary">Add</a>

    <table class="table table-striped mt-2">
        <thead>
            <tr class="table-primary text-center">
                <th scope="col">Id Komponen</th>
                <th scope="col">Nama Komponen</th>
                <th scope="col">Kategori</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Nominal</th>
                <th scope="col">Satuan</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="tableCourse">
            @if (!$komponen->isEmpty())
                @foreach ($komponen as $k)
                    <tr class="text-center">
                        <td>{{ $k->id_komponen_gaji }}</td>
                        <td>{{ $k->nama_komponen }}</td>
                        <td>{{ $k->kategori }}</td>
                        <td>{{ $k->jabatan }}</td>
                        <td>{{ $k->nominal }}</td>
                        <td>{{ $k->satuan }}</td>
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
