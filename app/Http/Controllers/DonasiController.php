<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    /** 🟦 Tampilkan semua donasi yang sudah disetujui */
    public function index()
    {
        $donasi = Donasi::where('hasil_verif', 'disetujui')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('donasi.all', compact('donasi'));
    }

    /** 🟩 Form tambah donasi */
    public function create()
    {
        return view('donasi.create');
    }

    /** 🟨 Simpan donasi baru ke database */
    public function storeBarang(Request $request)
    {
        $validated = $request->validate([
            'nama_donasi'   => 'required|string|max:255',
            'jenis_barang'  => 'required|string|max:255',
            'jumlah_barang' => 'required|string|max:100',
            'deskripsi'     => 'required|string',
            'foto'          => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'nomor_telepon' => 'nullable|string|max:20',
        ]);

        $filename = null;
        if ($request->hasFile('foto')) {
            $file     = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('foto'), $filename);
        }

        Donasi::create([
            'nama_donasi'   => $validated['nama_donasi'],
            'jenis_barang'  => $validated['jenis_barang'],
            'jumlah_barang' => $validated['jumlah_barang'],
            'deskripsi'     => $validated['deskripsi'],
            'foto'          => $filename,
            'nomor_telepon' => $validated['nomor_telepon'] ?? null,
            'status_donasi' => 'tersedia',
            'hasil_verif'   => 'menunggu',
            'username'      => auth()->user()->username
        ]);

        return redirect()->route('donasi.index')
                         ->with('success', 'Donasi berhasil diajukan! Menunggu verifikasi admin.');
    }

    /** 🟧 Form edit donasi */
    public function edit($id)
    {
        $donasi = Donasi::where('id_donasi', $id)
                        ->where('username', auth()->user()->username)
                        ->firstOrFail();

        if ($donasi->status_donasi === 'tersalurkan') {
            return redirect()->route('donasi.index')
                             ->with('error', 'Donasi yang sudah tersalurkan tidak dapat diubah.');
        }

        if ($donasi->status_edit === 'menunggu_edit') {
            return redirect()->route('donasi.index')
                             ->with('warning', 'Anda sudah mengajukan perubahan. Silakan tunggu respon admin.');
        }

        return view('donasi.edit', compact('donasi'));
    }

    /** 🟨 Ajukan perubahan ke admin */
    public function requestUpdate(Request $request, $id)
    {
        $donasi = Donasi::where('id_donasi', $id)
                        ->where('username', auth()->user()->username)
                        ->firstOrFail();

        $validated = $request->validate([
            'nama_donasi'   => 'required|string|max:255',
            'jenis_barang'  => 'required|string|max:255',
            'jumlah_barang' => 'required|string|max:100',
            'deskripsi'     => 'required|string',
            'foto_baru'     => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'nomor_telepon' => 'nullable|string|max:20',
        ]);

        $fotoDraftPath = $donasi->foto;
        if ($request->hasFile('foto_baru')) {
            $file     = $request->file('foto_baru');
            $filename = 'draft_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('foto'), $filename);
            $fotoDraftPath = $filename;
        }

        $donasi->update([
            'nama_donasi_draft'   => $validated['nama_donasi'],
            'jenis_barang_draft'  => $validated['jenis_barang'],
            'jumlah_barang_draft' => $validated['jumlah_barang'],
            'deskripsi_draft'     => $validated['deskripsi'],
            'foto_draft'          => $fotoDraftPath,
            'nomor_telepon'       => $validated['nomor_telepon'] ?? $donasi->nomor_telepon,
            'status_edit'         => 'menunggu_edit',
        ]);

        return redirect()->route('donasi.index')
                         ->with('success', 'Permintaan perubahan donasi telah dikirim.');
    }

    /** 🟥 Hapus donasi */
    public function destroy($id)
    {
        $donasi = Donasi::find($id);

        if (!$donasi) {
            return redirect()->back()->with('error', 'Donasi tidak ditemukan.');
        }
        
        if ($donasi->foto && file_exists(public_path('foto/' . $donasi->foto))) {
            unlink(public_path('foto/' . $donasi->foto));
        }

        $donasi->delete();

        return redirect()->back()->with('success', 'Donasi berhasil dihapus.');
    }

    /** 🔍 Tampilkan detail donasi publik */
    public function show(Donasi $donasi)
    {
        $pemilik = $donasi->user; 
        return view('donasi.create', compact('donasi', 'pemilik'));
    }

    /** 🔎 Filter donasi berdasarkan kategori */
    public function filter(Request $request)
    {
        $kategori = $request->query('kategori');

        $query = Donasi::where('hasil_verif', 'disetujui')
                       ->orderBy('created_at', 'desc');

        if ($kategori && $kategori !== 'Semua') {
            $query->where('jenis_barang', $kategori);
        }

        $donasi = $query->get();

        return view('donasi.all', compact('donasi'));
    }

    /** 🧩 Admin update status verifikasi */
    public function updateStatus(Request $request, $id)
    {
        $donasi = Donasi::findOrFail($id);

        $validated = $request->validate([
            'aksi_verifikasi' => 'required|in:disetujui,ditolak',
            'alasan_tolak'    => 'nullable|string|max:500',
        ]);

        $aksi = $validated['aksi_verifikasi'];

        if ($aksi === 'ditolak') {
            if (!$request->alasan_tolak) {
                return back()->withErrors(['alasan_tolak' => 'Alasan penolakan wajib.'])
                             ->withInput();
            }

            $donasi->update([
                'hasil_verif' => 'ditolak',
                'alasan_tolak' => $request->alasan_tolak,
            ]);

            return redirect()->route('admin.dashboard')
                             ->with('success', 'Donasi berhasil ditolak.');
        }

        $donasi->update([
            'hasil_verif'   => 'disetujui',
            'status_donasi' => 'tersedia',
            'alasan_tolak'  => null,
        ]);

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Donasi berhasil disetujui.');
    }


    /** 🧩 Admin proses edit */
    public function processEditRequest(Request $request, $id)
    {
        $donasi = Donasi::findOrFail($id);
        $action = $request->input('edit_action');
        
        if ($donasi->status_edit !== 'menunggu_edit') {
            return back()->with('error', 'Tidak ada permintaan perubahan yang tertunda.');
        }

        if ($action === 'approve') {
            $donasi->nama_donasi   = $donasi->nama_donasi_draft;
            $donasi->jenis_barang  = $donasi->jenis_barang_draft;
            $donasi->jumlah_barang = $donasi->jumlah_barang_draft;
            $donasi->deskripsi     = $donasi->deskripsi_draft;

            if ($donasi->foto_draft && $donasi->foto_draft !== $donasi->foto) {
                $donasi->foto = $donasi->foto_draft;
            }

            $message = 'Perubahan donasi berhasil disetujui dan data telah diperbarui.';
            
        } elseif ($action === 'reject') {
            $message = 'Permintaan perubahan donasi berhasil ditolak.';
        } else {
            return back()->with('error', 'Aksi tidak valid.');
        }

        $donasi->nama_donasi_draft   = null;
        $donasi->jenis_barang_draft  = null;
        $donasi->jumlah_barang_draft = null;
        $donasi->deskripsi_draft     = null;
        $donasi->foto_draft          = null;
        $donasi->status_edit         = null;
        $donasi->save();

        return redirect()->route('admin.dashboard')->with('success', $message);
    }

    /** 🧨 Admin hapus donasi */
    public function deleteDonasi($id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->delete(); 
        return redirect()->route('admin.dashboard')->with('success', 'Donasi berhasil dihapus.');
    }

    public function processEditDonasi(Request $request, $id)
{
    $request->validate([
        'edit_action' => 'required|in:approve,reject',
    ]);

    $donasi = Donasi::findOrFail($id);

    if ($request->edit_action === 'approve') {
        $donasi->status_edit = 'disetujui';

        // Jika disetujui, kamu bisa tambahkan logika di sini untuk 
        // menerapkan perubahan dari tabel edit (kalau kamu simpan di tempat terpisah)
        // contoh: $donasi->update([...]);
    } else {
        $donasi->status_edit = 'ditolak';
        // Jika ditolak, tidak ada perubahan data
    }

    $donasi->save();

    return response()->json([
        'success' => true,
        'message' => 'Permintaan edit donasi berhasil diproses.'
    ]);
}



}
