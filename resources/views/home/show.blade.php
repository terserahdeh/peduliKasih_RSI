@extends('home.navbar')

@section('title', 'Profil Saya - Peduli Kasih')

@section('content')
<div class="bg-gray-50 py-10">
    <div class="max-w-5xl mx-auto px-6 sm:px-8">
        <!-- Profile Header Card -->
        <div class="bg-white rounded-2xl shadow-md p-10 mb-12">
            <div class="flex flex-col md:flex-row items-center md:items-start justify-between space-y-8 md:space-y-0">
                
                <!-- Profile Photo and Info -->
                <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                    <!-- Profile Photo -->
                    <div class="relative">
                        <img src="{{ $user->avatar ? asset($user->avatar) : asset('images/default-avatar.jpg') }}" 
                            alt="Profile Photo"
                            class="w-40 h-40 rounded-full object-cover border-4 border-gray-200 shadow-sm">
                        <button class="absolute bottom-2 right-2 bg-white rounded-full p-3 shadow-md hover:shadow-lg transition">
                            <i class="fas fa-camera text-blue-500"></i>
                        </button>
                    </div>

                    <!-- User Info -->
                    <div class="text-left">
                        <h1 class="text-4xl font-bold text-gray-900 mb-3">{{ $user->nama }}</h1>
                        <p class="text-gray-600 mb-2 text-lg">
                            <i class="far fa-envelope mr-2"></i>{{ $user->email }}
                        </p>
                        <p class="text-gray-500 text-sm">
                            <i class="far fa-calendar mr-2"></i>Bergabung sejak {{ \Carbon\Carbon::parse($user->created_at)->locale('id')->translatedFormat('F Y') }}
                        </p>
                        
                        <!-- Edit Photo Link -->
                        <a href="{{ route('home.edit') }}" class="inline-block mt-4 text-blue-600 hover:text-blue-700 text-sm font-medium">
                            <i class="fas fa-pencil-alt mr-1"></i> Edit Profil
                        </a>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-4">
                    <a href="{{ route('home.edit') }}" 
                       class="bg-orange-100 text-orange-600 hover:bg-orange-200 px-6 py-3 rounded-xl font-medium transition flex items-center space-x-2">
                        <i class="fas fa-pencil-alt"></i>
                        <span>Edit Data Diri</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                                class="bg-gray-100 text-gray-700 hover:bg-gray-200 px-6 py-3 rounded-xl font-medium transition flex items-center space-x-2">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Animasi lembut */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .bg-white {
        animation: fadeInUp 0.5s ease-out;
    }

    /* Jarak ke footer lebih pendek */
    main, .bg-gray-50 {
        margin-bottom: 40px;
    }
</style>
@endpush
