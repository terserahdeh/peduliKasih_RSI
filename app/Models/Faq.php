<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    
    // Sesuaikan dengan nama tabel Anda
    protected $table = 'faq'; 
    
    // Sesuaikan dengan nama Primary Key Anda
    protected $primaryKey = 'id_faq'; 
    
    // Field yang boleh diisi (mass assignable)
    protected $fillable = ['question', 'answer', 'is_active']; 

    // Tidak perlu menambahkan $timestamps karena kolom Anda sudah disiapkan secara manual di DB
    // Namun, jika Anda ingin Laravel mengupdate created_at dan updated_at, 
    // pastikan nama kolom di DB Anda sesuai standar (created_at, updated_at).
    // Jika tidak, Anda bisa menonaktifkannya:
    // public $timestamps = false;
}