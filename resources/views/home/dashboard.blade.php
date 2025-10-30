@extends('home.navbar')

@section('title', 'Dashboard - Peduli Kasih')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-50 to-orange-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <!-- Left Content -->
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Berbagi Kebaikan,<br>
                    <span class="text-blue-600">Wujudkan Kepedulian</span>
                </h1>
                <p class="text-gray-600 text-lg mb-8">
                    Platform donasi yang memudahkan Anda peduli dengan mereka yang membutuhkan. Mari bersama menciptakan dampak positif untuk sesama.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#" class="px-6 py-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition shadow-lg">
                        Mulai Donasi Sekarang
                    </a>
                    <a href="#" class="px-6 py-3 bg-white text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition border border-gray-300">
                        Request Bantuan
                    </a>
                </div>
            </div>
            
            <!-- Right Image -->
            <div class="relative">
                <div class="bg-gradient-to-br from-orange-400 to-orange-300 rounded-3xl p-8 shadow-2xl">
                    <img src="/images/hero-illustration.svg" alt="Berbagi Kebaikan" class="w-full h-auto" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                    <div class="hidden w-full h-64 items-center justify-center">
                        <i class="fas fa-users text-white text-9xl opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <!-- Stat 1 -->
            <div class="text-center">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">2,450+</h3>
                <p class="text-gray-600 text-sm mt-1">Donatur Aktif</p>
            </div>
            
            <!-- Stat 2 -->
            <div class="text-center">
                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-hand-holding-heart text-orange-600 text-xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">850+</h3>
                <p class="text-gray-600 text-sm mt-1">Donasi Terkumpul</p>
            </div>
            
            <!-- Stat 3 -->
            <div class="text-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">650+</h3>
                <p class="text-gray-600 text-sm mt-1">Bantuan Tersalurkan</p>
            </div>
            
            <!-- Stat 4 -->
            <div class="text-center">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-heart text-purple-600 text-xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">1,200+</h3>
                <p class="text-gray-600 text-sm mt-1">Keluarga Terbantu</p>
            </div>
        </div>
    </div>
</section>

<!-- Latest Donations Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Donasi Terbaru</h2>
            <p class="text-gray-600">Lihat bagaimana kebaikan Anda dan hati mereka menciptakan perubahan nyata</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Donation Card 1 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition">
                <div class="relative h-48 bg-gradient-to-br from-blue-400 to-blue-600">
                    <img src="/images/donation1.jpg" alt="Bantuan Sembako" class="w-full h-full object-cover" onerror="this.style.display='none'">
                    <div class="absolute top-3 left-3 bg-orange-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                        Darurat
                    </div>
                </div>
                <div class="p-5">
                    <span class="text-xs text-gray-500">Desember 12, 2024</span>
                    <h3 class="text-lg font-bold text-gray-900 mt-2 mb-3">Bantuan Sembako untuk Keluarga Dhuafa</h3>
                    <p class="text-gray-600 text-sm mb-4">Membantu 15 keluarga prasejahtera dengan paket sembako yang sangat berguna untuk...</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">
                            <i class="fas fa-clock mr-1"></i> 2 menit lalu
                        </span>
                        <a href="#" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Donation Card 2 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition">
                <div class="relative h-48 bg-gradient-to-br from-green-400 to-green-600">
                    <img src="/images/donation2.jpg" alt="Pendidikan Anak" class="w-full h-full object-cover" onerror="this.style.display='none'">
                    <div class="absolute top-3 left-3 bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                        Pendidikan
                    </div>
                </div>
                <div class="p-5">
                    <span class="text-xs text-gray-500">Desember 11, 2024</span>
                    <h3 class="text-lg font-bold text-gray-900 mt-2 mb-3">Perlengkapan Sekolah Anak Yatim</h3>
                    <p class="text-gray-600 text-sm mb-4">Donasi alat tulis dan seragam untuk 30 anak yatim agar dapat belajar dengan...</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">
                            <i class="fas fa-clock mr-1"></i> 1 hari lalu
                        </span>
                        <a href="#" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Donation Card 3 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition">
                <div class="relative h-48 bg-gradient-to-br from-purple-400 to-purple-600">
                    <img src="/images/donation3.jpg" alt="Pakaian Layak" class="w-full h-full object-cover" onerror="this.style.display='none'">
                    <div class="absolute top-3 left-3 bg-purple-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                        Kemanusiaan
                    </div>
                </div>
                <div class="p-5">
                    <span class="text-xs text-gray-500">Desember 10, 2024</span>
                    <h3 class="text-lg font-bold text-gray-900 mt-2 mb-3">Pakaian Layak untuk Muslim Hujan</h3>
                    <p class="text-gray-600 text-sm mb-4">Distribusi pakaian berbagai ukuran untuk saudara kita yang membutuhkan musim penghujan...</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">
                            <i class="fas fa-clock mr-1"></i> 2 hari lalu
                        </span>
                        <a href="#" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center">
            <a href="#" class="inline-block px-6 py-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition">
                Lihat Semua Donasi
            </a>
        </div>
    </div>
</section>

<!-- Tips & Education Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Tips & Edukasi</h2>
            <p class="text-gray-600">Pelajari tips dan panduan untuk menjadi donatur yang bijak</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Tip 1 -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-shield-alt text-blue-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Kebaikan Kecil, Dampak Besar</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Donasi tidak harus besar selalu besar untuk membuat dampak. Mulai dengan berapa pun yang Anda mampu, kebaikan Anda bermakna!
                </p>
                <a href="#" class="text-blue-600 font-medium text-sm hover:underline inline-flex items-center">
                    Baca Lebih <i class="fas fa-arrow-right ml-2 text-xs"></i>
                </a>
            </div>
            
            <!-- Tip 2 -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-clipboard-check text-blue-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">4 Langkah Cek Kredibilitas Yayasan</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Jangan lewat verifikasi status resmi yayasan yang akan donasi untuk tujuan harus besar untuk membuat.
                </p>
                <a href="#" class="text-blue-600 font-medium text-sm hover:underline inline-flex items-center">
                    Baca Lebih <i class="fas fa-arrow-right ml-2 text-xs"></i>
                </a>
            </div>
            
            <!-- Tip 3 -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-moon text-blue-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Mengenal Zakat dan Crowdfunding Kebaikan</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Pahami prinsip zakat melalui sistem yang sesuai dan bagaimana pentingnya peran yang akan berperan penting untuk kebaikan.
                </p>
                <a href="#" class="text-blue-600 font-medium text-sm hover:underline inline-flex items-center">
                    Baca Lebih <i class="fas fa-arrow-right ml-2 text-xs"></i>
                </a>
            </div>
            
            <!-- Tip 4 -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-search text-blue-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Donasi Rutin vs. Donasi Sekali</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Pelajari perbedaan dan keuntungan donasi rutin dibandingkan dengan sekali plus dampak jangka panjang.
                </p>
                <a href="#" class="text-blue-600 font-medium text-sm hover:underline inline-flex items-center">
                    Baca Lebih <i class="fas fa-arrow-right ml-2 text-xs"></i>
                </a>
            </div>
            
            <!-- Tip 5 -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-mobile-alt text-blue-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Donasi Praktis Lewat E-Wallet</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Tata cara yang aman dan cepat untuk berdonasi digital e-wallet dari genggaman serta fitur pembayaran digital lainnya.
                </p>
                <a href="#" class="text-blue-600 font-medium text-sm hover:underline inline-flex items-center">
                    Baca Lebih <i class="fas fa-arrow-right ml-2 text-xs"></i>
                </a>
            </div>
            
            <!-- Tip 6 -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-trophy text-blue-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Keseimbangan Lemba dll Bakha dan Altu</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Identifikasi dan cara yang disalobakkan teranda di setiap keluarga yang membutuhkan bantuan Anda sehari-hari.
                </p>
                <a href="#" class="text-blue-600 font-medium text-sm hover:underline inline-flex items-center">
                    Baca Lebih <i class="fas fa-arrow-right ml-2 text-xs"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">FAQ</h2>
            <p class="text-gray-600">Proses mudah untuk berbagi dan menerima kebaikan</p>
        </div>
        
        <div class="space-y-4">
            <!-- FAQ Item 1 -->
            <div class="bg-blue-500 rounded-xl overflow-hidden">
                <button class="w-full px-6 py-4 text-left text-white font-semibold flex justify-between items-center hover:bg-blue-600 transition">
                    <span>Apakah setiap donasi akan langsung diterima oleh donee?</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>
            
            <!-- FAQ Item 2 -->
            <div class="bg-blue-500 rounded-xl overflow-hidden">
                <button class="w-full px-6 py-4 text-left text-white font-semibold flex justify-between items-center hover:bg-blue-600 transition">
                    <span>Apakah setiap donatur dan request diwajibkan oleh alamat?</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>
            
            <!-- FAQ Item 3 -->
            <div class="bg-blue-500 rounded-xl overflow-hidden">
                <button class="w-full px-6 py-4 text-left text-white font-semibold flex justify-between items-center hover:bg-blue-600 transition">
                    <span>Apakah setiap donasi dan request diwajibkan oleh alamat?</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>
            
            <!-- FAQ Item 4 (Expanded) -->
            <div class="bg-blue-500 rounded-xl overflow-hidden">
                <button class="w-full px-6 py-4 text-left text-white font-semibold flex justify-between items-center hover:bg-blue-600 transition">
                    <span>Bagaimana saya menreduksi status donasi atau request saya?</span>
                    <i class="fas fa-chevron-up"></i>
                </button>
                <div class="px-6 py-4 bg-blue-400 text-white">
                    Setelah dengan melakukan pendaftaran di main Bloryagl, tambahkan status pengunaan, verifikasi dengan mengunakan user untuk berikan yang lebih lanjutannya.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Cara Kerja Platform</h2>
            <p class="text-gray-600">Proses mudah untuk berbagi dan menerima kebaikan</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Step 1 -->
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-plus text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">1. Daftar Akun</h3>
                <p class="text-gray-600 text-sm">Buat akun gratis dan bergabung dengan komunitas peduli</p>
            </div>
            
            <!-- Step 2 -->
            <div class="text-center">
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-tasks text-orange-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">2. Post Kebutuhan</h3>
                <p class="text-gray-600 text-sm">Donatur posting kebutuhan atau request buat yang diperlukan</p>
            </div>
            
            <!-- Step 3 -->
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check-double text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">3. Verifikasi</h3>
                <p class="text-gray-600 text-sm">Tim kami memverifikasi donasi dan kecocokan kebutuhan</p>
            </div>
            
            <!-- Step 4 -->
            <div class="text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-handshake text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">4. Berbagi</h3>
                <p class="text-gray-600 text-sm">Donasi terdistribusi kepada yang membutuhkan</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-blue-700">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
            Mulai Berbagi Kebaikan Hari Ini
        </h2>
        <p class="text-blue-100 text-lg mb-8">
            Bergabunglah dengan ribuan orang yang telah memberikan manfaat untuk sesama
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="#" class="px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition shadow-lg">
                Mulai Donasi
            </a>
            <a href="#" class="px-8 py-3 bg-transparent border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-blue-600 transition">
                Ajukan Bantuan
            </a>
        </div>
    </div>
</section>

@endsection

@section('extra-js')
<script>
    // FAQ Accordion functionality
    document.querySelectorAll('.bg-blue-500 button').forEach(button => {
        button.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const icon = this.querySelector('i');
            
            if (content) {
                content.classList.toggle('hidden');
                icon.classList.toggle('fa-chevron-down');
                icon.classList.toggle('fa-chevron-up');
            }
        });
    });
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
</script>
@endsection