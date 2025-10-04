@extends('layout.admin')

@section('content')
    <h1 class="font-bold text-3xl uppercase mt-2">Daftar Anggota</h1>

    <div class="flex items-center justify-between mt-8">
        <a href="/admin/anggota/tambah"
            class="w-20 h-10 flex border-2 border-purple-500 bg-purple-500 text-white hover:bg-purple-300 hover:border-purple-300 rounded-md justify-center items-center ">Tambah</a>
        <form action="/admin/anggota/cari" method="GET" class="h-10 flex gap-2">
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
                    <td>{{ $a->jumlah_anak }}</td>
                    <td class="h-full flex gap-2 justify-center items-center">
                        <a href="/admin/anggota/edit/{{ $a->id_anggota }}"
                            class="flex p-2 border-2 border-green-500 bg-green-500 text-white hover:bg-green-300 hover:border-green-300 rounded-md justify-center items-center">Edit</a>
                        <a class="flex p-2 border-2 border-red-500 bg-red-500 text-white hover:bg-red-300 hover:border-red-300 rounded-md justify-center items-center hover:cursor-pointer btn-hapus"
                            data-id="{{ $a->id_anggota }}">Delete</a>
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

    <script>
        btnHapus = document.querySelectorAll('.btn-hapus');

        btnHapus.forEach(e => {
            e.addEventListener('click', function() {
                const id = this.dataset.id;

                Swal.fire({
                    title: `Apakah Kamu Ingin Menghapus Data ${this.dataset.id} ?`,
                    confirmButtonColor: "#d33",
                    confirmButtonText: "Delete",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("/admin/anggota/delete", {
                                method: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": document.querySelector(
                                        'meta[name="csrf-token"]').content,
                                    "Content-Type": "application/json",
                                },
                                body: JSON.stringify({
                                    id: id
                                }),
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire("Berhasil!", "Data berhasil dihapus.", "success");
                                    this.closest('tr').remove();
                                } else {
                                    Swal.fire("Gagal!", "Data gagal dihapus.", "error");
                                }
                            });
                    }
                });
            });
        });
    </script>
@endsection
