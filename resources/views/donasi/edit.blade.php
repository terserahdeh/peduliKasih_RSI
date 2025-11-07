@extends('home.navbar')

@section('title', 'Edit Donasi')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold mb-6">Ajukan Perubahan Donasi: {{ $donasi->judul_donasi }}</h1>
    
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <form action="{{ route('donasi.requestUpdate', $donasi->id_donasi) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="judul_donasi" class="block text-gray-700 text-sm font-bold mb-2">Judul Donasi Baru</label>
                <input type="text" name="judul_donasi" id="judul_donasi" 
                       value="{{ old('judul_donasi', $donasi->judul_donasi) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('judul_donasi')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Donasi Baru</label>
                <textarea name="deskripsi" id="deskripsi" rows="5"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('deskripsi', $donasi->deskripsi) }}</textarea>
                @error('deskripsi')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label for="kategori" class="block text-gray-700 text-sm font-bold mb-2">Kategori Donasi Baru</label>
                <select name="kategori" id="kategori" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                    <option value="">Pilih Kategori</option>
                    @foreach(['Sembako', 'Pakaian', 'Alat Tulis', 'Alat Rumah Tangga'] as $kategori)
                        <option value="{{ $kategori }}" {{ (old('kategori', $donasi->kategori) == $kategori) ? 'selected' : '' }}>
                            {{ $kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>
            
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Ajukan Perubahan ke Admin
                </button>
                <a href="{{ route('donasi.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection