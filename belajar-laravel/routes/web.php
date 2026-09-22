<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Redirect halaman utama ke daftar barang
Route::get('/', function () {
    return redirect()->route('barang.index');
});

// Halaman Tentang UEC MART
Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

// Route Auth (Login & Logout)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/')->with('success', 'Berhasil login!');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'Berhasil keluar!');
})->name('logout');

// Route Aplikasi Utama
Route::resource('barang', BarangController::class);
Route::get('/checkout', [TransaksiController::class, 'index'])->name('transaksi.checkout');
Route::post('/checkout/proses', [TransaksiController::class, 'process'])->name('transaksi.process');