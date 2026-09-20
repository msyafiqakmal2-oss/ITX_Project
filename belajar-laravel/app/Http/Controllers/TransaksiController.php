<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        // Simulasi item keranjang dari parameter/session
        // Anda bisa kembangkan dengan session keranjang belanja
        $barangs = Barang::all();
        return view('transaksi.checkout', compact('barangs'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required',
            'nama_pembeli' => 'required|string|max:255',
        ]);

        // Simpan transaksi di sini jika sudah ada tabel transaksi
        
        return redirect()->route('barang.index')->with('success', 'Transaksi berhasil diproses! Terima kasih sudah berbelanja di UEC MART.');
    }
}