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
        Route::get('/admin/home', 'index_home');
        Route::get('/admin/anggota', 'index_anggota');
        Route::get('/admin/anggota/tambah', 'index_tambah_anggota');
        Route::post('/admin/anggota/tambah', 'action_tambah_anggota');
        Route::get('/admin/anggota/edit/{slug}', 'index_edit_anggota');
        Route::post('/admin/anggota/edit', 'action_edit_anggota');
        Route::post('/admin/anggota/delete', 'action_delete_anggota');

        Route::get('/admin/komponen', 'index_komponen');
        Route::get('/admin/komponen/tambah', 'index_tambah_komponen');
        Route::post('/admin/komponen/tambah', 'action_tambah_komponen');
    });
});

Route::middleware(['auth', 'role:Public'])->group(function () {
    Route::controller(CitizenController::class)->group(function () {
        Route::get('/citizen/home', 'index_home');
    });
});

Route::middleware('auth')->post('/logout', [AuthController::class, 'action_logout']);
