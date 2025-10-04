<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitizenController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/', 'index_login')->name('login');
        Route::post('/login', 'action_login');
    });
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        // anggota
        Route::get('/admin/home', 'index_home');
        Route::get('/admin/anggota', 'index_anggota');
        Route::get('/admin/anggota/tambah', 'index_tambah_anggota');
        Route::post('/admin/anggota/tambah', 'action_tambah_anggota');
        Route::get('/admin/anggota/edit/{slug}', 'index_edit_anggota');
        Route::post('/admin/anggota/edit', 'action_edit_anggota');
        Route::post('/admin/anggota/delete', 'action_delete_anggota');
        Route::get('/admin/anggota/cari', 'action_cari_anggota');

        // komponen gaji
        Route::get('/admin/komponen', 'index_komponen');
        Route::get('/admin/komponen/tambah', 'index_tambah_komponen');
        Route::post('/admin/komponen/tambah', 'action_tambah_komponen');
        Route::get('/admin/komponen/edit/{slug}', 'index_edit_komponen');
        Route::post('/admin/komponen/edit', 'action_edit_komponen');
        Route::post('/admin/komponen/delete', 'action_delete_komponen');
        Route::get('/admin/komponen/cari', 'action_cari_komponen');


        // penggajian
        Route::get('/admin/penggajian', 'index_gaji');
        Route::get('/admin/penggajian/tambah', 'index_tambah_gaji');
        Route::post('/admin/penggajian/tambah', 'action_tambah_gaji');
        Route::get('/admin/penggajian/edit/{slug}', 'index_ubah_gaji');
        Route::post('/admin/penggajian/edit', 'action_ubah_gaji');
        Route::post('/admin/penggajian/delete', 'action_delete_penggajian');
        Route::get('/admin/penggajian/detail/{slug}', 'index_detail_penggajian');
        Route::get('/admin/penggajian/cari', 'action_cari_penggajian');

    });
});

Route::middleware(['auth', 'role:Public'])->group(function () {
    Route::controller(CitizenController::class)->group(function () {
        Route::get('/citizen/home', 'index_home');
        Route::get('/citizen/anggota', 'index_anggota');
        Route::get('/citizen/anggota/cari', 'action_cari_anggota');
        Route::get('/citizen/penggajian', 'index_penggajian');
        Route::get('/citizen/penggajian/cari', 'action_cari_penggajian');
        Route::get('/citizen/penggajian/detail/{slug}', 'index_detail_penggajian');
    });
});

Route::middleware('auth')->post('/logout', [AuthController::class, 'action_logout']);
