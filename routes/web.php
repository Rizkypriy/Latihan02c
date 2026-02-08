<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return view('welcome');
});

// Tambahkan ini untuk CRUD lengkap mahasiswa
Route::resource('mahasiswa', MahasiswaController::class);