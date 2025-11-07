{{-- resources/views/admin/permintaan_table.blade.php --}}

@forelse($permintaanList as $permintaan)
    <tr class="text-gray-700 hover:bg-gray-50 transition duration-150">
        
        {{-- 1. Nama Permintaan --}}
        <td class="px-6 py-3 border-t whitespace-nowrap">
            <div class="text-sm font-semibold text-gray-900">{{ $permintaan->nama_permintaan }}</div>
        </td>

        {{-- 2. Jumlah Permintaan --}}
        <td class="px-6 py-3 border-t whitespace-nowrap text-sm text-gray-500">
            {{ $permintaan->jumlah }}
        </td>
        
        {{-- 3. Pemohon (Menggunakan relasi Pengguna) --}}
        <td class="px-6 py-3 border-t whitespace-nowrap text-sm text-gray-500">
            {{ $permintaan->Pengguna->name ?? 'N/A' }}
        </td>

        {{-- 4. Status Permintaan --}}
        <td class="px-6 py-3 border-t whitespace-nowrap">
            @php
                // Ganti 'status_request' jika nama kolomnya berbeda
                $statusClass = [
                    'terpenuhi' => 'text-green-700 bg-green-100',
                    'pending' => 'text-yellow-700 bg-yellow-100',
                    'ditolak' => 'text-red-700 bg-red-100',
                ][$permintaan->status_request ?? 'pending'];
            @endphp
            <span class="px-2 py-1 font-semibold leading-tight rounded-full {{ $statusClass }}">
                {{ ucfirst($permintaan->status_request ?? 'pending') }}
            </span>
        </td>

        {{-- 5. Aksi --}}
        <td class="px-6 py-3 border-t whitespace-nowrap text-sm font-medium">
            <a href="#" class="text-indigo-600 hover:text-indigo-900">Lihat/Proses</a>
        </td>
    </tr>
@empty
    {{-- Tampilkan pesan jika tidak ada permintaan --}}
    <tr class="text-gray-500">
        <td colspan="5" class="px-6 py-4 text-center border-t">
            <p class="py-4">Belum ada permintaan donasi terbaru.</p>
        </td>
    </tr>
@endforelse