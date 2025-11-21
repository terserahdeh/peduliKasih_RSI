@extends('home.navbar')

@section('title', 'Daftar Request Donasi')

@section('content')
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
/>

<style>
/* ===================== GLOBAL ===================== */
.bg-purple { background-color: #9277EF !important; }

.icon-small {
    font-size: 16px;
    width: 20px;
    margin-right: 10px;
    color: #3B82F6;
}

/* ===================== LANDING HERO ===================== */
.landing-hero {
    background: linear-gradient(135deg, #EEF2FF 0%, #DBEAFE 100%);
    padding: 80px 0;
    margin-bottom: 60px;
}

.landing-wrapper {
    max-width: 1200px;
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 40px;
    padding: 0 20px;
}

.landing-text h1 {
    font-size: 44px;
    font-weight: 700;
    color: #1E293B;
    line-height: 1.3;
    margin-bottom: 20px;
}

.landing-text p {
    font-size: 17px;
    color: #475569;
    margin-bottom: 30px;
}

.hero-primary {
    background: #3B82F6;
    padding: 14px 32px;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    color: white;
    text-decoration: none;
    transition: .3s;
}

.hero-primary:hover {
    background: #2563EB;
    transform: translateY(-2px);
    box-shadow: 0 5px 12px rgba(59,130,246,.4);
}

.landing-image img {
    width: 430px;
    border-radius: 14px;
}

/* ===================== SECTION TITLE ===================== */
.section-title {
    text-align: center;
    margin-bottom: 40px;
}

.section-title h2 {
    font-size: 32px;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 12px;
}

.section-title p {
    font-size: 15px;
    color: #6B7280;
    margin-bottom: 15px;
}

/* ====== FILTER BUTTON ====== */
.filter-container {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}

.filter-btn {
    border: 1px solid #3B82F6;
    background-color: white;
    color: #3B82F6;
    border-radius: 8px;
    padding: 10px 24px;
    font-weight: 500;
    font-size: 14px;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
}

.filter-btn:hover,
.filter-btn.active {
    background-color: #3B82F6;
    color: white;
    border-color: #3B82F6;
}

/* ====== GRID ====== */
.donation-container {
    max-width: 1400px;
    margin: auto;
    padding: 0 20px 80px;
}

.donation-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 28px;
    margin: auto;
}

/* ====== CARD ====== */
.donation-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 14px rgba(0,0,0,0.07);
    transition: .3s;
    display: flex;
    flex-direction: column;
}

.donation-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 22px rgba(0,0,0,0.12);
}

.card-image-wrapper {
    position: relative;
    overflow: hidden;
    height: 220px;
    border-radius: 16px 16px 0 0;
}

.card-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* STATUS BADGE */
.card-status-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #FBBF24;
    color: #78350F;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 6px;
}

/* CONTENT */
.card-content { 
    padding: 15px 20px; 
}

.card-title {
    font-size: 17px;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 14px;
}

.card-info-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #4B5563;
    font-weight: 500;
    margin-bottom: 8px;
}


/* FOOTER */
.card-footer {
    margin-top: 10px;
    border-top: 1px solid #F3F4F6;
    padding-top: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.btn-detail {
    background: #3B82F6;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: .3s;
    border: none;
    cursor: pointer;
    width: 100%;
    text-align: center;
    display: block;
}

.btn-detail:hover { 
    opacity: .9; 
}

/* ====== MODAL STYLING ====== */
.modal.show {
    display: flex !important;
    align-items: flex-start;
    justify-content: center;
    padding: 40px 20px;
    overflow-y: auto;
}

.modal-dialog {
    margin: 0 auto;
    transform: none !important;
    animation: zoomIn .3s ease;
    max-width: 700px;
    width: 100%;
    max-height: calc(100vh - 80px);
}

.modal-dialog-centered {
    margin: 0 auto !important;
}

@keyframes zoomIn {
    from { 
        transform: scale(0.9); 
        opacity: 0; 
    }
    to { 
        transform: scale(1); 
        opacity: 1; 
    }
}

.modal-backdrop.show {
    opacity: 0.6;
}

.modal-content {
    border-radius: 20px !important;
    border: none;
    overflow: hidden;
}

/* Modal Header */
.modal-header {
    background: white !important;
    border-bottom: none;
    padding: 20px 24px 10px;
}

.modal-header .modal-title {
    font-size: 22px;
    font-weight: 700;
    color: #1F2937;
}

.modal-header .btn-close {
    opacity: 0.5;
}

/* Modal Body */
.modal-body {
    background: white !important;
    padding: 0 24px 24px;
}

/* Image in Modal */
.modal-body img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 20px;
}

/* Status Badges in Modal */
.status-badges {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.badge-approved {
    background: #D1FAE5;
    color: #065F46;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.badge-unfulfilled {
    background: #FEF3C7;
    color: #92400E;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

/* Title in Modal Body */
.modal-body h4 {
    font-size: 20px;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 16px;
}

/* Info Grid */
.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 20px;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.info-item-icon {
    width: 40px;
    height: 40px;
    background: #EFF6FF;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.info-item-icon i {
    font-size: 18px;
    color: #3B82F6;
}

.info-item-content {
    flex: 1;
}

.info-item-label {
    font-size: 12px;
    color: #6B7280;
    margin-bottom: 2px;
}

.info-item-value {
    font-size: 14px;
    font-weight: 600;
    color: #1F2937;
}

/* Description Section */
.description-section {
    background: #F9FAFB;
    padding: 16px;
    border-radius: 12px;
    margin-bottom: 20px;
}

.description-title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 600;
    color: #3B82F6;
    margin-bottom: 10px;
}

.description-title i {
    font-size: 16px;
}

.description-text {
    font-size: 14px;
    color: #4B5563;
    line-height: 1.6;
    margin: 0;
}

/* Action Buttons in Modal Body */
.action-buttons {
    display: flex;
    gap: 12px;
    margin-bottom: 20px;
}

.btn-edit-request {
    flex: 1;
    background: #FBBF24;
    color: white;
    padding: 12px 20px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: .3s;
    text-decoration: none;
}

.btn-edit-request:hover {
    background: #F59E0B;
    color: white;
}

.btn-delete-request {
    flex: 1;
    background: #EF4444;
    color: white;
    padding: 12px 20px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: .3s;
    cursor: pointer;
}

.btn-delete-request:hover {
    background: #DC2626;
}

/* Info Box */
.info-donation-box {
    background: #EFF6FF;
    border-left: 4px solid #3B82F6;
    padding: 16px;
    border-radius: 8px;
}

.info-donation-title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 600;
    color: #1E40AF;
    margin-bottom: 8px;
}

.info-donation-title i {
    font-size: 16px;
}

.info-donation-text {
    font-size: 13px;
    color: #1E40AF;
    margin: 0 0 12px 0;
}

.btn-contact-admin {
    background: #10B981;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: .3s;
    text-decoration: none;
}

.btn-contact-admin:hover {
    background: #059669;
    color: white;
}

/* ===================== COMMENTS SECTION ===================== */
.comments-section {
    background: #F9FAFB;
    border-radius: 12px;
    padding: 20px;
}

.comments-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #E5E7EB;
}

.comments-header i {
    font-size: 20px;
    color: #3B82F6;
}

.comments-header h5 {
    font-size: 16px;
    font-weight: 700;
    color: #1F2937;
    margin: 0;
}

.comments-subtitle {
    font-size: 13px;
    color: #6B7280;
    margin: -8px 0 16px 30px;
}

/* Comment Form */
.comment-form {
    background: white;
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 20px;
    border: 1px solid #E5E7EB;
}

.comment-input-wrapper {
    display: flex;
    gap: 12px;
    align-items: flex-start;
}

.comment-user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 16px;
    flex-shrink: 0;
}

.comment-input-container {
    flex: 1;
}

.comment-textarea {
    width: 100%;
    border: 1px solid #E5E7EB;
    border-radius: 10px;
    padding: 12px 14px;
    font-size: 14px;
    color: #1F2937;
    resize: vertical;
    min-height: 80px;
    font-family: 'Inter', sans-serif;
    transition: all 0.3s ease;
}

.comment-textarea:focus {
    outline: none;
    border-color: #3B82F6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.comment-textarea::placeholder {
    color: #9CA3AF;
}

.comment-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 10px;
}

.btn-comment-submit {
    background: #3B82F6;
    color: white;
    padding: 10px 24px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 6px;
}

.btn-comment-submit:hover {
    background: #2563EB;
    transform: translateY(-1px);
}

.btn-comment-submit:disabled {
    background: #D1D5DB;
    cursor: not-allowed;
    transform: none;
}

/* Comments List */
.comments-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.comment-item {
    background: white;
    border-radius: 12px;
    padding: 16px;
    border: 1px solid #E5E7EB;
    transition: all 0.3s ease;
}

.comment-item:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

.comment-header-info {
    display: flex;
    gap: 12px;
    margin-bottom: 12px;
}

.comment-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 16px;
    flex-shrink: 0;
}

.comment-user-info {
    flex: 1;
}

.comment-username {
    font-size: 14px;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 2px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.badge-admin {
    background: #DBEAFE;
    color: #1E40AF;
    font-size: 11px;
    padding: 2px 8px;
    border-radius: 4px;
    font-weight: 600;
}

.comment-time {
    font-size: 12px;
    color: #9CA3AF;
}

.comment-content {
    font-size: 14px;
    color: #4B5563;
    line-height: 1.6;
    margin-left: 52px;
}

.comment-actions-buttons {
    display: flex;
    gap: 16px;
    margin-left: 52px;
    margin-top: 10px;
}

.comment-action-btn {
    background: transparent;
    border: none;
    color: #6B7280;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 4px;
    padding: 4px 8px;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.comment-action-btn:hover {
    background: #F3F4F6;
    color: #3B82F6;
}

.comment-action-btn i {
    font-size: 14px;
}

.empty-comments {
    text-align: center;
    padding: 40px 20px;
}

.empty-comments i {
    font-size: 48px;
    color: #D1D5DB;
    margin-bottom: 12px;
}

.empty-comments p {
    font-size: 14px;
    color: #9CA3AF;
    margin: 0;
}

/* Modal Footer - Hide it */
.modal-footer {
    display: none !important;
}

/* RESPONSIVE */
@media (max-width: 1200px) {
    .donation-grid { 
        grid-template-columns: repeat(3, 1fr); 
    }
}

@media (max-width: 900px) {
    .donation-grid { 
        grid-template-columns: repeat(2, 1fr); 
    }
}

@media (max-width: 768px) {
    .modal.show {
        padding: 20px 15px;
    }
    
    .modal-dialog {
        margin: 20px auto;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .modal-body img {
        height: 250px;
    }
    
    .action-buttons {
        flex-direction: column;
    }
}

@media (max-width: 600px) {
    .donation-grid { 
        grid-template-columns: repeat(1, 1fr); 
    }
    
    .card-image-wrapper {
        height: 250px;
    }
    
    .landing-wrapper {
        flex-direction: column;
        text-align: center;
    }
    
    .landing-text h1 {
        font-size: 32px;
    }
    
    .landing-image img {
        width: 100%;
        max-width: 350px;
    }
}
</style>

{{-- ===================== LANDING SECTION ===================== --}}
<section class="landing-hero">
    <div class="landing-wrapper">
        <div class="landing-text">
            <h1>Berbagi Kebaikan,<br><span class="highlight">bantu mereka yang membutuhkan</span></h1>
            <p>Temukan daftar kebutuhan yang benar-benar urgent dan bantu dengan donasi barang layak pakai.</p>
            <a href="{{ route('donasi.create') }}" class="hero-primary">
                Mulai Donasi Sekarang
            </a>
        </div>
        <img src="https://ik.imagekit.io/ncqn8tn87/imagee.svg?updatedAt=1762781336398"
             style="max-width:50%; border-radius:10px;"
             alt="Donasi">
    </div>
</section>

{{-- ===================== SECTION CONTENT ===================== --}}
<div class="donation-container">

    <div class="section-title">
        <h2>Daftar Request Donasi</h2>
        <p>Pilih kategori kebutuhan yang ingin kamu bantu</p>
    </div>

    {{-- Filter Button --}}
    <div class="filter-container">
        <a href="{{ route('donasi.index') }}" class="filter-btn {{ !request('kategori') ? 'active' : '' }}">
            Semua
        </a>
        <a href="{{ route('donasi.filter', ['kategori' => 'Alat Rumah Tangga']) }}" 
           class="filter-btn {{ request('kategori') == 'Alat Rumah Tangga' ? 'active' : '' }}">
            Alat Rumah Tangga
        </a>
        <a href="{{ route('donasi.filter', ['kategori' => 'Sembako']) }}" 
           class="filter-btn {{ request('kategori') == 'Sembako' ? 'active' : '' }}">
            Sembako
        </a>
        <a href="{{ route('donasi.filter', ['kategori' => 'Pakaian']) }}" 
           class="filter-btn {{ request('kategori') == 'Pakaian' ? 'active' : '' }}">
            Pakaian
        </a>
        <a href="{{ route('donasi.filter', ['kategori' => 'Alat Tulis']) }}" 
           class="filter-btn {{ request('kategori') == 'Alat Tulis' ? 'active' : '' }}">
            Alat Tulis
        </a>
    </div>

    @if($donasi->count())
    <div class="donation-grid">
        @foreach($donasi as $item)
        <div class="donation-card">
            <div class="card-image-wrapper">
                <img src="{{ asset('foto/' . $item->foto) }}" class="card-image">
                @if($item->status_request != 'Terpenuhi')
                    <span class="card-status-badge">Belum Terpenuhi</span>
                @endif
            </div>

            <div class="card-content">
                <h5 class="card-title">{{ $item->nama_donasi }}</h5>

                <div class="card-info-item"><i class="bi bi-tags-fill icon-small"></i>{{ $item->jenis_barang ?? 'Tidak Diketahui' }}</div>
                <div class="card-info-item"><i class="bi bi-box-seam icon-small"></i>{{ $item->jumlah_barang ?? 0 }} unit</div>
                <div class="card-info-item"><i class="bi bi-calendar-event icon-small"></i>{{ \Carbon\Carbon::parse($item->tanggal_request)->format('d M Y') }}</div>

                <div class="card-footer">
                    <button type="button" class="btn-detail" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id_donasi }}">
                        Detail
                    </button>
                </div>
            </div>
        </div>

        <!-- MODAL DETAIL -->
<div class="modal fade" id="detailModal{{ $item->id_donasi }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $item->id_donasi }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel{{ $item->id_donasi }}">
                    Detail Barang Donasi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <!-- Image -->
                <img src="{{ asset('foto/' . $item->foto) }}" alt="{{ $item->nama_donasi }}">

                <!-- Status Badges -->
                <div class="status-badges">
                    <span class="badge-approved">
                        <i class="bi bi-check-circle-fill"></i> Disetujui
                    </span>
                    @if($item->status_request != 'Terpenuhi')
                    <span class="badge-unfulfilled">
                        <i class="bi bi-hourglass-split"></i> Belum Terpenuhi
                    </span>
                    @endif
                </div>

                <!-- Title -->
                <h4>{{ $item->nama_donasi }}</h4>

                <!-- Info Grid -->
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-item-icon">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="info-item-content">
                            <div class="info-item-label">Pengaju</div>
                            <div class="info-item-value">{{ $item->username ?? 'Anonim' }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-item-icon">
                            <i class="bi bi-tag-fill"></i>
                        </div>
                        <div class="info-item-content">
                            <div class="info-item-label">Jenis Barang</div>
                            <div class="info-item-value">{{ $item->jenis_barang ?? 'Tidak Diketahui' }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-item-icon">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>
                        <div class="info-item-content">
                            <div class="info-item-label">Jumlah</div>
                            <div class="info-item-value">{{ $item->jumlah_barang ?? 0 }} unit</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-item-icon">
                            <i class="bi bi-calendar-event-fill"></i>
                        </div>
                        <div class="info-item-content">
                            <div class="info-item-label">Tanggal Upload</div>
                            <div class="info-item-value">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="description-section">
                    <div class="description-title">
                        <i class="bi bi-file-text-fill"></i>
                        Deskripsi Kebutuhan
                    </div>
                    <p class="description-text">{{ $item->deskripsi ?? 'lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim ad minim veniam quis apa ya lagi tambahaaan' }}</p>
                </div>

                <!-- Action Buttons (Only for Owner) -->
                @auth('pengguna')
                    @if($item->username === auth()->user()->username)
                    <div class="action-buttons">
                        <a href="{{ route('donasi.edit', $item->id_donasi) }}" class="btn-edit-request">
                            <i class="bi bi-pencil-fill"></i> Edit Request
                        </a>
                        <form action="{{ route('donasi.destroy', $item->id_donasi) }}" method="POST" 
                            style="flex: 1; margin: 0;"
                            onsubmit="return confirm('Yakin ingin menghapus donasi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete-request" style="width: 100%;">
                                <i class="bi bi-trash-fill"></i> Hapus Request
                            </button>
                        </form>
                    </div>
                    @endif
                @endauth

                <!-- Info Box -->
                <div class="info-donation-box">
                    <div class="info-donation-title">
                        <i class="bi bi-info-circle-fill"></i>
                        Informasi Donasi
                    </div>
                    <p class="info-donation-text">
                        Untuk melakukan donasi sesuai request ini, silakan hubungi admin melalui WhatsApp:
                    </p>
                    @if($item->nomor_telepon)
                    <a href="https://wa.me/{{ $item->nomor_telepon }}?text=Halo,%20saya%20tertarik%20dengan%20donasi%20{{ urlencode($item->nama_donasi) }}" 
                       target="_blank" 
                       class="btn-contact-admin">
                        <i class="bi bi-whatsapp"></i> Hubungi Pengirim
                    </a>
                    @endif
                </div>
            </div>

             <!-- ===================== COMMENTS SECTION ===================== -->
                        <div class="comments-section">
                            <div class="comments-header">
                                <i class="bi bi-chat-left-text-fill"></i>
                                <h5>Komentar & Diskusi</h5>
                            </div>
                            <p class="comments-subtitle">Diskusikan lebih lanjut tentang donasi ini</p>

                            <!-- Comment Form (Only for authenticated users) -->
                            @auth('pengguna')
                            <form action="{{ route('komentar.store', $item->id_donasi) }}" method="POST" class="comment-form">
                                @csrf
                                <div class="comment-input-wrapper">
                                    <div class="comment-user-avatar">
                                        <img src="{{ auth('pengguna')->user()->avatar ? asset(auth('pengguna')->user()->avatar) : asset('images/default-avatar.jpg') }}"
                                            alt="{{ auth('pengguna')->user()->username }}" class="rounded-full w-10 h-10 object-cover">
                                    </div>

                                    <div class="comment-input-container">
                                        <textarea 
                                            name="isi_komentar" 
                                            class="comment-textarea" 
                                            placeholder="Tulis komentar atau pertanyaan Anda..." 
                                            required
                                            minlength="3"
                                            maxlength="500"></textarea>
                                        <div class="comment-actions">
                                            <button type="submit" class="btn-comment-submit">
                                                <i class="bi bi-send-fill"></i>
                                                Kirim Komentar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @else
                            <div class="comment-form">
                                <p style="text-align: center; color: #6B7280; margin: 0; font-size: 14px;">
                                    <i class="bi bi-lock-fill"></i> 
                                    Silakan <a href="{{ route('login') }}" style="color: #3B82F6; font-weight: 600;">login</a> untuk memberikan komentar
                                </p>
                            </div>
                            @endauth

                            <!-- Comments List -->
                            <div class="comments-list">
                                @foreach ($item->komentar()->whereNull('id_parent')->with('user', 'replies.user')->get() as $komen)
                                    <div class="comment-item">
                                        <div class="comment-header-info">
                                            <div class="comment-user-avatar">
                                                <img src="{{ $komen->user && $komen->user->avatar ? asset($komen->user->avatar) : asset('images/default-avatar.jpg') }}"
                                                    alt="{{ $komen->user->username ?? 'User' }}" class="rounded-full w-10 h-10 object-cover">

                                            </div>
                                            <div class="comment-user-info">
                                                <div class="comment-username">{{ $komen->user->username }}</div>
                                                @if($komen->user->is_admin)
                                                    <span class="badge-admin">ADMIN</span>
                                                @endif
                                            </div>
                                            <div class="comment-time">{{ $komen->created_at->diffForHumans() }}</div>
                                        </div>
                                        <p class="comment-content" id="comment-text-{{ $komen->id_komentar }}">
                                            {{ $komen->isi_komentar }}
                                        </p>

                                        <!-- Inline Edit Form (hidden by default) -->
                                        <div class="comment-edit-form" id="edit-form-{{ $komen->id_komentar }}" style="display:none; margin-top:10px;">
                                            <textarea id="edit-textarea-{{ $komen->id_komentar }}" 
                                                    class="comment-textarea"
                                                    style="width:100%; min-height:70px;">{{ $komen->isi_komentar }}</textarea>

                                            <div style="margin-top:8px; display:flex; gap:10px;">
                                                <button class="btn-save-edit" data-id="{{ $komen->id_komentar }}"
                                                    style="background:#059669; color:white; border:none; padding:5px 12px; border-radius:6px;">
                                                    Simpan
                                                </button>

                                                <button class="btn-cancel-edit" data-id="{{ $komen->id_komentar }}"
                                                    style="background:#9CA3AF; color:white; border:none; padding:5px 12px; border-radius:6px;">
                                                    Batal
                                                </button>
                                            </div>
                                        </div>

                                        <div class="comment-actions-buttons">
                                            @auth('pengguna')
                                            <!-- Tombol balas -->
                                            <button class="comment-action-btn btn-reply" data-comment-id="{{ $komen->id_komentar }}">
                                                <i class="bi bi-reply-fill"></i> Balas
                                            </button>

                                            <!-- Hanya tampil jika pemilik komentar -->
                                            @if ($komen->id_akun == auth('pengguna')->id())
                                                <!-- Tombol edit -->
                                                <button class="comment-action-btn btn-edit" data-comment-id="{{ $komen->id_komentar }}">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>

                                                <!-- Tombol hapus -->
                                                <form action="{{ route('komentar.destroy', $komen->id_komentar) }}"
                                                    method="POST"
                                                    style="display:inline-block;"
                                                    onsubmit="return confirm('Yakin ingin menghapus komentar ini?');">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="comment-action-btn btn-delete">
                                                        <i class="bi bi-trash-fill"></i> Hapus
                                                    </button>
                                                </form>
                                                @endif
                                            @endauth
                                        </div>

                                        {{-- Tampilkan balasan --}}
                                        @foreach ($komen->replies as $reply)
                                            <div class="comment-item" style="margin-left: 40px;">
                                                <div class="comment-header-info">
                                                    <div class="comment-avatar">
                                                        <img src="{{ $reply->user->avatar ? asset($reply->user->avatar) : asset('images/default-avatar.jpg') }}" 
                                                        alt="{{ $reply->user->username }}" class="rounded-full w-10 h-10 object-cover">
                                                    </div>
                                                    <div class="comment-user-info">
                                                        <div class="comment-username">{{ $reply->user->username }}</div>
                                                        @if($reply->user->is_admin)
                                                            <span class="badge-admin">ADMIN</span>
                                                        @endif
                                                    </div>
                                                    <div class="comment-time">{{ $reply->created_at->diffForHumans() }}</div>
                                                </div>
                                                <p class="comment-content">{{ $reply->isi_komentar }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- ===================== END COMMENTS SECTION ===================== -->

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>
        @endforeach
    </div>
    @endif
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- Reply Comment Script --}}
<script>
/* ============================================================
   ========== HANDLING BALAS KOMENTAR (REPLY FORM) ============
   ============================================================ */
document.querySelectorAll('.btn-reply').forEach(btn => {
    btn.addEventListener('click', () => {
        const commentId = btn.dataset.commentId;

        // cek apakah form reply sudah ada
        if (!document.getElementById('reply-form-' + commentId)) {
            const form = document.createElement('form');
            form.id = 'reply-form-' + commentId;
            form.action = '{{ route("komentar.store", $item->id_donasi) }}';
            form.method = 'POST';
            form.innerHTML = `
                @csrf
                <input type="hidden" name="id_parent" value="${commentId}">
                <textarea name="isi_komentar" class="comment-textarea" placeholder="Tulis balasan..." required></textarea>
                <div class="comment-actions">
                    <button type="submit" class="btn-comment-submit">
                        <i class="bi bi-send-fill"></i> Kirim Balasan
                    </button>
                </div>
            `;
            btn.parentElement.appendChild(form);

            // Fokus ke textarea setelah dibuat
            form.querySelector('textarea').focus();
        }
    });
});



/* ============================================================
   ========== HANDLING EDIT KOMENTAR (INLINE EDIT) ============
   ============================================================ */
document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.commentId;

        // elemen tampilan komentar
        const commentText = document.getElementById('comment-text-' + id);
        // elemen form edit
        const editForm = document.getElementById('edit-form-' + id);

        // tampilkan form edit + sembunyikan teks
        commentText.style.display = "none";
        editForm.style.display = "block";
    });
});

// tombol batal edit
document.querySelectorAll('.btn-cancel-edit').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;

        const commentText = document.getElementById('comment-text-' + id);
        const editForm = document.getElementById('edit-form-' + id);

        // sembunyikan form edit + tampilkan teks kembali
        editForm.style.display = "none";
        commentText.style.display = "block";
    });
});

// tombol simpan edit
document.querySelectorAll('.btn-save-edit').forEach(btn => {
    btn.addEventListener('click', async () => {
        const id = btn.dataset.id;
        const textarea = document.getElementById('edit-textarea-' + id);
        const newContent = textarea.value;

        // kirim AJAX PUT request
        const response = await fetch(`/komentar/${id}`, {
            method: 'PUT',
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                isi_komentar: newContent
            })
        });

        if (response.ok) {
            // update teks di UI tanpa reload
            const commentText = document.getElementById('comment-text-' + id);
            commentText.textContent = newContent;

            // sembunyikan editor
            document.getElementById('edit-form-' + id).style.display = "none";
            commentText.style.display = "block";
        } else {
            alert("Gagal menyimpan perubahan.");
        }
    });
});
</script>
@endsection