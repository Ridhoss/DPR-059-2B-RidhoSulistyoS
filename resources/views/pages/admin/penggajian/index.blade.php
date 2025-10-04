@extends('layout.admin')

@section('content')
    <h1 class="font-bold text-3xl uppercase mt-2">Penggajian Anggota DPR</h1>


    <div class="flex items-center justify-between mt-8">
        <a href="/admin/penggajian/tambah"
            class="w-20 h-10 flex border-2 border-purple-500 bg-purple-500 text-white hover:bg-purple-300 hover:border-purple-300 rounded-md justify-center items-center ">Tambah</a>
        <form action="/admin/penggajian/cari" method="GET" class="h-10 flex gap-2">
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
                        <a href="/admin/penggajian/detail/{{ $g['anggota']->id_anggota }}"
                            class="flex p-2 border-2 border-cyan-500 bg-cyan-500 text-white hover:bg-cyan-300 hover:border-cyan-300 rounded-md justify-center items-center">Detail</a>
                        <a href="/admin/penggajian/edit/{{ $g['anggota']->id_anggota }}"
                            class="flex p-2 border-2 border-green-500 bg-green-500 text-white hover:bg-green-300 hover:border-green-300 rounded-md justify-center items-center">Edit</a>
                        <a class="flex p-2 border-2 border-red-500 bg-red-500 text-white hover:bg-red-300 hover:border-red-300 rounded-md justify-center items-center hover:cursor-pointer btn-hapus"
                            data-id="{{ $g['anggota']->id_anggota }}">Delete</a>
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
                        fetch("/admin/penggajian/delete", {
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
