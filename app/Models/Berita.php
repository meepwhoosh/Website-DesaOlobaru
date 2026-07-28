<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'tanggal_publikasi',
        'views',
    ];

    protected $casts = [
        'gambar' => 'array',
    ];
}
