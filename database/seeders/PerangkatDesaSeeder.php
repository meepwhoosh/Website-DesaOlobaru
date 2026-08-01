<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerangkatDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('perangkat_desas')->truncate();

        $perangkatDesa = [
            [
                'nama' => 'ARNOLD',
                'jabatan' => 'Kepala Desa',
                'kategori' => 'pemdes',
                'gambar' => 'perangkat/Perangkat-kantor-desa/Arnold.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'NOLDY RAMBI',
                'jabatan' => 'Sekretariat Desa',
                'kategori' => 'pemdes',
                'gambar' => 'perangkat/Perangkat-kantor-desa/Noldy-Rambi.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'JEFRI TOPAN TULAK',
                'jabatan' => 'Kepala Seksi Pemerintahan',
                'kategori' => 'pemdes',
                'gambar' => 'perangkat/Perangkat-kantor-desa/Jefri-Topan-Tulak.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'YULIUS, SE',
                'jabatan' => 'Kepala Seksi Kesejahteraan',
                'kategori' => 'pemdes',
                'gambar' => 'perangkat/Perangkat-kantor-desa/Yulius.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'MASRI JONO',
                'jabatan' => 'Kepala Seksi Pelayanan',
                'kategori' => 'pemdes',
                'gambar' => 'perangkat/Perangkat-kantor-desa/Masri-Jono.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'ELDA SILAMMA',
                'jabatan' => 'Kepala Urusan Tata Usaha dan Umum',
                'kategori' => 'pemdes',
                'gambar' => 'perangkat/Perangkat-kantor-desa/Eldha.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'DESMON PALARI',
                'jabatan' => 'Kepala Urusan Perencanaan',
                'kategori' => 'pemdes',
                'gambar' => 'perangkat/Perangkat-kantor-desa/Desmon-Palari.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'RESMINA MANGA',
                'jabatan' => 'Kepala Urusan Keuangan',
                'kategori' => 'pemdes',
                'gambar' => 'perangkat/Perangkat-kantor-desa/Resmina-Manga.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'YANCE PESIK',
                'jabatan' => 'Kepala Dusun I',
                'kategori' => 'pemdes',
                'gambar' => 'perangkat/Perangkat-kantor-desa/Yance-Pesik.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'ROBIN TOBUBU',
                'jabatan' => 'Kepala Dusun II',
                'kategori' => 'pemdes',
                'gambar' => 'perangkat/Perangkat-kantor-desa/Robin-Tobubu.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'ASGAR KOKOU',
                'jabatan' => 'Kepala Dusun III',
                'kategori' => 'pemdes',
                'gambar' => 'perangkat/Perangkat-kantor-desa/Asgar-Kokou .jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('perangkat_desas')->insert($perangkatDesa);
    }
}
