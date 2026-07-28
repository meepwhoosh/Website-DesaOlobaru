<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MantanKades extends Model
{
    protected $fillable = [
        'nama',
        'masa_jabatan',
        'status',
        'foto',
        'urutan',
    ];
}
