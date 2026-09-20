<?php $__env->startSection('title', 'Tentang Kami - UEC MART UNIDA Gontor'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-6xl mx-auto px-4 space-y-12">

        <!-- Section 1: Hero Banner Header -->
        <div class="relative bg-gradient-to-r from-blue-900 via-brand-navy to-blue-800 rounded-3xl overflow-hidden shadow-xl text-white p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="space-y-4 max-w-xl z-10">
                <span class="bg-yellow-400 text-brand-navy text-xs font-black uppercase px-3 py-1 rounded-full tracking-wider">
                    Unida Edupreneur Center
                </span>
                <h1 class="text-3xl md:text-5xl font-black leading-tight">
                    Pusat Belanja & Edukasi Kewirausahaan Kampus
                </h1>
                <p class="text-blue-100 text-sm md:text-base leading-relaxed">
                    Selamat datang di **UEC MART UNIDA Gontor**. Kami hadir melayani kebutuhan harian seluruh civitas akademika dan masyarakat dengan semangat pelayanan Islami, modern, dan tepercaya.
                </p>
                <div class="pt-2 flex flex-wrap gap-4">
                    <a href="<?php echo e(route('barang.index')); ?>" class="bg-brand-red hover:bg-red-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg transition duration-200 text-sm flex items-center gap-2">
                        <i class="fa-solid fa-cart-shopping"></i> Mulai Belanja Online
                    </a>
                </div>
            </div>
            
            <!-- Foto Utama (Papan Nama UEC MART) -->
            <div class="relative w-full md:w-80 h-64 md:h-80 rounded-2xl overflow-hidden border-4 border-white/20 shadow-2xl flex-shrink-0">
                <img src="<?php echo e(asset('images/uec-plang.jpg')); ?>" alt="Plang UEC Mart" class="w-full h-full object-cover hover:scale-105 transition duration-500">
            </div>
        </div>

        <!-- Section 2: Tentang Kami & Gedung Utama -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center bg-white p-6 md:p-8 rounded-3xl border border-gray-200 shadow-sm">
            <!-- Foto Gedung Depan -->
            <div class="rounded-2xl overflow-hidden shadow-md border border-gray-100 group">
                <img src="<?php echo e(asset('images/uec-gedung.jpg')); ?>" alt="Gedung UNIDA Edupreneur Center" class="w-full h-72 object-cover group-hover:scale-105 transition duration-500">
                <div class="p-3 bg-gray-50 text-center text-xs font-semibold text-gray-500">
                    <i class="fa-solid fa-location-dot text-brand-red mr-1"></i> Gedung UNIDA Edupreneur Center (UEC)
                </div>
            </div>

            <!-- Narasi Profil -->
            <div class="space-y-4">
                <div class="inline-block px-3 py-1 bg-blue-50 text-brand-blue font-bold text-xs rounded-lg">
                    Profil Singkat
                </div>
                <h2 class="text-2xl font-black text-gray-800">
                    Mewujudkan Kemandirian Ekonomi Kampus
                </h2>
                <p class="text-gray-600 text-sm leading-relaxed text-justify">
                    **UEC MART** (*UNIDA Edupreneur Center Mart*) merupakan unit usaha strategis di bawah naungan Universitas Darussalam Gontor. UEC MART dirancang tidak hanya sebagai pusat perbelanjaan modern yang menyediakan produk-produk berkualitas, melainkan juga sebagai laboratorium hidup (*living lab*) bagi para mahasiswa untuk belajar manajemen bisnis modern dan berwirausaha secara langsung.
                </p>
                
                <div class="grid grid-cols-2 gap-4 pt-2">
                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <i class="fa-solid fa-store text-brand-blue text-xl mb-1"></i>
                        <h4 class="font-bold text-xs text-gray-800">Lengkap & Terjangkau</h4>
                        <p class="text-[11px] text-gray-500">Menyediakan barang harian santri & mahasiswa.</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <i class="fa-solid fa-handshake-angle text-green-600 text-xl mb-1"></i>
                        <h4 class="font-bold text-xs text-gray-800">Layanan Ramah</h4>
                        <p class="text-[11px] text-gray-500">Mengedepankan etika dan nilai-nilai keislaman.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3: Highlight UEC Coffee & Lounge (Cafe Corner) -->
        <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-3xl p-6 md:p-8 border border-amber-200/60 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Teks Cafe -->
                <div class="space-y-4 order-2 md:order-1">
                    <span class="bg-amber-200 text-amber-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                        Fasilitas Istimewa
                    </span>
                    <h2 class="text-2xl font-black text-gray-800">
                        UEC Coffee & Corner Cafe
                    </h2>
                    <p class="text-gray-600 text-sm leading-relaxed text-justify">
                        Nikmati racikan kopi terbaik, aneka minuman segar, serta suasana bersantai yang nyaman di area cafe UEC MART. Tempat yang ideal untuk berdiskusi, mengerjakan tugas kuliah, atau sekadar beristirahat sejenak di tengah kesibukan akademik kampus.
                    </p>
                    <ul class="space-y-2 text-xs font-semibold text-gray-700">
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-amber-600"></i> Biji kopi pilihan bernuansa cafe profesional
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-amber-600"></i> Tempat bersih, nyaman, dan ber-AC
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-amber-600"></i> Barista berpengalaman dari civitas akademika
                        </li>
                    </ul>
                </div>

                <!-- Foto Cafe / Kedai Kopi -->
                <div class="order-1 md:order-2 rounded-2xl overflow-hidden shadow-lg border-2 border-white group">
                    <img src="<?php echo e(asset('images/uec-cafe.jpeg')); ?>" alt="UEC Coffee Corner" class="w-full h-72 object-cover">
                </div>
            </div>
        </div>

        <!-- Section 4: Mengapa Memilih UEC MART? -->
        <div class="text-center space-y-8">
            <div>
                <h2 class="text-2xl font-black text-gray-800">Mengapa Memilih UEC MART?</h2>
                <p class="text-xs text-gray-500 mt-1">Keunggulan layanan yang selalu kami jaga untuk kenyamanan Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition text-center space-y-3">
                    <div class="w-12 h-12 bg-blue-100 text-brand-blue rounded-full flex items-center justify-center mx-auto text-xl font-bold">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-sm">Produk Halal & Thayyib</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Seluruh barang yang dijual terjamin kehalalan dan kebersihannya sesuai kaidah syariat.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition text-center space-y-3">
                    <div class="w-12 h-12 bg-yellow-100 text-yellow-700 rounded-full flex items-center justify-center mx-auto text-xl font-bold">
                        <i class="fa-solid fa-qrcode"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-sm">Pembayaran Digital Lengkap</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Mendukung pembayaran instan QRIS, E-Wallet (GoPay, OVO, DANA), hingga Transfer Bank.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition text-center space-y-3">
                    <div class="w-12 h-12 bg-green-100 text-green-700 rounded-full flex items-center justify-center mx-auto text-xl font-bold">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-sm">Dukungan Entrepreneurship</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Setiap transaksi Anda berpartisipasi langsung dalam mendukung program wirausaha mahasiswa UNIDA Gontor.</p>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/syafiqakmal/Downloads/belajar-laravel/resources/views/tentang.blade.php ENDPATH**/ ?>