<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerangkatDesa extends Model
{
    protected $fillable = [
        'nama',
        'jabatan',
        'kategori',
        'gambar',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(PerangkatDesa::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(PerangkatDesa::class, 'parent_id')->with('children');
    }
}
