<div id="modalContent">
    <!-- Header --> 
    <div class="flex justify-between items-start mb-6"> 
        <h2 class="text-2xl font-bold text-gray-800"> 
            Detail {{ $type === 'permintaan' ? 'Permintaan' : 'Donasi' }} 
        </h2> 
        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition"> 
            <i class="fas fa-times text-2xl"></i> 
        </button> 
    </div> 
    <!-- Image --> 
    <div class="mb-6"> 
        @if($data->foto) 
        <img src="{{ Storage::url($data->foto) }}" alt="{{ $data->nama_request ?? $data->nama_donasi }}" class="w-full max-h-96 object-cover rounded-xl"> 
        @else 
        <div class="w-full h-64 bg-gradient-to-br from-gray-200 to-gray-300 rounded-xl flex items-center justify-center"> 
            <i class="fas fa-image text-gray-400 text-6xl"></i> 
        </div> @endif 
    </div> 
    <!-- Status Badges --> 
    <div class="flex flex-wrap gap-3 mb-6"> 
        @if($data->hasil_verif === 'disetujui')
            <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center">
                <i class="fas fa-check-circle mr-2"></i> Disetujui
            </span>
        @elseif($data->hasil_verif === 'menunggu')
            <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center">
                <i class="fas fa-clock mr-2"></i> Menunggu Verifikasi
            </span>
        @else
            <span class="bg-red-100 text-red-800 px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center">
                <i class="fas fa-times-circle mr-2"></i> Ditolak
            </span>
        @endif

        @if ($data->status_request === 'terpenuhi' || $data->status_donasi === 'tersalurkan')
            {{-- Status terpenuhi / tersalurkan --}}
            <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center">
                <i class="fas fa-check-circle mr-2"></i> 
                {{ $data->status_request === 'terpenuhi' ? 'Terpenuhi' : 'Tersalurkan' }}
            </span>
        @else
            {{-- Status belum terpenuhi / tersedia --}}
            <span class="bg-orange-100 text-orange-800 px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center">
                <i class="fas fa-hourglass-half mr-2"></i>
                {{ $data->status_request === 'belum terpenuhi' ? 'Belum Terpenuhi' : 'Tersedia' }}
            </span>
        @endif
    </div> 
    <!-- Main Info --> 
    <div class="mb-6"> 
        <h3 class="text-2xl font-bold text-gray-800 mb-4"> 
            {{ $data->nama_request ?? $data->nama_donasi }} 
        </h3> 
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6"> 
            <div class="flex items-center text-gray-700"> 
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3"> 
                    <i class="fas fa-user text-blue-500"></i> 
                </div> 
                <div> 
                    <p class="text-sm text-gray-500">Pengaju</p> 
                    <p class="font-semibold">{{ $data->pengguna->nama ?? 'Unknown' }}</p> 
                </div> 
            </div>

            <div class="flex items-center text-gray-700"> 
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3"> 
                    <i class="fas fa-tag text-blue-500"></i> 
                </div> 
                <div> 
                    <p class="text-sm text-gray-500">Jenis Barang</p> 
                    <p class="font-semibold capitalize">{{ str_replace('-', ' ', $data->jenis_barang) }}</p> 
                </div> 
            </div> 

            @if($data->jumlah_barang) 
            <div class="flex items-center text-gray-700"> 
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3"> 
                    <i class="fas fa-boxes text-blue-500"></i> 
                </div> 
                <div> 
                    <p class="text-sm text-gray-500">Jumlah</p> 
                    <p class="font-semibold">{{ $data->jumlah_barang }} unit</p> 
                </div> 
            </div> 
            @endif 
            
            <div class="flex items-center text-gray-700"> 
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3"> 
                    <i class="fas fa-calendar text-blue-500"></i> 
                </div> 
                <div> 
                    <p class="text-sm text-gray-500">Tanggal Upload</p> 
                    <p class="font-semibold">{{ \Carbon\Carbon::parse($data->tanggal_upload)->format('d M Y') }}</p> 
                </div> 
            </div> 
        </div> 
        
        <div class="bg-gray-50 rounded-xl p-5"> 
            <h4 class="font-bold text-gray-800 mb-3 flex items-center"> 
                <i class="fas fa-file-alt text-blue-500 mr-2"></i> 
                Deskripsi Kebutuhan 
            </h4> 
            
            <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $data->deskripsi }}</p> 
        </div> 
    </div> 
</div>
