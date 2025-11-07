<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestDonasi extends Model
{
    use HasFactory;

    protected $table = 'request_donasi';
    protected $primaryKey = 'id_request';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'jumlah_barang',
        'jenis_barang',
        'deskripsi',
        'nama_request',
        'status_request',
        'hasil_verif',
        'tanggal_upload',
        'foto',
    ];

    protected $casts = [
        'tanggal_upload' => 'datetime',
        'jumlah_barang' => 'integer',
    ];

    // Relasi ke pengguna
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'username', 'username');
    }

    // Relasi ke upvote (jika ada)
    public function upvote()
    {
        return $this->hasMany(Upvote::class, 'id_request', 'id_request');
    }
}