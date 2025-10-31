@extends('layouts.navbar')

@section('title', 'Ajukan Request Donasi - Peduli Kasih')

@section('styles')
<style>
    .upload-area {
        border: 2px dashed #cbd5e0;
        transition: all 0.3s ease;
    }
    .upload-area:hover {
        border-color: #3b82f6;
        background-color: #eff6ff;
    }
    .upload-area.drag-over {
        border-color: #3b82f6;
        background-color: #dbeafe;
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-50 to-blue-100 py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Ajukan Request Donasi</h1>
        <p class="text-gray-600 text-lg">Isi formulir berikut untuk mengajukan permintaan donasi baru.</p>
    </div>
</div>

<!-- Form Section -->
<div class="container mx-auto px-4 py-12 max-w-4xl">
    <div class="bg-white rounded-xl shadow-lg p-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('request-donasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Pengaju -->
            <div class="mb-6">
                <label for="nama_pengaju" class="block text-gray-800 font-semibold mb-2">
                    Nama Pengaju <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="nama_pengaju" 
                    name="nama_pengaju" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    placeholder="Contoh: Panti Asuhan Harapan kita"
                    value="{{ old('nama_pengaju') }}"
                    required
                >
            </div>

            <!-- Jenis Donasi -->
            <div class="mb-6">
                <label for="jenis_donasi" class="block text-gray-800 font-semibold mb-2">
                    Jenis Donasi <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="jenis_donasi" 
                    name="jenis_donasi" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    placeholder="Contoh: Alat tulis"
                    value="{{ old('jenis_donasi') }}"
                    required
                >
            </div>

            <!-- Nama Barang -->
            <div class="mb-6">
                <label for="nama_barang" class="block text-gray-800 font-semibold mb-2">
                    Nama Barang <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="nama_barang" 
                    name="nama_barang" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    placeholder="Nama Spesifik Barang"
                    value="{{ old('nama_barang') }}"
                    required
                >
            </div>

            <!-- Jumlah Barang -->
            <div class="mb-6">
                <label for="jumlah_barang" class="block text-gray-800 font-semibold mb-2">
                    Jumlah Barang <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="jumlah_barang" 
                    name="jumlah_barang" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    placeholder="Contoh: 100 pcs"
                    value="{{ old('jumlah_barang') }}"
                    required
                >
            </div>

            <!-- Deskripsi Kebutuhan -->
            <div class="mb-6">
                <label for="deskripsi" class="block text-gray-800 font-semibold mb-2">
                    Deskripsi Kebutuhan <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="deskripsi" 
                    name="deskripsi" 
                    rows="6"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none"
                    placeholder="Jelaskan alasan kebutuhan donasi, siapa penerimanya, dan manfaat yang diharapkan."
                    required
                >{{ old('deskripsi') }}</textarea>
                <p class="text-gray-500 text-sm mt-2">Minimum 50 karakter</p>
            </div>

            <!-- Upload Contoh Barang -->
            <div class="mb-8">
                <label class="block text-gray-800 font-semibold mb-2">
                    Upload Contoh Barang Yang diperlukan <span class="text-red-500">*</span>
                </label>
                
                <div class="upload-area rounded-lg p-8 text-center cursor-pointer" id="upload-area">
                    <input 
                        type="file" 
                        id="file-input" 
                        name="gambar" 
                        class="hidden" 
                        accept="image/jpeg,image/png,image/jpg"
                        required
                    >
                    
                    <div id="upload-content">
                        <div class="mb-4">
                            <i class="fas fa-cloud-upload-alt text-gray-400 text-5xl"></i>
                        </div>
                        <p class="text-gray-600 mb-2">Klik untuk upload atau drag & drop</p>
                        <p class="text-gray-400 text-sm">JPG, PNG hingga 5MB</p>
                    </div>

                    <div id="preview-content" class="hidden">
                        <img id="preview-image" class="max-w-xs mx-auto rounded-lg mb-4" alt="Preview">
                        <p id="file-name" class="text-gray-700 font-medium mb-2"></p>
                        <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition" onclick="document.getElementById('file-input').click()">
                            Pilih File
                        </button>
                    </div>
                </div>

                <p class="text-gray-500 text-sm mt-2">
                    <i class="fas fa-info-circle"></i> Upload gambar contoh barang yang Anda butuhkan
                </p>
            </div>

            <!-- Buttons -->
            <div class="flex justify-center space-x-4">
                <a href="{{ route('home') }}" class="px-8 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-semibold">
                    Batal
                </a>
                <button type="submit" class="px-8 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition font-semibold">
                    Request Posting
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const uploadArea = document.getElementById('upload-area');
    const fileInput = document.getElementById('file-input');
    const uploadContent = document.getElementById('upload-content');
    const previewContent = document.getElementById('preview-content');
    const previewImage = document.getElementById('preview-image');
    const fileName = document.getElementById('file-name');

    // Click to upload
    uploadArea.addEventListener('click', () => {
        fileInput.click();
    });

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.classList.add('drag-over');
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.classList.remove('drag-over');
        }, false);
    });

    // Handle dropped files
    uploadArea.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        handleFiles(files);
    }, false);

    // Handle selected files
    fileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];
            
            // Validate file type
            if (!file.type.match('image.*')) {
                alert('Hanya file gambar yang diperbolehkan!');
                return;
            }

            // Validate file size (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran file maksimal 5MB!');
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImage.src = e.target.result;
                fileName.textContent = file.name;
                uploadContent.classList.add('hidden');
                previewContent.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }

    // Character counter for description
    const deskripsi = document.getElementById('deskripsi');
    deskripsi.addEventListener('input', () => {
        const length = deskripsi.value.length;
        const counter = deskripsi.nextElementSibling;
        if (length < 50) {
            counter.textContent = `Minimum 50 karakter (${length}/50)`;
            counter.classList.add('text-red-500');
            counter.classList.remove('text-gray-500');
        } else {
            counter.textContent = `${length} karakter`;
            counter.classList.remove('text-red-500');
            counter.classList.add('text-gray-500');
        }
    });
</script>
@endsection