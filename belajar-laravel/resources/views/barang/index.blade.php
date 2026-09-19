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
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-20">
    @forelse($barangs as $item)
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition flex flex-col justify-between overflow-hidden relative group">
            
            <!-- Admin Actions (Akses Cepat Edit & Hapus untuk Admin) -->
            <div class="absolute top-2 right-2 z-10 flex flex-col space-y-1 opacity-0 group-hover:opacity-100 transition">
                <button onclick="editBarang({{ json_encode($item) }})" class="w-7 h-7 bg-white/90 hover:bg-brand-blue hover:text-white text-gray-600 rounded-full flex items-center justify-center shadow text-xs transition" title="Edit Master Data">
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

            <!-- Card Bottom Button: MASUKKAN KERANJANG -->
            <div class="p-3 pt-0">
                <button onclick="addToCart({{ json_encode($item) }})" class="w-full bg-brand-blue hover:bg-brand-navy text-white font-bold py-2 px-2 rounded-lg text-xs flex items-center justify-center space-x-1.5 shadow-sm transition active:scale-95">
                    <i class="fa-solid fa-cart-plus text-sm"></i>
                    <span>+ Keranjang</span>
                </button>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white rounded-xl p-8 text-center border border-dashed border-gray-300">
            <i class="fa-solid fa-box-open text-4xl text-gray-300 mb-2"></i>
            <p class="text-gray-500 font-medium">Belum ada barang terdaftar pada kategori ini.</p>
        </div>
    @endforelse
</div>

<!-- FLOATING CART BAR (Bar Keranjang Melayang di Bawah) -->
<div id="cartBar" class="fixed bottom-4 left-1/2 -translate-x-1/2 w-[92%] max-w-4xl bg-brand-navy text-white rounded-2xl shadow-2xl p-4 flex items-center justify-between z-40 transition-all duration-300 transform translate-y-28 opacity-0">
    <div class="flex items-center space-x-4">
        <div class="relative bg-brand-yellow text-brand-navy p-3 rounded-xl">
            <i class="fa-solid fa-basket-shopping text-xl"></i>
            <span id="cartCountBadge" class="absolute -top-2 -right-2 bg-brand-red text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center border-2 border-brand-navy">0</span>
        </div>
        <div>
            <p class="text-xs text-blue-200 font-medium">Total Ringkasan Belanja:</p>
            <p id="cartTotalPrice" class="text-lg font-black text-brand-yellow">Rp 0</p>
        </div>
    </div>

    <div class="flex items-center space-x-3">
        <button onclick="openCartModal()" class="bg-white/10 hover:bg-white/20 text-white px-3 py-2 rounded-xl text-xs font-bold transition flex items-center space-x-1">
            <i class="fa-solid fa-list-check"></i>
            <span class="hidden sm:inline">Rincian</span>
        </button>
        <button onclick="checkout()" class="bg-brand-yellow hover:bg-yellow-400 text-brand-navy font-extrabold px-5 py-2.5 rounded-xl text-xs sm:text-sm shadow-md transition flex items-center space-x-2">
            <span>Bayar Sekarang</span>
            <i class="fa-solid fa-arrow-right"></i>
        </button>
    </div>
</div>

<!-- MODAL RINCIAN KERANJANG & PEMBAYARAN -->
<div id="cartModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl flex flex-col max-h-[85vh]">
        <div class="bg-brand-navy text-white px-6 py-4 flex items-center justify-between">
            <h3 class="font-bold text-base flex items-center">
                <i class="fa-solid fa-cart-shopping mr-2 text-brand-yellow"></i> Keranjang Belanja Anda
            </h3>
            <button onclick="closeModal('cartModal')" class="text-white/80 hover:text-white text-xl">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div id="cartItemsList" class="p-6 overflow-y-auto space-y-3 flex-1">
            <!-- Item keranjang diisi otomatis oleh JavaScript -->
        </div>

        <div class="p-6 bg-gray-50 border-t space-y-3">
            <div class="flex justify-between text-sm font-bold text-gray-700">
                <span>Total Item</span>
                <span id="modalTotalItems">0 Pcs</span>
            </div>
            <div class="flex justify-between text-base font-extrabold text-gray-900 border-t pt-2">
                <span>Total Pembayaran</span>
                <span id="modalTotalPrice" class="text-brand-red">Rp 0</span>
            </div>
            <button onclick="checkout()" class="w-full bg-brand-blue hover:bg-brand-navy text-white font-bold py-3 rounded-xl text-sm shadow-lg transition flex items-center justify-center space-x-2">
                <i class="fa-solid fa-credit-card"></i>
                <span>Lanjut ke Kasir / Pembayaran</span>
            </button>
        </div>
    </div>
</div>

<!-- Modal Edit Barang Master (Akses Admin) -->
<div id="editModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full overflow-hidden shadow-2xl transform transition-all">
        <div class="bg-brand-navy text-white px-6 py-4 flex items-center justify-between">
            <h3 class="font-bold text-base flex items-center">
                <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Data Barang (Master)
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
    let cart = JSON.parse(localStorage.getItem('uec_cart')) || [];

    document.addEventListener('DOMContentLoaded', updateCartUI);

    function addToCart(item) {
        let existing = cart.find(i => i.id === item.id);
        if (existing) {
            if (existing.qty < item.stok) {
                existing.qty += 1;
            } else {
                alert('Stok barang tidak mencukupi!');
                return;
            }
        } else {
            cart.push({
                id: item.id,
                nama_barang: item.nama_barang,
                harga: item.harga,
                gambar: item.gambar,
                qty: 1,
                stok: item.stok
            });
        }
        saveCart();
    }

    function updateQty(id, delta) {
        let item = cart.find(i => i.id === id);
        if (item) {
            item.qty += delta;
            if (item.qty <= 0) {
                cart = cart.filter(i => i.id !== id);
            } else if (item.qty > item.stok) {
                item.qty = item.stok;
                alert('Mencapai batas stok yang tersedia!');
            }
        }
        saveCart();
    }

    function saveCart() {
        localStorage.setItem('uec_cart', JSON.stringify(cart));
        updateCartUI();
    }

    function updateCartUI() {
        let totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
        let totalPrice = cart.reduce((sum, item) => sum + (item.harga * item.qty), 0);

        document.getElementById('cartCountBadge').innerText = totalItems;
        document.getElementById('cartTotalPrice').innerText = 'Rp ' + totalPrice.toLocaleString('id-ID');

        let cartBar = document.getElementById('cartBar');
        if (totalItems > 0) {
            cartBar.classList.remove('translate-y-28', 'opacity-0');
            cartBar.classList.add('translate-y-0', 'opacity-100');
        } else {
            cartBar.classList.remove('translate-y-0', 'opacity-100');
            cartBar.classList.add('translate-y-28', 'opacity-0');
        }

        renderCartModalItems(totalItems, totalPrice);
    }

    function renderCartModalItems(totalItems, totalPrice) {
        let container = document.getElementById('cartItemsList');
        document.getElementById('modalTotalItems').innerText = totalItems + ' Pcs';
        document.getElementById('modalTotalPrice').innerText = 'Rp ' + totalPrice.toLocaleString('id-ID');

        if (cart.length === 0) {
            container.innerHTML = `
                <div class="text-center py-8 text-gray-400">
                    <i class="fa-solid fa-basket-shopping text-4xl mb-2"></i>
                    <p class="text-xs">Keranjang Anda masih kosong</p>
                </div>`;
            return;
        }

        container.innerHTML = cart.map(item => `
            <div class="flex items-center justify-between border-b pb-3">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden border">
                        ${item.gambar ? `<img src="/storage/${item.gambar}" class="w-full h-full object-cover">` : `<i class="fa-solid fa-box text-gray-400"></i>`}
                    </div>
                    <div>
                        <h4 class="font-bold text-xs text-gray-800">${item.nama_barang}</h4>
                        <p class="text-xs text-brand-red font-semibold">Rp ${Number(item.harga).toLocaleString('id-ID')}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2 bg-gray-100 rounded-lg p-1">
                    <button onclick="updateQty(${item.id}, -1)" class="w-6 h-6 bg-white rounded flex items-center justify-center font-bold text-gray-600 hover:bg-gray-200 text-xs">-</button>
                    <span class="text-xs font-bold px-1">${item.qty}</span>
                    <button onclick="updateQty(${item.id}, 1)" class="w-6 h-6 bg-white rounded flex items-center justify-center font-bold text-gray-600 hover:bg-gray-200 text-xs">+</button>
                </div>
            </div>
        `).join('');
    }

    function openCartModal() {
        document.getElementById('cartModal').classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function checkout() {
        if(cart.length === 0) return alert('Keranjang belanja kosong!');
        alert('Fitur Pembayaran Kasir UEC MART siap dilanjutkan!');
    }

    function editBarang(item) {
        document.getElementById('edit_nama_barang').value = item.nama_barang;
        document.getElementById('edit_kategori').value = item.kategori ?? '';
        document.getElementById('edit_harga').value = item.harga;
        document.getElementById('edit_stok').value = item.stok;
        document.getElementById('editForm').action = `/barang/${item.id}`;
        document.getElementById('editModal').classList.remove('hidden');
    }
</script>
@endpush