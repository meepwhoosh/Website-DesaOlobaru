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
                'nama' => 'Drs. Suharwan',
                'jabatan' => 'Ketua BPD',
                'kategori' => 'bpd',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Novi Frangki',
                'jabatan' => 'Wakil Ketua BPD',
                'kategori' => 'bpd',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Aris Andi Lolo',
                'jabatan' => 'Sekretaris',
                'kategori' => 'bpd',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Bonar Palari',
                'jabatan' => 'Anggota',
                'kategori' => 'bpd',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Yuliani',
                'jabatan' => 'Anggota',
                'kategori' => 'bpd',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Efendi',
                'jabatan' => 'Anggota',
                'kategori' => 'bpd',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Nasrin',
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
