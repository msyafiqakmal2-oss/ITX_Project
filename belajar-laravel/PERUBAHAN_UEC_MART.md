# Perubahan: Data Mahasiswa → UEC MART

Ringkasan semua yang diubah dari project CRUD Mahasiswa menjadi UEC MART
(katalog barang ala minimarket).

## 1. Database
- `database/migrations/..._create_barang_table.php`
  Tabel `mahasiswa` (nama, nim, jurusan) → tabel `barang`:
  `kode_barang` (unik), `nama_barang`, `kategori`, `harga`, `stok`.
- `database/seeders/DatabaseSeeder.php`
  Ditambahkan 10 contoh barang (Indomie, Aqua, beras, dst).

## 2. Model
- `app/Models/Mahasiswa.php` → `app/Models/Barang.php`
  `$table = 'barang'`, `$fillable` sesuai kolom baru.

## 3. Controller
- `app/Http/Controllers/MahasiswaController.php` →
  `app/Http/Controllers/BarangController.php`
  Validasi disesuaikan: `kode_barang` unik, `harga` & `stok` numerik.

## 4. Routes (`routes/web.php`)
- `/mahasiswa*` → `/barang*`.
- `/` sekarang redirect otomatis ke `/barang`.

## 5. Views (`resources/views/barang/`)
- `index.blade.php` — daftar barang: kode, nama, kategori, harga
  (format Rupiah), stok (badge kuning kalau stok ≤ 5), aksi edit/hapus.
- `create.blade.php` — form tambah barang (5 field).
- `edit.blade.php` — dirapikan total (sebelumnya HTML polos tanpa style)
  agar senada dengan halaman lain.
- `_form-style.blade.php` & `_form-script.blade.php` — style/script form
  dipisah jadi partial supaya tidak duplikat antara create & edit.
- `layouts/app.blade.php` — rebranding: logo "UEC MART", navbar,
  teks preloader, dan warna aksen biru (#2563eb) → merah (#dc2626)
  ala minimarket.

## 6. Lain-lain
- `APP_NAME` di `.env` dan `.env.example` → `"UEC MART"`.
- Cache view lama (`storage/framework/views/*.php`) dibersihkan.

## Yang perlu kamu jalankan setelah extract

```bash
composer install        # kalau folder vendor belum ada / tidak lengkap
cp .env.example .env     # kalau belum ada .env (skip kalau sudah ada)
php artisan key:generate
php artisan migrate:fresh --seed   # PENTING: reset tabel lama (mahasiswa) jadi barang + isi data contoh
php artisan serve
```

Lalu buka `http://127.0.0.1:8000` → otomatis diarahkan ke `/barang`.

## Ide pengembangan lanjutan (opsional, belum dibuatkan)
- Upload gambar produk.
- Fitur pencarian & filter kategori di halaman index.
- Kasir sederhana (keranjang belanja + total transaksi).
- Role admin/kasir dengan Laravel Auth.
