@extends('layouts.app')

@section('title', 'Kasir & Pembayaran - UEC MART')

@section('content')
<div class="max-w-4xl mx-auto py-6 px-4">
    <!-- Header Page -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-black text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-cash-register text-brand-blue"></i> Kasir & Pembayaran UEC MART
            </h1>
            <p class="text-xs text-gray-500 mt-1">Selesaikan pesanan Anda dengan aman dan cepat.</p>
        </div>
        <a href="{{ route('barang.index') }}" class="text-xs font-bold text-brand-blue hover:text-brand-navy flex items-center gap-1 bg-blue-50 px-3 py-2 rounded-lg border border-blue-100">
            <i class="fa-solid fa-arrow-left"></i> Kembali Belanja
        </a>
    </div>

    <form action="{{ route('transaksi.process') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Kolom Kiri: Detail Pembeli & Metode Pembayaran -->
            <div class="md:col-span-2 space-y-6">
                
                <!-- Data Pembeli -->
                <div class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm">
                    <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-user text-brand-blue"></i> Data Pemesan
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nama Lengkap</label>
                            <input type="text" name="nama_pembeli" required placeholder="Contoh: Syafiq Akmal" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-blue focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nomor WhatsApp</label>
                            <input type="tel" name="no_hp" placeholder="Contoh: 08123456789" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-blue focus:outline-none">
                        </div>
                    </div>
                </div>

                <!-- Pilihan Metode Pembayaran -->
                <div class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm">
                    <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-wallet text-brand-blue"></i> Pilih Metode Pembayaran
                    </h2>

                    <input type="hidden" name="metode_pembayaran" id="selected_metode" value="qris" required>

                    <!-- Option 1: QRIS Instant -->
                    <div class="mb-4">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Instan QRIS</span>
                        <label onclick="selectPayment('qris')" id="pay-qris" class="payment-option flex items-center justify-between p-3.5 border-2 border-brand-blue bg-blue-50/50 rounded-xl cursor-pointer transition">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center border shadow-sm">
                                    <i class="fa-solid fa-qrcode text-brand-blue text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm text-gray-800">QRIS All Payment</h4>
                                    <p class="text-[11px] text-gray-500">Scan via GoPay, OVO, ShopeePay, Dana, & MBanking</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-circle-check text-brand-blue text-lg payment-icon"></i>
                        </label>
                    </div>

                    <!-- Option 2: E-Wallet -->
                    <div class="mb-4">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">E-Wallet</span>
                        <div class="grid grid-cols-2 gap-3">
                            <label onclick="selectPayment('gopay')" id="pay-gopay" class="payment-option flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-brand-blue transition">
                                <span class="font-bold text-xs text-gray-700">GoPay</span>
                                <i class="fa-solid fa-circle text-gray-300 text-sm payment-icon"></i>
                            </label>
                            <label onclick="selectPayment('shopeepay')" id="pay-shopeepay" class="payment-option flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-brand-blue transition">
                                <span class="font-bold text-xs text-gray-700">ShopeePay</span>
                                <i class="fa-solid fa-circle text-gray-300 text-sm payment-icon"></i>
                            </label>
                            <label onclick="selectPayment('dana')" id="pay-dana" class="payment-option flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-brand-blue transition">
                                <span class="font-bold text-xs text-gray-700">DANA</span>
                                <i class="fa-solid fa-circle text-gray-300 text-sm payment-icon"></i>
                            </label>
                            <label onclick="selectPayment('ovo')" id="pay-ovo" class="payment-option flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-brand-blue transition">
                                <span class="font-bold text-xs text-gray-700">OVO</span>
                                <i class="fa-solid fa-circle text-gray-300 text-sm payment-icon"></i>
                            </label>
                        </div>
                    </div>

                    <!-- Option 3: Virtual Account / Transfer Bank -->
                    <div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Transfer Bank (VA)</span>
                        <div class="space-y-2">
                            <label onclick="selectPayment('bca')" id="pay-bca" class="payment-option flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-brand-blue transition">
                                <span class="font-bold text-xs text-gray-700">BCA Virtual Account</span>
                                <i class="fa-solid fa-circle text-gray-300 text-sm payment-icon"></i>
                            </label>
                            <label onclick="selectPayment('mandiri')" id="pay-mandiri" class="payment-option flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-brand-blue transition">
                                <span class="font-bold text-xs text-gray-700">Bank Mandiri Livin'</span>
                                <i class="fa-solid fa-circle text-gray-300 text-sm payment-icon"></i>
                            </label>
                            <label onclick="selectPayment('bri')" id="pay-bri" class="payment-option flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-brand-blue transition">
                                <span class="font-bold text-xs text-gray-700">BRI BRIMO</span>
                                <i class="fa-solid fa-circle text-gray-300 text-sm payment-icon"></i>
                            </label>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Kolom Kanan: Rincian Ringkasan Belanja -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm sticky top-6">
                    <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4 border-b pb-3 flex items-center justify-between">
                        <span>Ringkasan Belanja</span>
                        <span class="bg-brand-yellow text-brand-navy text-[10px] px-2 py-0.5 rounded-full font-bold">UEC Mart</span>
                    </h2>

                    <!-- Daftar Item Keranjang -->
                    <div id="checkoutItemsList" class="space-y-3 mb-4 max-h-48 overflow-y-auto"></div>

                    <div class="border-t border-dashed pt-3 space-y-2 text-xs">
                        <div class="flex justify-between text-gray-500">
                            <span>Subtotal Barang</span>
                            <span id="checkoutSubtotal">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-gray-500">
                            <span>Biaya Layanan Kasir</span>
                            <span class="text-green-600 font-bold">GRATIS</span>
                        </div>
                        <div class="flex justify-between text-sm font-black text-gray-800 border-t pt-3">
                            <span>Total Bayar</span>
                            <span id="checkoutTotal" class="text-brand-red text-base">Rp 0</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full mt-6 bg-brand-blue hover:bg-brand-navy text-white font-extrabold py-3 px-4 rounded-xl shadow-lg transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-lock"></i>
                        <span>Bayar Sekarang</span>
                    </button>
                    
                    <p class="text-[10px] text-gray-400 text-center mt-3">
                        <i class="fa-solid fa-shield-halved text-green-500 mr-1"></i> Transaksi Enkripsi Aman 256-bit
                    </p>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let cart = JSON.parse(localStorage.getItem('uec_cart')) || [];
        let listContainer = document.getElementById('checkoutItemsList');
        let subtotalEl = document.getElementById('checkoutSubtotal');
        let totalEl = document.getElementById('checkoutTotal');

        if (cart.length === 0) {
            listContainer.innerHTML = `<p class="text-xs text-gray-400 text-center py-2">Keranjang belanja kosong.</p>`;
            return;
        }

        let totalPrice = cart.reduce((sum, item) => sum + (item.harga * item.qty), 0);

        listContainer.innerHTML = cart.map(item => `
            <div class="flex items-center justify-between text-xs border-b pb-2">
                <div>
                    <p class="text-gray-800 font-bold">${item.nama_barang}</p>
                    <p class="text-gray-400 text-[10px]">${item.qty} x Rp ${Number(item.harga).toLocaleString('id-ID')}</p>
                </div>
                <span class="font-bold text-gray-800">Rp ${Number(item.harga * item.qty).toLocaleString('id-ID')}</span>
            </div>
        `).join('');

        let formattedTotal = 'Rp ' + totalPrice.toLocaleString('id-ID');
        subtotalEl.innerText = formattedTotal;
        totalEl.innerText = formattedTotal;
    });

    function selectPayment(id) {
        document.getElementById('selected_metode').value = id;
        
        document.querySelectorAll('.payment-option').forEach(el => {
            el.classList.remove('border-brand-blue', 'bg-blue-50/50', 'border-2');
            el.classList.add('border-gray-200');
            const icon = el.querySelector('.payment-icon');
            if(icon) {
                icon.className = 'fa-solid fa-circle text-gray-300 text-sm payment-icon';
            }
        });

        const active = document.getElementById('pay-' + id);
        if(active) {
            active.classList.remove('border-gray-200');
            active.classList.add('border-brand-blue', 'bg-blue-50/50', 'border-2');
            const icon = active.querySelector('.payment-icon');
            if(icon) {
                icon.className = 'fa-solid fa-circle-check text-brand-blue text-lg payment-icon';
            }
        }
    }
</script>
@endsection