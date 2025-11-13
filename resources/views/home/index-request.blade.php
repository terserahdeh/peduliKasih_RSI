@extends('home.navbar')

@section('title', 'Request Donasi Full')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-br from-blue-50 via-blue-50 to-white py-16 lg:py-20">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
            <!-- Left Content -->
            <div class="lg:w-1/2 space-y-6">
                <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 leading-tight">
                    Jembatani kepedulian, 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-400">untuk kebutuhan anda</span>
                </h1>
                <p class="text-gray-600 text-lg lg:text-xl leading-relaxed">
                    Request Donasi Anda di sini, untuk menjadi jembatan yang membawa kehangatan dan pertolongan dari ribuan hati yang peduli.
                </p>
                
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="{{ route('request-donasi.create') }}" 
                       class="bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white px-8 py-4 rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl inline-flex items-center transform hover:scale-105">
                        <i class="fas fa-plus mr-2"></i>
                        Ajukan Request Donasi
                    </a>
                    <a href="{{ route('request-donasi.status') }}" 
                       class="bg-white hover:bg-gray-50 text-blue-600 border-2 border-blue-500 px-8 py-4 rounded-xl font-semibold transition-all shadow-md hover:shadow-lg inline-flex items-center">
                        <i class="fas fa-list mr-2"></i>
                        Lihat Status Pengajuan
                    </a>
                </div>
            </div>
            
            <!-- Right Image -->
            <div class="lg:w-1/2 flex justify-center">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-blue-600 rounded-3xl blur-3xl opacity-20"></div>
                    <img src="{{ asset('images/request-illustration.png') }}" 
                         alt="Request Donasi" 
                         class="relative w-full max-w-lg rounded-3xl shadow-2xl"
                         onerror="this.style.display='none'">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Daftar Request Donasi Section -->
<div class="bg-white py-16 lg:py-20">
    <div class="container mx-auto px-4 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Daftar Request Donasi</h2>
            <p class="text-gray-600 text-lg mb-3">Berikut daftar permintaan donasi yang telah diverifikasi oleh admin.</p>
            <p class="text-blue-600 font-medium text-lg">
                Hubungi admin untuk melakukan donasi sesuai request - 
                <a href="https://wa.me/082998252532" target="_blank" class="underline hover:text-blue-700 transition inline-flex items-center">
                    <i class="fab fa-whatsapp mr-1"></i> 082998252532
                </a>
            </p>
        </div>

        @if(session('success'))
            <div class="mb-8 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl flex items-center max-w-4xl mx-auto shadow-sm">
                <i class="fas fa-check-circle mr-3 text-xl"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Request Cards Grid -->
        <div id="cardsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @forelse($requests as $req)
                <div class="request-card bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <!-- Image with Badges -->
                    <div class="relative h-52">
                        @if($req->foto)
                            <img src="{{ Storage::url($req->foto) }}" 
                                 alt="{{ $req->nama_request }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                <i class="fas fa-image text-gray-400 text-5xl"></i>
                            </div>
                        @endif

                        <!-- Status Badge -->
                        <div class="absolute top-3 right-3">
                            @if($req->status_request === 'terpenuhi')
                                <span class="bg-green-500 text-white px-3 py-1.5 rounded-full text-xs font-bold flex items-center shadow-lg">
                                    <i class="fas fa-check mr-1"></i> Terpenuhi
                                </span>
                            @else
                                <span class="bg-orange-500 text-white px-3 py-1.5 rounded-full text-xs font-bold flex items-center shadow-lg">
                                    <i class="fas fa-clock mr-1"></i> Belum Terpenuhi
                                </span>
                            @endif
                        </div>

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </div>

                    <!-- Card Content -->
                    <div class="p-6">
                        <h3 class="font-bold text-xl text-gray-900 mb-4 line-clamp-2 min-h-[3.5rem]">{{ $req->nama_request }}</h3>
                        
                        <!-- Info List -->
                        <div class="space-y-2.5 mb-5">
                            <div class="flex items-center text-gray-600 text-sm">
                                <i class="fas fa-tag text-blue-500 mr-3 w-4"></i>
                                <span class="capitalize">{{ str_replace('-', ' ', $req->jenis_barang) }}</span>
                            </div>
                            @if($req->jumlah_barang)
                                <div class="flex items-center text-gray-600 text-sm">
                                    <i class="fas fa-cube text-blue-500 mr-3 w-4"></i>
                                    <span>{{ $req->jumlah_barang }} {{ ucfirst(explode(' ', $req->jenis_barang)[0]) }}</span>
                                </div>
                            @endif
                            <div class="flex items-center text-gray-600 text-sm">
                                <i class="fas fa-calendar text-blue-500 mr-3 w-4"></i>
                                <span>{{ \Carbon\Carbon::parse($req->tanggal_upload)->format('d M Y') }}</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-2.5">
                            <!-- Lihat Detail Button -->
                            <button onclick="showDetail({{ $req->id_request }})" 
                                    class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white py-3 rounded-xl font-semibold transition-all shadow-md hover:shadow-lg flex items-center justify-center">
                                <i class="fas fa-eye mr-2"></i>
                                Lihat Detail
                            </button>

                            <!-- Edit & Hapus Buttons (Owner Only) -->
                            @if(Auth::check() && Auth::user()->username === $req->username)
                                <div class="flex gap-2.5">
                                    <a href="{{ route('request-donasi.edit', $req->id_request) }}" 
                                       class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white py-2.5 rounded-lg font-medium transition-all text-center flex items-center justify-center text-sm shadow-md">
                                        <i class="fas fa-edit mr-1"></i>
                                        Edit
                                    </a>
                                    <button onclick="confirmDelete({{ $req->id_request }})" 
                                            class="flex-1 bg-red-500 hover:bg-red-600 text-white py-2.5 rounded-lg font-medium transition-all flex items-center justify-center text-sm shadow-md">
                                        <i class="fas fa-trash mr-1"></i>
                                        Hapus
                                    </button>
                                </div>
                            @endif
                        </div>

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
            @empty
                <div class="col-span-full text-center py-20">
                    <div class="inline-block p-8 bg-gray-50 rounded-3xl">
                        <i class="fas fa-inbox text-gray-300 text-7xl mb-4"></i>
                        <p class="text-gray-500 text-xl font-semibold">Belum ada request donasi yang disetujui.</p>
                        <p class="text-gray-400 mt-2">Jadilah yang pertama mengajukan request!</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Load More Button -->
        @if($requests->hasMorePages())
            <div class="text-center mt-12">
                <button id="loadMoreBtn" 
                        onclick="loadMore()"
                        class="bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white px-10 py-4 rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl inline-flex items-center transform hover:scale-105">
                    <span id="loadMoreText">Tampilkan Lebih Banyak</span>
                    <i class="fas fa-chevron-down ml-2" id="loadMoreIcon"></i>
                </button>
                <input type="hidden" id="currentPage" value="1">
                <input type="hidden" id="lastPage" value="{{ $requests->lastPage() }}">
            </div>
        @endif
    </div>
</div>

<!-- Modal Detail -->
<div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" style="backdrop-filter: blur(8px);">
    <div class="bg-white rounded-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
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

@push('scripts')
<script>
let isLoading = false;

function loadMore() {
    if (isLoading) return;
    
    const currentPageInput = document.getElementById('currentPage');
    const lastPageInput = document.getElementById('lastPage');
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const loadMoreText = document.getElementById('loadMoreText');
    const loadMoreIcon = document.getElementById('loadMoreIcon');
    
    let currentPage = parseInt(currentPageInput.value);
    const lastPage = parseInt(lastPageInput.value);
    
    if (currentPage >= lastPage) {
        loadMoreBtn.style.display = 'none';
        return;
    }
    
    isLoading = true;
    loadMoreText.textContent = 'Memuat...';
    loadMoreIcon.className = 'fas fa-spinner fa-spin ml-2';
    
    const nextPage = currentPage + 1;
    
    fetch(`{{ route('request-donasi.index') }}?page=${nextPage}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const newCards = doc.querySelectorAll('.request-card');
        const container = document.getElementById('cardsContainer');
        
        newCards.forEach(card => {
            container.appendChild(card);
        });
        
        currentPageInput.value = nextPage;
        
        if (nextPage >= lastPage) {
            loadMoreBtn.style.display = 'none';
        }
        
        isLoading = false;
        loadMoreText.textContent = 'Tampilkan Lebih Banyak';
        loadMoreIcon.className = 'fas fa-chevron-down ml-2';
    })
    .catch(error => {
        console.error('Error:', error);
        isLoading = false;
        loadMoreText.textContent = 'Coba Lagi';
        loadMoreIcon.className = 'fas fa-chevron-down ml-2';
    });
}

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
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
        })
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const content = doc.querySelector('#detailContent');
            if(content){
                modalContent.innerHTML = content.innerHTML;
            } else {
                modalContent.innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-exclamation-triangle text-4xl text-red-500"></i>
                        <p class="text-gray-600 mt-4">Gagal memuat detail</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            modalContent.innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-triangle text-4xl text-red-500"></i>
                    <p class="text-gray-600 mt-4">Terjadi kesalahan saat memuat detail</p>
                </div>
            `;
        });
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

// Close modal handlers
document.getElementById('detailModal')?.addEventListener('click', function(e) {
    if(e.target === this) closeModal();
});

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