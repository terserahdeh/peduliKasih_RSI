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
                    <a href="#" class="px-6 py-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition shadow-lg">
                        Mulai Donasi Sekarang
                    </a>
                    @endguest

                    @guest
                    <a href="javascript:void(0);" onclick="showLoginAlert()" class="px-6 py-3 bg-white text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition border border-gray-300">
                        Request Bantuan
                    </a>
                    @else
                    <a href="#" class="px-6 py-3 bg-white text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition border border-gray-300">
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Donasi Terbaru</h2>
            <p class="text-gray-600">Lihat bagaimana kebaikan Anda dan hati mereka menciptakan perubahan nyata</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            {{-- Loop Donasi Terbaru --}}
            @forelse ($latestDonations as $donation)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition">
                <div class="relative h-48 bg-gradient-to-br from-blue-400 to-blue-600">
                    <img src="{{ asset('storage/' . $donation->image) }}" alt="{{ $donation->title }}" class="w-full h-full object-cover" onerror="this.style.display='none'">
                    <div class="absolute top-3 left-3 bg-orange-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                        {{ $donation->category_name ?? 'Umum' }}
                    </div>
                </div>
                <div class="p-5">
                    <span class="text-xs text-gray-500">{{ $donation->created_at->format('F d, Y') }}</span>
                    <h3 class="text-lg font-bold text-gray-900 mt-2 mb-3">{{ $donation->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($donation->description, 70) }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">
                            <i class="fas fa-clock mr-1"></i> {{ $donation->created_at->diffForHumans() }}
                        </span>

                        @guest
                        <a href="javascript:void(0);" onclick="showLoginAlert()" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                            Lihat Detail
                        </a>
                        @else
                        <a href="#" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                            Lihat Detail
                        </a>
                        @endguest
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-8 text-gray-500">
                Belum ada donasi terbaru saat ini. Jadilah yang pertama!
            </div>
            @endforelse
        </div>
        
        <div class="text-center">
<<<<<<< HEAD
            <a href="{{ route('donasi.index') }}" class="inline-block px-6 py-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition">
=======
            @guest
            <a href="javascript:void(0);" onclick="showLoginAlert()" class="inline-block px-6 py-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition">
                Lihat Semua Donasi
                </a>
            @else
            <a href="#" class="inline-block px-6 py-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition">
>>>>>>> a23f29b33db9e82ced0eafd3152939e96cd75095
                Lihat Semua Donasi
            </a>
            @endguest
        </div>
    </div>
</section>


<section class="py-16 bg-white">
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

<section class="py-16 bg-white">
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