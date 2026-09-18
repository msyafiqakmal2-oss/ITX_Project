<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    // Kolom-kolom ini wajib didaftarkan agar bisa disimpan ke database
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori',
        'harga',
        'stok',
    ];
}