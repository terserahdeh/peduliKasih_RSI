@extends('home.navbar')

@section('title', 'Edit Donasi')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"/>

<style>
.form-container {
    max-width: 800px;
    margin: 50px auto;
    padding: 0 20px;
}

.form-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
}

.form-title {
    font-size: 32px;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 10px;
    text-align: center;
}

.form-subtitle {
    font-size: 16px;
    color: #6B7280;
    text-align: center;
    margin-bottom: 40px;
}

.form-label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
}

.form-control, .form-select {
    border-radius: 10px;
    padding: 12px 16px;
    border: 2px solid #E5E7EB;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.btn-submit {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 14px 32px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 16px;
    border: none;
    width: 100%;
    transition: all 0.3s ease;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
}

.btn-back {
    background: #6B7280;
    color: white;
    padding: 10px 24px;
    border-radius: 10px;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.btn-back:hover {
    background: #4B5563;
    color: white;
}

.current-image {
    max-width: 200px;
    border-radius: 12px;
    margin-top: 10px;
    border: 2px solid #E5E7EB;
}

.alert-info {
    background: #EFF6FF;
    border: 1px solid #BFDBFE;
    color: #1E40AF;
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 30px;
}

.file-upload-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
    width: 100%;
}

.file-upload-wrapper input[type=file] {
    position: absolute;
    left: -9999px;
}

.file-upload-label {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px;
    border: 2px dashed #D1D5DB;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #F9FAFB;
}

.file-upload-label:hover {
    border-color: #667eea;
    background: #EEF2FF;
}

.preview-image {
    max-width: 100%;
    max-height: 300px;
    border-radius: 12px;
    margin-top: 15px;
    display: none;
}
</style>

<div class="form-container">
    <a href="{{ route('donasi.index') }}" class="btn-back">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>

    <div class="form-card">
        <h1 class="form-title">✏️ Edit Donasi</h1>
        <p class="form-subtitle">Perubahan akan dikirim ke admin untuk ditinjau</p>

        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>
            <strong>Informasi:</strong> Setiap perubahan yang Anda ajukan akan direview oleh admin terlebih dahulu sebelum diterapkan.
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('donasi.request.update', $donasi->id_donasi) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="form-label">Nama Donasi <span class="text-danger">*</span></label>
                <input type="text" name="nama_donasi" class="form-control" value="{{ old('nama_donasi', $donasi->nama_donasi) }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Jenis Barang <span class="text-danger">*</span></label>
                <select name="jenis_barang" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Alat Rumah Tangga" {{ old('jenis_barang', $donasi->jenis_barang) == 'Alat Rumah Tangga' ? 'selected' : '' }}>Alat Rumah Tangga</option>
                    <option value="Sembako" {{ old('jenis_barang', $donasi->jenis_barang) == 'Sembako' ? 'selected' : '' }}>Sembako</option>
                    <option value="Pakaian" {{ old('jenis_barang', $donasi->jenis_barang) == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                    <option value="Alat Tulis" {{ old('jenis_barang', $donasi->jenis_barang) == 'Alat Tulis' ? 'selected' : '' }}>Alat Tulis</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Jumlah Barang <span class="text-danger">*</span></label>
                <input type="text" name="jumlah_barang" class="form-control" value="{{ old('jumlah_barang', $donasi->jumlah_barang) }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                <textarea name="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi', $donasi->deskripsi) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label">Nomor WhatsApp</label>
                <input type="text" name="nomor_telepon" class="form-control" value="{{ old('nomor_telepon', $donasi->nomor_telepon) }}" placeholder="08xxxxxxxxxx">
            </div>

            <div class="mb-4">
                <label class="form-label">Foto Barang Saat Ini</label>
                <div>
                    <img src="{{ asset('foto/' . $donasi->foto) }}" alt="Current" class="current-image">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Ganti Foto Barang (Opsional)</label>
                <div class="file-upload-wrapper">
                    <input type="file" name="foto_baru" id="foto_baru" accept="image/*" onchange="previewImage(event)">
                    <label for="foto_baru" class="file-upload-label">
                        <div class="text-center">
                            <i class="bi bi-cloud-upload d-block" style="font-size: 36px; color: #9CA3AF;"></i>
                            <span class="d-block mt-2">Klik untuk upload foto baru</span>
                            <small class="text-muted">Maksimal 5MB (JPG, PNG)</small>
                        </div>
                    </label>
                </div>
                <img id="preview" class="preview-image" alt="Preview">
            </div>

            <button type="submit" class="btn-submit">
                <i class="bi bi-check-circle-fill me-2"></i>Ajukan Perubahan
            </button>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection