<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

// Redirect halaman utama ke daftar barang
Route::get('/', function () {
    return redirect()->route('barang.index');
});

// Halaman Tentang UEC MART
Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

// ======================== ROUTE AUTHENTICATION ========================

// 1. HALAMAN & PROSES LOGIN
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
        return redirect()->intended('/')->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
    }

    return back()->withErrors([
        'email' => 'Email atau password yang Anda masukkan salah.',
    ]);
});

// 2. HALAMAN & PROSES REGISTER MAHASISWA
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'nim' => 'required|string|unique:users,nim',
        'fakultas' => 'required|string',
        'prodi' => 'required|string',
        'email' => 'required|string|email|max:255|unique:users,email',
        'no_hp' => 'required|string|max:15',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'nim' => $request->nim,
        'fakultas' => $request->fakultas,
        'prodi' => $request->prodi,
        'email' => $request->email,
        'no_hp' => $request->no_hp,
        'password' => Hash::make($request->password),
    ]);

    // Otomatis Login Setelah Berhasil Daftar
    Auth::login($user);

    return redirect()->route('barang.index')->with('success', 'Pendaftaran berhasil! Selamat datang di Klik UEC MART, ' . $user->name);
});

// 3. PROSES LOGOUT
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'Berhasil keluar dari akun!');
})->name('logout');

// ======================== ROUTE APLIKASI ========================
Route::resource('barang', BarangController::class);
Route::get('/checkout', [TransaksiController::class, 'index'])->name('transaksi.checkout');
Route::post('/checkout/proses', [TransaksiController::class, 'process'])->name('transaksi.process');