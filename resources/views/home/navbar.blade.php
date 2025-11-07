<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Peduli Kasih - Platform Donasi' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1 0 auto;
        }
        footer {
            flex-shrink: 0;
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="w-9 h-9 bg-blue-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-hand-holding-heart text-white"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-900">Peduli Kasih</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" 
                       class="{{ Request::is('/') ? 'text-blue-500 font-semibold' : 'text-gray-700 hover:text-gray-900' }} transition">
                        Beranda
                    </a>
                    <a href="#" 
                       class="{{ Request::is('donasi*') ? 'text-blue-500 font-semibold' : 'text-gray-700 hover:text-gray-900' }} transition">
                        Donasi
                    </a>
                    <a href="{{ route('request-donasi.landing') }}" 
                       class="{{ Request::is('request-donasi*') ? 'text-blue-500 font-semibold' : 'text-gray-700 hover:text-gray-900' }} transition">
                        Request Donasi
                    </a>
                    <a href="#" 
                       class="{{ Request::is('riwayat*') ? 'text-blue-500 font-semibold' : 'text-gray-700 hover:text-gray-900' }} transition">
                        Riwayat
                    </a>
                    <a href="#" 
                       class="{{ Request::is('akun*') ? 'text-blue-500 font-semibold' : 'text-gray-700 hover:text-gray-900' }} transition">
                        Akun
                    </a>
                </div>

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center">
                    @guest('pengguna')
                        <a href="{{ route('login.form') }}" 
                           class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg transition shadow-md hover:shadow-lg">
                            Login / Registrasi
                        </a>
                    @else
                        <div class="relative group">
                            <button class="flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                                <div class="w-9 h-9 bg-blue-500 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm font-semibold">
                                        {{ substr(Auth::guard('pengguna')->user()->nama, 0, 1) }}
                                    </span>
                                </div>
                                <span class="text-gray-700 font-medium">{{ Auth::guard('pengguna')->user()->nama }}</span>
                                <i class="fas fa-chevron-down text-gray-500 text-xs"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block">
                                <a href="{{ route('request-donasi.status') }}" 
                                   class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                                    <i class="fas fa-list mr-2"></i> Request Saya
                                </a>
                                <hr class="my-2">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <div class="px-4 py-3 space-y-3">
                <a href="{{ route('home') }}" class="block {{ Request::is('/') ? 'text-blue-500 font-semibold' : 'text-gray-700' }} py-2">Beranda</a>
                <a href="#" class="block {{ Request::is('donasi*') ? 'text-blue-500 font-semibold' : 'text-gray-700' }} py-2">Donasi</a>
                <a href="{{ route('request-donasi.landing') }}" class="block {{ Request::is('request-donasi*') ? 'text-blue-500 font-semibold' : 'text-gray-700' }} py-2">Request Donasi</a>
                <a href="#" class="block {{ Request::is('riwayat*') ? 'text-blue-500 font-semibold' : 'text-gray-700' }} py-2">Riwayat</a>
                <a href="#" class="block {{ Request::is('akun*') ? 'text-blue-500 font-semibold' : 'text-gray-700' }} py-2">Akun</a>

                <div class="pt-3 border-t">
                    @guest('pengguna')
                        <a href="{{ route('login.form') }}" class="block w-full text-center px-4 py-2 bg-blue-500 text-white rounded-lg font-medium">Login / Registrasi</a>
                    @else
                        <div class="space-y-2">
                            <div class="flex items-center space-x-2 py-2">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm font-semibold">{{ substr(Auth::guard('pengguna')->user()->nama, 0, 1) }}</span>
                                </div>
                                <span class="text-gray-700 font-medium">{{ Auth::guard('pengguna')->user()->nama }}</span>
                            </div>
                            <a href="{{ route('request-donasi.status') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                                <i class="fas fa-list mr-2"></i> Request Saya
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main>