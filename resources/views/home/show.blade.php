@extends('home.navbar')

@section('title', 'Profil Saya - Peduli Kasih')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Profile Header Card -->
        <div class="bg-white rounded-lg shadow-sm p-8 mb-6">
            <div class="flex flex-col md:flex-row items-center md:items-start justify-between">
                <!-- Profile Photo and Info -->
                <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6">
                    <!-- Profile Photo -->
                    <div class="relative">
                        <img src="{{ $user->avatar ? asset($user->avatar) : asset('images/default-avatar.jpg') }}" 
                            alt="Profile Photo"
                            class="w-32 h-32 rounded-full object-cover border-4 border-gray-100">
                        <button class="absolute bottom-0 right-0 bg-white rounded-full p-2 shadow-md hover:shadow-lg transition">
                            <i class="fas fa-camera text-blue-500"></i>
                        </button>
                    </div>

                    <!-- User Info -->
                    <div class="text-center md:text-left">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $user->name }}</h1>
                        <p class="text-gray-600 mb-2">
                            <i class="far fa-envelope mr-2"></i>{{ $user->email }}
                        </p>
                        <p class="text-gray-500 text-sm">
                            <i class="far fa-calendar mr-2"></i>Bergabung sejak {{ \Carbon\Carbon::parse($user->created_at)->locale('id')->translatedFormat('F Y') }}
                        </p>
                        
                        <!-- Edit Photo Link -->
                        <a href="{{ route('home.edit') }}" class="inline-block mt-3 text-blue-500 hover:text-blue-600 text-sm font-medium">
                            <i class="fas fa-pencil-alt mr-1"></i> Edit Foto
                        </a>

                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-3 mt-6 md:mt-0">
                    <a href="{{ route('home.edit') }}" 
                       class="bg-orange-100 text-orange-600 hover:bg-orange-200 px-6 py-2.5 rounded-lg font-medium transition flex items-center space-x-2">
                        <i class="fas fa-pencil-alt"></i>
                        <span>Edit Data Diri</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                                class="bg-gray-100 text-gray-700 hover:bg-gray-200 px-6 py-2.5 rounded-lg font-medium transition flex items-center space-x-2">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Activity Stats Card -->
        <div class="bg-white rounded-lg shadow-sm p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Aktivitas Saya</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Jumlah Donasi -->
                <div class="text-center p-6 bg-gray-50 rounded-lg hover:shadow-md transition">
                    <div class="text-4xl font-bold text-blue-500 mb-2">{{ $stats->total_donations ?? 12 }}</div>
                    <div class="text-gray-600 font-medium">Jumlah Donasi</div>
                </div>

                <!-- Program Diikuti -->
                <div class="text-center p-6 bg-gray-50 rounded-lg hover:shadow-md transition">
                    <div class="text-4xl font-bold text-blue-500 mb-2">{{ $stats->programs_followed ?? 5 }}</div>
                    <div class="text-gray-600 font-medium">Program Diikuti</div>
                </div>

                <!-- Bulan Aktif -->
                <div class="text-center p-6 bg-gray-50 rounded-lg hover:shadow-md transition">
                    <div class="text-4xl font-bold text-blue-500 mb-2">{{ $stats->active_months ?? 8 }}</div>
                    <div class="text-gray-600 font-medium">Bulan Aktif</div>
                </div>

                <!-- Total Poin -->
                <div class="text-center p-6 bg-gray-50 rounded-lg hover:shadow-md transition">
                    <div class="text-4xl font-bold text-blue-500 mb-2">{{ number_format($stats->total_points ?? 2450, 0, ',', '.') }}</div>
                    <div class="text-gray-600 font-medium">Total Poin</div>
                </div>
            </div>
        </div>

            @if(isset($recentDonations) && count($recentDonations) > 0)
                <div class="space-y-4">
                    @foreach($recentDonations as $donation)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <div class="flex items-center space-x-4">
                            <div class="bg-blue-100 text-blue-600 w-12 h-12 rounded-full flex items-center justify-center">
                                <i class="fas fa-hand-holding-heart text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ $donation->program_name }}</h3>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($donation->created_at)->locale('id')->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-blue-600">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
                            <span class="inline-block px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
                                Sukses
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Custom animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .bg-white {
        animation: fadeInUp 0.5s ease-out;
    }
</style>
@endpush