<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;

// Redirect halaman utama ke daftar barang
Route::get('/', function () {
    return redirect()->route('barang.index');
});
Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');
// Menyiapkan seluruh route resource untuk Barang (index, store, update, destroy, dll)
Route::resource('barang', BarangController::class);
Route::get('/checkout', [TransaksiController::class, 'index'])->name('transaksi.checkout');
Route::post('/checkout/proses', [TransaksiController::class, 'process'])->name('transaksi.process');