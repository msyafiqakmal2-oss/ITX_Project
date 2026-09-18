<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // 1. Menampilkan daftar barang
    public function index(Request $request)
    {
        $query = Barang::query();

        // Fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        $barangs = $query->latest()->get();
        $totalStok = Barang::sum('stok');

        return view('barang.index', compact('barangs', 'totalStok'));
    }

    // 2. Menyimpan barang baru
    public function store(Request $request)
{
    // 1. Validasi data input dari form modal
    $validated = $request->validate([
        'kode_barang' => 'nullable|string|max:50|unique:barang,kode_barang',
        'nama_barang' => 'required|string|max:255',
        'kategori'    => 'required|string|max:100',
        'harga'       => 'required|numeric|min:0',
        'stok'        => 'required|integer|min:0',
    ]);

    // 2. Jika kode_barang tidak diisi di form, sistem akan membuatkan kode otomatis
    if (empty($validated['kode_barang'])) {
        $validated['kode_barang'] = 'BRG-' . time();
    }

    // 3. Simpan data yang sudah valid dan lengkap ke database
    Barang::create($validated);

    return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
}
    // 3. Mengubah data barang
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui!');
    }

    // 4. Menghapus barang
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
    
}
