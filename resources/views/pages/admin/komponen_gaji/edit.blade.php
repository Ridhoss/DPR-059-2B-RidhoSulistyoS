@extends('layout.admin')

@section('content')
    <h1 class="font-bold text-3xl uppercase mt-10 text-center">Edit Komponen Gaji</h1>
    <div class="flex justify-center items-center mt-10">
        <div class="p-5 border-2 border-gray-300 bg-white shadow-xl rounded-lg">
            <form action="/admin/komponen/edit" method="POST" class="w-150">
                @csrf
                <input type="hidden" name="id_komponen_gaji" value="{{ $komponen->id_komponen_gaji }}">
                <div class="flex flex-col mt-3">
                    <label for="nama_komponen">Nama Komponen</label>
                    <input type="text" class="border border-gray-500 h-10 rounded-lg ps-2 mt-2" id="nama_komponen"
                        name="nama_komponen" value="{{ old('nama_komponen', $komponen->nama_komponen) }}" placeholder="Nama Komponen Gaji">
                </div>
                <div class="flex flex-col mt-3">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="border border-gray-500 h-10 rounded-lg ps-2 mt-2"
                        required>
                        @php
                            $statuses = ['Gaji Pokok', 'Tunjangan Melekat', 'Tunjangan Lain'];
                        @endphp
                        @foreach ($statuses as $s)
                            <option value="{{ $s }}" {{ old('status_pernikahan', $komponen->kategori) == $s ? 'selected' : '' }}>
                                {{ $s }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col mt-3">
                    <label for="jabatan">Jabatan</label>
                    <select name="jabatan" id="jabatan" class="border border-gray-500 h-10 rounded-lg ps-2 mt-2" required>
                        @php
                            $jabatans = ['Ketua', 'Wakil Ketua', 'Anggota', 'Semua'];
                        @endphp
                        @foreach ($jabatans as $j)
                            <option value="{{ $j }}" {{ old('jabatan', $komponen->jabatan) == $j ? 'selected' : '' }}>
                                {{ $j }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col mt-3">
                    <label for="nominal">Nominal</label>
                    <input type="text" class="border border-gray-500 h-10 rounded-lg ps-2 mt-2" id="nominal"
                        name="nominal" value="{{ old('nominal', $komponen->nominal) }}" placeholder="Nama Komponen Gaji">
                </div>
                <div class="flex flex-col mt-3">
                    <label for="satuan">Satuan</label>
                    <select name="satuan" id="satuan" class="border border-gray-500 h-10 rounded-lg ps-2 mt-2" required>
                        @php
                            $satuans = ['Bulan', 'Periode'];
                        @endphp
                        @foreach ($satuans as $s)
                            <option value="{{ $s }}" {{ old('satuan', $komponen->satuan) == $s ? 'selected' : '' }}>
                                {{ $s }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col mt-3">
                    <button type="submit"
                        class="w-full h-10 mt-8 rounded-lg bg-purple-600 hover:bg-purple-400 text-white">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
