<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Peduli Kasih')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between h-16">
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-heart text-white text-xl"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-800">Peduli Kasih</span>
                </div>
                
                <!-- Navigation Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-500 font-semibold border-b-2 border-blue-500 pb-1 transition">
                        Dashboard
                    </a>
                    <a href="#" class="text-gray-600 hover:text-blue-500 font-medium transition">
                        Riwayat
                    </a>
                    <a href="#" class="text-gray-600 hover:text-blue-500 font-medium transition">
                        Edukasi & Tips
                    </a>
                    <a href="#" class="text-gray-600 hover:text-blue-500 font-medium transition">
                        FAQ
                    </a>
                </div>
                
                <!-- User Profile -->
                <div class="flex items-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                            Logout
                        </button>
                    </form>
                </div>

                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle and other interactive elements can be added here
    </script>
    
    @stack('scripts')
</body>
</html>