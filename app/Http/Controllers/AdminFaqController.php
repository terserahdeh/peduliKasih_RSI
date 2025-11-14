<?php

namespace App\Http\Controllers;

use App\Models\Faq; // Panggil model Faq
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    /**
     * Tampilkan semua FAQ (Read - Admin).
     */
    public function index()
    {
        // Ambil semua FAQ, diurutkan dari yang terbaru
        $faq = Faq::orderBy('id_faq', 'desc')->get();
        return view('admin.faq.list', compact('faq'));
    }

    /**
     * Tampilkan form untuk membuat FAQ baru (Create).
     */
    public function create()
    {
        return view('admin.faq.create');
    }

    /**
     * Simpan FAQ baru ke database (Store).
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'is_active' => 1, // Default aktif saat dibuat
        ]);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil ditambahkan!');
    }

    /**
     * Tampilkan form untuk mengedit FAQ (Edit).
     */
    public function edit(Faq $faq) // Menggunakan Route Model Binding (Faq $faq)
    {
        // Parameter diubah menjadi $faq (bukan $id) karena menggunakan Route Model Binding
        return view('admin.faq.edit', compact('faq'));
    }

    /**
     * Update FAQ di database (Update).
     */
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $faq->update($request->all());

        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil diperbarui!');
    }
    
    /**
     * Hapus FAQ dari database (Delete).
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil dihapus!');
    }

    /**
     * Toggle (mengubah) status is_active.
     */
    public function toggleActive(Faq $faq)
    {
        $faq->is_active = !$faq->is_active; // Membalikkan status boolean
        $faq->save();

        return redirect()->route('admin.faq.index')->with('success', 'Status FAQ berhasil diubah!');
    }
}