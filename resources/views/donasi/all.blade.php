@extends('home.navbar')

@section('title', 'Daftar Request Donasi')

@section('content')
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
/>
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
  rel="stylesheet"
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
    display:flex;
    flex-direction: column;
}

.donation-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 22px rgba(0,0,0,0.12);
}

.card-image-wrapper {
    position: relative;
    overflow: hidden;
    height: 190px;
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
.card-content { padding: 15px 20px; }

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
    justify-content: space-between;
}

.btn-detail {
    background: #3B82F6;
    color: white;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: .3s;
}

.btn-detail:hover { opacity:.9; }

/* ====== MODAL FIX ====== */
.modal.show {
    display: flex !important;
    align-items: center;
    justify-content: center;
}

.modal-dialog {
    margin: 0 auto;
    transform: none !important;
    animation: zoomIn .3s ease;
}

@keyframes zoomIn {
  from { transform: scale(0.9); opacity: 0; }
  to { transform: scale(1); opacity: 1; }
}

.modal-backdrop.show {
    opacity: 0.6;
}

/* RESPONSIVE */
@media (max-width:1200px){
    .donation-grid { grid-template-columns: repeat(3,1fr); }
}
@media (max-width:900px){
    .donation-grid { grid-template-columns: repeat(2,1fr); }
}
@media (max-width:600px){
    .donation-grid { grid-template-columns: repeat(1,1fr); }
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
                    <span><i class="bi bi-heart-fill text-danger"></i> +{{ $item->total_likes ?? 0 }}</span>
                    <button type="button" class="btn-detail" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id_donasi }}">
                        Detail
                    </button>
                </div>
            </div>
        </div>

        <!-- MODAL DETAIL -->
        <div class="modal fade" id="detailModal{{ $item->id_donasi }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $item->id_donasi }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-3xl shadow-lg border-0">

                    <div class="modal-header bg-primary text-white rounded-top">
                        <h5 class="modal-title" id="detailModalLabel{{ $item->id_donasi }}">
                            Detail Donasi - {{ $item->nama_donasi }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body bg-light">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <img src="{{ asset('foto/' . $item->foto) }}" alt="{{ $item->nama_donasi }}" class="img-fluid rounded">
                            </div>
                            <div class="col-md-6">
                                <h4 class="fw-bold">{{ $item->nama_donasi }}</h4>
                                <p><i class="bi bi-tags-fill text-primary"></i> {{ $item->jenis_barang }}</p>
                                <p><i class="bi bi-box-seam text-primary"></i> {{ $item->jumlah_barang }}</p>
                                <p><i class="bi bi-calendar-event text-primary"></i> {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</p>
                                <p><i class="bi bi-telephone text-success"></i> {{ $item->nomor_telepon ?? 'Tidak tersedia' }}</p>
                                <hr>
                                <p>{{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

                                @if($item->nomor_telepon)
                                <a href="https://wa.me/{{ $item->nomor_telepon }}?text=Halo,%20saya%20tertarik%20dengan%20donasi%20{{ urlencode($item->nama_donasi) }}" 
                                target="_blank" class="btn btn-success mt-2">
                                    <i class="bi bi-whatsapp"></i> Hubungi via WhatsApp
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-white d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        
                        {{-- Tombol Edit/Hapus hanya muncul jika donasi milik user yang login --}}
                        @auth('pengguna')
                            @if($item->username === auth()->user()->username)
                            <div class="d-flex gap-2">
                                <a href="{{ route('donasi.edit', $item->id_donasi) }}" class="btn btn-warning text-white">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('donasi.destroy', $item->id_donasi) }}" method="POST" 
                                    onsubmit="return confirm('Yakin ingin menghapus donasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger font-medium">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                            @endif
                        @endauth
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
@endsection
