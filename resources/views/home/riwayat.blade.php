@extends('home.navbar')

@section('title', 'Riwayat Donasi & Request - Peduli Kasih')

@section('styles')
{{-- Tidak ada lagi custom CSS. Kita pakai kelas Tailwind langsung. --}}
@endsection

@section('content')

<div class="bg-gradient-to-r from-blue-50 to-blue-100 py-16">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
<h1 class="text-4xl font-extrabold text-gray-900 mb-2">Riwayat Donasi & Request</h1>
<p class="text-lg text-gray-600">Pantau status terbaru donasi dan permintaan bantuan yang Anda ajukan.</p>
</div>
</div>

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
<div class="space-y-4">
{{-- Mengambil data dari paginator secara eksplisit --}}
@php
$items = $riwayat instanceof \Illuminate\Pagination\LengthAwarePaginator ? $riwayat->items() : ($riwayat ?? collect());
@endphp

@forelse($items as $item)
<div class="bg-white rounded-xl shadow-lg border-l-4 
    @php
        $normalizedStatus = strtolower(trim((string)($item->status ?? '')));
        if (in_array($normalizedStatus, ['diterima', '1', 'disetujui'])) {
            echo 'border-green-500';
        } elseif (in_array($normalizedStatus, ['ditolak', '0'])) {
            echo 'border-red-500';
        } else {
            echo 'border-yellow-400';
        }
    @endphp
    p-6 hover:shadow-xl transition-all duration-300 ease-in-out">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
        
        {{-- Detail Item --}}
        <div class="mb-4 sm:mb-0">
            <span class="text-xs font-semibold uppercase tracking-wider 
                @if (str_contains($item->jenis_donasi, 'Request')) 
                    text-blue-600 bg-blue-100 
                @else 
                    text-green-600 bg-green-100 
                @endif 
                px-2 py-0.5 rounded-full">
                {{ $item->jenis_donasi }}
            </span>
            <h3 class="text-xl font-bold text-gray-900 mt-2">{{ $item->judul }}</h3>
            
            {{-- PERBAIKAN SUSUNAN: Menggunakan Flexbox untuk label yang sejajar --}}
            <div class="space-y-1 text-sm mt-3">
                <div class="flex">
                    <span class="text-gray-500 w-24 flex-shrink-0">Barang:</span>
                    <span class="font-medium text-gray-800 ml-2">: {{ $item->nama_barang }}</span>
                </div>
                <div class="flex">
                    <span class="text-gray-500 w-24 flex-shrink-0">Jumlah:</span>
                    <span class="font-medium text-gray-800 ml-2">: {{ $item->jumlah }}</span>
                </div>
                <div class="flex">
                    <span class="text-gray-500 w-24 flex-shrink-0">Diajukan:</span>
                    <span class="font-medium text-gray-500 ml-2">: {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}</span>
                </div>
            </div>
        </div>

        {{-- Status Badge --}}
        <div class="flex-shrink-0">
            @php
                $statusText = '';
                $statusClass = '';
                $iconPath = ''; // SVG Path
                
                if (in_array($normalizedStatus, ['diterima', '1', 'disetujui'])) {
                    $statusText = 'Diterima';
                    $statusClass = 'bg-green-100 text-green-800';
                    $iconPath = '<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>';
                } elseif (in_array($normalizedStatus, ['ditolak', '0'])) {
                    $statusText = 'Ditolak';
                    $statusClass = 'bg-red-100 text-red-800';
                    $iconPath = '<path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>';
                } else {
                    $statusText = 'Menunggu';
                    $statusClass = 'bg-yellow-100 text-yellow-800';
                    $iconPath = '<path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM8.707 9.293a1 1 0 00-1.414 1.414L9.586 12 7.293 14.293a1 1 0 101.414 1.414L11 13.414l2.293 2.293a1 1 0 001.414-1.414L12.414 12l2.293-2.293a1 1 0 00-1.414-1.414L11 10.586 8.707 8.293a1 1 0 00-1.414 1.414z" clip-rule="evenodd"/>';
                }
            @endphp

            <span class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-full {{ $statusClass }} shadow-md">
                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                    {!! $iconPath !!}
                </svg>
                {{ $statusText }}
            </span>
        </div>
    </div>
</div>
@empty
<div class="bg-white rounded-xl shadow-lg p-12 text-center border-2 border-dashed border-gray-300">
    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
    </svg>
    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Riwayat</h3>
    <p class="text-gray-500 mb-6">Anda belum memiliki riwayat donasi atau permintaan bantuan di sini.</p>
    <div class="flex justify-center space-x-4">
        <a href="{{ route('donasi.create') }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 font-medium transition duration-200">
            Mulai Donasi
        </a>
        <a href="{{ route('request-donasi.create') }}" class="px-6 py-2 border border-gray-400 text-gray-700 rounded-lg shadow-md hover:bg-gray-100 font-medium transition duration-200">
            Request Bantuan
        </a>
    </div>
</div>
@endforelse


</div>

@if(isset($riwayat) && $riwayat->hasPages())

<div class="mt-8">
{{ $riwayat->links() }}
</div>
@endif
</div>
@endsection