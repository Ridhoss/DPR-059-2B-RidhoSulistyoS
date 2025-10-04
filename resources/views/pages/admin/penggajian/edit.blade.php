@extends('layout.admin')

@section('content')
    <h1 class="font-bold text-3xl uppercase mt-10 text-center">Edit Penggajian</h1>
    <div class="flex mt-10 w-full">
        <form action="/admin/penggajian/edit" method="POST" class="flex mt-10 w-full">
            @csrf
            <div class="flex flex-col justify-center items-center w-[70%]">
                <div class="p-5 border-2 border-gray-300 bg-white shadow-xl rounded-lg w-full">
                    <div class="flex flex-col mt-3">
                        <label for="cmbAnggota">Anggota</label>
                        <input type="hidden" name="anggota" value="{{ $anggota->id_anggota }}">
                        <input type="hidden" name="jumlah_anak" value="{{ $anggota->jumlah_anak }}">
                        <input type="text" class="border border-gray-500 h-10 rounded-lg ps-2 mt-2" id="anggota"
                            value="{{ old('anggota') }}"
                            placeholder="{{ $anggota->id_anggota . ' - ' . $anggota->gelar_depan . ' ' . $anggota->nama_depan . ' ' . $anggota->nama_belakang . ' ' . $anggota->gelar_belakang . ' - ' . $anggota->jabatan }}"
                            required disabled>
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
                        <span class="text-sm text-red-500">*Total Sudah beserta Tunjangan Anak Max 2 (Jika Ada)</span>
                    </div>
                    <button type="submit"
                        class="w-full h-10 flex border-2 border-purple-500 bg-purple-500 text-white hover:bg-purple-300 hover:border-purple-300 rounded-md justify-center items-center mt-8">Simpan</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        let komponenGajiArray = [];
        let komponenGajiTerpilih = [];
        const tabelKomponenGaji = document.getElementById('tabelKomponenGaji');
        const textGajiPokok = document.getElementById('totalGajiPokok');
        const textTunjanganMelekat = document.getElementById('totalTunjanganMelekat');
        const textTunjanganLain = document.getElementById('totalTunjanganLain');
        const textTotal = document.getElementById('totalGajiKeseluruhan');

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

        @foreach ($komponenReady as $k)
            komponenGajiTerpilih.push({
                id_komponen_gaji: "{{ $k->id_komponen_gaji }}",
                nama_komponen: "{{ $k->nama_komponen }}",
                kategori: "{{ $k->kategori }}",
                jabatan: "{{ $k->jabatan }}",
                nominal: {{ number_format($k->nominal, 2, '.', '') }},
                satuan: "{{ $k->satuan }}",
            });
        @endforeach

        const anakCount = Math.min({{ $anggota->jumlah_anak ?? 0 }}, 2);

        komponenGajiArray.forEach(k => {
            const jumlahTersimpan = komponenGajiTerpilih.filter(kt => kt.id_komponen_gaji == k.id_komponen_gaji).length;
            const isTunjanganAnak = k.nama_komponen === 'Tunjangan Anak';

            let extraMultiplier = 1;
            if (isTunjanganAnak) {
                extraMultiplier = anakCount > 0 ? anakCount : 1;
            }

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
                            <input class="scale-125" type="checkbox" name="pilihGaji[]" value="${k.id_komponen_gaji}" ${jumlahTersimpan > 0 ? 'checked' : ''} data-multiplier="${extraMultiplier}">
                        </td>
                    `;
            tabelKomponenGaji.appendChild(row);
        });

        let totalGaji = 0;
        let totalGajiPokok = 0;
        let totalTunjanganMelekat = 0;
        let totalTunjanganLain = 0;

        const checkboxes = document.querySelectorAll('input[name="pilihGaji[]"]');

        checked();

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                checked();
            });
        });

        ubahTextNominal();

        function checked() {
            totalGaji = 0;
            totalGajiPokok = 0;
            totalTunjanganMelekat = 0;
            totalTunjanganLain = 0;

            checkboxes.forEach(cb => {
                if (cb.checked) {
                    const checkedGaji = komponenGajiArray.find(k => k.id_komponen_gaji == cb.value);

                    if (!checkedGaji) return;

                    if (checkedGaji.kategori === 'Gaji Pokok') {
                        totalGajiPokok += checkedGaji.nominal;
                    } else if (checkedGaji.kategori === 'Tunjangan Melekat') {
                        totalTunjanganMelekat += checkedGaji.nominal;
                    } else if (checkedGaji.kategori === 'Tunjangan Lain') {
                        totalTunjanganLain += checkedGaji.nominal;
                    }

                    const multiplier = parseInt(cb.getAttribute('data-multiplier') || 1);
                    totalGaji += checkedGaji.nominal * multiplier;
                }
            });

            ubahTextNominal();
        }

        function ubahTextNominal() {
            textGajiPokok.textContent = `Rp. ${totalGajiPokok.toLocaleString('id-ID')}`;
            textTunjanganMelekat.textContent =
                `Rp. ${totalTunjanganMelekat.toLocaleString('id-ID')}`;
            textTunjanganLain.textContent =
                `Rp. ${totalTunjanganLain.toLocaleString('id-ID')}`;
            textTotal.textContent = `Rp. ${totalGaji.toLocaleString('id-ID')}`;
        }
    </script>
@endsection
