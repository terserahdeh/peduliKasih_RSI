@extends('home.navbar')

@section('title', 'Edit Profil - Peduli Kasih')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb Navigation -->
        <div class="mb-6">
            <button onclick="window.history.back()" class="flex items-center text-gray-600 hover:text-blue-600 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </button>
        </div>

        <!-- Edit Profile Form -->
        <div class="bg-white rounded-lg shadow-sm p-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('home.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Profile Picture Section -->
                <div class="flex items-start mb-8">
                    <div class="relative">
                        <img id="profilePreview" 
                             src="{{ auth()->user()->avatar && file_exists(public_path(auth()->user()->avatar)) 
                                    ? asset(auth()->user()->avatar) 
                                    : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->nama) . '&size=120' }}"
                            alt="Profile Picture"
                            class="w-28 h-28 rounded-full object-cover border-4 border-gray-200">
                        
                        <!-- Edit Button Overlay -->
                        <label for="avatar" class="absolute bottom-0 right-0 bg-blue-600 text-white p-2 rounded-full cursor-pointer hover:bg-blue-700 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                            <input type="file" 
                                   id="avatar" 
                                   name="avatar" 
                                   accept="image/*" 
                                   class="hidden"
                                   onchange="previewImage(event)">
                        </label>
                    </div>

                    <div class="ml-6 flex-1">
                        <h2 class="text-2xl font-bold text-gray-900">{{ auth()->user()->nama }}</h2>
                        <p class="text-gray-600">{{ auth()->user()->email }}</p>
                        <p class="text-sm text-gray-500 mt-1">Bergabung sejak {{ date('F Y', strtotime(auth()->user()->created_at)) }}</p>
                    </div>
                </div>

                <!-- Form Fields -->
                <div class="space-y-6">
                    
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap
                        </label>
                        <input type="text" 
                               id="nama" 
                               name="nama" 
                               value="{{ old('nama', auth()->user()->nama) }}"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                               required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', auth()->user()->email) }}"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                               required>
                        <p class="text-xs text-gray-500 mt-1">Email tidak dapat diubah untuk akun terverifikasi</p>
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <label for="no_tlp" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Telepon
                        </label>
                        <input type="tel" 
                               id="no_tlp" 
                               name="no_tlp" 
                               value="{{ old('no_tlp', auth()->user()->no_tlp) }}"
                               placeholder="+62 812-3456-7890"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                               required>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                    <button type="button" 
                            onclick="window.history.back()"
                            class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

@push('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('profilePreview');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            reader.readAsDataURL(file);
        } else {
            preview.src = "{{ asset(auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->nama)) }}";
        }
    }
</script>
@endpush
@endsection
