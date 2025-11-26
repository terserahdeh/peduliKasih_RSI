@forelse($permintaanList ?? [] as $permintaan)
<tr class="hover:bg-gray-50 permintaan-row" data-verifikasi="{{ $permintaan->hasil_verif }}" data-status="{{ $permintaan->status_request }}">
    <td class="px-6 py-4 text-sm text-gray-800">{{ $permintaan->username }}</td>
    <td class="px-6 py-4 text-sm">
        <button type="button" onclick="showDetail({{ $permintaan->id_request }}, 'permintaan')" class="open-detail text-blue-600 hover:text-blue-800 hover:underline font-medium bg-transparent p-0 border-0 cursor-pointer focus:outline-none" data-type="permintaan" data-id="{{ $permintaan->id_permintaan }}" aria-label="Detail {{ $permintaan->nama_permintaan }}">
        {{ $permintaan->nama_request }}
        </button>
    </td>
    <td class="px-6 py-4 text-sm text-gray-800">{{ $permintaan->jumlah_barang }}</td>
    <td class="px-6 py-4 verifikasi-cell">
        @if($permintaan->hasil_verif === 'menunggu')
        <div class="flex space-x-2">
            <button onclick="updateVerifikasi(this, {{ $permintaan->id_request }}, 'disetujui', 'permintaan')" 
                class="px-3 py-1 text-xs font-medium text-white bg-green-500 rounded-lg hover:bg-green-600 transition mr-2">
                <i class="fas fa-check mr-1"></i> Setujui
            </button>

            <button onclick="updateVerifikasi(this, {{ $permintaan->id_request }}, 'ditolak', 'permintaan')" 
                class="px-3 py-1 text-xs font-medium text-white bg-red-500 rounded-lg hover:bg-red-600 transition">
                <i class="fas fa-times mr-1"></i> Tolak
            </button>
        </div>
        @elseif($permintaan->hasil_verif === 'disetujui')
        <span class="px-3 py-1 text-xs font-medium text-white bg-green-500 rounded-full inline-flex items-center">
            <i class="fas fa-check-circle mr-1"></i> Disetujui
        </span>
        @else
        <span class="px-3 py-1 text-xs font-medium text-white bg-red-500 rounded-full inline-flex items-center">
            <i class="fas fa-times-circle mr-1"></i> Ditolak
        </span>
        @endif
    </td>
    <td class="px-6 py-4">
        <select 
            onchange="updateStatusPermintaan(this, {{ $permintaan->id_request }}, this.value)"
            class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
            @if($permintaan->hasil_verif == 'menunggu' || $permintaan->hasil_verif == 'ditolak') disabled @endif
        >
            <option value="belum terpenuhi" {{ $permintaan->status_request == 'belum_terpenuhi' ? 'selected' : '' }}>
                Belum Terpenuhi
            </option>
            <option value="terpenuhi" {{ $permintaan->status_request == 'terpenuhi' ? 'selected' : '' }}>
                Terpenuhi
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