<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pengguna';
    protected $primaryKey = 'id_akun';

    protected $fillable = [
        'username',
        'nama',
        'no_tlp',
        'email',
        'password',
        'avatar'
    ];

    protected $hidden = [
        'password'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed'
        ];
    }

    public function donasi()
    {
        return $this->hasMany(Donasi::class, 'username','username');
    }

    public function requestdonasi()
    {
        return $this->hasMany(RequestDonasi::class, 'username','username');
    }

    public function upvote()
    {
        return $this->hasMany(Upvote::class, 'username','username');
    }
}
