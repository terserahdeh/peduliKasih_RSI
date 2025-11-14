<?php

namespace App\Http\Controllers;

use App\Models\RequestDonasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pengguna');
    }

    // 🟢 Landing Page Request Donasi (Hero Section dengan 2 tombol)
    public function landing()
    {
        return view('home.landing-request');
    }

    // 🟢 Halaman Daftar Request yang Disetujui (Card-card)
    public function index()
    {
        $requests = RequestDonasi::with('pengguna')
            ->where('hasil_verif', 'disetujui')
            ->latest('tanggal_upload')
            ->paginate(12);

        return view('home.index-request', compact('requests'));
    }

    // 🟢 Form membuat request donasi baru
    public function create()
    {
        return view('home.Request');
    }

    // 🟢 Menyimpan request donasi baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis_barang'  => 'required|in:alat rumah tangga,sembako,pakaian,alat tulis,lain-lain',
            'nama_request'  => 'required|string|max:100',
            'jumlah_barang' => 'nullable|integer|min:1',
            'deskripsi'     => 'required|string|min:20',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ], [
            'jenis_barang.required' => 'Jenis barang harus dipilih',
            'nama_request.required' => 'Nama request harus diisi',
            'nama_request.max' => 'Nama request maksimal 100 karakter',
            'deskripsi.required' => 'Deskripsi harus diisi',
            'deskripsi.min' => 'Deskripsi minimal 20 karakter',
            'foto.image' => 'File harus berupa gambar',
            'foto.max' => 'Ukuran gambar maksimal 5MB',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('request_donasi', 'public');
        }

        RequestDonasi::create([
            'username'       => Auth::user()->username,
            'jenis_barang'   => $data['jenis_barang'],
            'nama_request'   => $data['nama_request'],
            'jumlah_barang'  => $data['jumlah_barang'] ?? null,
            'deskripsi'      => $data['deskripsi'],
            'foto'           => $path,
            'status_request' => 'belum terpenuhi',
            'hasil_verif'    => 'menunggu',
            'tanggal_upload' => now()->format('Y-m-d'),
        ]);

        return redirect()->route('request-donasi.status')
            ->with('success', 'Request Donasi berhasil dikirim dan menunggu verifikasi admin.');
    }

    // 🟢 Halaman status request donasi milik pengguna
    public function status()
    {
        $requests = RequestDonasi::with('pengguna')
            ->where('username', Auth::user()->username)
            ->latest('tanggal_upload')
            ->paginate(10);

        return view('home.status-request', compact('requests'));
    }

    // 🟢 Menampilkan detail request donasi (untuk AJAX/Modal)
    public function show($id_request)
    {
        $req = RequestDonasi::with('pengguna')->findOrFail($id_request);
        
        // Cek apakah user adalah pemilik request
        $isOwner = Auth::check() && Auth::user()->username === $req->username;
        
        return view('home.detail-request', compact('req', 'isOwner'));
    }

    // 🟢 Form edit request donasi (hanya untuk request yang sudah disetujui)
    public function edit($id_request)
    {
        $req = RequestDonasi::where('id_request', $id_request)
            ->where('username', Auth::user()->username)
            ->where('hasil_verif', 'disetujui') // Hanya bisa edit yang sudah disetujui
            ->firstOrFail();

        return view('home.edit-request', compact('req'));
    }

    // 🟢 Proses update data request donasi
    public function update(Request $request, $id_request)
    {
        $req = RequestDonasi::where('id_request', $id_request)
            ->where('username', Auth::user()->username)
            ->where('hasil_verif', 'disetujui') // Hanya bisa update yang sudah disetujui
            ->firstOrFail();

        $data = $request->validate([
            'jenis_barang'  => 'required|in:alat rumah tangga,sembako,pakaian,alat tulis,lain-lain',
            'nama_request'  => 'required|string|max:100',
            'jumlah_barang' => 'nullable|integer|min:1',
            'deskripsi'     => 'required|string|min:20',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            if ($req->foto) {
                Storage::disk('public')->delete($req->foto);
            }
            $data['foto'] = $request->file('foto')->store('request_donasi', 'public');
        }

        // Setelah diedit, status kembali ke menunggu verifikasi
        $data['hasil_verif'] = 'menunggu';
        $data['status_request'] = 'belum terpenuhi';

        $req->update($data);

        return redirect()->route('request-donasi.index')
            ->with('success', 'Request Donasi berhasil diperbarui dan akan diverifikasi kembali oleh admin.');
    }

    // 🟢 Menghapus request donasi (hanya untuk request yang sudah disetujui)
    public function destroy($id_request)
    {
        $req = RequestDonasi::where('id_request', $id_request)
            ->where('username', Auth::user()->username)
            ->where('hasil_verif', 'disetujui')
            ->firstOrFail();

        if ($req->foto) {
            Storage::disk('public')->delete($req->foto);
        }

        $req->delete();

        return redirect()->route('request-donasi.index')
            ->with('success', 'Request Donasi berhasil dihapus.');
    }
}