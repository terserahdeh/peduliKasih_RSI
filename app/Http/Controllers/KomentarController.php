<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Donasi;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function store(Request $request, $idDonasi)
    {
        $request->validate([
            'isi_komentar' => 'required|min:3|max:2000',
        ]);

        Komentar::create([
            'id_donasi' => $idDonasi,
            'id_akun' => auth()->guard('pengguna')->id(),
            'id_parent' => $request->id_parent ?? null, // ambil id_parent jika ada
            'isi_komentar' => $request->isi_komentar,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan');
    }


    public function update(Request $request, $id)
    {
        $komentar = Komentar::findOrFail($id);

        // Pastikan pemilik komentar
        if ($komentar->id_akun != auth()->guard('pengguna')->id()) {
            abort(403);
        }

        $request->validate([
            'isi_komentar' => 'required|min:3|max:500',
        ]);

        $komentar->isi_komentar = $request->isi_komentar;
        $komentar->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Komentar berhasil diupdate',
            'isi_baru' => $komentar->isi_komentar
        ]);
    }


    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);

        if ($komentar->id_akun != auth()->guard('pengguna')->id()) {
            abort(403);
        }

        $komentar->deleteWithChildren();

        return back()->with('success', 'Komentar berhasil dihapus');
    }

        public function adminIndex()
    {
        $komentar = Komentar::with('user')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10); // tampil 10 per halaman

        return view('admin.komentar', compact('komentar'));
    }

    public function destroyAdmin($id)
    {
        $komentar = Komentar::findOrFail($id);

        // Hapus komentar + semua anak-anaknya
        $komentar->deleteWithChildren();

        return back()->with('success', 'Komentar berhasil dihapus');
    }
}