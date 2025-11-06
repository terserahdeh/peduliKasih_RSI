@extends('admin.navbar')

@section('title', 'Edit Edukasi & Tips - Admin Peduli Kasih')

@section('content')
<main class="container mx-auto px-6 py-8 max-w-5xl">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Edukasi & Tips</h1>
        </div>

@if(session('success'))
<div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
 <div class="flex items-center">
    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
    </svg>
    
    <p class="text-green-700 font-medium">{{ session('success') }}</p>
 </div>
</div>
@endif

@if($errors->any())
<div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
     <div class="flex items-start">
         <svg class="w-5 h-5 text-red-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
            <p class="text-red-700 font-medium mb-2">Terdapat kesalahan:</p>
             <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
                 @foreach($errors->all() as $error)
                 <li>{{ $error }}</li>
                 @endforeach
             </ul> 
        </div>
     </div>
</div>
@endif

<form action="{{ route('admin.edukasintips.update', $tip->id_tipsnedukasi) }}" method="POST" enctype="multipart/form-data">
     @csrf
      @method('PUT')

<div class="bg-white rounded-lg shadow-sm p-8 mb-6">
    <label class="block text-gray-400 text-lg font-medium mb-4">Judul:</label>
    <input type="text"
    name="judul_tipsnedukasi"
    value="{{ old('judul_tipsnedukasi', $tip->judul_tipsnedukasi) }}"
    class="w-full text-2xl md:text-3xl font-bold text-gray-900 border-none focus:ring-0 focus:outline-none p-0"
    placeholder="Masukkan judul edukasi & tips"
    required>
    @error('judul_tipsnedukasi')
    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="bg-white rounded-lg shadow-sm p-8 mb-6">
    <label class="block text-gray-400 text-lg font-medium mb-4">Deskripsi:</label>
    <textarea name="deskripsi"
    rows="4"
    class="w-full text-gray-900 border-none focus:ring-0 focus:outline-none p-0 resize-none"
    placeholder="Masukkan deskripsi singkat"
    required>{{ old('deskripsi', $tip->deskripsi) }}</textarea>
    @error('deskripsi')
    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="bg-white rounded-lg shadow-sm p-8 mb-6">
    <label class="block text-gray-400 text-lg font-medium mb-4">Konten:</label>
    <textarea name="konten_tipsnedukasi"
    rows="15"
    id="kontenEditor"
    class="w-full text-gray-900 border-none focus:ring-0 focus:outline-none p-0 resize-y"
    placeholder="Masukkan konten lengkap edukasi & tips"
    required>{{ old('konten_tipsnedukasi', $tip->konten_tipsnedukasi) }}</textarea>
     @error('konten_tipsnedukasi')
      <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
       @enderror
</div>


<div class="flex justify-end items-center space-x-4">
    <a href="{{ route('admin.edukasintips.index') }}" class="px-8 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">
        Batal
    </a>
    <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm">
        Simpan
    </button>
 </div>
</form>

</main>

@push('scripts')
<script>
// JavaScript Anda di sini (Tidak ada perubahan yang diperlukan)
</script>
@endpush
@endsection