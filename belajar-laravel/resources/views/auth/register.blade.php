@extends('layouts.app')

@section('content')
<div class="min-h-[85vh] flex flex-col justify-center py-6 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-4xl bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden grid grid-cols-1 md:grid-cols-12">
        
        <!-- Sisi Kiri: Banner Promosi & Benefit Mahasiswa (5 Cols) -->
        <div class="md:col-span-5 bg-gradient-to-br from-brand-blue via-brand-navy to-blue-900 p-8 text-white flex flex-col justify-between relative overflow-hidden">
            <!-- Pattern Hiasan -->
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
            <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-brand-red/20 rounded-full blur-2xl"></div>

            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md px-3 py-1 rounded-full text-xs font-semibold text-brand-yellow mb-6">
                    <i class="fa-solid fa-graduation-cap"></i> Khusus Civitas Academica
                </div>
                <h3 class="text-2xl font-black leading-tight mb-3">Bergabung dengan Komunitas UEC MART</h3>
                <p class="text-xs text-blue-100 leading-relaxed mb-6">Dapatkan akses transaksi cepat, diskon khusus mahasiswa, dan dukung ekosistem wirausaha Kampus UNIDA Gontor.</p>
                
                <!-- List Benefit / Fitur Menarik -->
                <div class="space-y-3 text-xs">
                    <div class="flex items-center gap-2.5">
                        <div class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-check text-[10px]"></i>
                        </div>
                        <span>Poin Reward Mahasiswa setiap belanja</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <div class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-check text-[10px]"></i>
                        </div>
                        <span>Kemudahan pembayaran QRIS & E-Wallet</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <div class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-check text-[10px]"></i>
                        </div>
                        <span>Riwayat pesanan terintegrasi NIM</span>
                    </div>
                </div>
            </div>

            <div class="relative z-10 mt-8 pt-6 border-t border-white/10 text-[11px] text-blue-200">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-brand-yellow font-bold hover:underline">Masuk Sekarang</a>
            </div>
        </div>

        <!-- Sisi Kanan: Form Pendaftaran (7 Cols) -->
        <div class="md:col-span-7 p-6 sm:p-8 flex flex-col justify-center">
            <div class="mb-6">
                <h2 class="text-2xl font-black text-gray-800">Daftar Akun Mahasiswa</h2>
                <p class="text-xs text-gray-500 mt-1">Lengkapi data diri akademis Anda di bawah ini.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Nama Lengkap & NIM -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-brand-blue text-xs outline-none transition" placeholder="Ahmad Fauzi">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">NIM / NIMKO</label>
                        <input type="text" name="nim" value="{{ old('nim') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-brand-blue text-xs outline-none transition" placeholder="402026...">
                    </div>
                </div>

                <!-- Fakultas & Prodi -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Fakultas</label>
                        <select name="fakultas" required class="w-full px-3.5 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-brand-blue text-xs outline-none transition bg-white">
                            <option value="">-- Pilih Fakultas --</option>
                            <option value="Fakultas Ekonomi dan Manajemen">Fakultas Ekonomi & Manajemen</option>
                            <option value="Fakultas Sains dan Teknologi">Fakultas Sains & Teknologi</option>
                            <option value="Fakultas Tarbiyah">Fakultas Tarbiyah</option>
                            <option value="Fakultas Ushuluddin">Fakultas Ushuluddin</option>
                            <option value="Fakultas Syariah">Fakultas Syariah</option>
                            <option value="Fakultas Humaniora">Fakultas Humaniora</option>
                            <option value="Fakultas Kesehatan">Fakultas Kesehatan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Program Studi (Prodi)</label>
                        <input type="text" name="prodi" value="{{ old('prodi') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-brand-blue text-xs outline-none transition" placeholder="Contoh: Teknik Informatika">
                    </div>
                </div>

                <!-- Email & No HP -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-brand-blue text-xs outline-none transition" placeholder="mahasiswa@unida.gontor.ac.id">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Nomor WhatsApp / HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-brand-blue text-xs outline-none transition" placeholder="08123456789">
                    </div>
                </div>

                <!-- Password & Konfirmasi Password -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" required class="w-full px-3.5 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-brand-blue text-xs outline-none transition" placeholder="••••••••">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required class="w-full px-3.5 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-brand-blue text-xs outline-none transition" placeholder="••••••••">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-brand-blue hover:bg-brand-navy text-white font-bold py-3 rounded-xl shadow-md hover:shadow-lg transition duration-200 text-xs flex items-center justify-center gap-2">
                        <i class="fa-solid fa-user-plus"></i> Daftar Sekarang
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection