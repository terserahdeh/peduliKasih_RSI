@extends('home.navbar')

@section('title', 'Dashboard - Peduli Kasih')

@section('content')
<section class="bg-gradient-to-r from-blue-50 to-orange-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Berbagi Kebaikan,<br>
                    <span class="text-blue-600">Wujudkan Kepedulian</span>
                </h1>
                <p class="text-gray-600 text-lg mb-8">
                    Platform donasi yang memudahkan Anda peduli dengan mereka yang membutuhkan. Mari bersama menciptakan dampak positif untuk sesama.
                </p>
                <div class="flex flex-wrap gap-4">
                    @guest
                    <a href="javascript:void(0);" onclick="showLoginAlert()" class="px-6 py-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition shadow-lg">
                        Mulai Donasi Sekarang
                    </a>
                    @else
                    <a href="{{ route('donasi.index') }}" class="px-6 py-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition shadow-lg">
                        Mulai Donasi Sekarang
                    </a>
                    @endguest

                    @guest
                    <a href="javascript:void(0);" onclick="showLoginAlert()" class="px-6 py-3 bg-white text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition border border-gray-300">
                        Request Bantuan
                    </a>
                    @else
                    <a href="{{ route('request-donasi.landing') }}" class="px-6 py-3 bg-white text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition border border-gray-300">
                        Request Bantuan
                    </a>
                    @endguest
                </div>
            </div>
            
            <div class="relative">
                <div class="bg-gradient-to-br from-orange-400 to-orange-300 rounded-3xl p-8 shadow-2xl">
                    <img src="/images/hero-illustration.svg" alt="Berbagi Kebaikan" class="w-full h-auto" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                    <div class="hidden w-full h-64 items-center justify-center">
                        <i class="fas fa-users text-white text-9xl opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            {{-- Loop $stats: sekarang variabel ini sudah didefinisikan di Controller --}}
            @foreach ($stats as $stat)
            <div class="text-center">
                <div class="w-12 h-12 bg-{{ $stat['color'] }}-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="{{ $stat['icon'] }} text-{{ $stat['color'] }}-600 text-xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">{{ $stat['value'] }}</h3>
                <p class="text-gray-600 text-sm mt-1">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <style>
        /* ====== DONASI TERBARU SECTION STYLING ====== */
        .donasi-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            transition: all 0.3s ease;
            position: relative;
            height: 100%;
        }

        .donasi-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .donasi-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3B82F6, #8B5CF6, #EC4899);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .donasi-card:hover::before {
            opacity: 1;
        }

        .donasi-image-wrapper {
            position: relative;
            height: 240px;
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .donasi-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .donasi-card:hover .donasi-image {
            transform: scale(1.1);
        }

        .donasi-badge {
            position: absolute;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .badge-category {
            top: 12px;
            left: 12px;
            background: rgba(249, 115, 22, 0.95);
            color: white;
        }

        .badge-status {
            top: 12px;
            right: 12px;
            background: rgba(34, 197, 94, 0.95);
            color: white;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .donasi-content {
            padding: 20px;
        }

        .donasi-date {
            font-size: 11px;
            color: #9CA3AF;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            display: block;
        }

        .donasi-title {
            font-size: 18px;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 12px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 50px;
        }

        .donasi-description {
            font-size: 14px;
            color: #6B7280;
            line-height: 1.6;
            margin-bottom: 16px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 44px;
        }

        .donasi-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            padding-top: 16px;
            border-top: 2px solid #F3F4F6;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #4B5563;
        }

        .meta-item i {
            font-size: 14px;
            color: #3B82F6;
        }

        .meta-item.likes i {
            color: #EF4444;
        }

        .meta-item.time {
            margin-left: auto;
            color: #9CA3AF;
            font-size: 12px;
            font-weight: 500;
        }

        .meta-item.time i {
            color: #9CA3AF;
        }

        /* Empty State */
        .empty-state {
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
            border-radius: 20px;
            padding: 60px 40px;
            text-align: center;
        }

        .empty-state-icon {
            font-size: 80px;
            color: #93C5FD;
            margin-bottom: 20px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .empty-state-title {
            font-size: 24px;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 12px;
        }

        .empty-state-text {
            font-size: 15px;
            color: #6B7280;
            margin-bottom: 24px;
        }

        /* Button Styles */
        .btn-view-all {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background: linear-gradient(135deg, #F97316 0%, #EA580C 100%);
            color: white;
            font-weight: 700;
            font-size: 15px;
            border-radius: 12px;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(249, 115, 22, 0.4);
            transition: all 0.3s ease;
        }

        .btn-view-all:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(249, 115, 22, 0.5);
            color: white;
        }

        .btn-view-all i {
            transition: transform 0.3s ease;
        }

        .btn-view-all:hover i {
            transform: translateX(5px);
        }

        .btn-create {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
            color: white;
            font-weight: 600;
            font-size: 14px;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
            color: white;
        }

        /* Section Title Animation */
        .section-title-animated {
            position: relative;
            display: inline-block;
        }

        .section-title-animated::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #3B82F6, #8B5CF6);
            border-radius: 2px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .donasi-image-wrapper {
                height: 200px;
            }
            
            .donasi-title {
                font-size: 16px;
            }
            
            .donasi-meta {
                flex-wrap: wrap;
            }
            
            .meta-item.time {
                margin-left: 0;
                width: 100%;
                justify-content: center;
                padding-top: 8px;
            }
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-3 section-title-animated">
                Donasi Terbaru
            </h2>
            <p class="text-gray-600">Lihat bagaimana kebaikan Anda dan hati mereka menciptakan perubahan nyata</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            {{-- Loop Donasi Terbaru dari Database --}}
            @forelse ($latestDonations as $donation)
            <div class="donasi-card">
                <div class="donasi-image-wrapper">
                    {{-- Gambar donasi dari folder foto --}}
                    <img src="{{ asset('foto/' . $donation->foto) }}" 
                         alt="{{ $donation->nama_donasi }}" 
                         class="donasi-image">
                    
                    {{-- Badge kategori --}}
                    <div class="donasi-badge badge-category">
                        {{ $donation->jenis_barang ?? 'Umum' }}
                    </div>
                    
                    {{-- Badge status --}}
                    @if($donation->status_request == 'Disetujui')
                    <div class="donasi-badge badge-status">
                        <i class="fas fa-check-circle"></i>
                        <span>Disetujui</span>
                    </div>
                    @endif
                </div>
                
                <div class="donasi-content">
                    <span class="donasi-date">
                        {{ \Carbon\Carbon::parse($donation->tanggal_request)->format('F d, Y') }}
                    </span>
                    
                    <h3 class="donasi-title">
                        {{ $donation->nama_donasi }}
                    </h3>
                    
                    <p class="donasi-description">
                        {{ $donation->deskripsi ?? 'Tidak ada deskripsi untuk donasi ini.' }}
                    </p>
                    
                    {{-- Meta Information --}}
                    <div class="donasi-meta">
                        <div class="meta-item">
                            <i class="fas fa-box"></i>
                            <span>{{ $donation->jumlah_barang ?? 0 }} unit</span>
                        </div>
                        <div class="meta-item time">
                            <i class="fas fa-clock"></i>
                            <span>{{ \Carbon\Carbon::parse($donation->created_at)->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="empty-state">
                    <i class="fas fa-box-open empty-state-icon"></i>
                    <h3 class="empty-state-title">Belum Ada Donasi Terbaru</h3>
                    <p class="empty-state-text">Jadilah yang pertama untuk berbagi kebaikan dengan sesama!</p>
                    
                    @auth
                    <a href="{{ route('donasi.create') }}" class="btn-create">
                        <i class="fas fa-plus-circle"></i>
                        Buat Request Donasi
                    </a>
                    @endauth
                </div>
            </div>
            @endforelse
        </div>
        
        <div class="text-center">
            <a href="{{ route('donasi.index') }}" class="btn-view-all">
                <span>Lihat Semua Donasi</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>


<section id = "tipsnedukasi" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Tips & Edukasi</h2>
            <p class="text-gray-600">Pelajari tips dan panduan untuk menjadi donatur yang bijak</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Loop Tips & Edukasi --}}
            @forelse ($tips as $tip)
            <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    {{-- Di sini kita asumsikan Anda memiliki kolom 'icon' atau sesuaikan secara manual --}}
                    <i class="{{ $tip->icon ?? 'fas fa-lightbulb' }} text-blue-600 text-xl"></i>
                </div>
                {{-- [PENTING] Menggunakan nama kolom DATABASE yang benar --}}
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $tip->judul_tipsnedukasi }}</h3>
                <p class="text-gray-600 text-sm mb-4">
                    {{ Str::limit($tip->konten_tipsnedukasi, 100) }}
                </p>
                {{-- [PERBAIKAN ERROR ROUTE NOT FOUND] Mengirimkan Primary Key ke Route --}}
                <a href="{{ route('home.showtipsnedukasi', ['id' => $tip->id_tipsnedukasi]) }}" class="text-blue-600 font-medium text-sm hover:underline inline-flex items-center">
                    Baca Lebih 
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-8 text-gray-500">
                Belum ada tips dan edukasi yang tersedia saat ini.
            </div>
            @endforelse
        </div>
    </div>
</section>

<section id="faq-section" class="py-5 bg-white"> 
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">FAQ</h2>
            <p class="text-gray-600">Proses mudah untuk berbagi dan menerima kebaikan</p>
        </div>
        
        <div id="faqAccordionTailwind">
            
            {{-- PERBAIKAN: Menggunakan $faqs (collection) as $item (item) --}}
            @forelse ($faq as $index => $item) 
            
            @php
                // Logika $isLastItem untuk menentukan item mana yang terbuka default (seperti pada gambar)
                $faqsCollection = collect($faq);
                $isLastItem = ($index == $faqsCollection->count() - 1);
            @endphp
            
            <div class="mb-3 rounded-xl overflow-hidden"> 
                
                {{-- Header (Tombol Pertanyaan) --}}
                <div id="heading{{ $item->id_faq }}">
                    <button class="w-full text-left py-3 px-4 flex justify-between items-center transition duration-300" 
                            style="background-color: #6495ED; color: white; font-weight: 600;"
                            onclick="toggleFaq({{ $item->id_faq }})"
                            aria-expanded="{{ $isLastItem ? 'true' : 'false' }}" 
                            data-faq-id="{{ $item->id_faq }}">
                        
                        {{ $item->question }}
                        
                        {{-- Icon Chevron (Kelas yang menentukan arah) --}}
                        <i id="icon-{{ $item->id_faq }}" 
                           class="fas ml-2 text-sm transition duration-300 {{ $isLastItem ? 'fa-chevron-up' : 'fa-chevron-down' }}">
                        </i>
                    </button>
                </div>

                {{-- Body (Jawaban) --}}
                <div id="content-{{ $item->id_faq }}" 
                     class="px-4 py-3 border border-gray-200 {{ $isLastItem ? '' : 'hidden' }}"
                     style="background-color: #f7f7f7;">
                    
                    <p class="text-gray-600 text-sm">
                        {!! nl2br(e($item->answer)) !!}
                    </p>
                </div>
            </div>
            @empty
            <div class="bg-blue-100 text-blue-800 p-4 rounded-lg text-center">
                Belum ada pertanyaan yang tersedia saat ini.
            </div>
            @endforelse
        </div>
    </div>
</section>

<section id ="panduan" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Cara Kerja Platform</h2>
            <p class="text-gray-600">Proses mudah untuk berbagi dan menerima kebaikan</p>
        </div>
        
        {{-- Konten Cara Kerja Platform yang sudah dikoreksi dan lengkap --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-plus text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">1. Daftar Akun</h3>
                <p class="text-gray-600 text-sm">Buat akun gratis dan bergabung dengan komunitas peduli</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-tasks text-orange-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">2. Post Kebutuhan</h3>
                <p class="text-gray-600 text-sm">Donatur posting kebutuhan atau request buat yang diperlukan</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check-double text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">3. Verifikasi</h3>
                <p class="text-gray-600 text-sm">Tim kami memverifikasi donasi dan kecocokan kebutuhan</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-handshake text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">4. Berbagi</h3>
                <p class="text-gray-600 text-sm">Donasi terdistribusi kepada yang membutuhkan</p>
            </div>
        </div>
    </div>
</section>

@endsection

@section('extra-js')
<script>
// Fungsi untuk toggle FAQ accordion
function toggleFaq(id) {
    const content = document.getElementById(`content-${id}`);
    const icon = document.getElementById(`icon-${id}`);

    // Tutup semua accordion lain
    document.querySelectorAll('[id^="content-"]').forEach(item => {
        const itemId = item.id.replace('content-', '');
        if (itemId != id) {
            item.classList.add('hidden');
            const itemIcon = document.getElementById(`icon-${itemId}`);
            if (itemIcon) {
                itemIcon.classList.remove('fa-chevron-up');
                itemIcon.classList.add('fa-chevron-down');
            }
        }
    });

    // Toggle item yang diklik
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
    } else {
        content.classList.add('hidden');
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
    }
}
</script>
@endsection