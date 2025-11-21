<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // <-- BARIS INI DITAMBAHKAN
use App\Models\Pengguna;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasi';
    protected $primaryKey = 'id_donasi';

    protected $fillable = [
    'nama_donasi', 'jenis_barang', 'jumlah_barang', 'deskripsi',
    'foto', 'nomor_telepon', 'status_donasi', 'hasil_verif', 'username'
    ];

    // Accessor untuk format tanggal
    public function getFormattedDateAttribute()
    {
        $diff = Carbon::parse($this->created_at)->diffForHumans();
        return $diff;
    }

    // Accessor untuk URL foto
    public function getFotoUrlAttribute()
    {   
        if ($this->foto) {
            return asset('storage/donasi/' . $this->foto);
        }
        return asset('images/default-donation.jpg');
    }

    public function Pengguna()
    {
        return $this->belongsTo(User::class, 'name', 'id');
    }

    public function showUserDetail($id)
    {
        // Cari data donasi berdasarkan ID. Gunakan firstOrFail() untuk menampilkan 404 jika ID tidak ditemukan.
        $donasi = Donasi::findOrFail($id);
        
        // Tampilkan view detail (misalnya resources/views/donasi/show.blade.php)
        // dan kirimkan data $donasi ke view tersebut.
        return view('donasi.show', compact('donasi'));
    }

    public function komentar() {
        return $this->hasMany(Komentar::class, 'id_donasi', 'id_donasi')->latest();
    }

}
