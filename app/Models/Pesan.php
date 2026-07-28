<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengirim',
        'email',
        'no_hp',
        'subjek',
        'isi_pesan',
        'status',
    ];
}
