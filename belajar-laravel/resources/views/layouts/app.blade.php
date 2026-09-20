<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'KLIK UEC MART - Belanja Kebutuhan Harian')</title>

    <!-- Tailwind CSS CDN & FontAwesome Icons -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            blue: '#0057A0',
                            navy: '#003366',
                            red: '#ED1C24',
                            yellow: '#FFC808',
                            lightBg: '#F3F4F6'
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans text-gray-800 flex flex-col min-h-screen">

    <!-- Top Navigation Bar -->
    <header class="sticky top-0 z-40 bg-white shadow-sm border-b border-gray-200">
        <!-- Sub-header top -->
        <div class="bg-brand-blue text-white text-xs py-1.5 px-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <span class="bg-brand-red text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Promo</span>
                    <span>Download App UEC MART Mobile di PlayStore</span>
                </div>
                <div class="hidden sm:flex items-center space-x-4">
                    <a href="{{ route('tentang') }}" class="hover:text-yellow-300 transition">Tentang UEC MART</a>
                    <a href="#" class="hover:underline">Produk Terlaris</a>
                    <a href="#" class="hover:underline">Promo Spesial</a>
                </div>
            </div>
        </div>

        <!-- Main Header -->
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between gap-4">
                <!-- Logo UEC MART -->
                <a href="{{ route('barang.index') }}" class="flex items-center space-x-2 group shrink-0">
                    <div class="bg-gradient-to-r from-brand-blue via-brand-navy to-brand-red p-2 rounded-lg text-white font-extrabold tracking-wider text-xl flex items-center shadow-md">
                        <span class="text-white">UEC</span>
                        <span class="text-brand-yellow ml-1">MART</span>
                    </div>
                </a>

                <!-- Search Bar -->
                <div class="flex-1 max-w-2xl">
                    <form action="{{ route('barang.index') }}" method="GET" class="relative flex items-center">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang di Klik UEC MART..." class="w-full pl-4 pr-12 py-2 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue focus:bg-white transition">
                        <button type="submit" class="absolute right-1 px-3 py-1.5 bg-brand-blue text-white rounded-md hover:bg-brand-navy transition">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </button>
                    </form>
                </div>

                <!-- Right Menu & User Section -->
                <div class="flex items-center space-x-3 shrink-0">
                    <a href="{{ route('barang.index') }}" class="p-2 text-gray-600 hover:text-brand-blue relative" title="Daftar Barang">
                        <i class="fa-solid fa-boxes-stacked text-xl"></i>
                    </a>
                    
                    <button onclick="openModal('createModal')" class="bg-brand-red hover:bg-red-700 text-white font-semibold text-sm px-4 py-2 rounded-lg flex items-center space-x-2 shadow hover:shadow-md transition">
                        <i class="fa-solid fa-plus text-xs"></i>
                        <span class="hidden sm:inline">Tambah Barang</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Location & Category Strip -->
        <div class="bg-gray-50 border-t border-gray-200 px-4 py-2 text-xs">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center space-x-2 text-gray-600">
                    <i class="fa-solid fa-location-dot text-brand-red"></i>
                    <span>Area Pengiriman: <strong class="text-gray-800">Kampus UEC / Sekitarnya</strong></span>
                </div>
                <div class="text-gray-500">
                    Total Stok Terdata: <strong class="text-brand-blue">{{ $totalStok ?? 0 }} item</strong>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 py-6">
        <!-- Flash Message Notification -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg flex items-center justify-between shadow-sm">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-circle-check text-green-600 text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg shadow-sm">
                <div class="flex items-center space-x-2 mb-1">
                    <i class="fa-solid fa-triangle-exclamation text-red-600"></i>
                    <strong class="font-bold">Gagal Menyimpan Data:</strong>
                </div>
                <ul class="list-disc list-inside text-sm pl-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12 text-sm text-gray-600">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div>
                    <div class="bg-gradient-to-r from-brand-blue via-brand-navy to-brand-red p-2 rounded-lg text-white font-extrabold tracking-wider text-lg inline-flex items-center mb-3">
                        <span>UEC</span><span class="text-brand-yellow ml-1">MART</span>
                    </div>
                    <p class="text-xs text-gray-500">Katalog dan Manajemen Stok Minimarket Terpercaya UEC MART.</p>
                </div>
                <div>
                    <h4 class="font-bold text-gray-800 mb-2">Layanan Pelanggan</h4>
                    <ul class="space-y-1 text-xs">
                        <li><a href="#" class="hover:underline">Bantuan & FAQ</a></li>
                        <li><a href="#" class="hover:underline">Cara Pembayaran</a></li>
                        <li><a href="#" class="hover:underline">Kebijakan Pengembalian</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-gray-800 mb-2">Tentang Kami</h4>
                    <ul class="space-y-1 text-xs">
                        <li><a href="#" class="hover:underline">Profil UEC MART</a></li>
                        <li><a href="#" class="hover:underline">Karir</a></li>
                        <li><a href="#" class="hover:underline">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-gray-800 mb-2">Pembayaran</h4>
                    <div class="flex space-x-2 text-2xl text-gray-400">
                        <i class="fa-solid fa-credit-card"></i>
                        <i class="fa-solid fa-qrcode"></i>
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-200 mt-6 pt-4 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} Klik UEC MART. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Helper JavaScript Modal Functions -->
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>

    @stack('scripts')
</body>
</html>