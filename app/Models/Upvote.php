<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upvote extends Model
{
    use HasFactory;

    protected $table = 'upvote';
    protected $primaryKey = 'id_upvote';
    public $timestamps = true;

    protected $fillable = [
        'username',
        'id_request',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'username', 'username');
    }

    public function requestDonasi()
    {
        return $this->belongsTo(RequestDonasi::class, 'id_request', 'id_request');
    }
}
