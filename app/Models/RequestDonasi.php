<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestDonasi extends Model
{
    use HasFactory;
    protected $table = 'request_donasi';
    protected $primaryKey = 'id_request';

    protected $fillable = [
        'username',
        'jumlah_barang',
        'jenis_barang',
        'deskripsi',
        'nama_request',
        'status_request',
        'hasil_verif',
        'tanggal_upload'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'username', 'username');
    }
    public function upvote()
    {
        return $this->hasMany(Upvote::class, 'id_request');
    }
}
