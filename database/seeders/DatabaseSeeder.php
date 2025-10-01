<?php

namespace Database\Seeders;

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
    }
}
