<?php

namespace App\Http\Controllers;

use App\Models\TipsnEdukasi; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 

class TipsnEdukasiController extends Controller
{
    /**
     * Menampilkan daftar semua Tips & Edukasi (index).
     */
    public function index()
    {
        // 1. Mengambil data tips dengan paginasi (Read/Tampilkan)
        $tips = TipsnEdukasi::orderBy('updated_at', 'desc')->paginate(10); 
        
        // 2. Mengambil data statistik untuk cards di view (Read/Tampilkan)
        $totalTips = TipsnEdukasi::count();
        
        return view('admin.edukasintips', [ 
            'tips' => $tips,
            'totalTips' => $totalTips,

        ]);
    }


    /**
     * Menampilkan form untuk mengedit Tips (edit).
     */
    public function edit($id)
    {
        // Cari data berdasarkan primary key 'id_tipsnedukasi'
        $tip = TipsnEdukasi::findOrFail($id); 
        return view('admin.editedukasintips', compact('tip'));
    }

    /**
     * Memperbarui Tips di database (update).
     */
   // app/Http/Controllers/TipsnEdukasiController.php

// app/Http/Controllers/TipsnEdukasiController.php

public function update(Request $request, $id)
{
    // 1. Validasi Data
    $validatedData = $request->validate([
        'judul_tipsnedukasi' => 'required|string|max:255',
        'konten_tipsnedukasi' => 'required|string',
        'deskripsi' => 'required|string|max:500', 
        // Field 'status' telah dihapus dari validasi.
    ]);
    
    // 2. Cari dan Perbarui Data
    $tip = TipsnEdukasi::findOrFail($id);
    $tip->update($validatedData); // Hanya field yang lolos validasi yang akan di-update
    
    // 3. Redirect
    Session::flash('success', 'Tips & Edukasi berhasil diperbarui.');
    return redirect()->route('admin.edukasintips');
}

    // METHOD 'destroy' DIHILANGKAN
}