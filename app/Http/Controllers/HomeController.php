<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\TipsnEdukasi;
use App\Models\Faq; // ✅ kapital benar

class HomeController extends Controller
{
    public function index()
    {
        // ambil 3 donasi terbaru
        $donations = Donasi::latest()->take(3)->get();

        // ambil tips (6)
        $tips = TipsnEdukasi::latest()->take(6)->get();

        // ambil faq
        $faqs = Faq::all();

        // statistics (dummy data)
        $stats = [
            'donatur' => 2450,
            'donasi' => 850,
            'terbantu' => 650,
            'keluarga' => 1200,
        ];

        return view('home.dashboard', compact('donations', 'tips', 'faqs', 'stats'));
    }
}
