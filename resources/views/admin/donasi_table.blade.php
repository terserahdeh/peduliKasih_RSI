{{-- resources/views/admin/donasi_table.blade.php --}}

@forelse($donasiList as $donasi)
<tr class="text-gray-700 hover:bg-gray-50 transition duration-150 donasi-row"
    data-verifikasi="{{ $donasi->hasil_verif }}" data-status="{{ $donasi->status_donasi }}">

    {{-- 1. Nama Donasi --}}
    <td class="px-6 py-3 border-t whitespace-nowrap">
        <div class="text-sm font-semibold text-gray-900">{{ $donasi->nama_donasi }}</div>
    </td>

    {{-- 2. Kategori/Jenis Barang --}}
    <td class="px-6 py-3 border-t whitespace-nowrap text-sm text-gray-500">
        {{ $donasi->jenis_barang }}
    </td>

    {{-- 3. Jumlah Barang --}}
    <td class="px-6 py-3 border-t whitespace-nowrap text-sm text-gray-500">
        {{ $donasi->jumlah_barang }}
    </td>

    {{-- 4. Donatur --}}
    <td class="px-6 py-3 border-t whitespace-nowrap text-sm text-gray-500">
        {{ $donasi->Pengguna->name ?? $donasi->username ?? 'Guest' }}
    </td>

    {{-- 5. Status Verifikasi --}}
    <td class="px-6 py-3 border-t whitespace-nowrap verifikasi-cell">
        @php
            $statusClass = [
                'disetujui' => 'text-green-700 bg-green-100',
                'ditolak'   => 'text-red-700 bg-red-100',
                'menunggu'  => 'text-yellow-700 bg-yellow-100',
            ][$donasi->hasil_verif ?? 'menunggu'];
        @endphp

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
        <span
            class="px-3 py-1 text-xs font-medium text-white bg-green-500 rounded-full inline-flex items-center">
            <i class="fas fa-check-circle mr-1"></i> Disetujui
        </span>
        @elseif($donasi->hasil_verif === 'ditolak')
        <span
            class="px-3 py-1 text-xs font-medium text-white bg-red-500 rounded-full inline-flex items-center">
            <i class="fas fa-times-circle mr-1"></i> Ditolak
        </span>
        @else
        <span
            class="px-3 py-1 text-xs font-medium text-gray-700 rounded-full inline-flex items-center {{ $statusClass }}">
            {{ ucfirst($donasi->hasil_verif ?? 'menunggu') }}
        </span>
        @endif
    </td>

    {{-- 6. Status Donasi --}}
    <td class="px-3 py-4">
        <select onchange="updateStatusDonasi(this, {{ $donasi->id_donasi }}, this.value)"
            class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
            @if($donasi->hasil_verif == 'menunggu' || $donasi->hasil_verif == 'ditolak') disabled @endif>
            <option value="tersedia" {{ $donasi->status_donasi == 'tersedia' ? 'selected' : '' }}>
                Tersedia
            </option>
            <option value="tersalurkan" {{ $donasi->status_donasi == 'tersalurkan' ? 'selected' : '' }}>
                Tersalurkan
            </option>
        </select>
    </td>

    {{-- aksi edittt --}}
    <!-- <td class="px-6 py-4">
        @if($donasi->status_edit === 'menunggu')
            <span class="px-3 py-1 text-xs font-medium text-white bg-orange-500 rounded-full inline-flex items-center">
                <i class="fas fa-clock mr-1"></i> Pending
            </span>
        @else
            <span class="text-gray-400 text-xs">-</span>
        @endif
    </td> -->


    {{-- 7. Aksi (Lihat Detail & Hapus) --}}
    <td class="px-6 py-3 border-t whitespace-nowrap text-sm font-medium">

        <form action="{{ route('admin.donasi.delete', $donasi->id_donasi) }}" method="POST"
            class="inline-block"
            onsubmit="return confirm('Yakin ingin menghapus donasi {{ $donasi->nama_donasi }}?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="px-4 py-1.5 text-xs font-medium text-white bg-red-500 rounded-lg hover:bg-red-600 transition flex items-center">
                <i class="fas fa-trash mr-1"></i> Hapus
            </button>
        </form>
    </td>
</tr>
@empty
<tr class="text-gray-500">
    <td colspan="7" class="px-6 py-4 text-center border-t">
        <p class="py-4">Belum ada donasi terbaru yang tersedia.</p>
    </td>
</tr>
@endforelse
