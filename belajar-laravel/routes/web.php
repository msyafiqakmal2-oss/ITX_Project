<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

// Redirect halaman utama ke daftar barang
Route::get('/', function () {
    return redirect()->route('barang.index');
});

// Menyiapkan seluruh route resource untuk Barang (index, store, update, destroy, dll)
Route::resource('barang', BarangController::class);