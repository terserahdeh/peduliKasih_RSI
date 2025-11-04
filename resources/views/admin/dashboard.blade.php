@extends('admin.navbar')

@section('title', 'Dashboard Admin - Peduli Kasih')

@push('styles')
<style>
    .status-updating {
        opacity: 0.6;
        pointer-events: none;
    }
    select:disabled {
    background-color: #e5e7eb !important; /* gray-200 */
    color: #6b7280 !important; /* gray-500 */
    cursor: not-allowed;
    opacity: 0.7;
}
</style>
@endpush

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
        <p class="text-gray-600 mt-1">Selamat datang, {{Auth::guard('admin')->user()->nama}}</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8" id="statsCards">
        <!-- Donasi Menunggu Verifikasi -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Donasi Menunggu Verifikasi</p>
                    <h3 class="text-3xl font-bold text-orange-500" id="donasiMenunggu">{{ $donasiMenunggu ?? 24 }}</h3>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-orange-500 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Permintaan Menunggu Verifikasi -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Permintaan Menunggu Verifikasi</p>
                    <h3 class="text-3xl font-bold text-blue-500" id="permintaanMenunggu">{{ $permintaanMenunggu ?? 18 }}</h3>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-download text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Pengguna Aktif -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Pengguna Aktif</p>
                    <h3 class="text-3xl font-bold text-green-500" id="penggunaAktif">{{ number_format($penggunaAktif ?? 1247) }}</h3>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-green-500 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Terpenuhi -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Terpenuhi</p>
                    <h3 class="text-3xl font-bold text-purple-500" id="totalTerpenuhi">{{ $totalTerpenuhi }}</h3>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-purple-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Verifikasi Post Donasi -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 mb-8">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-800">Verifikasi Post Donasi</h2>
                <div class="flex space-x-3">
                    <select id="filterVerifikasiDonasi" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Verifikasi</option>
                        <option value="menunggu">Menunggu</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                    <select id="filterStatusDonasi" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="tersalurkan">Tersalurkan</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Donatur</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul Donasi</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah Donasi</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Verifikasi</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status Donasi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="donasiTableBody">
                    @forelse($donasiList ?? [] as $donasi)
                    <tr class="hover:bg-gray-50 donasi-row" data-verifikasi="{{ $donasi->hasil_verif }}" data-status="{{ $donasi->status_donasi }}">
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $donasi->username }}</td>
                        <td class="px-6 py-4 text-sm">
                            <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline font-medium">
                                {{ $donasi->nama_donasi }}
                            </a>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $donasi->jumlah_barang }}</td>
                        <td class="px-6 py-4 verifikasi-cell">
                            @if($donasi->hasil_verif === 'menunggu')
                            <div class="flex space-x-2">
                                <button onclick="updateVerifikasi(this, {{ $donasi->id_donasi }}, 'disetujui', 'donasi')"
                                        class="px-3 py-1 text-xs font-medium text-white bg-green-500 hover:bg-green-600 rounded-full flex items-center transition">
                                    <i class="fas fa-check mr-1"></i> Setujui
                                </button>
                                <button onclick="updateVerifikasi(this, {{ $donasi->id_donasi }}, 'ditolak', 'donasi')"
                                        class="px-3 py-1 text-xs font-medium text-white bg-red-500 hover:bg-red-600 rounded-full flex items-center transition">
                                    <i class="fas fa-times mr-1"></i> Tolak
                                </button>
                            </div>
                            @elseif($donasi->hasil_verif === 'disetujui')
                            <span class="px-3 py-1 text-xs font-medium text-white bg-green-500 rounded-full inline-flex items-center">
                                <i class="fas fa-check-circle mr-1"></i> Disetujui
                            </span>
                            @elseif($donasi->hasil_verif === 'ditolak')
                            <span class="px-3 py-1 text-xs font-medium text-white bg-red-500 rounded-full inline-flex items-center">
                                <i class="fas fa-times-circle mr-1"></i> Ditolak
                            </span>
                            @else
                            <span class="px-3 py-1 text-xs font-medium text-gray-700 rounded-full inline-flex items-center">
                                {{ $donasi->hasil_verif }}
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <select 
                                onchange="updateStatusDonasi(this, {{ $donasi->id_donasi }}, this.value)"
                                class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
                                @if($donasi->hasil_verif == 'menunggu' || $donasi->hasil_verif == 'ditolak') disabled @endif
                            >
                                <option value="tersedia" {{ $donasi->status_donasi == 'tersedia' ? 'selected' : '' }}>
                                    Tersedia
                                </option>
                                <option value="tersalurkan" {{ $donasi->status_donasi == 'tersalurkan' ? 'selected' : '' }}>
                                    Tersalurkan
                                </option>
                            </select>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="px-6 py-4 text-center text-gray-500" colspan="5">
                            Data kosong
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-gray-100 text-center">
            <a href="#" class="text-blue-500 hover:text-blue-600 font-medium text-sm">
                Lihat Semua Donasi
            </a>
        </div>
    </div>

    <!-- Verifikasi Permintaan Donasi -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 mb-8">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-800">Verifikasi Permintaan Donasi</h2>
                <div class="flex space-x-3">
                    <select id="filterVerifikasiPermintaan" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Verifikasi</option>
                        <option value="menunggu">Menunggu</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                    <select id="filterStatusPermintaan" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="belum terpenuhi">Belum Terpenuhi</option>
                        <option value="terpenuhi">Terpenuhi</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Peminta</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul Permintaan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah Kebutuhan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Verifikasi</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status Permintaan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="permintaanTableBody">
                    @forelse($permintaanList ?? [] as $permintaan)
                    <tr class="hover:bg-gray-50 permintaan-row" data-verifikasi="{{ $permintaan->hasil_verif }}" data-status="{{ $permintaan->status_request }}">
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $permintaan->username }}</td>
                        <td class="px-6 py-4 text-sm">
                            <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline font-medium">
                                {{ $permintaan->nama_request }}
                            </a>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $permintaan->jumlah_barang }}</td>
                        <td class="px-6 py-4 verifikasi-cell">
                            @if($permintaan->hasil_verif == 'menunggu')
                            <div class="flex space-x-2">
                                <button onclick="updateVerifikasi(this, {{ $permintaan->id_request }}, 'disetujui', 'permintaan')" 
                                    class="px-3 py-1 text-xs font-medium text-white bg-green-500 rounded-lg hover:bg-green-600 transition mr-2">
                                    <i class="fas fa-check mr-1"></i> Setujui
                                </button>

                                <button onclick="updateVerifikasi(this, {{ $permintaan->id_request }}, 'ditolak', 'permintaan')" 
                                    class="px-3 py-1 text-xs font-medium text-white bg-red-500 rounded-lg hover:bg-red-600 transition">
                                    <i class="fas fa-times mr-1"></i> Tolak
                                </button>
                            </div>
                            @elseif($permintaan->hasil_verif == 'disetujui')
                            <span class="px-3 py-1 text-xs font-medium text-white bg-green-500 rounded-full inline-flex items-center">
                                <i class="fas fa-check-circle mr-1"></i> Disetujui
                            </span>
                            @else
                            <span class="px-3 py-1 text-xs font-medium text-white bg-red-500 rounded-full inline-flex items-center">
                                <i class="fas fa-times-circle mr-1"></i> Ditolak
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <select 
                                onchange="updateStatusPermintaan(this, {{ $permintaan->id_request }}, this.value)"
                                class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
                                @if($permintaan->hasil_verif == 'menunggu' || $permintaan->hasil_verif == 'ditolak') disabled @endif
                            >
                                <option value="belum_terpenuhi" {{ $permintaan->status_request == 'belum_terpenuhi' ? 'selected' : '' }}>
                                    Belum Terpenuhi
                                </option>
                                <option value="terpenuhi" {{ $permintaan->status_request == 'terpenuhi' ? 'selected' : '' }}>
                                    Terpenuhi
                                </option>
                            </select>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="px-6 py-4 text-center text-gray-500" colspan="5">
                            Data kosong
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-gray-100 text-center">
            <a href="#" class="text-blue-500 hover:text-blue-600 font-medium text-sm">
                Lihat Semua Permintaan Donasi
            </a>
        </div>
    </div>
    @if(session('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif
    <!-- Daftar Pengguna -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-800">Daftar Pengguna</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Username</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Bergabung</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($penggunaList ?? [] as $pengguna)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $pengguna->username }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $pengguna->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $pengguna->created_at->format('d-m-Y') }}</td>
                        <td class="px-6 py-4">
                            <!-- ✅ Delete Form -->
                            <form action="{{ route('admin.pengguna.delete', $pengguna->id_akun) }}"
                                method="POST" class="inline-block"
                                onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-4 py-1.5 text-xs font-medium text-white bg-red-500 rounded-lg hover:bg-red-600 transition flex items-center">
                                    <i class="fas fa-trash mr-1"></i> Hapus Akun
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="px-6 py-4 text-center text-gray-500" colspan="5">
                            Data kosong
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-gray-100 text-center">
            <!--EDIT-->
            <a href="{{ route('admin.dashboard') }}" class="text-blue-500 hover:text-blue-600 font-medium text-sm">
                Lihat Semua Profil
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function updateVerifikasi(button, id, status, type) {
        // basic UI guard
        if (!button || !id || !status || !type) {
            console.error('updateVerifikasi: missing args', { button, id, status, type });
            return;
        }

        const row = button.closest('tr');
        const cell = row.querySelector('.verifikasi-cell');

        // UI: disable buttons inside the cell while updating
        const buttons = cell.querySelectorAll('button');
        buttons.forEach(b => b.disabled = true);
        cell.classList.add('status-updating');

        // Build URL
        const url = `/admin/${type}/verifikasi/${id}`;
        console.log('updateVerifikasi ->', { url, status });

        // Prepare CSRF
        const meta = document.querySelector('meta[name="csrf-token"]');
        const csrf = meta ? meta.getAttribute('content') : null;
        if (!csrf) console.warn('CSRF token not found in meta tag');

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ status: status })
        })
        .then(async (response) => {
            console.log('HTTP status:', response.status);
            // Try to parse JSON safely
            let data = null;
            try { data = await response.json(); } catch (e) { console.warn('No JSON body', e); }
            return { ok: response.ok, status: response.status, data };
        })
        .then(({ ok, status: httpStatus, data }) => {
            // enable buttons again
            buttons.forEach(b => b.disabled = false);
            cell.classList.remove('status-updating');

            console.log('Response data:', data);

            if (!ok) {
                // show useful message
                const msg = (data && (data.message || JSON.stringify(data))) || `Request failed (${httpStatus})`;
                showNotification(msg, 'error');
                return;
            }

            if (data && data.success) {
                // update UI to reflect new verifikasi
                if (status === 'disetujui') {
                    cell.innerHTML = `
                        <span class="px-3 py-1 text-xs font-medium text-white bg-green-500 rounded-full inline-flex items-center">
                            <i class="fas fa-check-circle mr-1"></i> Disetujui
                        </span>
                    `;
                } else if (status === 'ditolak') {
                    cell.innerHTML = `
                        <span class="px-3 py-1 text-xs font-medium text-white bg-red-500 rounded-full inline-flex items-center">
                            <i class="fas fa-times-circle mr-1"></i> Ditolak
                        </span>
                    `;
                } else {
                    cell.textContent = status;
                }

                // update data attribute
                row.setAttribute('data-verifikasi', status);

                // update stats
                updateStatisticsCards();

                showNotification('Verifikasi berhasil diperbarui', 'success');
            } else {
                const msg = (data && (data.message || JSON.stringify(data))) || 'Gagal memperbarui verifikasi';
                showNotification(msg, 'error');
            }
        })
        .catch((err) => {
            console.error('Fetch error:', err);
            buttons.forEach(b => b.disabled = false);
            cell.classList.remove('status-updating');
            showNotification('Terjadi kesalahan jaringan saat memperbarui verifikasi', 'error');
        });
    }
    // Update Status Permintaan
    function updateStatusPermintaan(select, id, status) {
        const row = select.closest('tr');
        
        select.disabled = true;
        select.classList.add('status-updating');
        
        fetch(`/admin/permintaan/status/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ status: status })
        })
        .then(res => res.json())
        .then(data => {
            if (!data.success) throw new Error("Update status gagal");
            
            row.setAttribute('data-status', status);

            // ✅ Tambahkan ini supaya "Total Terpenuhi" ikut update
            updateStatisticsCards();

            select.disabled = false;
            select.classList.remove('status-updating');
            showNotification('Status permintaan berhasil diperbarui!', 'success');
        })
        .catch(err => {
            console.error(err);
            select.disabled = false;
            select.classList.remove('status-updating');
            showNotification('Gagal memperbarui status permintaan', 'error');
        });
    }


    // Update Status Donasi
    function updateStatusDonasi(select, id, status) {
        const row = select.closest('tr');

        select.disabled = true;
        select.classList.add('status-updating');
        
        fetch(`/admin/donasi/status/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ status: status })
        })
        .then(r => r.json())
        .then(data => {
            if (!data.success) throw new Error("Update gagal");
            
            row.dataset.status = status;

            select.disabled = false;
            select.classList.remove('status-updating');

            showNotification('Status donasi berhasil diperbarui!', 'success');
        })
        .catch(error => {
            console.error(error);
            select.disabled = false;
            select.classList.remove('status-updating');
            showNotification('Gagal memperbarui status donasi', 'error');
        });
    }


    // // Update Status Permintaan
    // function updateStatusPermintaan(id, status) {
    //     const select = event.target;
    //     const row = select.closest('tr');
        
    //     // Add loading state
    //     select.disabled = true;
    //     select.classList.add('status-updating');
        
    //     fetch(`/admin/permintaan/status/${id}`, {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    //         },
    //         body: JSON.stringify({ status: status })
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         if (data.success) {
    //             // Update data attribute
    //             row.setAttribute('data-status', status);
                
    //             // Update statistics cards
    //             updateStatisticsCards();
                
    //             // Remove loading state
    //             select.disabled = false;
    //             select.classList.remove('status-updating');
                
    //             // Show success notification
    //             showNotification('Status permintaan berhasil diperbarui', 'success');
    //         }
    //     })
    //     .catch(error => {
    //         console.error('Error:', error);
    //         select.disabled = false;
    //         select.classList.remove('status-updating');
    //         showNotification('Gagal memperbarui status permintaan', 'error');
    //     });
    // }

    // Delete Pengguna
    function deletePengguna(id) {
        if (!confirm('Apakah Anda yakin ingin menghapus akun ini?')) {
            return;
        }
        
        const button = event.target.closest('button');
        const row = button.closest('tr');
        
        // Add loading state
        button.disabled = true;
        button.classList.add('status-updating');
        
        fetch(`/admin/pengguna/delete/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove row with animation
                row.style.opacity = '0';
                row.style.transform = 'translateX(-20px)';
                row.style.transition = 'all 0.3s ease';
                
                setTimeout(() => {
                    row.remove();
                }, 300);
                
                // Update statistics cards
                updateStatisticsCards();
                
                // Show success notification
                showNotification('Pengguna berhasil dihapus', 'success');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            button.disabled = false;
            button.classList.remove('status-updating');
            showNotification('Gagal menghapus pengguna', 'error');
        });
    }

    // Update Statistics Cards
    function updateStatisticsCards() {
        fetch('/admin/statistics', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update each card with animation
                animateValue('donasiMenunggu', parseInt(document.getElementById('donasiMenunggu').textContent), data.donasiMenunggu, 500);
                animateValue('permintaanMenunggu', parseInt(document.getElementById('permintaanMenunggu').textContent), data.permintaanMenunggu, 500);
                animateValue('penggunaAktif', parseInt(document.getElementById('penggunaAktif').textContent.replace(/,/g, '')), data.penggunaAktif, 500);
                animateValue(
                    'totalTerpenuhi',
                    parseInt(document.getElementById('totalTerpenuhi').textContent.replace(/,/g, '')),
                    data.totalTerpenuhi,
                    500
                );            
            }
        })
        .catch(error => {
            console.error('Error updating statistics:', error);
        });
    }

    // Animate number changes
    function animateValue(id, start, end, duration) {
        const element = document.getElementById(id);
        const range = end - start;
        const increment = range / (duration / 16); // 60fps
        let current = start;
        
        const timer = setInterval(() => {
            current += increment;
            if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
                current = end;
                clearInterval(timer);
            }
            
            // Format number with comma for penggunaAktif
            if (id === 'penggunaAktif') {
                element.textContent = Math.round(current).toLocaleString();
            } else {
                element.textContent = Math.round(current);
            }
        }, 16);
    }

    // Show notification
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white z-50 ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        notification.innerHTML = `
            <div class="flex items-center space-x-2">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.style.opacity = '1';
            notification.style.transform = 'translateY(0)';
        }, 10);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }

    // Filter functionality for Donasi
    document.getElementById('filterVerifikasiDonasi').addEventListener('change', function() {
        filterTable('donasi', this.value, document.getElementById('filterStatusDonasi').value);
    });

    document.getElementById('filterStatusDonasi').addEventListener('change', function() {
        filterTable('donasi', document.getElementById('filterVerifikasiDonasi').value, this.value);
    });

    // Filter functionality for Permintaan
    document.getElementById('filterVerifikasiPermintaan').addEventListener('change', function() {
        filterTable('permintaan', this.value, document.getElementById('filterStatusPermintaan').value);
    });

    document.getElementById('filterStatusPermintaan').addEventListener('change', function() {
        filterTable('permintaan', document.getElementById('filterVerifikasiPermintaan').value, this.value);
    });

    // Filter table function
    function filterTable(type, verifikasiFilter, statusFilter) {
        const rows = document.querySelectorAll(`.${type}-row`);
        
        rows.forEach(row => {
            const verifikasi = row.getAttribute('data-verifikasi');
            const status = row.getAttribute('data-status');
            
            let showRow = true;
            
            // Check verifikasi filter
            if (verifikasiFilter && verifikasi !== verifikasiFilter) {
                showRow = false;
            }
            
            // Check status filter
            if (statusFilter && status !== statusFilter) {
                showRow = false;
            }
            
            // Show or hide row with animation
            if (showRow) {
                row.style.display = '';
                setTimeout(() => {
                    row.style.opacity = '1';
                }, 10);
            } else {
                row.style.opacity = '0';
                setTimeout(() => {
                    row.style.display = 'none';
                }, 300);
            }
        });
    }

    // Initialize notification styling
    const style = document.createElement('style');
    style.textContent = `
        .fixed {
            transition: opacity 0.3s ease, transform 0.3s ease;
            opacity: 0;
            transform: translateY(-20px);
        }
    `;
    document.head.appendChild(style);
    document.addEventListener('click', function(e) {
        if (e.target.matches('.btn-delete')) {
            const id = e.target.dataset.id;

            if(confirm('Yakin ingin menghapus pengguna ini?')) {
                fetch(`/admin/pengguna/delete/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(res => res.json())
                .then(() => location.reload());
            }
        }
    });
</script>
@endpush