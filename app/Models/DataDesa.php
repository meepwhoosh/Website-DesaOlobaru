<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataDesa extends Model
{
    protected $fillable = [
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'agama',
        'status_perkawinan',
        'tempat_tanggal_lahir',
        'pendidikan',
        'pekerjaan',
        'dusun'
    ];
}
