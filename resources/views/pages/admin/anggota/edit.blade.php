@extends('layout.admin')

@section('content')
    <h1 class="font-bold text-3xl uppercase mt-10 text-center">Edit Anggota</h1>
    <div class="flex justify-center items-center mt-10">
        <div class="p-5 border-2 border-gray-300 bg-white shadow-xl rounded-lg">
            <form action="/admin/anggota/edit" method="POST" class="w-150">
                @csrf
                <input type="hidden" name="id_anggota" value="{{ $anggota->id_anggota }}">
                <div class="flex gap-5">
                    <div class="flex flex-col mt-3 w-full">
                        <label for="nama_depan">Nama Depan</label>
                        <input type="text" class="border border-gray-500 h-10 rounded-lg ps-2 mt-2" id="nama_depan"
                            name="nama_depan" value="{{ old('nama_depan', $anggota->nama_depan) }}" placeholder="Nama Depan"
                            required>
                    </div>
                    <div class="flex flex-col mt-3 w-full">
                        <label for="nama_belakang">Nama Belakang</label>
                        <input type="text" class="border border-gray-500 h-10 rounded-lg ps-2 mt-2" id="nama_belakang"
                            name="nama_belakang" value="{{ old('nama_belakang', $anggota->nama_belakang) }}"
                            placeholder="Nama Belakang" required>
                    </div>
                </div>
                <div class="flex flex-col mt-3">
                    <label for="gelar_depan">Gelar Depan</label>
                    <input type="text" class="border border-gray-500 h-10 rounded-lg ps-2 mt-2" id="gelar_depan"
                        name="gelar_depan" value="{{ old('gelar_depan', $anggota->gelar_depan) }}"
                        placeholder="Gelar Depan">
                </div>
                <div class="flex flex-col mt-3">
                    <label for="gelar_belakang">Gelar Belakang</label>
                    <input type="text" class="border border-gray-500 h-10 rounded-lg ps-2 mt-2" id="gelar_belakang"
                        name="gelar_belakang" value="{{ old('gelar_belakang', $anggota->gelar_belakang) }}"
                        placeholder="Gelar Belakang">
                </div>
                <div class="flex flex-col mt-3">
                    <label for="jabatan">Jabatan</label>
                    <select name="jabatan" id="jabatan" class="border border-gray-500 h-10 rounded-lg ps-2 mt-2" required>
                        @php
                            $jabatans = ['Ketua', 'Wakil Ketua', 'Anggota'];
                        @endphp
                        @foreach ($jabatans as $j)
                            <option value="{{ $j }}"
                                {{ old('jabatan', $anggota->jabatan) == $j ? 'selected' : '' }}>
                                {{ $j }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col mt-3">
                    <label for="status_pernikahan">Status Pernikahan</label>
                    <select name="status_pernikahan" id="status_pernikahan"
                        class="border border-gray-500 h-10 rounded-lg ps-2 mt-2" required>
                        @php
                            $statuses = ['Menikah', 'Belum Menikah'];
                        @endphp
                        @foreach ($statuses as $s)
                            <option value="{{ $s }}"
                                {{ old('status_pernikahan', $anggota->status_pernikahan) == $s ? 'selected' : '' }}>
                                {{ $s }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col mt-3">
                    <label for="jumlah_anak">Jumlah Anak</label>
                    <input type="number" class="border border-gray-500 h-10 rounded-lg ps-2 mt-2" id="jumlah_anak"
                        name="jumlah_anak" value="{{ old('jumlah_anak', $anggota->jumlah_anak) }}" placeholder="Jumlah Anak" min="0"
                        required>
                </div>
                <div class="flex flex-col mt-3">
                    <button type="submit"
                        class="w-full h-10 mt-8 rounded-lg bg-purple-600 hover:bg-purple-400 text-white">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
