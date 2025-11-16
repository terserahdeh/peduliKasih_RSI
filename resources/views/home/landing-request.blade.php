@extends('home.navbar')

@section('title', 'Request Donasi')

@section('content')
<!-- Full Page with Gradient Background -->
<div class="bg-gradient-to-b from-blue-50 to-white min-h-screen">
    <!-- Hero Section -->
    <div class="py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                <!-- Left Content -->
                <div class="lg:w-1/2">
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-800 mb-4">
                        Jembatani kepedulian, 
                        <span class="text-blue-500">untuk kebutuhan anda</span>
                    </h1>
                    <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                        Request Donasi Anda di sini, untuk menjadi jembatan yang membawa kehangatan dan pertolongan dari ribuan hati yang peduli.
                    </p>
                    
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('request-donasi.create') }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition inline-flex items-center shadow-md">
                            <i class="fas fa-plus mr-2"></i>
                            Ajukan Request Donasi
                        </a>
                        <a href="{{ route('request-donasi.status') }}" 
                           class="bg-white hover:bg-gray-50 text-blue-500 border-2 border-blue-500 px-6 py-3 rounded-lg font-semibold transition inline-flex items-center shadow-md">
                            <i class="fas fa-list mr-2"></i>
                            Lihat Status Pengajuan
                        </a>
                    </div>
                </div>
                
                <!-- Right Image -->
                <div class="lg:w-1/2 flex justify-center">
                    <img src="{{ asset('images/request-illustration.png') }}" 
                         alt="Request Donasi" 
                         class="w-full max-w-md rounded-2xl"
                         onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22300%22%3E%3Crect fill=%22%23ddd%22 width=%22400%22 height=%22300%22/%3E%3Ctext fill=%22%23999%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 font-size=%2220%22%3EIllustration%3C/text%3E%3C/svg%3E'">
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Request Donasi Section -->
    <div class="py-12">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-800 mb-3">Daftar Request Donasi</h2>
                <p class="text-gray-600 mb-2">Berikut daftar permintaan donasi yang telah diverifikasi oleh admin.</p>
                <p class="text-blue-500 font-medium">
                    Hubungi admin untuk melakukan donasi sesuai request - 
                    <a href="https://wa.me/082998252532" target="_blank" class="underline hover:text-blue-700 transition">
                        082998252532
                    </a>
                </p>
            </div>

            @php
                // Ambil semua request yang sudah disetujui
                $previewRequests = \App\Models\RequestDonasi::with('pengguna')
                ->withCount('upvote')
                ->where('hasil_verif', 'disetujui')
                ->orderByRaw('CASE WHEN upvote_count = 0 THEN 1 ELSE 0 END') // Upvote >0 dulu
                ->orderBy('upvote_count', 'desc') // lalu sort by jumlah upvote
                ->orderBy('tanggal_upload', 'desc') // kalau upvote 0, urutkan by tanggal
                ->get();
            @endphp

            @if($previewRequests->count() > 0)
                <!-- Horizontal Scrollable Cards Container -->
                <div class="relative">
                    <div id="cardsContainer" class="flex gap-6 overflow-x-auto pb-4 snap-x snap-mandatory scrollbar-hide" style="scroll-behavior: smooth;">
                        @foreach($previewRequests as $req)
                            <div class="flex-shrink-0 w-80 snap-start">
                                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 h-full">
                                    <!-- Image with Badges -->
                                    <div class="relative">
                                        @if($req->foto)
                                            <img src="{{ Storage::url($req->foto) }}" 
                                                 alt="{{ $req->nama_request }}" 
                                                 class="w-full h-48 object-cover">
                                        @else
                                            <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                                <i class="fas fa-image text-gray-400 text-5xl"></i>
                                            </div>
                                        @endif

                                        <!-- Status Badge -->
                                        <div class="absolute top-3 right-3">
                                            @if($req->status_request === 'terpenuhi')
                                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center">
                                                    <i class="fas fa-check mr-1"></i> Terpenuhi
                                                </span>
                                            @else
                                                <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center">
                                                    <i class="fas fa-clock mr-1"></i> Belum Terpenuhi
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Card Content -->
                                    <div class="p-5">
                                        <h3 class="font-bold text-lg text-gray-800 mb-3 line-clamp-2">{{ $req->nama_request }}</h3>
                                        
                                        <!-- Info List -->
                                        <div class="space-y-2 mb-4">
                                            <div class="flex items-center text-gray-600 text-sm">
                                                <i class="fas fa-tag text-blue-500 mr-2 w-4"></i>
                                                <span class="capitalize">{{ str_replace('-', ' ', $req->jenis_barang) }}</span>
                                            </div>
                                            @if($req->jumlah_barang)
                                                <div class="flex items-center text-gray-600 text-sm">
                                                    <i class="fas fa-cube text-blue-500 mr-2 w-4"></i>
                                                    <span>{{ $req->jumlah_barang }} unit</span>
                                                </div>
                                            @endif
                                            <div class="flex items-center text-gray-600 text-sm">
                                                <i class="fas fa-calendar text-blue-500 mr-2 w-4"></i>
                                                <span>{{ \Carbon\Carbon::parse($req->tanggal_upload)->format('d M Y') }}</span>
                                            </div>
                                        </div>

                                        <!-- Action Button -->
                                        <button onclick="showDetail({{ $req->id_request }})" 
                                                class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2.5 rounded-lg font-semibold transition flex items-center justify-center">
                                            <i class="fas fa-eye mr-2"></i>
                                            Lihat Detail
                                        </button>

                                        <!-- Progress Bar -->
                                        <div class="flex items-center text-sm text-gray-600 mb-1 space-x-2">
                                            @php
                                                $hasUpvoted = $req->upvote->contains('username', Auth::user()->username ?? '');
                                                $count = $req->upvote->count();
                                            @endphp

                                            <button 
                                                id="heart-btn-{{ $req->id_request }}"
                                                onclick="toggleUpvote({{ $req->id_request }})"
                                                class="flex items-center gap-2 focus:outline-none transition"
                                            >
                                                <i id="heart-icon-{{ $req->id_request }}"
                                                class="fas fa-heart text-xl transition-all duration-300 {{ $hasUpvoted ? 'text-red-500 scale-110' : 'text-gray-400 hover:text-red-400' }}">
                                                </i>
                                                <span id="upvote-count-{{ $req->id_request }}" class="font-semibold text-gray-700">
                                                    +{{ $count }}
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Scroll Indicators (Optional) -->
                    @if($previewRequests->count() > 3)
                        <button onclick="scrollCards('left')" class="hidden lg:block absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-white rounded-full shadow-lg p-3 hover:bg-gray-100 transition z-10">
                            <i class="fas fa-chevron-left text-gray-600"></i>
                        </button>
                        <button onclick="scrollCards('right')" class="hidden lg:block absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-white rounded-full shadow-lg p-3 hover:bg-gray-100 transition z-10">
                            <i class="fas fa-chevron-right text-gray-600"></i>
                        </button>
                    @endif
                </div>

                <!-- View All Button -->
                <div class="text-center mt-10">
                    <a href="{{ route('request-donasi.index') }}" 
                       class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold transition shadow-md">
                        Lihat Semua Request Donasi
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            @else
                <div class="text-center py-20">
                    <i class="fas fa-inbox text-gray-300 text-7xl mb-4"></i>
                    <p class="text-gray-500 text-lg font-medium">Belum ada request donasi yang disetujui.</p>
                    <p class="text-gray-400 mt-2">Jadilah yang pertama mengajukan request!</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" style="backdrop-filter: blur(4px);">
    <div class="bg-white rounded-xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6" id="modalContent">
            <div class="text-center py-8">
                <i class="fas fa-spinner fa-spin text-4xl text-blue-500"></i>
                <p class="text-gray-600 mt-4">Memuat detail...</p>
            </div>
        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="deleteForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>
</main>
@endsection

@push('styles')
<style>
    /* Hide scrollbar but keep functionality */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endpush

@push('scripts')
<script>
function showDetail(id) {
    const modal = document.getElementById('detailModal');
    const modalContent = document.getElementById('modalContent');
    
    modal.classList.remove('hidden');
    modalContent.innerHTML = `
        <div class="text-center py-8">
            <i class="fas fa-spinner fa-spin text-4xl text-blue-500"></i>
            <p class="text-gray-600 mt-4">Memuat detail...</p>
        </div>
    `;
    
    fetch(`/request-donasi/${id}`)
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const content = doc.querySelector('#detailContent');
            if(content){
                modalContent.innerHTML = content.innerHTML;
            }
        })
        .catch(error => console.error('Error:', error));
}

function closeModal() {
    document.getElementById('detailModal').classList.add('hidden');
}

function confirmDelete(id) {
    if(confirm('⚠️ Apakah Anda yakin ingin menghapus request donasi ini?\n\nRequest yang dihapus tidak dapat dikembalikan.')) {
        const form = document.getElementById('deleteForm');
        form.action = `/request-donasi/${id}`;
        form.submit();
    }
}

function scrollCards(direction) {
    const container = document.getElementById('cardsContainer');
    const scrollAmount = 336; // width of card (320px) + gap (16px)
    
    if (direction === 'left') {
        container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    } else {
        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    }
}

// Close on outside click
document.getElementById('detailModal')?.addEventListener('click', function(e) {
    if(e.target === this) closeModal();
});

// Close with ESC key
document.addEventListener('keydown', function(e) {
    if(e.key === 'Escape') closeModal();
});

// Mobile menu toggle
document.getElementById('mobile-menu-button')?.addEventListener('click', () => {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
});
function toggleUpvote(id) {
    const token = '{{ csrf_token() }}';
    const heartIcon = document.getElementById(`heart-icon-${id}`);
    const countSpan = document.getElementById(`upvote-count-${id}`);
    const progressBar = document.getElementById(`progress-${id}`);

    fetch(`/request-donasi/${id}/upvote`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (!data || data.count === undefined) {
            console.error("Response error:", data);
            return;
        }

        // Update count safely
        countSpan.textContent = `+${data.count}`;

        // Update heart style (clicked vs unclicked)
        if (data.status === 'added') {
            heartIcon.classList.remove('text-gray-400', 'hover:text-red-400');
            heartIcon.classList.add('text-red-500');
            heartIcon.style.transform = 'scale(1.2)';
            setTimeout(() => heartIcon.style.transform = 'scale(1)', 200);
        } else {
            heartIcon.classList.remove('text-red-500');
            heartIcon.classList.add('text-gray-400', 'hover:text-red-400');
        }

        // Update progress bar
        const width = Math.min(data.count / 2, 100);
        progressBar.style.width = `${width}%`;
    })
    .catch(err => console.error('Upvote error:', err));
}
</script>
@endpush