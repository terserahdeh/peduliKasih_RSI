@extends('home.navbar')

@section('title', 'Detail Donasi')

@section('content')
<style>
    .detail-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        color: #1F2937;
        font-size: 16px;
        text-decoration: none;
        margin-bottom: 24px;
        transition: 0.3s;
        font-weight: 500;
    }

    .back-button:hover {
        color: #3B82F6;
    }

    .detail-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .detail-image {
        width: 100%;
        height: 450px;
        object-fit: cover;
    }

    .detail-content {
        padding: 32px;
    }

    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 24px;
        gap: 20px;
    }

    .detail-title {
        font-size: 28px;
        font-weight: 700;
        color: #1F2937;
        margin-bottom: 8px;
    }

    .status-badge {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-menunggu {
        background: #FEF3C7;
        color: #92400E;
    }

    .status-disetujui {
        background: #D1FAE5;
        color: #065F46;
    }

    .status-ditolak {
        background: #FEE2E2;
        color: #991B1B;
    }

    .detail-meta {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin: 24px 0;
        padding: 20px;
        background: #F9FAFB;
        border-radius: 12px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .meta-icon {
        color: #3B82F6;
        font-size: 20px;
    }

    .meta-text {
        font-size: 14px;
        color: #6B7280;
        margin: 0;
    }

    .meta-value {
        font-size: 15px;
        font-weight: 600;
        color: #1F2937;
        margin: 0;
    }

    .detail-section {
        margin-top: 24px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #1F2937;
        margin-bottom: 12px;
    }

    .section-text {
        font-size: 15px;
        color: #4B5563;
        line-height: 1.7;
    }

    .action-buttons {
        display: flex;
        gap: 12px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid #E5E7EB;
    }

    .btn-edit {
        flex: 1;
        background: #3B82F6;
        color: white;
        padding: 14px 24px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        transition: 0.3s;
        border: none;
        cursor: pointer;
    }

    .btn-edit:hover {
        background: #2563EB;
        transform: translateY(-2px);
    }

    .btn-delete {
        flex: 1;
        background: #EF4444;
        color: white;
        padding: 14px 24px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        transition: 0.3s;
        border: none;
        cursor: pointer;
    }

    .btn-delete:hover {
        background: #DC2626;
        transform: translateY(-2px);
    }

    .alert {
        padding: 16px 20px;
        border-radius: 10px;
        margin-bottom: 24px;
        font-size: 14px;
    }

    .alert-success {
        background: #D1FAE5;
        color: #065F46;
        border: 1px solid #6EE7B7;
    }

    .alert-error {
        background: #FEE2E2;
        color: #991B1B;
        border: 1px solid #FCA5A5;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        animation: fadeIn 0.3s;
    }

    .modal-content {
        background-color: white;
        margin: 10% auto;
        padding: 32px;
        border-radius: 16px;
        width: 90%;
        max-width: 450px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        animation: slideUp 0.3s;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .modal-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .modal-icon {
        width: 64px;
        height: 64px;
        background: #FEE2E2;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }

    .modal-icon i {
        color: #EF4444;
        font-size: 32px;
    }

    .modal-title {
        font-size: 20px;
        font-weight: 700;
        color: #1F2937;
        margin-bottom: 8px;
    }

    .modal-text {
        font-size: 14px;
        color: #6B7280;
        line-height: 1.6;
    }

    .modal-buttons {
        display: flex;
        gap: 12px;
        margin-top: 24px;
    }

    .btn-cancel {
        flex: 1;
        background: #F3F4F6;
        color: #374151;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-cancel:hover {
        background: #E5E7EB;
    }

    .btn-confirm {
        flex: 1;
        background: #EF4444;
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-confirm:hover {
        background: #DC2626;
    }

    @media (max-width: 768px) {
        .detail-image {
            height: 300px;
        }

        .detail-content {
            padding: 24px;
        }

        .detail-title {
            font-size: 24px;
        }

        .action-buttons {
            flex-direction: column;
        }
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />

<div class="detail-container">
    <a href="{{ route('donasi.index') }}" class="back-button">
        <i class="bi bi-arrow-left"></i> &nbsp;Kembali
    </a>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div class="detail-card">
        <img src="{{ asset('foto/' . $donasi->foto) }}" alt="{{ $donasi->nama_donasi }}" class="detail-image">

        <div class="detail-content">
            <div class="detail-header">
                <div>
                    <h1 class="detail-title">{{ $donasi->nama_donasi }}</h1>
                </div>
                <div>
                    @if($donasi->hasil_verif == 'menunggu')
                        <span class="status-badge status-menunggu">⏳ Menunggu Verifikasi</span>
                    @elseif($donasi->hasil_verif == 'disetujui')
                        <span class="status-badge status-disetujui">✓ Disetujui</span>
                    @elseif($donasi->hasil_verif == 'ditolak')
                        <span class="status-badge status-ditolak">✗ Ditolak</span>
                    @endif
                </div>
            </div>

            <div class="detail-meta">
                <div class="meta-item">
                    <i class="bi bi-tags-fill meta-icon"></i>
                    <div>
                        <p class="meta-text">Kategori</p>
                        <p class="meta-value">{{ $donasi->jenis_barang }}</p>
                    </div>
                </div>

                <div class="meta-item">
                    <i class="bi bi-box-seam meta-icon"></i>
                    <div>
                        <p class="meta-text">Jumlah</p>
                        <p class="meta-value">{{ $donasi->jumlah_barang }}</p>
                    </div>
                </div>

                <div class="meta-item">
                    <i class="bi bi-geo-alt-fill meta-icon"></i>
                    <div>
                        <p class="meta-text">Lokasi</p>
                        <p class="meta-value">{{ $donasi->lokasi ?? 'Tidak disebutkan' }}</p>
                    </div>
                </div>

                <div class="meta-item">
                    <i class="bi bi-calendar-event meta-icon"></i>
                    <div>
                        <p class="meta-text">Tanggal Upload</p>
                        <p class="meta-value">{{ \Carbon\Carbon::parse($donasi->tanggal_upload)->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="detail-section">
                <h3 class="section-title">Deskripsi</h3>
                <p class="section-text">{{ $donasi->deskripsi }}</p>
            </div>

            @if($donasi->hasil_verif == 'ditolak' && $donasi->alasan_tolak)
            <div class="detail-section">
                <h3 class="section-title">Alasan Penolakan</h3>
                <p class="section-text" style="color: #DC2626;">{{ $donasi->alasan_tolak }}</p>
            </div>
            @endif

            {{-- Tombol Edit & Hapus (Hanya muncul jika user adalah pemilik) --}}
            @if(Auth::check() && Auth::user()->username === $donasi->username)
            <div class="action-buttons">
                <a href="{{ route('donasi.edit', $donasi->id_donasi) }}" class="btn-edit">
                    <i class="bi bi-pencil-square"></i> Edit Donasi
                </a>
                <button type="button" class="btn-delete" onclick="openDeleteModal()">
                    <i class="bi bi-trash-fill"></i> Hapus Donasi
                </button>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Hapus --}}
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-icon">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>
            <h2 class="modal-title">Konfirmasi Hapus</h2>
            <p class="modal-text">
                Apakah Anda yakin ingin menghapus donasi ini? Tindakan ini tidak dapat dibatalkan.
            </p>
        </div>
        <div class="modal-buttons">
            <button class="btn-cancel" onclick="closeDeleteModal()">Batal</button>
            <form action="{{ route('donasi.destroy', $donasi->id_donasi) }}" method="POST" style="flex: 1;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-confirm" style="width: 100%;">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

<script>
function openDeleteModal() {
    document.getElementById('deleteModal').style.display = 'block';
}

function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('deleteModal');
    if (event.target == modal) {
        closeDeleteModal();
    }
}
</script>

@endsection