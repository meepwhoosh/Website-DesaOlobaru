<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SejarahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sejarahs')->insert([
            [
                'tahun' => '1952',
                'judul' => 'Awal Kedatangan',
                'konten' => 'Warga desa Olobaru awalnya terdiri dari beberapa orang petani yang datang dari daerah Minahasa Propinsi Sulawesi Utara pada tahun 1952 dengan maksud untuk bertani. Karena saat itu mereka tidak punya lahan pertanian di desa Maesa, maka masyarakat memohon kepada Bapak Raja Tagunu untuk diberikan lahan pertanian. Oleh Bapak Raja Tagunu ditempatkanlah orang Minahasa tersebut disebelah timur pasar Lemusa yang kemudian menjadi dusun IV Tombatu wilayah desa Maesa dengan kepala desanya Bp. Hendrik Maliangkay.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tahun' => '1960',
                'judul' => 'Pembentukan Desa Olotua',
                'konten' => 'Pada tahun 1960 oleh prakarsa beberapa Tokoh masyarakat Minahasa yang kemudian mendapat dukungan dari Camat Parigi yang pada saat itu dijabat oleh Bp. Arsid Pasau dibentuklah desa baru yang bernama Olotua memisahkan diri dari desa Maesa dengan Kepala desa Pertama yaitu Bp. Geno Salindeho dan pusat pemerintahannya di Olotua.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tahun' => '1966',
                'judul' => 'Musibah Banjir',
                'konten' => 'Oleh karena musibah banjir yang melanda pemukiman warga Minahasa disebelah selatan pasar Lemusa pada tahun 1966 sekaligus memporak porandakan sebagian besar rumah warga yang kebanyakan terbuat dari kayu, beserta dengan areal persawahan maka warga masyarakat Minahasa yang membentuk desa Olotua terpaksa pindah mencari hunian baru yang lebih aman.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tahun' => 'Pasca 1966',
                'judul' => 'Berdirinya Desa Olobaru',
                'konten' => 'Pasca banjir tahun 1966, beberapa Tokoh masyarakat Minahasa mengajak seluruh warga untuk membeli perkintalan dari masyarakat desa Olaya yang letaknya disebelah utara desa Lemusa untuk dijadikan hunian baru. Karena sebagian besar warga masyarakat desa Olotua saat itu adalah orang Minahasa yang telah pindah ke lokasi pemukiman yang baru yaitu disebelah utara sungai Korontua atau sebelah barat desa Olaya, maka Bp. Geno Salindeho sebagai kepala desa Olotua memutuskan untuk memindahkan pusat pemerintahan dari Olotua ke pemukiman baru dan atas kesepakatan bersama antara pemerintah desa dan masyarakat hunian yang baru itu akhirnya diberi nama desa Olobaru. Sejak saat itulah desa Olobaru resmi berdiri sendiri dengan kepala desa pertama yaitu Bp. Geno Salindeho.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
