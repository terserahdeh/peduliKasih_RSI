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
        <p class="text-gray-600 mt-1">Selamat datang, {{ Auth::guard('admin')->user()->nama }}</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8" id="statsCards">
        <!-- Donasi Menunggu Verifikasi -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Donasi Menunggu Verifikasi</p>
                    <h3 class="text-3xl font-bold text-orange-500" id="donasiMenunggu">{{ $donasiMenunggu ?? 0 }}</h3>
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
                    <h3 class="text-3xl font-bold text-blue-500" id="permintaanMenunggu">{{ $permintaanMenunggu ?? 0 }}</h3>
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
                    <h3 class="text-3xl font-bold text-green-500" id="penggunaAktif">{{ number_format($penggunaAktif ?? 0) }}</h3>
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
                    <h3 class="text-3xl font-bold text-purple-500" id="totalTerpenuhi">{{ $totalTerpenuhi ?? 0 }}</h3>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-purple-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Verifikasi Donasi -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 mb-8">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800">Verifikasi Post Donasi</h2>
            <div class="flex space-x-3">
                <select id="filterVerifikasiDonasi" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Verifikasi</option>
                    <option value="menunggu" {{ request('filterVerifikasiDonasi') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="disetujui" {{ request('filterVerifikasiDonasi') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ request('filterVerifikasiDonasi') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <select id="filterStatusDonasi" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="tersedia" {{ request('filterStatusDonasi') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="tersalurkan" {{ request('filterStatusDonasi') == 'tersalurkan' ? 'selected' : '' }}>Tersalurkan</option>
                </select>
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
                    @include('admin.donasi_table', ['donasiList' => $donasiList])
                </tbody>
            </table>
        </div>
    </div>

    <!-- Verifikasi Permintaan -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 mb-8">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800">Verifikasi Permintaan Donasi</h2>
            <div class="flex space-x-3">
                <select id="filterVerifikasiPermintaan" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Verifikasi</option>
                    <option value="menunggu" {{ request('filterVerifikasiPermintaan') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="disetujui" {{ request('filterVerifikasiPermintaan') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ request('filterVerifikasiPermintaan') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <select id="filterStatusPermintaan" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="terpenuhi" {{ request('filterStatusPermintaan') == 'terpenuhi' ? 'selected' : '' }}>Terpenuhi</option>
                    <option value="belum terpenuhi" {{ request('filterStatusPermintaan') == 'belum terpenuhi' ? 'selected' : '' }}>Belum Terpenuhi</option>
                </select>
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
                    @include('admin.permintaan_table', ['permintaanList' => $permintaanList])
                </tbody>
            </table>
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
        const select = row.querySelector('select'); // grab dropdown in the same row

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
                    if (select) select.disabled = false; // enable dropdown
                } else if (status === 'ditolak') {
                    cell.innerHTML = `
                        <span class="px-3 py-1 text-xs font-medium text-white bg-red-500 rounded-full inline-flex items-center">
                            <i class="fas fa-times-circle mr-1"></i> Ditolak
                        </span>
                    `;
                    if (select) select.disabled = true; // keep dropdown disabled
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

        // Disable dropdown during update
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

            // Update row data attribute
            row.setAttribute('data-status', status);

            // ✅ Update "Total Terpenuhi" or any stats cards
            updateStatisticsCards();

            // Re-enable dropdown only if hasil_verif === 'disetujui'
            const hasilVerif = row.getAttribute('data-verifikasi');
            if (hasilVerif === 'disetujui') {
                select.disabled = false;
            } else {
                select.disabled = true;
            }

            select.classList.remove('status-updating');
            showNotification('Status permintaan berhasil diperbarui!', 'success');
        })
        .catch(err => {
            console.error(err);
            // keep disabled based on verifikasi
            const hasilVerif = row.getAttribute('data-verifikasi');
            select.disabled = hasilVerif !== 'disetujui';
            select.classList.remove('status-updating');
            showNotification('Gagal memperbarui status permintaan', 'error');
        });
    }

    // Update Status Donasi
    function updateStatusDonasi(select, id, status) {
        const row = select.closest('tr');

        // Disable dropdown during update
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

            // Update row data attribute
            row.dataset.status = status;

            // ✅ Enable dropdown only if hasil_verif === 'disetujui'
            const hasilVerif = row.dataset.verifikasi;
            if (hasilVerif === 'disetujui') {
                select.disabled = false;
            } else {
                select.disabled = true;
            }

            select.classList.remove('status-updating');

            showNotification('Status donasi berhasil diperbarui!', 'success');
        })
        .catch(error => {
            console.error(error);

            // Keep disabled based on verifikasi
            const hasilVerif = row.dataset.verifikasi;
            select.disabled = hasilVerif !== 'disetujui';
            select.classList.remove('status-updating');

            showNotification('Gagal memperbarui status donasi', 'error');
        });
    }


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

    document.querySelectorAll('#filterVerifikasiDonasi, #filterStatusDonasi').forEach(select => {
        select.addEventListener('change', () => {
            const verif = document.getElementById('filterVerifikasiDonasi').value;
            const status = document.getElementById('filterStatusDonasi').value;

            fetch(`/admin/dashboard/donasi-table?filterVerifikasiDonasi=${verif}&filterStatusDonasi=${status}`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('donasiTableBody').innerHTML = html;
                });
        });
    });

    document.querySelectorAll('#filterVerifikasiPermintaan, #filterStatusPermintaan').forEach(select => {
        select.addEventListener('change', () => {
            const verif = document.getElementById('filterVerifikasiPermintaan').value;
            const status = document.getElementById('filterStatusPermintaan').value;

            fetch(`/admin/dashboard/permintaan-table?filterVerifikasiPermintaan=${verif}&filterStatusPermintaan=${status}`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('permintaanTableBody').innerHTML = html;
                });
        });
    });
</script>
@endpush