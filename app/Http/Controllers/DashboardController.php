<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\RequestDonasi;
use App\Models\Pengguna;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        // Statistik
        $donasiMenunggu = Donasi::where('hasil_verif', 'menunggu')->count();
        $permintaanMenunggu = RequestDonasi::where('hasil_verif', 'menunggu')->count();
        $penggunaAktif = Pengguna::count();
        $totalTerpenuhi = RequestDonasi::where('status_request', 'terpenuhi')->count();

        // Latest 5 Donasi - DITAMBAHKAN PRIORITAS UNTUK MENUNGGU EDIT
        $donasiList = Donasi::with('Pengguna')
            ->orderByRaw("FIELD(status_edit, 'menunggu_edit') DESC")
            ->orderByRaw("FIELD(hasil_verif, 'menunggu') DESC")
            ->orderBy('created_at','desc')
            ->take(5)
            ->get();

        // Latest 5 Permintaan
        $permintaanList = RequestDonasi::with('Pengguna')->orderBy('created_at','desc')->take(5)->get();

        // Latest 5 Pengguna
        $penggunaList = Pengguna::latest()->take(5)->get();

        // Kirim semua ke view
        return view('admin.dashboard', compact(
            'donasiMenunggu',
            'permintaanMenunggu',
            'penggunaAktif',
            'totalTerpenuhi',
            'donasiList',  
            'permintaanList',  
            'penggunaList'
        ));
    }

    public function donasiTable(Request $request)
    {
        $query = Donasi::with('Pengguna');
        
        if ($request->filterVerifikasiDonasi) {
            $query->where('hasil_verif', $request->filterVerifikasiDonasi);
        }
        if ($request->filterStatusDonasi) {
            $query->where('status_donasi', $request->filterStatusDonasi);
        }
        
        // DITAMBAHKAN PRIORITAS UNTUK MENUNGGU EDIT
        $donasiList = $query
            ->orderByRaw("FIELD(status_edit, 'menunggu_edit') DESC")
            ->orderBy('created_at','desc')
            ->take(5)
            ->get();

        return view('admin.donasi_table', compact('donasiList'))->render();
    }

    public function permintaanTable(Request $request)
    {
        $query = RequestDonasi::with('Pengguna');

        if ($request->filterVerifikasiPermintaan) {
            $query->where('hasil_verif', $request->filterVerifikasiPermintaan);
        }
        if ($request->filterStatusPermintaan) {
            $query->where('status_request', $request->filterStatusPermintaan);
        }

        $permintaanList = $query->orderBy('created_at','desc')->take(5)->get();

        return view('admin.permintaan_table', compact('permintaanList'))->render();
    }

    // Update verifikasi status for Donasi
    public function updateVerifikasiDonasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak'
        ]);
        
        $donasi = Donasi::findOrFail($id);
        $donasi->hasil_verif = $request->status;
        $donasi->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Verifikasi donasi berhasil diperbarui'
        ]);
    }
    
    // Update verifikasi status for Permintaan
    public function updateVerifikasiPermintaan(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak'
        ]);
        
        $permintaan = RequestDonasi::findOrFail($id);
        $permintaan->hasil_verif = $request->status;
        $permintaan->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Verifikasi permintaan berhasil diperbarui'
        ]);
    }
    
    // Update status donasi
    public function updateStatusDonasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:tersedia,tersalurkan'
        ]);
        
        $donasi = Donasi::findOrFail($id);
        $donasi->status_donasi = $request->status;
        $donasi->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Status donasi berhasil diperbarui'
        ]);
    }
    
    // Update status permintaan
    public function updateStatusPermintaan(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:belum terpenuhi,terpenuhi'
        ]);
        
        $permintaan = RequestDonasi::findOrFail($id);
        $permintaan->status_request = $request->status;
        $permintaan->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Status permintaan berhasil diperbarui'
        ]);
    }
    
    // Delete pengguna
    public function deletePengguna($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->delete();

        return redirect()->back()->with('success', 'Pengguna berhasil dihapus');
    }
    
    // Get statistics
    public function getStatistics()
    {
        $donasiMenunggu = Donasi::where('hasil_verif', 'menunggu')->count();
        $permintaanMenunggu = RequestDonasi::where('hasil_verif', 'menunggu')->count();
        $penggunaAktif = Pengguna::count();
        $totalTerpenuhi = RequestDonasi::where('status_request', 'terpenuhi')->count();
        
        return response()->json([
            'success' => true,
            'donasiMenunggu' => $donasiMenunggu,
            'permintaanMenunggu' => $permintaanMenunggu,
            'penggunaAktif' => $penggunaAktif,
            'totalTerpenuhi' => $totalTerpenuhi
        ]);
    }
    
    // Show donasi detail
    public function showDonasiDetail($id)
    {
        $donasi = Donasi::with('Pengguna')->findOrFail($id);
        return view('admin.donasi.detail', compact('donasi'));
    }
    
    // Show permintaan detail
    public function showPermintaanDetail($id)
    {
        $permintaan = RequestDonasi::with('Pengguna')->findOrFail($id);
        return view('admin.permintaan.detail', compact('permintaan'));
    }

    // public function homeDashboard()
    // {
    //     // Anda bisa menambahkan logika atau mengambil data di sini
        
    //     // Mengarahkan ke resources/views/home/dashboard.blade.php
    //     return view('home.dashboard'); 
    // }
}