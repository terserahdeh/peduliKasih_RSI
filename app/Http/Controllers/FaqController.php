<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function showUserFaq()
    {
        // Ambil HANYA FAQ yang aktif (is_active = 1)
        $faq = Faq::where('is_active', 1)->orderBy('id_faq', 'asc')->get();
        
        // Di sini Anda bisa mengembalikan view beranda Anda
        return view('welcome', compact('faq')); 
        // Ganti 'welcome' dengan nama file beranda Anda (misalnya 'homepage')
    }
}