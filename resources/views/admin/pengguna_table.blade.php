@forelse($penggunaList as $pengguna)
<tr class="hover:bg-gray-50">
    <td class="px-6 py-4 text-sm text-gray-800">{{ $pengguna->username }}</td>
    <td class="px-6 py-4 text-sm text-gray-800">{{ $pengguna->email }}</td>
    <td class="px-6 py-4 text-sm text-gray-800">{{ $pengguna->no_tlp }}</td>
    <td class="px-6 py-4 text-sm text-gray-800">
        {{ \Carbon\Carbon::parse($pengguna->created_at)->format('d-m-Y') }}
    </td>
    <td class="px-6 py-4">
        <form action="{{ route('admin.pengguna.delete', $pengguna->id_akun) }}"
              method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-4 py-1.5 text-xs font-medium text-white bg-red-500 rounded-lg hover:bg-red-600">
                <i class="fas fa-trash mr-1"></i> Hapus Akun
            </button>
        </form>
    </td>
</tr>
@empty
<tr>
    <td class="px-6 py-4 text-center text-gray-500" colspan="5">Data kosong</td>
</tr>
@endforelse
