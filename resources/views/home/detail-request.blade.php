<div id="detailContent">
    <!-- Header -->
    <div class="flex justify-between items-start mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Detail Request Donasi</h2>
        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition">
            <i class="fas fa-times text-2xl"></i>
        </button>
    </div>

    <!-- Image -->
    <div class="mb-6">
        @if($req->foto)
            <img src="{{ Storage::url($req->foto) }}" 
                 alt="{{ $req->nama_request }}" 
                 class="w-full max-h-96 object-cover rounded-xl">
        @else
            <div class="w-full h-64 bg-gradient-to-br from-gray-200 to-gray-300 rounded-xl flex items-center justify-center">
                <i class="fas fa-image text-gray-400 text-6xl"></i>
            </div>
        @endif
    </div>

    <!-- Status Badges -->
    <div class="flex flex-wrap gap-3 mb-6">
        @if($req->hasil_verif === 'disetujui')
            <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center">
                <i class="fas fa-check-circle mr-2"></i> Disetujui
            </span>
        @elseif($req->hasil_verif === 'menunggu')
            <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center">
                <i class="fas fa-clock mr-2"></i> Menunggu Verifikasi
            </span>
        @else
            <span class="bg-red-100 text-red-800 px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center">
                <i class="fas fa-times-circle mr-2"></i> Ditolak
            </span>
        @endif

        @if($req->status_request === 'terpenuhi')
            <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center">
                <i class="fas fa-heart mr-2"></i> Terpenuhi
            </span>
        @else
            <span class="bg-orange-100 text-orange-800 px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center">
                <i class="fas fa-hourglass-half mr-2"></i> Belum Terpenuhi
            </span>
        @endif
    </div>

    <!-- Main Info -->
    <div class="mb-6">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $req->nama_request }}</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="flex items-center text-gray-700">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-user text-blue-500"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pengaju</p>
                    <p class="font-semibold">{{ $req->pengguna->nama ?? 'Unknown' }}</p>
                </div>
            </div>

            <div class="flex items-center text-gray-700">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-tag text-blue-500"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Jenis Barang</p>
                    <p class="font-semibold capitalize">{{ str_replace('-', ' ', $req->jenis_barang) }}</p>
                </div>
            </div>

            @if($req->jumlah_barang)
                <div class="flex items-center text-gray-700">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-boxes text-blue-500"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jumlah</p>
                        <p class="font-semibold">{{ $req->jumlah_barang }} unit</p>
                    </div>
                </div>
            @endif

            <div class="flex items-center text-gray-700">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-calendar text-blue-500"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Upload</p>
                    <p class="font-semibold">{{ \Carbon\Carbon::parse($req->tanggal_upload)->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="bg-gray-50 rounded-xl p-5">
            <h4 class="font-bold text-gray-800 mb-3 flex items-center">
                <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                Deskripsi Kebutuhan
            </h4>
            <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $req->deskripsi }}</p>
        </div>
    </div>

    <!-- Actions (Only for Owner) -->
    @if($isOwner)
        <div class="border-t pt-6">
            <div class="flex flex-wrap gap-3">
                @if($req->hasil_verif === 'disetujui' || $req->hasil_verif === 'ditolak')
                    <a href="{{ route('request-donasi.edit', $req->id_request) }}" 
                       class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white py-3 rounded-lg font-semibold transition text-center inline-flex items-center justify-center">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Request
                    </a>
                @endif

                @if($req->hasil_verif === 'disetujui')
                    <button onclick="confirmDelete({{ $req->id_request }})" 
                            class="flex-1 bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg font-semibold transition inline-flex items-center justify-center">
                        <i class="fas fa-trash mr-2"></i>
                        Hapus Request
                    </button>
                @endif
            </div>
        </div>
    @endif

    <!-- Contact Admin -->
    <div class="mt-6 bg-blue-50 rounded-xl p-5">
        <h4 class="font-bold text-gray-800 mb-2 flex items-center">
            <i class="fas fa-info-circle text-blue-500 mr-2"></i>
            Informasi Donasi
        </h4>
        <p class="text-gray-700 text-sm mb-3">
            Untuk melakukan donasi sesuai request ini, silakan hubungi admin melalui WhatsApp:
        </p>
        <a href="https://wa.me/082998252532?text=Halo, saya ingin mendonasikan {{ $req->nama_request }}" 
           target="_blank"
           class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-semibold transition inline-flex items-center">
            <i class="fab fa-whatsapp mr-2 text-xl"></i>
            Hubungi Admin
        </a>
    </div>
</div>