<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipsnEdukasi extends Model
{
    use HasFactory;
    protected $table = 'tipsnedukasi';
    protected $primaryKey = 'id_tipsnedukasi';

    protected $fillable = [
        'judul_tipsnedukasi',
        'konten_tipsnedukasi'
    ];

}