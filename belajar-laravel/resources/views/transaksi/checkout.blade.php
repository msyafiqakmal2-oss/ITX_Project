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

    <form id="checkoutForm" onsubmit="handleCheckout(event)">
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
                            <input type="text" id="nama_pembeli" required placeholder="Contoh: Syafiq Akmal" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-blue focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nomor WhatsApp</label>
                            <input type="tel" id="no_hp" required placeholder="Contoh: 08123456789" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-blue focus:outline-none">
                        </div>
                    </div>
                </div>

                <!-- Pilihan Metode Pembayaran -->
                <div class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm">
                    <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-wallet text-brand-blue"></i> Pilih Metode Pembayaran
                    </h2>

                    <input type="hidden" id="selected_metode" value="qris">

                    <!-- Option 1: QRIS Instant -->
                    <div class="mb-4">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Instan QRIS</span>
                        <label onclick="selectPayment('qris', 'QRIS All Payment')" id="pay-qris" class="payment-option flex items-center justify-between p-3.5 border-2 border-brand-blue bg-blue-50/50 rounded-xl cursor-pointer transition">
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
                            <label onclick="selectPayment('gopay', 'GoPay')" id="pay-gopay" class="payment-option flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-brand-blue transition">
                                <span class="font-bold text-xs text-gray-700">GoPay</span>
                                <i class="fa-solid fa-circle text-gray-300 text-sm payment-icon"></i>
                            </label>
                            <label onclick="selectPayment('shopeepay', 'ShopeePay')" id="pay-shopeepay" class="payment-option flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-brand-blue transition">
                                <span class="font-bold text-xs text-gray-700">ShopeePay</span>
                                <i class="fa-solid fa-circle text-gray-300 text-sm payment-icon"></i>
                            </label>
                            <label onclick="selectPayment('dana', 'DANA')" id="pay-dana" class="payment-option flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-brand-blue transition">
                                <span class="font-bold text-xs text-gray-700">DANA</span>
                                <i class="fa-solid fa-circle text-gray-300 text-sm payment-icon"></i>
                            </label>
                            <label onclick="selectPayment('ovo', 'OVO')" id="pay-ovo" class="payment-option flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-brand-blue transition">
                                <span class="font-bold text-xs text-gray-700">OVO</span>
                                <i class="fa-solid fa-circle text-gray-300 text-sm payment-icon"></i>
                            </label>
                        </div>
                    </div>

                    <!-- Option 3: Virtual Account / Transfer Bank -->
                    <div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Transfer Bank (VA)</span>
                        <div class="space-y-2">
                            <label onclick="selectPayment('bca', 'BCA Virtual Account')" id="pay-bca" class="payment-option flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-brand-blue transition">
                                <span class="font-bold text-xs text-gray-700">BCA Virtual Account</span>
                                <i class="fa-solid fa-circle text-gray-300 text-sm payment-icon"></i>
                            </label>
                            <label onclick="selectPayment('mandiri', 'Mandiri Virtual Account')" id="pay-mandiri" class="payment-option flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-brand-blue transition">
                                <span class="font-bold text-xs text-gray-700">Bank Mandiri Livin'</span>
                                <i class="fa-solid fa-circle text-gray-300 text-sm payment-icon"></i>
                            </label>
                            <label onclick="selectPayment('bri', 'BRI Virtual Account')" id="pay-bri" class="payment-option flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-brand-blue transition">
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

<!-- ================= MODAL PEMBAYARAN E-WALLET ================= -->
<div id="ewalletModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full overflow-hidden shadow-2xl p-6">
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h3 class="font-bold text-gray-800 text-base flex items-center gap-2">
                <i class="fa-solid fa-wallet text-brand-blue"></i> Pembayaran <span id="ewalletTitle">E-Wallet</span>
            </h3>
            <button onclick="closeModal('ewalletModal')" class="text-gray-400 hover:text-gray-600">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <form onsubmit="processEwalletPay(event)" class="space-y-4">
            <div class="bg-blue-50 p-3 rounded-xl flex justify-between items-center text-xs">
                <span class="text-gray-600">Total Tagihan:</span>
                <span id="ewalletTotal" class="font-extrabold text-brand-red text-sm">Rp 0</span>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nomor Akun / HP E-Wallet</label>
                <input type="tel" id="ewallet_phone" required placeholder="08xxxxxxxxxx" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-blue focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">PIN / Password Security</label>
                <input type="password" maxlength="6" id="ewallet_pin" required placeholder="******" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-brand-blue focus:outline-none tracking-widest text-center text-lg">
            </div>

            <button type="submit" id="btnPayEwallet" class="w-full bg-brand-blue hover:bg-brand-navy text-white font-bold py-3 rounded-xl text-sm shadow transition">
                Konfirmasi & Bayar Sekarang
            </button>
        </form>
    </div>
</div>

<!-- ================= MODAL PEMBAYARAN QRIS ================= -->
<div id="qrisModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-sm w-full overflow-hidden shadow-2xl p-6 text-center">
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h3 class="font-bold text-gray-800 text-sm">Scan QRIS UEC MART</h3>
            <button onclick="closeModal('qrisModal')" class="text-gray-400 hover:text-gray-600">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <p class="text-xs text-gray-500 mb-2">Buka Aplikasi GoPay, Shopee, DANA, OVO, atau Mobile Banking Anda lalu Scan di bawah ini:</p>

        <!-- Logo QRIS & QR Code Generator -->
        <div class="bg-gray-50 border-2 border-dashed border-gray-300 p-4 rounded-2xl my-3 inline-block relative">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=UECMART-PAYMENT" alt="QRIS Code" class="mx-auto rounded-lg shadow-sm">
            <div class="mt-2 flex items-center justify-center gap-1">
                <span class="font-black text-xs text-red-600">QRIS</span>
                <span class="text-[9px] text-gray-400">GPN Approved</span>
            </div>
        </div>

        <div class="bg-yellow-50 text-yellow-800 text-xs p-2.5 rounded-xl mb-4 font-semibold">
            Total: <span id="qrisTotal" class="font-bold text-brand-red">Rp 0</span>
        </div>

        <button onclick="simulasiQrisSukses()" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2.5 rounded-xl text-xs shadow transition flex items-center justify-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>Simulasi Scan & Bayar Sukses</span>
        </button>
    </div>
</div>

<!-- ================= MODAL PEMBAYARAN VIRTUAL ACCOUNT ================= -->
<div id="vaModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full overflow-hidden shadow-2xl p-6">
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h3 class="font-bold text-gray-800 text-base">Transfer Virtual Account</h3>
            <button onclick="closeModal('vaModal')" class="text-gray-400 hover:text-gray-600">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <div class="space-y-4">
            <div class="bg-gray-50 p-3 rounded-xl border text-center">
                <p class="text-xs text-gray-500 mb-1">Nomor Virtual Account <span id="vaBankName" class="font-bold">BCA</span>:</p>
                <div class="flex items-center justify-center gap-2">
                    <span id="vaNumber" class="text-lg font-black tracking-widest text-brand-navy">88012839201923</span>
                    <button onclick="copyVA()" class="text-xs bg-blue-100 text-brand-blue font-bold px-2 py-1 rounded">Salin</button>
                </div>
            </div>

            <div class="bg-blue-50 p-3 rounded-xl flex justify-between items-center text-xs">
                <span class="text-gray-600">Total Pembayaran:</span>
                <span id="vaTotal" class="font-extrabold text-brand-red text-sm">Rp 0</span>
            </div>

            <button onclick="simulasiVASukses()" class="w-full bg-brand-blue hover:bg-brand-navy text-white font-bold py-3 rounded-xl text-sm shadow transition">
                Saya Sudah Transfer
            </button>
        </div>
    </div>
</div>

<!-- ================= MODAL TANDA VERIFIKASI / STRUK SUKSES ================= -->
<div id="successModal" class="fixed inset-0 bg-black/70 backdrop-blur-md z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-sm w-full overflow-hidden shadow-2xl p-6 text-center transform transition-all scale-100">
        
        <!-- Animated Check Icon -->
        <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-green-200">
            <i class="fa-solid fa-check text-4xl"></i>
        </div>

        <h2 class="text-xl font-black text-gray-800 mb-1">Pembayaran Berhasil!</h2>
        <p class="text-xs text-gray-500 mb-4">Transaksi Anda telah terverifikasi oleh sistem UEC MART.</p>

        <!-- Struk Ringkas -->
        <div class="bg-gray-50 border border-dashed border-gray-300 rounded-2xl p-4 text-left space-y-2 mb-6">
            <div class="flex justify-between text-xs text-gray-500">
                <span>No. Transaksi</span>
                <span id="successTrxId" class="font-mono font-bold text-gray-700">#UEC-89213</span>
            </div>
            <div class="flex justify-between text-xs text-gray-500">
                <span>Nama Pemesan</span>
                <span id="successName" class="font-bold text-gray-700">-</span>
            </div>
            <div class="flex justify-between text-xs text-gray-500">
                <span>Metode Pembayaran</span>
                <span id="successMethod" class="font-bold text-gray-700">-</span>
            </div>
            <div class="border-t border-dashed pt-2 flex justify-between text-xs font-bold text-gray-800">
                <span>Total Lunas</span>
                <span id="successTotal" class="text-brand-red font-black">Rp 0</span>
            </div>
        </div>

        <a href="{{ route('barang.index') }}" onclick="clearCartAndFinish()" class="w-full block bg-brand-blue hover:bg-brand-navy text-white font-bold py-3 rounded-xl text-sm shadow-lg transition">
            Kembali ke Katalog Belanja
        </a>
    </div>
</div>

<script>
    let cart = [];
    let selectedPaymentMethod = 'qris';
    let selectedPaymentLabel = 'QRIS All Payment';
    let grandTotal = 0;

    document.addEventListener('DOMContentLoaded', function() {
        cart = JSON.parse(localStorage.getItem('uec_cart')) || [];
        let listContainer = document.getElementById('checkoutItemsList');
        let subtotalEl = document.getElementById('checkoutSubtotal');
        let totalEl = document.getElementById('checkoutTotal');

        if (cart.length === 0) {
            listContainer.innerHTML = `<p class="text-xs text-gray-400 text-center py-2">Keranjang belanja kosong.</p>`;
            return;
        }

        grandTotal = cart.reduce((sum, item) => sum + (item.harga * item.qty), 0);

        listContainer.innerHTML = cart.map(item => `
            <div class="flex items-center justify-between text-xs border-b pb-2">
                <div>
                    <p class="text-gray-800 font-bold">${item.nama_barang}</p>
                    <p class="text-gray-400 text-[10px]">${item.qty} x Rp ${Number(item.harga).toLocaleString('id-ID')}</p>
                </div>
                <span class="font-bold text-gray-800">Rp ${Number(item.harga * item.qty).toLocaleString('id-ID')}</span>
            </div>
        `).join('');

        let formattedTotal = 'Rp ' + grandTotal.toLocaleString('id-ID');
        subtotalEl.innerText = formattedTotal;
        totalEl.innerText = formattedTotal;
    });

    function selectPayment(id, label) {
        selectedPaymentMethod = id;
        selectedPaymentLabel = label;
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

    // HANDLER SAAT TOMBOL "BAYAR SEKARANG" DIKLIK
    function handleCheckout(e) {
        e.preventDefault();
        if (cart.length === 0) return alert('Keranjang belanja kosong!');

        const nama = document.getElementById('nama_pembeli').value;
        const phone = document.getElementById('no_hp').value;

        if(!nama || !phone) return alert('Harap isi Nama Pemesan dan Nomor WhatsApp terlebih dahulu!');

        let formattedTotal = 'Rp ' + grandTotal.toLocaleString('id-ID');

        // Buka modal sesuai metode pembayaran yang dipilih
        if (['gopay', 'shopeepay', 'dana', 'ovo'].includes(selectedPaymentMethod)) {
            document.getElementById('ewalletTitle').innerText = selectedPaymentLabel;
            document.getElementById('ewalletTotal').innerText = formattedTotal;
            document.getElementById('ewallet_phone').value = phone;
            openModal('ewalletModal');
        } else if (selectedPaymentMethod === 'qris') {
            document.getElementById('qrisTotal').innerText = formattedTotal;
            openModal('qrisModal');
        } else {
            document.getElementById('vaBankName').innerText = selectedPaymentLabel;
            document.getElementById('vaTotal').innerText = formattedTotal;
            document.getElementById('vaNumber').innerText = '8801' + Math.floor(1000000000 + Math.random() * 9000000000);
            openModal('vaModal');
        }
    }

    // PROSES BAYAR E-WALLET (SIMULASI MASUKKAN PIN)
    function processEwalletPay(e) {
        e.preventDefault();
        let btn = document.getElementById('btnPayEwallet');
        btn.innerText = 'Memproses Pembayaran...';
        btn.disabled = true;

        setTimeout(() => {
            closeModal('ewalletModal');
            btn.innerText = 'Konfirmasi & Bayar Sekarang';
            btn.disabled = false;
            showSuccessModal();
        }, 1500);
    }

    // SIMULASI PROSES QRIS SUKSES
    function simulasiQrisSukses() {
        closeModal('qrisModal');
        showSuccessModal();
    }

    // SIMULASI PROSES VA SUKSES
    function simulasiVASukses() {
        closeModal('vaModal');
        showSuccessModal();
    }

    // TAMPILKAN STRUK/VERIFIKASI BERHASIL
    function showSuccessModal() {
        let nama = document.getElementById('nama_pembeli').value;
        let formattedTotal = 'Rp ' + grandTotal.toLocaleString('id-ID');
        
        document.getElementById('successTrxId').innerText = '#UEC-' + Math.floor(100000 + Math.random() * 900000);
        document.getElementById('successName').innerText = nama;
        document.getElementById('successMethod').innerText = selectedPaymentLabel;
        document.getElementById('successTotal').innerText = formattedTotal;

        openModal('successModal');
    }

    function clearCartAndFinish() {
        localStorage.removeItem('uec_cart');
    }

    function copyVA() {
        let vaNum = document.getElementById('vaNumber').innerText;
        navigator.clipboard.writeText(vaNum);
        alert('Nomor VA berhasil disalin!');
    }

    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>
@endsection