@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-4xl bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden grid grid-cols-1 md:grid-cols-2">
        
        <!-- Sisi Kiri: Ilustrasi -->
        <div class="bg-blue-50/50 p-8 flex flex-col justify-center items-center text-center border-r border-gray-100">
            <img src="{{ asset('images/uec-plang.jpeg') }}" alt="UEC Mart" class="w-48 h-48 object-cover rounded-2xl shadow-md mb-6">
            <h3 class="text-xl font-black text-gray-800">Belanja Mudah di UEC Mart</h3>
            <p class="text-xs text-gray-500 mt-2">Pusat perbelanjaan modern & edukasi kewirausahaan UNIDA Gontor.</p>
        </div>

        <!-- Sisi Kanan: Form Login -->
        <div class="p-8 md:p-12 flex flex-col justify-center space-y-6">
            <div>
                <h2 class="text-2xl font-black text-gray-800">Masuk Akun</h2>
                <p class="text-xs text-gray-500 mt-1">
                    Belum punya akun? <a href="#" class="text-blue-600 font-bold hover:underline">Daftar</a>
                </p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Email / Nomor Handphone</label>
                    <input type="text" name="email" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm outline-none transition" placeholder="Masukkan Email atau No. HP">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm outline-none transition" placeholder="Masukkan Password">
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-md transition duration-200 text-sm">
                    Masuk
                </button>
            </form>
        </div>

    </div>
</div>
@endsection