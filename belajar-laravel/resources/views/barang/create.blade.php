@extends('layouts.app')

@section('title', 'Tambah Barang — UEC MART')

@section('content')

<div class="create-page">

    {{-- TOP META --}}
    <div class="page-meta">
        <div class="meta-left">
            <span class="meta-dot"></span>
            UEC MART — INVENTORY SYSTEM
        </div>

        <div class="meta-right">
            01 / 02
        </div>
    </div>


    {{-- HERO --}}
    <section class="create-hero">

        <div class="hero-label">
            NEW PRODUCT
        </div>

        <h1 class="create-title">
            TAMBAH<br>
            BARANG<span>.</span>
        </h1>

        <p class="create-description">
            Tambahkan barang baru ke dalam katalog UEC MART.
            Isi informasi dengan lengkap sebelum menyimpan.
        </p>

    </section>


    {{-- FORM AREA --}}
    <section class="form-section">

        {{-- LEFT INFORMATION --}}
        <div class="form-info">

            <div class="info-number">
                01
            </div>

            <div class="info-title">
                PRODUCT<br>
                INFORMATION
            </div>

            <p>
                Data yang kamu masukkan
                akan tersimpan ke katalog
                barang UEC MART.
            </p>

            <div class="info-line"></div>

            <div class="info-circle"></div>

        </div>


        {{-- FORM CARD --}}
        <div class="form-card">

            <div class="form-top-line"></div>

            <form action="/barang" method="POST">

                @csrf


                {{-- KODE BARANG --}}
                <div class="input-group">

                    <div class="input-label">
                        <span>01</span>
                        KODE BARANG
                    </div>

                    <input
                        type="text"
                        name="kode_barang"
                        value="{{ old('kode_barang') }}"
                        placeholder="Contoh: UEC-0001..."
                        autocomplete="off"
                        required
                    >

                    <div class="input-line"></div>

                    @error('kode_barang')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- NAMA BARANG --}}
                <div class="input-group">

                    <div class="input-label">
                        <span>02</span>
                        NAMA BARANG
                    </div>

                    <input
                        type="text"
                        name="nama_barang"
                        value="{{ old('nama_barang') }}"
                        placeholder="Contoh: Indomie Goreng..."
                        autocomplete="off"
                        required
                    >

                    <div class="input-line"></div>

                    @error('nama_barang')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- KATEGORI --}}
                <div class="input-group">

                    <div class="input-label">
                        <span>03</span>
                        KATEGORI
                    </div>

                    <input
                        type="text"
                        name="kategori"
                        value="{{ old('kategori') }}"
                        placeholder="Contoh: Makanan Instan..."
                        autocomplete="off"
                        required
                    >

                    <div class="input-line"></div>

                    @error('kategori')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- HARGA --}}
                <div class="input-group">

                    <div class="input-label">
                        <span>04</span>
                        HARGA (RP)
                    </div>

                    <input
                        type="number"
                        name="harga"
                        value="{{ old('harga') }}"
                        placeholder="Contoh: 3500..."
                        min="0"
                        autocomplete="off"
                        required
                    >

                    <div class="input-line"></div>

                    @error('harga')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- STOK --}}
                <div class="input-group">

                    <div class="input-label">
                        <span>05</span>
                        STOK
                    </div>

                    <input
                        type="number"
                        name="stok"
                        value="{{ old('stok') }}"
                        placeholder="Contoh: 100..."
                        min="0"
                        autocomplete="off"
                        required
                    >

                    <div class="input-line"></div>

                    @error('stok')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ACTION --}}
                <div class="form-actions">

                    <a href="/barang" class="back-link">
                        <span>←</span>
                        KEMBALI KE DAFTAR BARANG
                    </a>

                    <button
                        type="submit"
                        class="save-button magnetic-btn"
                    >
                        <span>SIMPAN DATA</span>
                        <strong>→</strong>
                    </button>

                </div>

            </form>

        </div>

    </section>

</div>

@endsection


@section('style')
@include('barang._form-style')
@endsection


@section('script')
@include('barang._form-script')
@endsection
