<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MantanKadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kades = [
            ['nama' => 'Geno Salindesa', 'masa_jabatan' => 'Tahun 1966 s/d 1971', 'status' => null, 'urutan' => 1],
            ['nama' => 'Ferni Mokodaser', 'masa_jabatan' => 'Tahun 1971 s/d 1980', 'status' => null, 'urutan' => 2],
            ['nama' => 'Yorry Matindas', 'masa_jabatan' => 'Tahun 1980 s/d 1981', 'status' => null, 'urutan' => 3],
            ['nama' => 'Sam Korompis', 'masa_jabatan' => 'Tahun 1981 s/d 1982', 'status' => 'Pejabat Sementara', 'urutan' => 4],
            ['nama' => 'AV Palari', 'masa_jabatan' => 'Tahun 1982 s/d 1992', 'status' => 'Pejabat Sementara (1982-1984), Kades Terpilih (1984-1992)', 'urutan' => 5],
            ['nama' => 'Daniel Kawulur', 'masa_jabatan' => 'Tahun 1992 s/d 1993', 'status' => 'Pejabat Sementara', 'urutan' => 6],
            ['nama' => 'Yulius Ganzet', 'masa_jabatan' => 'Tahun 1993 s/d 2001', 'status' => null, 'urutan' => 7],
            ['nama' => 'Yorry Matindas', 'masa_jabatan' => 'Tahun 2001 s/d 2006', 'status' => null, 'urutan' => 8],
            ['nama' => 'Berlin Saragih', 'masa_jabatan' => 'Tahun 2006 s/d 2012', 'status' => null, 'urutan' => 9],
            ['nama' => 'Salmon Hamise', 'masa_jabatan' => 'Tahun 2012 s/d 2018', 'status' => null, 'urutan' => 10],
            ['nama' => 'Mohsen SE', 'masa_jabatan' => 'Tahun 2018 s/d April 2019', 'status' => 'Pejabat Sementara', 'urutan' => 11],
            ['nama' => 'Enang Pandake', 'masa_jabatan' => 'Mei 2019 s/d Oktober 2019', 'status' => 'Pejabat Sementara', 'urutan' => 12],
            ['nama' => 'Arnold', 'masa_jabatan' => 'Oktober 2019 s/d Sekarang', 'status' => 'Kades Aktif', 'urutan' => 13],
        ];

        foreach ($kades as $k) {
            \App\Models\MantanKades::create($k);
        }
    }
}
