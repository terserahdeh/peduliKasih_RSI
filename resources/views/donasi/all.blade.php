@extends('home.navbar')

@section('title', 'Semua Donasi')

@section('content')
<style>
    /* ====== WARNA & GAYA GLOBAL ====== */
    .bg-purple { background-color: #9277EF !important; }
    
    /* ====== HERO SECTION ====== */
    .hero-section {
        background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
        padding: 60px 0;
        margin-bottom: 60px;
    }
    
    .hero-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
    }
    
    .hero-text {
        flex: 1;
    }
    
    .hero-section h1 {
        font-weight: 700;
        color: #1E293B;
        font-size: 42px;
        line-height: 1.3;
        margin-bottom: 24px;
    }
    
    .hero-section h1 .highlight {
        color: #3B82F6;
    }
    
    .hero-btn {
        background-color: #3B82F6;
        border: none;
        padding: 14px 32px;
        font-weight: 600;
        border-radius: 8px;
        color: white;
        transition: 0.3s;
        text-decoration: none;
        display: inline-block;
        font-size: 15px;
    }
    
    .hero-btn:hover {
        background-color: #2563EB;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }
    
    .hero-image {
        flex: 0 0 400px;
        text-align: right;
    }
    
    .hero-image img {
        max-width: 100%;
        height: auto;
    }

    /* ====== SECTION TITLE ====== */
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

    /* ====== LAYOUT 3 KOLOM ====== */
    .donation-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px 80px;
    }
    
    .donation-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }
    
    /* ====== EMPTY STATE ====== */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6B7280;
    }
    
    .empty-state svg {
        width: 120px;
        height: 120px;
        margin-bottom: 20px;
        color: #D1D5DB;
    }
    
    .empty-state h3 {
        font-size: 20px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .empty-state p {
        font-size: 14px;
        margin-bottom: 24px;
    }
    
    @media (max-width: 992px) {
        .hero-content {
            flex-direction: column;
            text-align: center;
        }
        
        .hero-image {
            flex: 0 0 auto;
        }
        
        .donation-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 576px) {
        .hero-section h1 {
            font-size: 32px;
        }
        
        .donation-grid {
            grid-template-columns: 1fr;
        }
    }

    /* ====== CARD DONASI ====== */
    .donation-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .donation-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }
    
    .card-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    
    .card-content {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }
    
    .card-badge {
        font-size: 11px;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 10px;
        display: inline-block;
    }
    
    .badge-sembako {
        background-color: #10B981;
        color: white;
    }
    
    .badge-alat-tulis {
        background-color: #3B82F6;
        color: white;
    }
    
    .badge-pakaian {
        background-color: #9277EF;
        color: white;
    }
    
    .badge-alat-rumah-tangga {
        background-color: #6B7280;
        color: white;
    }
    
    .card-time {
        font-size: 12px;
        color: #9CA3AF;
        font-weight: 400;
    }
    
    .card-title {
        font-weight: 700;
        color: #1F2937;
        font-size: 17px;
        margin-bottom: 10px;
        line-height: 1.4;
    }
    
    .card-description {
        font-size: 13px;
        color: #6B7280;
        line-height: 1.6;
        margin-bottom: 16px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }
    
    .card-location {
        font-size: 13px;
        color: #6B7280;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    .card-location i {
        font-size: 14px;
    }
    
    .btn-detail {
        background-color: #3B82F6;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 600;
        transition: 0.3s;
        display: block;
        width: 100%;
        text-align: center;
        text-decoration: none;
    }
    
    .btn-detail:hover {
        background-color: #2563EB;
        color: white;
        transform: translateY(-2px);
    }

    /* Success Alert */
    .alert-success {
        background-color: #D1FAE5;
        color: #065F46;
        border: 1px solid #6EE7B7;
        padding: 16px 20px;
        border-radius: 8px;
        margin-bottom: 30px;
        font-size: 14px;
    }
</style>

{{-- ================= HERO SECTION ================= --}}
<section class="hero-section">
    <div class="hero-content">
        <div class="hero-text">
            <h1>
                Berbagi Kebaikan,<br>
                <span class="highlight">donasikan barang yang tidak kamu pakai lagi</span>
            </h1>
            <a href="{{ route('donasi.create') }}" class="hero-btn">
                Mulai Donasi Sekarang
            </a>
        </div>
        <div class="hero-image">
            <!-- <img src="{{ asset('images/hero-donasi.png') }}" alt="Hero Image"> -->
        </div>
    </div>
</section>

{{-- ================= SECTION SEMUA DONASI ================= --}}
<div class="donation-container">
    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="section-title">
        <h2>Donasi Terbaru</h2>
        <p>Lihat bagaimana kebaikan terus mengalir setiap hari</p>
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

    {{-- Kartu Donasi dari Database --}}
    @if($donasi->count() > 0)
        <div class="donation-grid">
            @foreach($donasi as $item)
            <div class="donation-card">
                <img src="{{ $item->foto_url}}" class="card-image" alt="{{ $item->judul_donasi }}">
                <div class="card-content">
                    <div class="card-header">
                        <span class="card-badge 
                            @if($item->kategori == 'Sembako') badge-sembako
                            @elseif($item->kategori == 'Alat Tulis') badge-alat-tulis
                            @elseif($item->kategori == 'Pakaian') badge-pakaian
                            @else badge-alat-rumah-tangga
                            @endif">
                            {{ $item->jenis_barang }}
                        </span>
                        <span class="card-time">{{ $item->formatted_date }}</span>
                    </div>

                    <h5 class="card-title">{{ $item->nama_donasi }}</h5>
                    
                    <p class="card-description">
                        {{ $item->deskripsi }}
                    </p>
                    
                    <div class="card-location">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>{{ $item->lokasi }}</span>
                    </div>
                    
                    <a href="#" class="btn-detail">Lihat Detail</a>
                </div>
            </div>
            @endforeach
        </div>
    @else
        {{-- Empty State --}}
        <div class="empty-state">
            <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
            </svg> -->
            <h3>Belum Ada Donasi</h3>
            <p>Belum ada donasi yang tersedia saat ini. Jadilah yang pertama berbagi kebaikan!</p>
            <a href="{{ route('donasi.create') }}" class="hero-btn">
                Mulai Donasi
            </a>
        </div>
    @endif
</div>
@endsection