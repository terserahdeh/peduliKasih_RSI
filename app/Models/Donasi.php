<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;
    protected $table = 'donasi';
    protected $primaryKey = 'id_donasi';

    protected $fillable = [
        'username',
        'jumlah_barang',
        'jenis_barang',
        'deskripsi',
        'nama_donasi',
        'status_donasi',
        'hasil_verif',
        'foto',
        'tanggal_upload'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'username', 'username');
    }
}
