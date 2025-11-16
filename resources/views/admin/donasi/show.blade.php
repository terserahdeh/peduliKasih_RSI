{{-- resources/views/admin/donasi/show.blade.php --}}
@extends('admin.navbar')

@section('content')
<style>
    .detail-page {
        max-width: 900px;
        margin: 0 auto;
        padding: 40px 20px;
    }
    
    .nav-tabs-custom {
        border-bottom: 2px solid #E5E7EB;
        margin-bottom: 40px;
    }
    
    .nav-tabs-custom .nav-link {
        color: #6B7280;
        font-size: 16px;
        font-weight: 500;
        padding: 12px 24px;
        border: none;
        background: transparent;
        position: relative;
    }
    
    .nav-tabs-custom .nav-link.active {
        color: #2563EB;
        background: transparent;
        border: none;
    }
    
    .nav-tabs-custom .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 3px;
        background-color: #2563EB;
    }
    
    .page-title {
        font-size: 32px;
        font-weight: 700;
        color: #1F2937;
        margin-bottom: 40px;
    }
    
    .info-card {
        background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
        border-radius: 12px;
        padding: 32px;
        margin-bottom: 40px;
        color: white;
    }
    
    .info-card h3 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 24px;
        color: white;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }
    
    .info-item {
        background: rgba(255, 255, 255, 0.1);
        padding: 20px;
        border-radius: 8px;
        backdrop-filter: blur(10px);
    }
    
    .info-label {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
        opacity: 0.9;
    }
    
    .info-value {
        font-size: 16px;
        font-weight: 500;
    }
    
    .status-badge {
        display: inline-block;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .status-menunggu {
        background-color: #10B981;
        color: white;
    }
    
    .status-disetujui {
        background-color: #3B82F6;
        color: white;
    }
    
    .status-ditolak {
        background-color: #EF4444;
        color: white;
    }
    
    .action-section {
        margin-bottom: 40px;
    }
    
    .action-section h4 {
        font-size: 20px;
        font-weight: 700;
        color: #1F2937;
        margin-bottom: 20px;
    }
    
    .action-buttons {
        display: flex;
        gap: 16px;
    }
    
    .btn-action {
        flex: 1;
        padding: 16px 24px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .btn-approve {
        background-color: #10B981;
        color: white;
    }
    
    .btn-approve:hover {
        background-color: #059669;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    
    .btn-reject {
        background-color: #EF4444;
        color: white;
    }
    
    .btn-reject:hover {
        background-color: #DC2626;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }
    
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #2563EB;
        font-size: 16px;
        font-weight: 500;
        text-decoration: none;
        margin-top: 40px;
        transition: all 0.3s ease;
    }
    
    .back-link:hover {
        color: #1D4ED8;
        gap: 12px;
    }
    
    .back-link i {
        font-size: 20px;
    }
    
    .verified-status {
        background-color: #F3F4F6;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .verified-status p {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
        color: #1F2937;
    }
    
    .rejection-reason {
        background-color: #FEE2E2;
        border-left: 4px solid #EF4444;
        padding: 16px;
        border-radius: 4px;
        margin-top: 12px;
    }
    
    .rejection-reason p {
        margin: 0;
        color: #991B1B;
        font-size: 14px;
    }
    
    /* Modal Styles */
    .modal-overlay {
        z-index: 1000;
    }
    
    .modal-content-custom {
        background: white;
        border-radius: 12px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .modal-header-custom {
        padding: 24px;
        border-bottom: 1px solid #E5E7EB;
    }
    
    .modal-header-custom h3 {
        font-size: 20px;
        font-weight: 700;
        color: #1F2937;
        margin: 0;
    }
    
    .modal-body-custom {
        padding: 24px;
    }
    
    .modal-footer-custom {
        padding: 20px 24px;
        border-top: 1px solid #E5E7EB;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }
    
    .btn-modal {
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .btn-cancel {
        background-color: #E5E7EB;
        color: #374151;
    }
    
    .btn-cancel:hover {
        background-color: #D1D5DB;
    }
    
    .btn-confirm {
        background-color: #2563EB;
        color: white;
    }
    
    .btn-confirm:hover {
        background-color: #1D4ED8;
    }
    
    .form-group-custom {
        margin-bottom: 20px;
    }
    
    .form-label-custom {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .form-control-custom {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #D1D5DB;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    
    .form-control-custom:focus {
        outline: none;
        border-color: #2563EB;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    
    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            flex-direction: column;
        }
    }
</style>

<div class="detail-page">
    {{-- Navigation Tabs --}}
    <!-- <ul class="nav nav-tabs nav-tabs-custom">
        <li class="nav-item">
            <a class="nav-link active" href="#">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Konfoirmasi Donasi</a>
        </li>
    </ul> -->
    
    {{-- Page Title --}}
    <h1 class="page-title">Detail & Verifikasi Donasi #{{ $donasi->id_donasi }}</h1>
    
    {{-- Information Card --}}
    <div class="info-card">
        <h3>Informasi Donasi</h3>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Nama Donasi:</div>
                <div class="info-value">{{ $donasi->nama_donasi ?? 'tidak ada judul' }}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">Deskripsi:</div>
                <div class="info-value">{{ Str::limit($donasi->deskripsi ?? 'Kondisi masih sangat baik...', 50) }}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">Kategori:</div>
                <div class="info-value">{{ $donasi->jenis_barang ?? 'Pakaian' }}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">Status Saat Ini:</div>
                <div class="info-value">
                    <span class="status-badge 
                        @if($donasi->hasil_verif == 'menunggu') status-menunggu
                        @elseif($donasi->hasil_verif == 'disetujui') status-disetujui
                        @else status-ditolak
                        @endif">
                        {{ strtoupper($donasi->hasil_verif) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Action Section --}}
    <div class="action-section">
        <h4>Konfirmasi Aksi</h4>
        
        @if($donasi->hasil_verif == 'menunggu')
            <div class="action-buttons">
                <button type="button" data-modal-target="verifModal" data-modal-status="disetujui" class="btn-action btn-approve open-modal">
                    <i class="bi bi-check-lg"></i> Setujui
                </button>
                <button type="button" data-modal-target="verifModal" data-modal-status="ditolak" class="btn-action btn-reject open-modal">
                    <i class="bi bi-x-lg"></i> Tolak
                </button>
            </div>
        @else
            <div class="verified-status">
                <p>Status telah diverifikasi: <strong>{{ ucfirst($donasi->hasil_verif) }}</strong></p>
                @if($donasi->hasil_verif == 'ditolak' && $donasi->alasan_tolak)
                    <div class="rejection-reason">
                        <p><strong>Alasan Penolakan:</strong> {{ $donasi->alasan_tolak }}</p>
                    </div>
                @endif
            </div>
        @endif
    </div>
    
    {{-- Back Link --}}
    <a href="{{ route('admin.dashboard') }}" class="back-link">
        <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
    </a>
</div>

{{-- Modal --}}
<div id="verifModal" class="modal-overlay hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
    <div class="modal-content-custom">
        <div class="modal-header-custom">
            <h3 id="modalTitle">Konfirmasi Aksi</h3>
        </div>
        
        <form method="POST" action="{{ route('admin.donasi.update-status', $donasi->id_donasi) }}">
            @csrf
            
            <div class="modal-body-custom">
                <input type="hidden" name="aksi_verifikasi" id="aksiVerifikasiInput">

                {{-- Kolom Alasan Tolak (Hanya muncul jika ditolak) --}}
                <div id="alasanTolakSection" class="form-group-custom hidden">
                    <label for="alasan_tolak" class="form-label-custom">Alasan Penolakan</label>
                    <textarea name="alasan_tolak" id="alasan_tolak_modal" rows="4" class="form-control-custom" placeholder="Wajib diisi jika ditolak"></textarea>
                    @error('alasan_tolak')
                        <p class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="modal-footer-custom">
                <button type="button" class="btn-modal btn-cancel close-modal">Batal</button>
                <button type="submit" id="submitModalButton" class="btn-modal btn-confirm">Konfirmasi</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Logika JS untuk membuka/menutup modal
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('verifModal');
        const openModalButtons = document.querySelectorAll('.open-modal');
        const closeModalButtons = document.querySelectorAll('.close-modal');
        const alasanSection = document.getElementById('alasanTolakSection');
        const aksiInput = document.getElementById('aksiVerifikasiInput');
        const modalTitle = document.getElementById('modalTitle');

        openModalButtons.forEach(button => {
            button.addEventListener('click', () => {
                const status = button.getAttribute('data-modal-status');
                
                // Atur nilai aksi di input tersembunyi
                aksiInput.value = status;
                
                if (status === 'ditolak') {
                    alasanSection.classList.remove('hidden');
                    modalTitle.textContent = 'Konfirmasi Penolakan';
                } else {
                    alasanSection.classList.add('hidden');
                    document.getElementById('alasan_tolak_modal').value = ''; // Kosongkan
                    modalTitle.textContent = 'Konfirmasi Persetujuan';
                }
                modal.classList.remove('hidden');
            });
        });

        closeModalButtons.forEach(button => {
            button.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
        });

        // Menutup modal jika klik di luar area
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
</script>
@endsection