@include('home.navbar')

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-3">Edit Request Donasi</h1>
                <p class="text-gray-600 text-lg">Perbarui informasi request donasi Anda.</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                @if($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                        <p class="font-semibold mb-2">Terdapat kesalahan:</p>
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-6 bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-lg">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-xl mr-3 mt-1"></i>
                        <div>
                            <p class="font-semibold mb-1">Perhatian: Edit Request</p>
                            <p class="text-sm">Setelah Anda mengedit request ini, status akan kembali ke <strong>"Menunggu Verifikasi"</strong> dan request akan dihapus dari halaman utama sampai admin menyetujui kembali.</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('request-donasi.update', $req->id_request) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nama Pengaju -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">
                            Nama Pengaju
                        </label>
                        <input type="text" 
                               value="{{ Auth::user()->nama }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100" 
                               disabled>
                    </div>

                    <!-- Jenis Donasi -->
                    <div class="mb-6">
                        <label for="jenis_barang" class="block text-gray-700 font-semibold mb-2">
                            Jenis Donasi <span class="text-red-500">*</span>
                        </label>
                        <select name="jenis_barang" 
                                id="jenis_barang" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                            <option value="">Pilih Jenis Donasi</option>
                            <option value="alat rumah tangga" {{ old('jenis_barang', $req->jenis_barang) == 'alat rumah tangga' ? 'selected' : '' }}>Alat Rumah Tangga</option>
                            <option value="sembako" {{ old('jenis_barang', $req->jenis_barang) == 'sembako' ? 'selected' : '' }}>Sembako</option>
                            <option value="pakaian" {{ old('jenis_barang', $req->jenis_barang) == 'pakaian' ? 'selected' : '' }}>Pakaian</option>
                            <option value="alat tulis" {{ old('jenis_barang', $req->jenis_barang) == 'alat tulis' ? 'selected' : '' }}>Alat Tulis</option>
                            <option value="lain-lain" {{ old('jenis_barang', $req->jenis_barang) == 'lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                        </select>
                    </div>

                    <!-- Nama Barang -->
                    <div class="mb-6">
                        <label for="nama_request" class="block text-gray-700 font-semibold mb-2">
                            Nama Barang <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="nama_request" 
                               id="nama_request"
                               value="{{ old('nama_request', $req->nama_request) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Nama Spesifik Barang"
                               required>
                    </div>

                    <!-- Jumlah Barang -->
                    <div class="mb-6">
                        <label for="jumlah_barang" class="block text-gray-700 font-semibold mb-2">
                            Jumlah Barang
                        </label>
                        <input type="number" 
                               name="jumlah_barang" 
                               id="jumlah_barang"
                               value="{{ old('jumlah_barang', $req->jumlah_barang) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Contoh: 100"
                               min="1">
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-6">
                        <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">
                            Deskripsi Kebutuhan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="deskripsi" 
                                  id="deskripsi"
                                  rows="6"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Jelaskan alasan kebutuhan donasi, siapa penerimanya, dan manfaat yang diharapkan. Minimal 20 karakter."
                                  required>{{ old('deskripsi', $req->deskripsi) }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">Minimal 20 karakter</p>
                    </div>

                    <!-- Upload Foto -->
                    <div class="mb-8">
                        <label class="block text-gray-700 font-semibold mb-2">
                            Upload Contoh Barang
                        </label>

                        @if($req->foto)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                                <img src="{{ Storage::url($req->foto) }}" 
                                     alt="Current" 
                                     class="max-w-xs h-auto rounded-lg shadow-md">
                            </div>
                        @endif

                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition">
                            <div class="mb-4">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-5xl"></i>
                            </div>
                            <p class="text-gray-600 mb-2">Klik untuk upload foto baru atau drag & drop</p>
                            <p class="text-sm text-gray-500 mb-4">JPG, PNG hingga 5MB</p>
                            <input type="file" 
                                   name="foto" 
                                   id="foto"
                                   accept="image/jpeg,image/jpg,image/png"
                                   class="hidden"
                                   onchange="previewImage(this)">
                            <button type="button" 
                                    onclick="document.getElementById('foto').click()"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold transition">
                                Pilih File Baru
                            </button>
                        </div>

                        <!-- Preview -->
                        <div id="imagePreview" class="mt-4 hidden">
                            <p class="text-sm text-gray-600 mb-2">Preview foto baru:</p>
                            <img id="preview" class="max-w-xs h-auto rounded-lg shadow-md" alt="Preview">
                            <button type="button" 
                                    onclick="removeImage()"
                                    class="mt-2 text-red-500 hover:text-red-700 text-sm">
                                <i class="fas fa-times mr-1"></i> Batalkan Foto Baru
                            </button>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4">
                        <a href="{{ route('request-donasi.status') }}" 
                           class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-lg font-semibold text-center transition">
                            Batal
                        </a>
                        <button type="submit" 
                                class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-semibold transition">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage() {
    document.getElementById('foto').value = '';
    document.getElementById('imagePreview').classList.add('hidden');
}
</script>
