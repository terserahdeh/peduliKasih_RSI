<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'Pengguna';       // nama tabel
    protected $primaryKey = 'id_akun';
    public $timestamps = false;          // kalau tidak pakai created_at/updated_at

    protected $fillable = [
        'username',
        'nama',
        'no_tlp',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [                  // ✅ harus property, bukan function
        'password' => 'hashed',
    ];

    // Relasi ke Donasi
    public function donasi()
    {
        return $this->hasMany(Donasi::class, 'username','username');
    }

    // Relasi ke Request Donasi
    public function requestDonasi()
    {
        return $this->hasMany(RequestDonasi::class, 'username','username');
    }

    // Relasi ke Upvote
    public function upvote()
    {
        return $this->hasMany(Upvote::class, 'username','username');
    }
}
