@extends('home.navbar')

@section('title','Post Donasi Barang')

@section('content')
<style>
    /* Container & Layout */
    .post-donasi-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    /* Header */
    .back-button {
        display: inline-flex;
        align-items: center;
        color: #1F2937;
        font-size: 24px;
        text-decoration: none;
        margin-bottom: 20px;
        transition: 0.3s;
    }
    
    .back-button:hover {
        color: #3B82F6;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #1F2937;
        margin-bottom: 8px;
    }

    .page-subtitle {
        font-size: 14px;
        color: #6B7280;
        margin-bottom: 40px;
    }

    /* Form Container */
    .form-container {
        background: #FFFFFF;
        border-radius: 12px;
        padding: 40px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    }

    /* Form Labels & Inputs */
    .form-label {
        font-size: 15px;
        font-weight: 600;
        color: #1F2937;
        margin-bottom: 8px;
        display: block;
    }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #D1D5DB;
        border-radius: 8px;
        font-size: 14px;
        color: #374151;
        background-color: #F9FAFB;
        transition: all 0.3s;
        margin-bottom: 24px;
    }

    .form-input::placeholder {
        color: #9CA3AF;
    }

    .form-input:focus {
        outline: none;
        border-color: #3B82F6;
        background-color: #FFFFFF;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-textarea {
        height: 150px;
        resize: vertical;
    }

    /* Upload Area */
    .upload-area {
        border: 2px dashed #CBD5E1;
        border-radius: 12px;
        background-color: #F8FAFC;
        padding: 60px 20px;
        text-align: center;
        margin-bottom: 24px;
        transition: all 0.3s;
        cursor: pointer;
        position: relative;
    }

    .upload-area:hover {
        border-color: #3B82F6;
        background-color: #EFF6FF;
    }

    .upload-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 16px;
        background-color: #E5E7EB;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .upload-icon svg {
        width: 40px;
        height: 40px;
        color: #6B7280;
    }

    .upload-text {
        font-size: 14px;
        color: #374151;
        margin-bottom: 4px;
    }

    .upload-subtext {
        font-size: 12px;
        color: #9CA3AF;
    }

    .file-input-hidden {
        position: absolute;
        width: 1px;
        height: 1px;
        opacity: 0;
        overflow: hidden;
    }

    .upload-button {
        background-color: #3B82F6;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 24px;
        font-size: 14px;
        font-weight: 600;
        margin-top: 16px;
        cursor: pointer;
        transition: 0.3s;
    }

    .upload-button:hover {
        background-color: #2563EB;
    }

    .file-name-display {
        margin-top: 12px;
        font-size: 13px;
        color: #059669;
        font-weight: 500;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 16px;
        margin-top: 40px;
    }

    .btn-cancel {
        background-color: transparent;
        color: #6B7280;
        border: 1px solid #D1D5DB;
        border-radius: 8px;
        padding: 12px 32px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-cancel:hover {
        background-color: #F3F4F6;
        color: #374151;
    }

    .btn-submit {
        background-color: #3B82F6;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px 40px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-submit:hover {
        background-color: #2563EB;
    }

    /* Alert Styles */
    .alert {
        padding: 16px 20px;
        border-radius: 8px;
        margin-bottom: 24px;
        font-size: 14px;
    }

    .alert-success {
        background-color: #D1FAE5;
        color: #065F46;
        border: 1px solid #6EE7B7;
    }

    .alert-danger {
        background-color: #FEE2E2;
        color: #991B1B;
        border: 1px solid #FCA5A5;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-container {
            padding: 24px;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-cancel,
        .btn-submit {S
            width: 100%;
        }
    }
</style>

<div class="post-donasi-container">
    {{-- Back Button --}}
    <a href="{{ route('donasi.index') }}" class="back-button">
        ← 
    </a>

    {{-- Page Header --}}
    <h1 class="page-title">Post Donasi Barang</h1>
    <p class="page-subtitle">Isi formulir berikut untuk mengajukan donasi. Data akan diverifikasi oleh admin.</p>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Error Messages --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Container --}}
    <div class="form-container">
        <form action="{{ route('donasi.barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Nama Donasi --}}
            <label class="form-label">Nama Donasi</label>
            <input 
                type="text" 
                name="nama_donasi" 
                class="form-input" 
                placeholder="Contoh: Donasi Pakaian Layak Pakai Untuk Anak"
                value="{{ old('nama_donasi') }}"
                required
            >

            <!-- {{-- Jenis Barang --}}
            <label class="form-label">Nama Barang</label>
            <input 
                type="text" 
                name="jenis_barang" 
                class="form-input" 
                placeholder="Nama Spesifik Barang"
                value="{{ old('jenis_barang') }}"
                required
            > -->

            {{-- Jenis Barang --}}
            <label class="form-label">Kategori Barang</label>
            <select name="jenis_barang" class="form-input" required>
                <option value="">Pilih Kategori</option>
                <option value="Sembako" {{ old('kategori') == 'Sembako' ? 'selected' : '' }}>Sembako</option>
                <option value="Alat Tulis" {{ old('kategori') == 'Alat Tulis' ? 'selected' : '' }}>Alat Tulis</option>
                <option value="Pakaian" {{ old('kategori') == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                <option value="Alat Rumah Tangga" {{ old('kategori') == 'Alat Rumah Tangga' ? 'selected' : '' }}>Alat Rumah Tangga</option>
            </select>

            {{-- Jumlah Barang --}}
            <label class="form-label">Jumlah Barang</label>
            <input 
                type="text" 
                name="jumlah_barang" 
                class="form-input" 
                placeholder="Contoh: 10 pasang atau 200 pcs"
                value="{{ old('jumlah_barang') }}"
                required
            >

            {{-- Lokasi --}}
            <label class="form-label">Lokasi</label>
            <input 
                type="text" 
                name="lokasi" 
                class="form-input" 
                placeholder="Contoh: Jakarta Timur"
                value="{{ old('lokasi') }}"
            >

            {{-- Deskripsi Barang --}}
            <label class="form-label">Deskripsi Barang</label>
            <textarea 
                name="deskripsi" 
                class="form-input form-textarea" 
                placeholder="Jelaskan kondisi barang, manfaat, kegunaan, dan tambahan lainnya"
                required
            >{{ old('deskripsi') }}</textarea>

            <div class="mb-3">
                <label for="nomor_telepon" class="form-label">Nomor WhatsApp</label>
                <input type="text" name="nomor_telepon" id="nomor_telepon" class="form-control" placeholder="Contoh: 6281234567890" value="{{ old('nomor_telepon') }}">
                <small class="text-muted">Gunakan format internasional (misalnya 6281234567890 tanpa +).</small>
            </div>

            {{-- Upload Foto Barang --}}
            <label class="form-label">Upload Foto Barang</label>
            <div class="upload-area" onclick="document.getElementById('fileInput').click()">
                <div class="upload-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
                <div class="upload-text">Klik untuk upload atau drag & drop</div>
                <div class="upload-subtext">JPG, PNG hingga 5MB</div>
                <input 
                    type="file" 
                    id="fileInput"
                    name="foto" 
                    class="file-input-hidden"
                    accept="image/jpeg,image/png,image/jpg"
                    onchange="displayFileName(this)"
                >
                <button type="button" class="upload-button" onclick="document.getElementById('fileInput').click(); event.stopPropagation();">
                    Pilih File
                </button>
                <div id="fileName" class="file-name-display"></div>
            </div>  

            {{-- Action Buttons --}}
            <div class="action-buttons">
                <a href="{{ route('donasi.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit">Ajukan Postingan</button>
            </div>

        </form>
    </div>
</div>

<script>
function displayFileName(input) {
    const fileNameDiv = document.getElementById('fileName');
    if (input.files && input.files[0]) {
        fileNameDiv.textContent = '✓ File terpilih: ' + input.files[0].name;
    } else {
        fileNameDiv.textContent = '';
    }
}
</script>

@endsection