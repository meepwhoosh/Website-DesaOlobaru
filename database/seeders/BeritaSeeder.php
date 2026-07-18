<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Berita::create([
            'judul' => 'Penyaluran BLT Dana Desa Tahap I',
            'slug' => 'penyaluran-blt-dana-desa-tahap-i',
            'konten' => 'Pemerintah Desa Olobaru telah sukses menyalurkan Bantuan Langsung Tunai (BLT) Dana Desa kepada puluhan keluarga penerima manfaat...',
            'gambar' => null, // Placeholder untuk gambar
            'tanggal_publikasi' => now(),
        ]);

        \App\Models\Berita::create([
            'judul' => 'Gotong Royong Membersihkan Saluran Air',
            'slug' => 'gotong-royong-membersihkan-saluran-air',
            'konten' => 'Warga Desa Olobaru bersama perangkat desa melakukan kerja bakti membersihkan saluran air menjelang musim penghujan...',
            'gambar' => null,
            'tanggal_publikasi' => now()->subDays(2),
        ]);
        
        \App\Models\Berita::create([
            'judul' => 'Pembukaan Turnamen Olahraga Antar Dusun',
            'slug' => 'pembukaan-turnamen-olahraga-antar-dusun',
            'konten' => 'Dalam rangka mempererat tali silaturahmi, Pemerintah Desa Olobaru mengadakan turnamen bola voli yang diikuti oleh perwakilan setiap dusun...',
            'gambar' => null,
            'tanggal_publikasi' => now()->subDays(5),
        ]);
    }
}
