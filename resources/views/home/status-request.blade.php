@extends('home.navbar')

@section('title', 'Status Request')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold text-gray-800 mb-3">Status Pengajuan Request Donasi</h1>
                <p class="text-gray-600 text-lg">Pantau status pengajuan donasimu yang sedang diverifikasi oleh admin.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center">
                    <i class="fas fa-check-circle mr-3 text-xl"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center">
                    <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- List Request -->
            <div class="space-y-6">
                @forelse($requests as $req)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row gap-6">
                                <!-- Image -->
                                <div class="md:w-48 flex-shrink-0">
                                    @if($req->foto)
                                        <img src="{{ Storage::url($req->foto) }}" 
                                             alt="{{ $req->nama_request }}" 
                                             class="w-full h-40 object-cover rounded-lg">
                                    @else
                                        <div class="w-full h-40 bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="flex-1">
                                    <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-4">
                                        <div class="flex-1">
                                            <div class="flex items-start justify-between mb-2">
                                                <h3 class="text-xl font-bold text-gray-800">
                                                    Nama Pengaju: {{ $req->pengguna->nama ?? 'Unknown' }}
                                                </h3>
                                                <!-- Status Badges (Mobile - Right Side) -->
                                                <div class="flex md:hidden flex-col gap-2 ml-3">
                                                    @if($req->hasil_verif === 'menunggu')
                                                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold inline-flex items-center whitespace-nowrap">
                                                            <i class="fas fa-clock mr-1"></i> Menunggu Verifikasi
                                                        </span>
                                                    @elseif($req->hasil_verif === 'disetujui')
                                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold inline-flex items-center whitespace-nowrap">
                                                            <i class="fas fa-check-circle mr-1"></i> Diterima
                                                        </span>
                                                    @else
                                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold inline-flex items-center whitespace-nowrap">
                                                            <i class="fas fa-times-circle mr-1"></i> Ditolak
                                                        </span>
                                                    @endif

                                                    @if($req->hasil_verif === 'disetujui')
                                                        @if($req->status_request === 'terpenuhi')
                                                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold inline-flex items-center whitespace-nowrap">
                                                                <i class="fas fa-heart mr-1"></i> Terpenuhi
                                                            </span>
                                                        @else
                                                            <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-xs font-semibold inline-flex items-center whitespace-nowrap">
                                                                <i class="fas fa-hourglass-half mr-1"></i> Belum Terpenuhi
                                                            </span>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="space-y-1 text-sm">
                                                <div class="flex items-center text-gray-600">
                                                    <span class="font-medium w-32">Jenis Donasi:</span>
                                                    <span class="capitalize">{{ str_replace('-', ' ', $req->jenis_barang) }}</span>
                                                </div>
                                                <div class="flex items-center text-gray-600">
                                                    <span class="font-medium w-32">Nama Barang:</span>
                                                    <span>{{ $req->nama_request }}</span>
                                                </div>
                                                @if($req->jumlah_barang)
                                                    <div class="flex items-center text-gray-600">
                                                        <span class="font-medium w-32">Jumlah Barang:</span>
                                                        <span>{{ $req->jumlah_barang }} unit</span>
                                                    </div>
                                                @endif
                                                <div class="flex items-center text-gray-600">
                                                    <span class="font-medium w-32">Tanggal Pengajuan:</span>
                                                    <span>{{ \Carbon\Carbon::parse($req->tanggal_upload)->format('d M Y') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Status Badges (Desktop - Right Side) -->
                                        <div class="hidden md:flex flex-col gap-2 ml-4">
                                            @if($req->hasil_verif === 'menunggu')
                                                <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center whitespace-nowrap">
                                                    <i class="fas fa-clock mr-2"></i> Menunggu Verifikasi
                                                </span>
                                            @elseif($req->hasil_verif === 'disetujui')
                                                <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center whitespace-nowrap">
                                                    <i class="fas fa-check-circle mr-2"></i> Diterima
                                                </span>
                                            @else
                                                <span class="bg-red-100 text-red-800 px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center whitespace-nowrap">
                                                    <i class="fas fa-times-circle mr-2"></i> Ditolak
                                                </span>
                                            @endif

                                            @if($req->hasil_verif === 'disetujui')
                                                @if($req->status_request === 'terpenuhi')
                                                    <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center whitespace-nowrap">
                                                        <i class="fas fa-heart mr-2"></i> Terpenuhi
                                                    </span>
                                                @else
                                                    <span class="bg-orange-100 text-orange-800 px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center whitespace-nowrap">
                                                        <i class="fas fa-hourglass-half mr-2"></i> Belum Terpenuhi
                                                    </span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex flex-wrap gap-3 mt-4">
                                        <button onclick="showDetail({{ $req->id_request }})" 
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition inline-flex items-center text-sm">
                                            <i class="fas fa-eye mr-2"></i>
                                            Lihat Detail
                                        </button>

                                        @if($req->hasil_verif === 'disetujui' || $req->hasil_verif === 'ditolak')
                                            <a href="{{ route('request-donasi.edit', $req->id_request) }}" 
                                               class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-medium transition inline-flex items-center text-sm">
                                                <i class="fas fa-upload mr-2"></i>
                                                Upload Ulang
                                            </a>
                                        @endif

                                        @if($req->hasil_verif === 'ditolak')
                                            <button onclick="showRejectionReason('{{ addslashes($req->nama_request) }}')" 
                                                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition inline-flex items-center text-sm">
                                                <i class="fas fa-info-circle mr-2"></i>
                                                Lihat Alasan
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                        <i class="fas fa-inbox text-gray-300 text-7xl mb-4"></i>
                        <p class="text-gray-500 text-lg font-medium mb-2">Belum ada pengajuan request donasi.</p>
                        <p class="text-gray-400 mb-6">Mulai ajukan request donasi pertama Anda!</p>
                        <a href="{{ route('request-donasi.create') }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition inline-flex items-center">
                            <i class="fas fa-plus mr-2"></i>
                            Ajukan Request Donasi
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($requests->hasPages())
                <div class="mt-8">
                    {{ $requests->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" style="backdrop-filter: blur(4px);">
    <div class="bg-white rounded-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
        <div class="p-6" id="modalContent"></div>
    </div>
</div>
@endsection

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

function showRejectionReason(namaRequest) {
    alert(`Request "${namaRequest}" ditolak oleh admin.\n\nSilakan edit dan ajukan kembali request Anda dengan informasi yang lebih lengkap.`);
}

document.getElementById('detailModal')?.addEventListener('click', function(e) {
    if(e.target === this) closeModal();
});

document.addEventListener('keydown', function(e) {
    if(e.key === 'Escape') closeModal();
});
</script>
@endpush