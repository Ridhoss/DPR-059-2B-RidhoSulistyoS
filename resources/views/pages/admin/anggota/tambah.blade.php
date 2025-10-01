@extends('layout.admin')

@section('content')
    <h1>Tambah Anggota</h1>
    <form action="/admin/anggota/tambah" method="POST">
        @csrf
        <div class="w-50">
            <label for="nama_depan" class="form-label">Nama Depan</label>
            <input type="text" class="form-control" id="nama_depan" name="nama_depan" value="{{ old('nama_depan') }}"
                required>
        </div>
        <div class="w-50">
            <label for="nama_belakang" class="form-label">Nama Belakang</label>
            <input type="text" class="form-control" id="nama_belakang" name="nama_belakang"
                value="{{ old('nama_belakang') }}" required>
        </div>
        <div class="w-50">
            <label for="gelar_depan" class="form-label">Gelar Depan</label>
            <input type="text" class="form-control" id="gelar_depan" name="gelar_depan" value="{{ old('gelar_depan') }}">
        </div>
        <div class="w-50">
            <label for="gelar_belakang" class="form-label">Gelar Belakang</label>
            <input type="text" class="form-control" id="gelar_belakang" name="gelar_belakang"
                value="{{ old('gelar_belakang') }}">
        </div>
        <div class="w-50">
            <label for="jabatan" class="form-label">Jabatan</label>
            <select name="jabatan" id="jabatan" class="form-control" required>
                <option value="Ketua">Ketua</option>
                <option value="Wakil Ketua">Wakil Ketua</option>
                <option value="Anggota">Anggota</option>
            </select>
        </div>
        <div class="w-50">
            <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
            <select name="status_pernikahan" id="status_pernikahan" class="form-control" required>
                <option value="Menikah">Menikah</option>
                <option value="Belum Menikah">Belum Menikah</option>
            </select>
        </div>
        {{-- <div class="w-50">
            <label for="jumlah_anak" class="form-label">Jumlah Anak</label>
            <input type="text" class="form-control" id="jumlah_anak" name="jumlah_anak" required>
        </div> --}}
        <div class="w-50">
            <button type="submit" class="btn btn-success mt-3">Submit</button>
        </div>
    </form>
@endsection
