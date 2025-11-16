{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    {{-- Tambahkan link CSS/aset di sini --}}
</head>
<body>
    <header>... Navigasi Admin ...</header>
    
    <main class="py-4">
        {{-- Ini adalah tempat konten dari show.blade.php akan dimasukkan --}}
        @yield('content') 
    </main>

    <footer>... Footer Admin ...</footer>
    {{-- Tambahkan script JS di sini --}}
</body>
</html>