@extends('home.navbar')

@section('title', 'Pilih Jenis Donasi')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"/>

<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 80px 0;
    color: white;
    text-align: center;
}

.hero-section h1 {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 20px;
}

.hero-section p {
    font-size: 18px;
    opacity: 0.9;
}

.card-container {
    max-width: 1000px;
    margin: -60px auto 80px;
    padding: 0 20px;
}

.donation-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    text-align: center;
    height: 100%;
    border: 3px solid transparent;
}

.donation-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 50px rgba(0,0,0,0.15);
    border-color: #667eea;
}

.donation-card .icon {
    font-size: 64px;
    color: #667eea;
    margin-bottom: 20px;
}

.donation-card h3 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #1F2937;
}

.donation-card p {
    font-size: 16px;
    color: #6B7280;
    margin-bottom: 25px;
    line-height: 1.6;
}

.donation-card .btn-pilih {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 14px 32px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 16px;
    border: none;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.donation-card .btn-pilih:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
}

.info-section {
    background: #F9FAFB;
    padding: 60px 20px;
    text-align: center;
}

.info-section h2 {
    font-size: 32px;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 20px;
}

.info-section p {
    font-size: 16px;
    color: #6B7280;
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.8;
}
</style>

<div class="hero-section">
    <h1>🎁 Mulai Berbagi Kebaikan</h1>
    <p>Pilih jenis donasi yang ingin Anda salurkan untuk membantu mereka yang membutuhkan</p>
</div>

<div class="card-container">
    <div class="row g-4">
        {{-- Card Donasi Barang --}}
        <div class="col-md-6">
            <div class="donation-card">
                <div class="icon">
                    <i class="bi bi-box-seam-fill"></i>
                </div>
                <h3>Donasi Barang</h3>
                <p>Salurkan barang layak pakai seperti pakaian, alat rumah tangga, alat tulis, atau sembako untuk membantu mereka yang membutuhkan.</p>
                <a href="{{ route('donasi.barang.create') }}" class="btn-pilih">
                    <i class="bi bi-plus-circle me-2"></i>Pilih Donasi Barang
                </a>
            </div>
        </div>

        {{-- Card Donasi Uang --}}
        <div class="col-md-6">
            <div class="donation-card">
                <div class="icon">
                    <i class="bi bi-cash-coin"></i>
                </div>
                <h3>Donasi Uang</h3>
                <p>Berikan bantuan dalam bentuk uang tunai yang akan disalurkan langsung kepada yang membutuhkan melalui sistem yang transparan.</p>
                <a href="{{ route('donasi.uang.create') }}" class="btn-pilih">
                    <i class="bi bi-plus-circle me-2"></i>Pilih Donasi Uang
                </a>
            </div>
        </div>
    </div>
</div>

<div class="info-section">
    <h2>💡 Mengapa Berdonasi di Platform Kami?</h2>
    <p>
        Setiap donasi yang Anda berikan akan melalui proses verifikasi oleh admin kami untuk memastikan penyaluran yang tepat sasaran. 
        Anda juga dapat melacak status donasi Anda secara real-time dan melihat dampak nyata dari kontribusi Anda.
    </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection