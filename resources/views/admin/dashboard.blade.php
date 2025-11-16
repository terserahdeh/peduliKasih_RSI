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
    /* Hide scrollbar but keep functionality */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    #detailModal {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        z-index: 999999 !important;
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #detailModal.hidden {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
    }

    #detailModal:not(.hidden) {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* Pastikan modal content terlihat */
    #detailModal > div {
        position: relative !important;
        z-index: 1000000 !important;
        margin: auto !important;
    }

    /* Prevent body scroll when modal open */
    body.modal-open {
        overflow: hidden !important;
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
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800">Daftar Pengguna</h2>
             <div class="flex space-x-3">
                <input type="text" id="searchPengguna" placeholder="Cari pengguna..." value="{{ request('searchPengguna') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></input>
            </div>
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
                <tbody id="penggunaTableBody" class="bg-white divide-y divide-gray-200">
                    @include('admin.pengguna_table',['penggunaList' => $penggunaList])
                </tbody>
            </table>
        </div>
    </div>
    
</div>

<!-- Modal Detail -->
<div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-[99999] flex items-center justify-center p-4" style="backdrop-filter: blur(4px);">
    <div class="bg-white rounded-xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6" id="modalContent">
            <div class="text-center py-8">
                <i class="fas fa-spinner fa-spin text-4xl text-blue-500"></i>
                <p class="text-gray-600 mt-4">Memuat detail...</p>
            </div>
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

    const searchInput = document.getElementById('searchPengguna');
        searchInput.addEventListener('input', doSearch);
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault(); 
                doSearch();         // jalankan search tanpa reload
            }
    });
    function doSearch() {
        const q = searchInput.value;

        fetch(`{{ route('admin.pengguna_table') }}?searchPengguna=${encodeURIComponent(q)}`, {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById('penggunaTableBody').innerHTML = html;
        })
        .catch(err => console.error(err));
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

    function showDetail(id, type) {
        console.log('showDetail called:', {id, type}); // Debug log
        
        const modal = document.getElementById("detailModal");
        const modalContent = document.getElementById("modalContent");

        if (!modal || !modalContent) {
            console.error('Modal elements not found!');
            return;
        }

        modal.classList.remove('hidden');
        console.log('Modal display:', window.getComputedStyle(modal).display);

        modalContent.innerHTML = `
            <div class="text-center py-8">
                <i class="fas fa-spinner fa-spin text-4xl text-blue-500"></i>
                <p class="text-gray-600 mt-4">Memuat detail...</p>
            </div>
        `;

        const url = `/admin/detail/${type}/${id}`;
        console.log('Fetching URL:', url); // Debug log

        fetch(url)
            .then(res => {
                console.log('Response status:', res.status); // Debug log
                if (!res.ok) {
                    throw new Error(`HTTP error! status: ${res.status}`);
                }
                return res.text();
            })
            .then(html => {
                console.log('HTML received, length:', html.length); // Debug log
                modalContent.innerHTML = html;

                
            })
            .catch(err => {
                console.error('Fetch error:', err); // Debug log
                modalContent.innerHTML = `
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-6">
                            <h2 class="text-2xl font-bold text-gray-800">Error</h2>
                            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition">
                                <i class="fas fa-times text-2xl"></i>
                            </button>
                        </div>
                        <div class="text-center py-8 text-red-500">
                            <i class="fas fa-exclamation-circle text-4xl"></i>
                            <p class="mt-3 font-semibold">Tidak dapat memuat detail</p>
                            <p class="text-sm text-gray-600 mt-2">${err.message}</p>
                        </div>
                    </div>
                `;
            });
    }

    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    function confirmDelete(id) {
        if(confirm('⚠️ Apakah Anda yakin ingin menghapus request donasi ini?\n\nRequest yang dihapus tidak dapat dikembalikan.')) {
            const form = document.getElementById('deleteForm');
            form.action = `/request-donasi/${id}`;
            form.submit();
        }
    }

    function scrollCards(direction) {
        const container = document.getElementById('cardsContainer');
        const scrollAmount = 336; // width of card (320px) + gap (16px)
        
        if (direction === 'left') {
            container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else {
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }

    // Close on outside click
    document.getElementById('detailModal')?.addEventListener('click', function(e) {
        if(e.target === this) closeModal();
    });

    // Close with ESC key
    document.addEventListener('keydown', function(e) {
        if(e.key === 'Escape') closeModal();
    });

    // Mobile menu toggle
    document.getElementById('mobile-menu-button')?.addEventListener('click', () => {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
@endpush