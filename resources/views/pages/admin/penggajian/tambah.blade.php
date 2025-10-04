@extends('layout.admin')

@section('content')
    <h1 class="font-bold text-3xl uppercase mt-10 text-center">Tambah Penggajian</h1>
    <div class="flex mt-10 w-full">
        <form action="/admin/penggajian/tambah" method="POST" class="flex mt-10 w-full">
            @csrf
            <div class="flex flex-col justify-center items-center w-[70%]">
                <div class="p-5 border-2 border-gray-300 bg-white shadow-xl rounded-lg w-full">
                    <div class="flex flex-col mt-3">
                        <label for="cmbAnggota">Anggota</label>
                        <select name="anggota" id="cmbAanggota" class="border border-gray-500 h-10 rounded-lg ps-2 mt-2"
                            required>
                            <option value="" selected disabled>-- Pilih Anggota --</option>
                        </select>
                    </div>
                </div>
                <div class="p-5 border-2 border-gray-300 bg-white shadow-xl rounded-lg mt-5 w-full">
                    <table class="mt-5 w-full h-50">
                        <thead>
                            <tr class="bg-gray-500 text-white h-12">
                                <th>Id Komponen</th>
                                <th>Nama Komponen</th>
                                <th>Kategori</th>
                                <th>Jabatan</th>
                                <th>Nominal</th>
                                <th>Satuan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tabelKomponenGaji"></tbody>
                    </table>
                </div>
            </div>
            <div class="flex justify-center items-start w-[30%]">
                <div class="p-5 border-2 border-gray-300 bg-white shadow-xl rounded-lg w-[80%]">
                    <h2 class="text-xl font-bold mb-5">Keterangan Gaji</h2>
                    <div class="flex flex-col gap-3">
                        <div class="flex justify-between">
                            <span>Total Gaji Pokok:</span>
                            <span id="totalGajiPokok">Rp. 0</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Total Tunjangan Melekat:</span>
                            <span id="totalTunjanganMelekat">Rp. 0</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Total Tunjangan Lain:</span>
                            <span id="totalTunjanganLain">Rp. 0</span>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between font-bold">
                            <span>Total Gaji Keseluruhan:</span>
                            <span id="totalGajiKeseluruhan">Rp. 0</span>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full h-10 flex border-2 border-purple-500 bg-purple-500 text-white hover:bg-purple-300 hover:border-purple-300 rounded-md justify-center items-center mt-8">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        let anggotaArray = [];
        let komponenGajiArray = [];
        let komponenGajiTerpilih = [];
        const cmbAnggota = document.getElementById('cmbAanggota');
        const tabelKomponenGaji = document.getElementById('tabelKomponenGaji');
        const textGajiPokok = document.getElementById('totalGajiPokok');
        const textTunjanganMelekat = document.getElementById('totalTunjanganMelekat');
        const textTunjanganLain = document.getElementById('totalTunjanganLain');
        const textTotal = document.getElementById('totalGajiKeseluruhan');

        @foreach ($anggota as $a)
            anggotaArray.push({
                id_anggota: "{{ $a->id_anggota }}",
                nama_depan: "{{ $a->nama_depan }}",
                nama_belakang: "{{ $a->nama_belakang }}",
                gelar_depan: "{{ $a->gelar_depan }}",
                gelar_belakang: "{{ $a->gelar_belakang }}",
                jabatan: "{{ $a->jabatan }}",
                status_pernikahan: "{{ $a->status_pernikahan }}",
                jumlah_anak: {{ $a->jumlah_anak }},
            });
        @endforeach

        @foreach ($komponen as $k)
            komponenGajiArray.push({
                id_komponen_gaji: "{{ $k->id_komponen_gaji }}",
                nama_komponen: "{{ $k->nama_komponen }}",
                kategori: "{{ $k->kategori }}",
                jabatan: "{{ $k->jabatan }}",
                nominal: {{ number_format($k->nominal, 2, '.', '') }},
                satuan: "{{ $k->satuan }}",
            });
        @endforeach

        anggotaArray.forEach(a => {
            const option = document.createElement('option');
            option.value = a.id_anggota;
            option.name = 'id_anggota'
            option.text =
                `${a.id_anggota} - ${a.gelar_depan} ${a.nama_depan} ${a.nama_belakang} ${a.gelar_belakang} - ${a.jabatan}`;
            cmbAnggota.appendChild(option);
        });

        tabelKomponenGaji.innerHTML = /*html*/ `
                    <tr class="text-center">
                        <td colspan="7">Tidak ada data Komponen Gaji</td>
                    </tr>
                `;

        cmbAnggota.addEventListener('change', function() {
            const selectedId = this.value;
            const selectedAnggota = anggotaArray.find(a => a.id_anggota === selectedId);
            komponenGajiTerpilih = komponenGajiArray.filter(k => k.jabatan === selectedAnggota.jabatan || k
                .jabatan === 'Semua');

            tabelKomponenGaji.innerHTML = '';

            if (komponenGajiTerpilih.length === 0) {
                tabelKomponenGaji.innerHTML = /*html*/ `
                    <tr class="text-center">
                        <td colspan="7">Tidak ada data Komponen Gaji</td>
                    </tr>
                `;
            } else {
                komponenGajiTerpilih.forEach(k => {
                    const row = document.createElement('tr');
                    row.classList.add('text-center', 'h-15', 'border-b-1', 'border-gray-400');
                    row.innerHTML = /*html*/ `
                        <td>${k.id_komponen_gaji}</td>
                        <td>${k.nama_komponen}</td>
                        <td>${k.kategori}</td>
                        <td>${k.jabatan}</td>
                        <td>Rp. ${new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(k.nominal).replace('Rp', '').trim()}</td>
                        <td>${k.satuan}</td>
                        <td class="h-full flex gap-2 justify-center items-center">
                            <input class="scale-125" type="checkbox" name="pilihGaji[]" value="${k.id_komponen_gaji}">
                        </td>
                    `;
                    tabelKomponenGaji.appendChild(row);
                });
            }

            let totalGaji = 0;
            let totalGajiPokok = 0;
            let totalTunjanganMelekat = 0;
            let totalTunjanganLain = 0;

            const checkboxes = document.querySelectorAll('input[name="pilihGaji[]"]');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    totalGaji = 0;
                    totalGajiPokok = 0;
                    totalTunjanganMelekat = 0;
                    totalTunjanganLain = 0;

                    checkboxes.forEach(cb => {
                        if (cb.checked) {
                            const checkedGaji = komponenGajiTerpilih.find(k => k
                                .id_komponen_gaji === cb.value);

                            if (checkedGaji.kategori === 'Gaji Pokok') {
                                totalGajiPokok += checkedGaji.nominal;
                                totalGaji += checkedGaji.nominal;
                            } else if (checkedGaji.kategori === 'Tunjangan Melekat') {
                                totalTunjanganMelekat += checkedGaji.nominal;
                                totalGaji += checkedGaji.nominal;
                            } else if (checkedGaji.kategori === 'Tunjangan Lain') {
                                totalTunjanganLain += checkedGaji.nominal;
                                totalGaji += checkedGaji.nominal;
                            }
                        }

                        ubahTextNominal();
                    })
                });
            });

            ubahTextNominal();

            function ubahTextNominal() {
                textGajiPokok.textContent = `Rp. ${totalGajiPokok.toLocaleString('id-ID')}`;
                textTunjanganMelekat.textContent =
                    `Rp. ${totalTunjanganMelekat.toLocaleString('id-ID')}`;
                textTunjanganLain.textContent =
                    `Rp. ${totalTunjanganLain.toLocaleString('id-ID')}`;
                textTotal.textContent = `Rp. ${totalGaji.toLocaleString('id-ID')}`;
            }

        });
    </script>
@endsection
