<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;

Route::get('/', function () {
    return view('welcome');
});

// Tambahkan ini untuk CRUD lengkap mahasiswa
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('matakuliah', MataKuliahController::class);