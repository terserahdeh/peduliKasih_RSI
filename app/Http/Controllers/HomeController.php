<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipsnEdukasi; 
use App\Models\Donasi; 
use App\Models\Faq; 

class HomeController extends Controller
{
    /**
     * Method untuk halaman utama (index)
     * Mengambil data yang diperlukan untuk ditampilkan di view home.dashboard.
     */
    public function index()
    {
        // Data Statistik (Dummy)
        $stats = [
            [
                'icon' => 'fas fa-hand-holding-heart',
                'value' => '1,234',
                'label' => 'Total Donasi',
                'color' => 'blue'
            ],
            [
                'icon' => 'fas fa-users',
                'value' => '567',
                'label' => 'Donatur Aktif',
                'color' => 'green'
            ],
            [
                'icon' => 'fas fa-smile',
                'value' => '890',
                'label' => 'Penerima Bantuan',
                'color' => 'orange'
            ],
            [
                'icon' => 'fas fa-check-circle',
                'value' => '95%',
                'label' => 'Tingkat Kepuasan',
                'color' => 'purple'
            ],
        ];

        // Mengambil 6 data donasi terbaru
        $latestDonations = Donasi::orderBy('created_at', 'desc')->limit(6)->get();
        
        // Mengambil 6 tips/edukasi terbaru
        $tips = TipsnEdukasi::orderBy('id_tipsnedukasi', 'desc')->limit(6)->get();
        
        // Mengambil semua FAQ
        $faq = Faq::all(); 
        
        // Mengirimkan semua data ke view
        return view('home.dashboard', compact('latestDonations', 'tips', 'faq', 'stats'));
    }

    /**
     * Method untuk menampilkan detail Tips & Edukasi tertentu.
     */
    public function showTipsnEdukasi($id)
    {
        try {
            $tip = TipsnEdukasi::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle jika data tidak ditemukan (optional)
            abort(404, 'Tips atau Edukasi tidak ditemukan.');
        }

        // 2. Tampilkan view detail
        // Pastikan Anda membuat file resources/views/home/detail_tipsnedukasi.blade.php
        return view('home.showtipsnedukasi', compact('tip'));
    }
}
