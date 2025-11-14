<footer class="bg-gray-900 text-white mt-auto">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand -->
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-9 h-9 bg-blue-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-hand-holding-heart text-white"></i>
                    </div>
                    <span class="text-xl font-bold">Peduli Kasih</span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Platform donasi terpercaya untuk menyalurkan kebaikan kepada sesama yang membutuhkan.
                </p>
            </div>

            <!-- Menu Utama -->
            <div>
                <h3 class="font-semibold text-lg mb-4">Menu Utama</h3>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="#" class="hover:text-white transition">Donasi</a></li>
                    <li><a href="{{ route('request-donasi.landing') }}" class="hover:text-white transition">Request Donasi</a></li>
                    <li><a href="#" class="hover:text-white transition">Riwayat</a></li>
                </ul>
            </div>

            <!-- Bantuan -->
            <div>
                <h3 class="font-semibold text-lg mb-4">Bantuan</h3>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                    <li><a href="#" class="hover:text-white transition">Cara Donasi</a></li>
                    <li><a href="https://wa.me/082998252532" target="_blank" class="hover:text-white transition">Hubungi Kami</a></li>
                    <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                </ul>
            </div>

            <!-- Social Media -->
            <div>
                <h3 class="font-semibold text-lg mb-4">Ikuti Kami</h3>
                <div class="flex space-x-3">
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-pink-600 transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-400 transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
            <p>© 2024 Peduli Kasih. Seluruh hak cipta dilindungi.</p>
        </div>
    </div>
</footer>