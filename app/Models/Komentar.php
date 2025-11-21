<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengguna;
use App\Models\Donasi;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentar';
    protected $primaryKey = 'id_komentar';

    protected $fillable = [
        'id_donasi',
        'id_akun',
        'id_parent',
        'isi_komentar',
    ];

    public function user()
    {
        return $this->belongsTo(Pengguna::class, 'id_akun', 'id_akun');
    }

    public function donasi()
    {
        return $this->belongsTo(Donasi::class, 'id_donasi', 'id_donasi');
    }

    // relasi parent-child
    public function parent()
    {
        return $this->belongsTo(Komentar::class, 'id_parent');
    }

    public function replies()
    {
        return $this->hasMany(Komentar::class, 'id_parent');
    }

    //untuk hapus reply
    public function children()
    {
        return $this->hasMany(Komentar::class, 'id_parent');
    }

    public function deleteWithChildren()
    {
        foreach ($this->children as $child) {
            $child->deleteWithChildren();
        }
        $this->delete();
    }

}
