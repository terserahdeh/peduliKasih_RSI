@extends('home.navbar')

@section('title', 'Post Donasi - Peduli Kasih')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Heading --}}
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Posting Donasi Barang</h2>
            <p class="text-gray-600">Silahkan isi informasi detail barang yang ingin Anda donasikan.</p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white shadow-lg rounded-xl p-8">
            <form action="{{ route('donasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nama Donasi --}}
                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-1">Nama Donasi</label>
                    <input type="text" name="nama_donasi" class="w-full border-gray-300 rounded-lg shadow-sm"
                        placeholder="Contoh: Pakaian Layak Pakai" required>
                </div>

                {{-- Jenis Barang --}}
                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-1">Jenis Barang</label>
                    <select name="jenis_barang" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option>Pakaian</option>
                        <option>Makanan</option>
                        <option>Elektronik</option>
                        <option>Alat Tulis</option>
                        <option>Barang Lainnya</option>
                    </select>
                </div>

                {{-- Kondisi --}}
                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-1">Kondisi Barang</label>
                    <select name="kondisi" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                        <option value="">-- Pilih Kondisi --</option>
                        <option>Baru</option>
                        <option>Bekas (Baik)</option>
                    </select>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm"
                        placeholder="Tambahkan deskripsi barang..." required></textarea>
                </div>

                {{-- Foto --}}
                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-1">Foto Barang</label>
                    <input type="file" name="foto" accept="image/*" class="w-full" required>
                </div>

                {{-- Alamat Pengambilan --}}
                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-1">Alamat Pengambilan</label>
                    <input type="text" name="alamat" class="w-full border-gray-300 rounded-lg shadow-sm"
                        placeholder="Contoh: Jl. Merdeka No. 12" required>
                </div>

                {{-- Tombol Submit --}}
                <div class="mt-8 flex justify-between">
                    <a href="/donasi"
                        class="px-6 py-2 rounded-lg bg-gray-500 text-white hover:bg-gray-600 transition">
                        Kembali
                    </a>

                    <button type="submit"
                        class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                        Posting Donasi
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>
@endsection
