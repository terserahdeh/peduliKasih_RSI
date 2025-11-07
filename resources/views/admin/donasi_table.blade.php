{{-- resources/views/admin/donasi_table.blade.php --}}

@forelse($donasiList as $donasi)
    <tr class="text-gray-700 hover:bg-gray-50 transition duration-150">
        
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

        {{-- 4. Donatur (Menggunakan relasi Pengguna yang sudah kita perbaiki) --}}
        <td class="px-6 py-3 border-t whitespace-nowrap text-sm text-gray-500">
            {{ $donasi->Pengguna->name ?? $donasi->username ?? 'Guest' }}
        </td>
        
        {{-- 5. Status Verifikasi --}}
        <td class="px-6 py-3 border-t whitespace-nowrap">
            @php
                // Tentukan class berdasarkan status
                $statusClass = [
                    'disetujui' => 'text-green-700 bg-green-100', // <-- GANTI 'approved' menjadi 'disetujui'
                    'ditolak'   => 'text-red-700 bg-red-100',    // <-- GANTI 'rejected' menjadi 'ditolak'
                    'menunggu'  => 'text-yellow-700 bg-yellow-100', 
                ][$donasi->hasil_verif ?? 'menunggu']; // Menggunakan 'menunggu' sebagai default jika null
            @endphp
            <span class="px-2 py-1 font-semibold leading-tight rounded-full {{ $statusClass }}">
                {{ ucfirst($donasi->hasil_verif ?? 'menunggu') }}
            </span>
        </td>

        {{-- 6. Aksi (Tombol Verifikasi/Lihat Detail) --}}
        <td class="px-6 py-3 border-t whitespace-nowrap text-sm font-medium">
            {{-- Ganti '#' dengan route yang sesuai --}}
            <a href="{{ route('admin.donasi.show', $donasi->id_donasi) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Lihat Detail</a>
        </td>

        <td class="px-6 py-4">
            <form action="{{ route('admin.donasi.delete', $donasi->id_donasi) }}" 
                method="POST" class="inline-block"
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
    {{-- Tampilkan pesan jika tidak ada donasi --}}
    <tr class="text-gray-500">
        <td colspan="6" class="px-6 py-4 text-center border-t">
            <p class="py-4">Belum ada donasi terbaru yang tersedia.</p>
        </td>
    </tr>
@endforelse