@extends('layouts.admin') 

@section('content')
    <div class="container">
        <h1 class="text-3xl font-bold mb-4">Detail Barang Donasi</h1>

        <div class="mb-4">
            {{-- Asumsi Anda memiliki kolom 'gambar' di database --}}
            {{-- <img src="{{ asset('storage/' . $donasi->gambar) }}" alt="{{ $donasi->nama_barang }}" class="w-full h-auto max-h-96 object-cover"> --}}
                    </div>

        <div class="detail-section mb-4">
            <h3 class="text-xl font-semibold">Nama Barang: {{ $donasi->nama_barang }}</h3>
            <p><strong>Deskripsi:</strong> {{ $donasi->deskripsi }}</p>
            <p><strong>Status Donasi:</strong> {{ $donasi->status }}</p>
            {{-- Tambahkan detail lain yang ingin dilihat user --}}
        </div>
        
        <a href="{{ url('/') }}" class="btn btn-secondary mt-4">Kembali ke Beranda</a>
    </div>
@endsection