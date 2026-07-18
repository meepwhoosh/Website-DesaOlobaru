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
                'nama' => 'Arnold',
                'jabatan' => 'Kepala Desa',
                'kategori' => 'pemdes',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Noldy Rambi',
                'jabatan' => 'Sekretariat Desa',
                'kategori' => 'pemdes',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Jefri Topan Tulak',
                'jabatan' => 'Kepala Seksi Pemerintahan',
                'kategori' => 'pemdes',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Yulius, SE',
                'jabatan' => 'Kepala Seksi Kesejahteraan',
                'kategori' => 'pemdes',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Masri Jono',
                'jabatan' => 'Kepala Seksi Pelayanan',
                'kategori' => 'pemdes',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Desmon Palari',
                'jabatan' => 'Kepala Urusan Tata Usaha dan Umum',
                'kategori' => 'pemdes',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Resmina Manga',
                'jabatan' => 'Kepala Urusan Keuangan',
                'kategori' => 'pemdes',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Yance Pesik',
                'jabatan' => 'Kepala Dusun I',
                'kategori' => 'pemdes',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Robin Tobubu',
                'jabatan' => 'Kepala Dusun II',
                'kategori' => 'pemdes',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Asgar Kokou',
                'jabatan' => 'Kepala Dusun III',
                'kategori' => 'pemdes',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // BPD
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
                'jabatan' => 'Sekretaris BPD',
                'kategori' => 'bpd',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Bonar Palari',
                'jabatan' => 'Anggota BPD',
                'kategori' => 'bpd',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Yuliani',
                'jabatan' => 'Anggota BPD',
                'kategori' => 'bpd',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Efendi',
                'jabatan' => 'Anggota BPD',
                'kategori' => 'bpd',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Nasrin',
                'jabatan' => 'Anggota BPD',
                'kategori' => 'bpd',
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('perangkat_desas')->insert($perangkatDesa);
    }
}
