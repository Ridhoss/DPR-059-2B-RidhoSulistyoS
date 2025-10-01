<?php

namespace Database\Seeders;

use App\Models\anggota;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::insert([
            [
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'email' => 'thoriq@simanjuntak.com',
                'nama_depan' => 'Thoriq',
                'nama_belakang' => 'Simanjuntak',
                'role' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'citizen',
                'password' => Hash::make('public123'),
                'email' => 'richard@subakat.com',
                'nama_depan' => 'Richard',
                'nama_belakang' => 'Subakat',
                'role' => 'Public',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        anggota::insert([
            [
                'id_anggota' => 101,
                'nama_depan' => 'Puan',
                'nama_belakang' => 'Maharani',
                'gelar_depan' => 'Dr. (H.C.)',
                'gelar_belakang' => 'S.Sos',
                'jabatan' => 'Ketua',
                'status_pernikahan' => 'Menikah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_anggota' => 102,
                'nama_depan' => 'Lodewijk',
                'nama_belakang' => 'Paulus',
                'gelar_depan' => NULL,
                'gelar_belakang' => NULL,
                'jabatan' => 'Wakil Ketua',
                'status_pernikahan' => 'Menikah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_anggota' => 103,
                'nama_depan' => 'Fadli',
                'nama_belakang' => 'Zon',
                'gelar_depan' => 'Dr.',
                'gelar_belakang' => 'S.S., M.Sc.',
                'jabatan' => 'Anggota',
                'status_pernikahan' => 'Menikah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_anggota' => 104,
                'nama_depan' => 'Sufmi',
                'nama_belakang' => 'Dasco',
                'gelar_depan' => 'Prof. Dr. Ir. H.',
                'gelar_belakang' => 'S.H., M.H.',
                'jabatan' => 'Wakil Ketua',
                'status_pernikahan' => 'Menikah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_anggota' => 105,
                'nama_depan' => 'Muhaimin',
                'nama_belakang' => 'Iskandar',
                'gelar_depan' => 'Dr (HC). Drs.',
                'gelar_belakang' => NULL,
                'jabatan' => 'Anggota',
                'status_pernikahan' => 'Menikah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_anggota' => 106,
                'nama_depan' => 'Herman',
                'nama_belakang' => 'Hery',
                'gelar_depan' => NULL,
                'gelar_belakang' => NULL,
                'jabatan' => 'Anggota',
                'status_pernikahan' => 'Belum Menikah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}



// (102, 'Lodewijk', 'Paulus', NULL, NULL, 'Wakil Ketua', 'Kawin'),
//   (103, 'Fadli', 'Zon', 'Dr.', 'S.S., M.Sc.', 'Anggota', 'Kawin'),
//   (104, 'Sufmi', 'Dasco', 'Prof. Dr. Ir. H.', 'S.H., M.H.', 'Wakil Ketua', 'Kawin'),
//   (105, 'Muhaimin', 'Iskandar', 'Dr (HC). Drs.', NULL, 'Anggota', 'Kawin'),
//   (106, 'Herman', 'Hery', NULL, NULL, 'Anggota', 'Belum Kawin');
