@extends('admin.navbar')

@section('title', 'Manajemen Komentar - Admin')

@section('content')

<main class="container mx-auto px-6 py-8">

    {{-- HEADER (samain seperti edukasi & tips) --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Manajemen Komentar</h1>
        <p class="text-gray-600">Kelola komentar pengguna yang melanggar</p>
    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                </svg>
                <p class="text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    {{-- TABLE WRAPPER --}}
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">

            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-16">No.</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pengguna</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Isi Komentar</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">Tanggal</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider w-24">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($komentar as $index => $item)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- NO --}}
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                            {{ $komentar->firstItem() + $index }}
                        </td>

                        {{-- USER --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $item->user->avatar ? asset($item->user->avatar) : asset('images/default-avatar.jpg') }}"
                                     class="w-10 h-10 rounded-full object-cover" />
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $item->user->username }}</p>
                                    @if($item->id_parent)
                                        <span class="text-xs text-gray-500">(Balasan)</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        {{-- ISI KOMENTAR --}}
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ Str::limit($item->isi_komentar, 80) }}
                        </td>

                        {{-- TANGGAL --}}
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $item->created_at->format('d-m-Y H:i') }}
                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('admin.komentar.delete', $item->id_komentar) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus komentar ini? Termasuk balasannya.')">
                                @csrf
                                @method('DELETE')

                                {{-- ICON HAPUS (SVG custom) --}}
                                <button type="submit" class="text-red-600 hover:text-red-800 transition" title="Hapus">
                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            Belum ada komentar yang tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        {{-- PAGINATION --}}
        @if($komentar->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $komentar->links() }}
        </div>
        @endif

    </div>

</main>
@endsection