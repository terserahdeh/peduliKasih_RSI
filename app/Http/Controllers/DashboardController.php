<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\RequestDonasi;
use App\Models\Pengguna;

class DashboardController extends Controller
{
    // Display dashboard
    public function dashboard()
    {
        $donasiMenunggu = Donasi::where('hasil_verif', 'menunggu')->count();
        $permintaanMenunggu = RequestDonasi::where('hasil_verif', 'menunggu')->count();
        $penggunaAktif = Pengguna::count();
        $totalTerpenuhi = RequestDonasi::where('status_request', 'terpenuhi')->count();
        
        $donasiList = Donasi::with('Pengguna')->latest()->take(5)->get();
        $permintaanList = RequestDonasi::with('Pengguna')->latest()->take(5)->get();
        $penggunaList = Pengguna::latest()->take(5)->get();
        
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
}