@extends('layouts.app')

@section('title', 'Katalog Barang - Klik UEC MART')

@section('content')

<!-- Promo Banner Carousel Placeholder -->
<div class="bg-gradient-to-r from-brand-blue to-brand-navy rounded-2xl p-6 text-white mb-8 shadow-md relative overflow-hidden">
    <div class="relative z-10 max-w-xl">
        <span class="bg-brand-yellow text-brand-navy font-bold text-xs px-3 py-1 rounded-full uppercase tracking-wide">Promo Hemat UEC</span>
        <h1 class="text-2xl sm:text-3xl font-extrabold mt-2 mb-1">Belanja Kebutuhan Harian Murah & Lengkap</h1>
        <p class="text-sm text-blue-100 mb-4">Dapatkan penawaran harga terbaik untuk stok barang pokok harian Anda.</p>
        <button onclick="openModal('createModal')" class="bg-brand-yellow text-brand-navy hover:bg-yellow-400 font-bold px-4 py-2 rounded-lg text-sm shadow transition">
            + Tambah Stok Barang
        </button>
    </div>
    <div class="absolute -right-6 -bottom-10 opacity-10 text-white text-[160px] font-black pointer-events-none">
        UEC
    </div>
</div>

<!-- Tab Navigasi Kategori -->
<div class="mb-6 overflow-x-auto pb-2">
    <div class="flex items-center space-x-2 min-w-max">
        @php
            $currentKategori = request('kategori');$categories = [
                'Semua' => ['icon' => 'fa-boxes-stacked', 'val' => ''],
                'Makanan' => ['icon' => 'fa-bowl-food', 'val' => 'Makanan'],
                'Minuman' => ['icon' => 'fa-wine-glass', 'val' => 'Minuman'],
                'Perlengkapan' => ['icon' => 'fa-pump-soap', 'val' => 'Perlengkapan'],
                'Alat Tulis' => ['icon' => 'fa-pen-ruler', 'val' => 'Alat Tulis'],
                'Kebutuhan' => ['icon' => 'fa-basket-shopping', 'val' => 'Kebutuhan'],
            ];
        @endphp

        @foreach($categories as $label =>$cat)
            @php $isActive = $currentKategori ==$cat['val']; @endphp
            <a href="{{ route('barang.index', array_merge(request()->query(), ['kategori' => $cat['val']])) }}" 
               class="flex items-center space-x-2 px-4 py-2 rounded-xl text-xs font-bold transition shadow-sm border {{ $isActive ? 'bg-brand-blue text-white border-brand-blue shadow-blue-200' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                <i class="fa-solid {{ $cat['icon'] }}"></i>
                <span>{{ $label }}</span>
            </a>
        @endforeach
    </div>
</div>

<!-- Category Headers Info -->
<div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-bold text-gray-800 flex items-center">
        <i class="fa-solid fa-fire text-brand-red mr-2"></i> 
        {{ request('kategori') ? 'Kategori: ' . request('kategori') : 'Daftar Produk Tersedia' }}
    </h2>
    <span class="text-xs text-gray-500 font-medium">Menampilkan {{ $barangs->count() }} barang</span>
</div>

<!-- Product Grid -->
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
    @forelse($barangs as $item)
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition flex flex-col justify-between overflow-hidden relative group">
            
            <!-- Floating Action Buttons -->
            <div class="absolute top-2 right-2 z-10 flex flex-col space-y-1 opacity-0 group-hover:opacity-100 transition">
                <button onclick="editBarang({{ json_encode($item) }})" class="w-7 h-7 bg-white/90 hover:bg-brand-blue hover:text-white text-gray-600 rounded-full flex items-center justify-center shadow text-xs transition" title="Edit Barang">
                    <i class="fa-solid fa-pen"></i>
                </button>
                
                <form action="{{ route('barang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-7 h-7 bg-white/90 hover:bg-brand-red hover:text-white text-gray-600 rounded-full flex items-center justify-center shadow text-xs transition" title="Hapus Barang">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>

            <div>
                <!-- Product Image Header -->
                <div class="h-36 bg-gray-50 flex items-center justify-center p-2 relative border-b border-gray-100 overflow-hidden">
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_barang }}" class="w-full h-full object-cover">
                    @else
                        <i class="fa-solid fa-box text-5xl text-gray-300"></i>
                    @endif

                    <!-- Strip Label Kuning -->
                    <div class="absolute bottom-0 left-0 right-0 bg-brand-yellow text-brand-navy text-[10px] font-bold px-2 py-0.5 text-center truncate z-10">
                        Stok: {{ $item->stok }} Pcs
                    </div>
                </div>

                <!-- Product Content -->
                <div class="p-3">
                    <span class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider block mb-1">
                        Kategori: {{ $item->kategori ?? 'Umum' }}
                    </span>
                    <h3 class="font-bold text-gray-800 text-xs sm:text-sm line-clamp-2 min-h-[32px]" title="{{ $item->nama_barang }}">
                        {{ $item->nama_barang }}
                    </h3>

                    <!-- Price -->
                    <div class="mt-2">
                        <span class="text-xs text-gray-400 block text-[10px]">Harga UEC</span>
                        <span class="text-brand-red font-extrabold text-sm sm:text-base">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Card Bottom Button -->
            <div class="p-3 pt-0">
                <button onclick="editBarang({{ json_encode($item) }})" class="w-full bg-brand-blue hover:bg-brand-navy text-white font-bold py-1.5 px-2 rounded-lg text-xs flex items-center justify-center space-x-1 shadow-sm transition">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>Edit Data</span>
                </button>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white rounded-xl p-8 text-center border border-dashed border-gray-300">
            <i class="fa-solid fa-box-open text-4xl text-gray-300 mb-2"></i>
            <p class="text-gray-500 font-medium">Belum ada barang terdaftar pada kategori ini.</p>
            <button onclick="openModal('createModal')" class="mt-3 bg-brand-blue text-white text-xs px-4 py-2 rounded-lg hover:bg-brand-navy">
                + Tambah Barang Pertama
            </button>
        </div>
    @endforelse
</div>


<!-- Modal Create Barang -->
<div id="createModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full overflow-hidden shadow-2xl transform transition-all">
        <div class="bg-brand-blue text-white px-6 py-4 flex items-center justify-between">
            <h3 class="font-bold text-base flex items-center">
                <i class="fa-solid fa-circle-plus mr-2"></i> Tambah Barang Baru
            </h3>
            <button onclick="closeModal('createModal')" class="text-white/80 hover:text-white text-xl">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        
        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nama Barang</label>
                <input type="text" name="nama_barang" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-blue focus:outline-none" placeholder="Contoh: Indomie Goreng 85g">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Kategori</label>
                <select name="kategori" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-blue focus:outline-none">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                    <option value="Perlengkapan">Perlengkapan</option>
                    <option value="Alat Tulis">Alat Tulis</option>
                    <option value="Kebutuhan">Kebutuhan</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Harga (Rp)</label>
                    <input type="number" name="harga" required min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-blue focus:outline-none" placeholder="3500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Stok Pcs</label>
                    <input type="number" name="stok" required min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-blue focus:outline-none" placeholder="10">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Foto Produk</label>
                <input type="file" name="gambar" accept="image/*" class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-blue focus:outline-none file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-brand-blue file:text-white hover:file:bg-brand-navy">
            </div>

            <div class="flex items-center justify-end space-x-2 pt-4 border-t">
                <button type="button" onclick="closeModal('createModal')" class="px-4 py-2 border text-gray-600 rounded-lg text-xs font-bold hover:bg-gray-100">Batal</button>
                <button type="submit" class="px-4 py-2 bg-brand-blue text-white rounded-lg text-xs font-bold hover:bg-brand-navy shadow">Simpan Barang</button>
            </div>
        </form>
    </div>
</div>


<!-- Modal Edit Barang -->
<div id="editModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full overflow-hidden shadow-2xl transform transition-all">
        <div class="bg-brand-navy text-white px-6 py-4 flex items-center justify-between">
            <h3 class="font-bold text-base flex items-center">
                <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Data Barang
            </h3>
            <button onclick="closeModal('editModal')" class="text-white/80 hover:text-white text-xl">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        
        <form id="editForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nama Barang</label>
                <input type="text" id="edit_nama_barang" name="nama_barang" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-blue focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Kategori</label>
                <select id="edit_kategori" name="kategori" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-blue focus:outline-none">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                    <option value="Perlengkapan">Perlengkapan</option>
                    <option value="Alat Tulis">Alat Tulis</option>
                    <option value="Kebutuhan">Kebutuhan</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Harga (Rp)</label>
                    <input type="number" id="edit_harga" name="harga" required min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-blue focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Stok Pcs</label>
                    <input type="number" id="edit_stok" name="stok" required min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-blue focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Ubah Foto Produk (Opsional)</label>
                <input type="file" name="gambar" accept="image/*" class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-blue focus:outline-none file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-brand-blue file:text-white hover:file:bg-brand-navy">
            </div>

            <div class="flex items-center justify-end space-x-2 pt-4 border-t">
                <button type="button" onclick="closeModal('editModal')" class="px-4 py-2 border text-gray-600 rounded-lg text-xs font-bold hover:bg-gray-100">Batal</button>
                <button type="submit" class="px-4 py-2 bg-brand-yellow text-brand-navy rounded-lg text-xs font-bold hover:bg-yellow-400 shadow">Update Barang</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function editBarang(item) {
        document.getElementById('edit_nama_barang').value = item.nama_barang;
        document.getElementById('edit_kategori').value = item.kategori ?? '';
        document.getElementById('edit_harga').value = item.harga;
        document.getElementById('edit_stok').value = item.stok;
        
        // Update URL form action
        document.getElementById('editForm').action = `/barang/${item.id}`;
        
        openModal('editModal');
    }
</script>
@endpush