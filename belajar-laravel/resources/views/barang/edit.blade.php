@extends('layouts.app')

@section('title', 'Edit Barang — UEC MART')

@section('content')

<div class="create-page">

    <div class="page-meta">
        <div class="meta-left">
            <span class="meta-dot"></span>
            UEC MART — INVENTORY SYSTEM
        </div>

        <div class="meta-right">
            EDIT
        </div>
    </div>


    <section class="create-hero">

        <div class="hero-label">
            EDIT PRODUCT
        </div>

        <h1 class="create-title">
            EDIT<br>
            BARANG<span>.</span>
        </h1>

        <p class="create-description">
            Perbarui data <strong>{{ $barang->nama_barang }}</strong>
            di katalog UEC MART.
        </p>

    </section>


    <section class="form-section">

        <div class="form-info">

            <div class="info-number">
                #{{ $barang->id }}
            </div>

            <div class="info-title">
                PRODUCT<br>
                INFORMATION
            </div>

            <p>
                Perubahan akan langsung
                tersimpan ke katalog
                barang UEC MART.
            </p>

            <div class="info-line"></div>

            <div class="info-circle"></div>

        </div>


        <div class="form-card">

            <div class="form-top-line"></div>

            <form action="/barang/{{ $barang->id }}" method="POST">

                @csrf
                @method('PUT')


                <div class="input-group">

                    <div class="input-label">
                        <span>01</span>
                        KODE BARANG
                    </div>

                    <input
                        type="text"
                        name="kode_barang"
                        value="{{ old('kode_barang', $barang->kode_barang) }}"
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


                <div class="input-group">

                    <div class="input-label">
                        <span>02</span>
                        NAMA BARANG
                    </div>

                    <input
                        type="text"
                        name="nama_barang"
                        value="{{ old('nama_barang', $barang->nama_barang) }}"
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


                <div class="input-group">

                    <div class="input-label">
                        <span>03</span>
                        KATEGORI
                    </div>

                    <input
                        type="text"
                        name="kategori"
                        value="{{ old('kategori', $barang->kategori) }}"
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


                <div class="input-group">

                    <div class="input-label">
                        <span>04</span>
                        HARGA (RP)
                    </div>

                    <input
                        type="number"
                        name="harga"
                        value="{{ old('harga', $barang->harga) }}"
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


                <div class="input-group">

                    <div class="input-label">
                        <span>05</span>
                        STOK
                    </div>

                    <input
                        type="number"
                        name="stok"
                        value="{{ old('stok', $barang->stok) }}"
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


                <div class="form-actions">

                    <a href="/barang" class="back-link">
                        <span>←</span>
                        KEMBALI KE DAFTAR BARANG
                    </a>

                    <button
                        type="submit"
                        class="save-button magnetic-btn"
                    >
                        <span>SIMPAN PERUBAHAN</span>
                        <strong>→</strong>
                    </button>

                </div>

            </form>

        </div>

    </section>

</div>

@endsection


{{-- Pakai style & script yang sama persis dengan halaman create --}}

@section('style')
@include('barang._form-style')
@endsection

@section('script')
@include('barang._form-script')
@endsection
