<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bpd = [
            [
                'nama' => 'DRS. SUHARWAN',
                'jabatan' => 'Ketua BPD',
                'kategori' => 'bpd',
                'gambar' => 'perangkat/BPD/Suharwan .jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'NOVI FRANGKI',
                'jabatan' => 'Wakil Ketua BPD',
                'kategori' => 'bpd',
                'gambar' => 'perangkat/BPD/Novi-franki .jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'ARIS ANDI LOLO',
                'jabatan' => 'Sekretaris',
                'kategori' => 'bpd',
                'gambar' => 'perangkat/BPD/Aris-andi-lolo.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'BONAR PALARI',
                'jabatan' => 'Anggota',
                'kategori' => 'bpd',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'YULIANI',
                'jabatan' => 'Anggota',
                'kategori' => 'bpd',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'MASHUN',
                'jabatan' => 'Anggota',
                'kategori' => 'bpd',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'NASRIN',
                'jabatan' => 'Anggota',
                'kategori' => 'bpd',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('perangkat_desas')->insert($bpd);
    }
}
