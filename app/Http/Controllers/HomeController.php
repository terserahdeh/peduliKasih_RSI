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
                'icon' => 'fas fa-users', 
                'color' => 'blue', 
                'value' => '2,450+', 
                'label' => 'Donatur Aktif'
            ],
            [
                'icon' => 'fas fa-hand-holding-heart', 
                'color' => 'orange', 
                'value' => '850+', 
                'label' => 'Donasi Terkumpul'
            ],
            [
                'icon' => 'fas fa-check-circle', 
                'color' => 'green', 
                'value' => '650+', 
                'label' => 'Bantuan Tersalurkan'
            ],
            [
                'icon' => 'fas fa-heart', 
                'color' => 'purple', 
                'value' => '1,200+', 
                'label' => 'Keluarga Terbantu'
            ],
        ];

        // Mengambil 6 data donasi terbaru
        $latestDonations = Donasi::orderBy('created_at', 'desc')->limit(6)->get();
        
        // Mengambil 6 tips/edukasi terbaru
        $tips = TipsnEdukasi::orderBy('id_tipsnedukasi', 'desc')->limit(6)->get();
        
        // Mengambil semua FAQ
        $faqs = Faq::all(); 
        
        // Mengirimkan semua data ke view
        return view('home.dashboard', compact('latestDonations', 'tips', 'faqs', 'stats'));
    }

    /**
     * Method untuk menampilkan detail Tips & Edukasi tertentu.
     */
    public function showTipsnEdukasi($id)
    {
        // Mengambil data berdasarkan Primary Key, jika tidak ditemukan akan throw 404
        $tip = TipsnEdukasi::findOrFail($id);

        return view('home.showtipsnedukasi', compact('tip'));
    }
}
