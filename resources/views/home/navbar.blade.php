<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Peduli Kasih - Platform Donasi' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMD/CDQ6uV/U/m6D27F5d2Kj+T2I3g9T5f5z5M1p8/5S5V5w=" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
<!-- Navbar -->
<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home.dashboard') }}" class="flex items-center space-x-2">
                    <div class="w-9 h-9 bg-blue-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-hand-holding-heart text-white"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Peduli Kasih</span>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home.dashboard') }}" 
                   class="{{ Request::routeIs('home.dashboard') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-gray-900' }} transition">
                    Beranda
                </a>
                
                @guest
                <a href="javascript:void(0);" 
                   onclick="showLoginAlert()" 
                   class="text-gray-600 hover:text-gray-900 transition">
                    Donasi
                </a>
                @else
                <a href="{{ route('donasi.index') }}" 
                   class="{{ Request::routeIs('donasi.index') || Request::routeIs('donasi.filter') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-gray-900' }} transition">
                    Donasi
                </a>
                @endguest

                @guest
                <a href="javascript:void(0);" 
                   onclick="showLoginAlert()" 
                   class="text-gray-600 hover:text-gray-900 transition">
                    Request Donasi
                </a>
                @else
                <a href="{{ route('request-donasi.landing') }}" 
                   class="{{ Request::routeIs('request-donasi.landing') || Request::routeIs('donasi.create') || Request::routeIs('donasi.edit') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-gray-900' }} transition">
                    Request Donasi
                </a>
                @endguest

                @guest
                <a href="javascript:void(0);" 
                   onclick="showLoginAlert()" 
                   class="text-gray-600 hover:text-gray-900 transition">
                    Riwayat
                </a>
                @else
                <a href="#" 
                   class="{{ Request::routeIs('riwayat.*') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-gray-900' }} transition">
                    Riwayat
                </a>
                @endguest
            </div>

            <!-- Auth Buttons -->
            <div class="hidden md:flex items-center space-x-3">
                @guest
                    <a href="{{ route('login') }}" 
                    class="px-5 py-2 text-blue-600 font-medium hover:bg-blue-50 rounded-lg transition">
                    Login / Registrasi
                    </a>
                @else
                    <a href="{{ route('home.show') }}" 
                    class="flex items-center space-x-2 py-2 hover:bg-gray-100 rounded-lg transition px-2 {{ Request::routeIs('home.show') ? 'bg-blue-50' : '' }}">
                    
                    @if(auth()->user()->avatar && file_exists(public_path(auth()->user()->avatar)))
                        <img src="{{ asset(auth()->user()->avatar) }}" 
                                alt="Profile" 
                                class="w-8 h-8 rounded-full object-cover border border-gray-300">
                    @else
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-semibold">
                                {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                            </span>
                        </div>
                    @endif

                    <span class="text-gray-700 font-medium">{{ auth()->user()->nama }}</span>
                    </a>
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
            <a href="{{ route('home.dashboard') }}" 
               class="block py-2 {{ Request::routeIs('home.dashboard') ? 'text-blue-600 font-semibold' : 'text-gray-600' }}">
                Beranda
            </a>
            
            @guest
            <a href="javascript:void(0);" 
               onclick="showLoginAlert()" 
               class="block text-gray-600 py-2">
                Donasi
            </a>
            @else
            <a href="{{ route('donasi.index') }}" 
               class="block py-2 {{ Request::routeIs('donasi.index') || Request::routeIs('donasi.filter') ? 'text-blue-600 font-semibold' : 'text-gray-600' }}">
                Donasi
            </a>
            @endguest

            @guest
            <a href="javascript:void(0);" 
               onclick="showLoginAlert()" 
               class="block text-gray-600 py-2">
                Request Donasi
            </a>
            @else
            <a href="{{ route('request-donasi.landing') }}" 
               class="block py-2 {{ Request::routeIs('request-donasi.landing') || Request::routeIs('donasi.create') || Request::routeIs('donasi.edit') ? 'text-blue-600 font-semibold' : 'text-gray-600' }}">
                Request Donasi
            </a>
            @endguest

            @guest
            <a href="javascript:void(0);" 
               onclick="showLoginAlert()" 
               class="block text-gray-600 py-2">
                Riwayat
            </a>
            @else
            <a href="#" 
               class="block py-2 {{ Request::routeIs('riwayat.*') ? 'text-blue-600 font-semibold' : 'text-gray-600' }}">
                Riwayat
            </a>
            @endguest
            
            <div class="pt-3 border-t">
                @guest('pengguna')
                    <a href="{{ route('login.form') }}" class="block w-full text-center px-4 py-2 bg-blue-500 text-white rounded-lg font-medium">Login / Registrasi</a>
                @else
                    <div class="flex items-center space-x-2 py-2">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-semibold">{{ substr(auth()->user()->nama, 0, 1) }}</span>
                        </div>
                        <span class="text-gray-700 font-medium">{{ auth()->user()->nama }}</span>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand Section -->
                <div class="col-span-1">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-hand-holding-heart text-white text-sm"></i>
                        </div>
                        <span class="text-xl font-bold">Peduli Kasih</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">
                        Platform donasi terpercaya untuk membangun masa depan yang lebih baik bersama-sama.
                    </p>
                </div>
                
                <!-- Menu Utama -->
                <div>
                    <h3 class="font-semibold mb-4">Menu Utama</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="#" class="hover:text-white transition">Donasi</a></li>
                        <li><a href="#" class="hover:text-white transition">Request Donasi</a></li>
                        <li><a href="#" class="hover:text-white transition">Riwayat</a></li>
                    </ul>
                </div>
                
                <!-- Bantuan -->
                <div>
                    <h3 class="font-semibold mb-4">Bantuan</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition">Panduan</a></li>
                        <li><a href="#" class="hover:text-white transition">Kontak</a></li>
                        <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                
                <!-- Ikuti Kami -->
                <div>
                    <h3 class="font-semibold mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-400 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-pink-600 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>© 2025 Peduli Kasih. Semua hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script>
        // Mobile Menu Toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

    <script>
    // Mobile Menu Toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });

    // Popup Login Alert
    function showLoginAlert() {
        document.getElementById('loginAlertModal').classList.remove('hidden');
    }

    function closeLoginAlert() {
        document.getElementById('loginAlertModal').classList.add('hidden');
    }
    </script>

    
    <!-- Popup Modal -->
    <div id="loginAlertModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl shadow-lg max-w-sm w-full p-6 text-center">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Akses Ditolak</h2>
            <p class="text-gray-600 mb-6">Anda harus login terlebih dahulu untuk mengakses halaman akun.</p>
            <div class="flex justify-center space-x-3">
                <button onclick="closeLoginAlert()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Tutup</button>
                <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Login</a>
            </div>
        </div>
    </div>
    @yield('extra-js')
    @stack('scripts')
</body>
</html>
