@forelse($donasiList ?? [] as $donasi)
<tr class="hover:bg-gray-50 donasi-row" data-verifikasi="{{ $donasi->hasil_verif }}" data-status="{{ $donasi->status_donasi }}">
    <td class="px-6 py-4 text-sm text-gray-800">{{ $donasi->username }}</td>
    <td class="px-6 py-4 text-sm">
        <button onclick="showDetail({{ $donasi->id_donasi }}, 'donasi')" class="open-detail text-blue-600 hover:text-blue-800 hover:underline font-medium bg-transparent p-0 border-0 cursor-pointer focus:outline-none" data-type="donasi" data-id="{{ $donasi->id_donasi }}" aria-label="Detail {{ $donasi->nama_donasi }}">
        {{ $donasi->nama_donasi }}
        </button>
    </td>
    <td class="px-6 py-4 text-sm text-gray-800">{{ $donasi->jumlah_barang }}</td>
    <td class="px-6 py-4 verifikasi-cell">
        @if($donasi->hasil_verif === 'menunggu')
        <div class="flex space-x-2">
            <button onclick="updateVerifikasi(this, {{ $donasi->id_donasi }}, 'disetujui', 'donasi')"
                    class="px-3 py-1 text-xs font-medium text-white bg-green-500 hover:bg-green-600 rounded-full flex items-center transition">
                <i class="fas fa-check mr-1"></i> Setujui
            </button>
            <button onclick="updateVerifikasi(this, {{ $donasi->id_donasi }}, 'ditolak', 'donasi')"
                    class="px-3 py-1 text-xs font-medium text-white bg-red-500 hover:bg-red-600 rounded-full flex items-center transition">
                <i class="fas fa-times mr-1"></i> Tolak
            </button>
        </div>
        @elseif($donasi->hasil_verif === 'disetujui')
        <span class="px-3 py-1 text-xs font-medium text-white bg-green-500 rounded-full inline-flex items-center">
            <i class="fas fa-check-circle mr-1"></i> Disetujui
        </span>
        @elseif($donasi->hasil_verif === 'ditolak')
        <span class="px-3 py-1 text-xs font-medium text-white bg-red-500 rounded-full inline-flex items-center">
            <i class="fas fa-times-circle mr-1"></i> Ditolak
        </span>
        @else
        <span class="px-3 py-1 text-xs font-medium text-gray-700 rounded-full inline-flex items-center">
            {{ $donasi->hasil_verif }}
        </span>
        @endif
    </td>
    <td class="px-6 py-4">
        <select 
            onchange="updateStatusDonasi(this, {{ $donasi->id_donasi }}, this.value)"
            class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
            @if($donasi->hasil_verif == 'menunggu' || $donasi->hasil_verif == 'ditolak') disabled @endif
        >
            <option value="tersedia" {{ $donasi->status_donasi == 'tersedia' ? 'selected' : '' }}>
                Tersedia
            </option>
            <option value="tersalurkan" {{ $donasi->status_donasi == 'tersalurkan' ? 'selected' : '' }}>
                Tersalurkan
            </option>
        </select>
    </td>
</tr>
@empty
<tr>
    <td class="px-6 py-4 text-center text-gray-500" colspan="5">
        Data kosong
    </td>
</tr>
@endforelse