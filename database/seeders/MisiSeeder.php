<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Misi;

class MisiSeeder extends Seeder
{
    public function run()
    {
        Misi::truncate();

        $misis = [
            [
                'urutan' => 1,
                'konten' => 'Membangun kepercayaan masyarakat terhadap pemerintah desa melalui pemerintahan yang jujur, berkeadilan, transparan, aküntabel, dan partisipatif.'
            ],
            [
                'urutan' => 2,
                'konten' => 'Pendistribusian dan perlindungan secara adil dan merata semua yang menjadi hak masyarakat lemah dan kaum difabel.'
            ],
            [
                'urutan' => 3,
                'konten' => 'Mengatasi dengan segera dampak bahaya bencana alam yang mengancam lingkungan pemukiman masyarakat dan penyakit sosial masyarakat dengan mengedepankan pola kearifan lokal.'
            ],
            [
                'urutan' => 4,
                'konten' => 'Penguatan lembaga keagamaan, lembaga sosial desa, kelompok tani, kelompok pelaku usaha kecil di desa sebagai mitra pemerintah desa dalam mewujudkan kesejahteraan masyarakat Desa.'
            ],
            [
                'urutan' => 5,
                'konten' => 'Membangun sarana prasarana infrastruktur desa dalam rangka menunjang pendidikan formal dan non formal peningkatan kesehatan, penyediaan air bersih, dan penguatan ekonomi lokal Desa.'
            ],
            [
                'urutan' => 6,
                'konten' => 'Menciptakan generasi muda yang semakin kuat dan tangguh serta berkepribadian luhur denagn melibatkan peran pemuka agama, tokoh masyarakat dan pemuka adat.'
            ],
            [
                'urutan' => 7,
                'konten' => 'Penguatan sumberdaya manusia dalam rangka peningkatan ekonomi produktif demi demi terwujudnya produk unggulan Desa.'
            ],
            [
                'urutan' => 8,
                'konten' => 'Membangun sarana prasarana penunjang dan dan pendampingan bagi generasi muda dalam rangka pengembangan minat dan bakat demi mewujudkan pemuda remaja yang trampil, kuat, tangguh, berprestasi dan berdaya saing.'
            ]
        ];

        foreach ($misis as $misi) {
            Misi::create($misi);
        }
    }
}
