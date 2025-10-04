@extends('layout.admin')

@section('content')
    <h1 class="font-bold text-3xl uppercase mt-2">Komponen Gaji</h1>

    <a href="/admin/komponen/tambah"
        class="w-20 h-10 flex border-2 border-purple-500 bg-purple-500 text-white hover:bg-purple-300 hover:border-purple-300 rounded-md justify-center items-center mt-8">Tambah</a>
    <table class="mt-5 w-full h-50">
        <tr class="bg-gray-500 text-white h-12">
            <th>Id Komponen</th>
            <th>Nama Komponen</th>
            <th>Kategori</th>
            <th>Jabatan</th>
            <th>Nominal</th>
            <th>Satuan</th>
            <th>Action</th>
        </tr>
        @if (!$komponen->isEmpty())
            @foreach ($komponen as $k)
                <tr class="text-center h-15 border-b-1 border-gray-400">
                    <td>{{ $k->id_komponen_gaji }}</td>
                    <td>{{ $k->nama_komponen }}</td>
                    <td>{{ $k->kategori }}</td>
                    <td>{{ $k->jabatan }}</td>
                    <td>Rp. {{ number_format($k->nominal, 2, ',', '.') }}</td>
                    <td>{{ $k->satuan }}</td>
                    <td class="h-full flex gap-2 justify-center items-center">
                        <a href="/admin/komponen/edit/{{ $k->id_komponen_gaji }}"
                            class="flex p-2 border-2 border-green-500 bg-green-500 text-white hover:bg-green-300 hover:border-green-300 rounded-md justify-center items-center">Edit</a>
                        <a class="flex p-2 border-2 border-red-500 bg-red-500 text-white hover:bg-red-300 hover:border-red-300 rounded-md justify-center items-center hover:cursor-pointer btn-hapus"
                            data-id="{{ $k->id_komponen_gaji }}">Delete</a>
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
