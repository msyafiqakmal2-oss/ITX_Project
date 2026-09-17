<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $barangs = [
            ['kode_barang' => 'UEC-0001', 'nama_barang' => 'Indomie Goreng',        'kategori' => 'Makanan Instan',    'harga' => 3500,  'stok' => 120],
            ['kode_barang' => 'UEC-0002', 'nama_barang' => 'Aqua Botol 600ml',      'kategori' => 'Minuman',           'harga' => 4000,  'stok' => 80],
            ['kode_barang' => 'UEC-0003', 'nama_barang' => 'Teh Botol Sosro',       'kategori' => 'Minuman',           'harga' => 5000,  'stok' => 60],
            ['kode_barang' => 'UEC-0004', 'nama_barang' => 'Beras Premium 5kg',     'kategori' => 'Sembako',           'harga' => 65000, 'stok' => 25],
            ['kode_barang' => 'UEC-0005', 'nama_barang' => 'Minyak Goreng 1L',      'kategori' => 'Sembako',           'harga' => 18000, 'stok' => 40],
            ['kode_barang' => 'UEC-0006', 'nama_barang' => 'Sabun Mandi Lifebuoy',  'kategori' => 'Perawatan Tubuh',   'harga' => 4500,  'stok' => 90],
            ['kode_barang' => 'UEC-0007', 'nama_barang' => 'Pasta Gigi Pepsodent',  'kategori' => 'Perawatan Tubuh',   'harga' => 9500,  'stok' => 55],
            ['kode_barang' => 'UEC-0008', 'nama_barang' => 'Kopi Kapal Api Sachet', 'kategori' => 'Minuman',           'harga' => 1500,  'stok' => 200],
            ['kode_barang' => 'UEC-0009', 'nama_barang' => 'Tisu Paseo',            'kategori' => 'Kebutuhan Rumah',   'harga' => 8000,  'stok' => 35],
            ['kode_barang' => 'UEC-0010', 'nama_barang' => 'Gula Pasir 1kg',        'kategori' => 'Sembako',           'harga' => 16000, 'stok' => 4],
        ];

        foreach ($barangs as $barang) {
            Barang::create($barang);
        }
    }
}
