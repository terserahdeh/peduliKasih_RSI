@forelse($permintaanList ?? [] as $permintaan)
<tr class="hover:bg-gray-50 permintaan-row" data-verifikasi="{{ $permintaan->hasil_verif }}" data-status="{{ $permintaan->status_request }}">
    <td class="px-6 py-4 text-sm text-gray-800">{{ $permintaan->username }}</td>
    <td class="px-6 py-4 text-sm">
        <button type="button" onclick="showDetail({{ $permintaan->id_request }}, 'permintaan')" class="open-detail text-blue-600 hover:text-blue-800 hover:underline font-medium bg-transparent p-0 border-0 cursor-pointer focus:outline-none" data-type="permintaan" data-id="{{ $permintaan->id_permintaan }}" aria-label="Detail {{ $permintaan->nama_permintaan }}">
        {{ $permintaan->nama_request }}
        </button>
    </td>

    {{-- 4. Status Verifikasi --}}
    <td class="px-6 py-4 verifikasi-cell whitespace-nowrap">
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
        @elseif($permintaan->hasil_verif === 'ditolak')
        <span class="px-3 py-1 text-xs font-medium text-white bg-red-500 rounded-full inline-flex items-center">
            <i class="fas fa-times-circle mr-1"></i> Ditolak
        </span>
        @else
        @php
            $statusClass = [
                'terpenuhi' => 'text-green-700 bg-green-100',
                'pending' => 'text-yellow-700 bg-yellow-100',
                'ditolak' => 'text-red-700 bg-red-100',
            ][$permintaan->status_request ?? 'pending'];
        @endphp
        <span class="px-2 py-1 font-semibold leading-tight rounded-full {{ $statusClass }}">
            {{ ucfirst($permintaan->status_request ?? 'pending') }}
        </span>
        @endif
    </td>

    {{-- 5. Status Permintaan --}}
    <td class="px-6 py-4">
        <select 
            onchange="updateStatusPermintaan(this, {{ $permintaan->id_request }}, this.value)"
            class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
            @if($permintaan->hasil_verif == 'menunggu' || $permintaan->hasil_verif == 'ditolak') disabled @endif
        >
            <option value="belum_terpenuhi" {{ $permintaan->status_request == 'belum_terpenuhi' ? 'selected' : '' }}>
                Belum Terpenuhi
            </option>
            <option value="terpenuhi" {{ $permintaan->status_request == 'terpenuhi' ? 'selected' : '' }}>
                Terpenuhi
            </option>
        </select>
    </td>

    {{-- 6. Aksi --}}
    <td class="px-6 py-3 border-t whitespace-nowrap text-sm font-medium">
        <a href="#" class="text-indigo-600 hover:text-indigo-900">Lihat/Proses</a>
    </td>
</tr>
@empty
<tr class="text-gray-500">
    <td colspan="6" class="px-6 py-4 text-center border-t">
        <p class="py-4">Belum ada permintaan donasi terbaru.</p>
    </td>
</tr>
@endforelse
