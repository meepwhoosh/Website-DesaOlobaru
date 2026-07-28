<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportDataExcelDesa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data-desa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bulk import data desa dari semua file .xls (HTML) di folder Data file excel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $folderPath = base_path('Data file excel');
        if (!is_dir($folderPath)) {
            $this->error("Folder '$folderPath' tidak ditemukan!");
            return;
        }

        $files = glob($folderPath . '/*.{xls,xlsx,csv}', GLOB_BRACE);
        if (empty($files)) {
            $this->info("Tidak ada file Excel ditemukan di $folderPath.");
            return;
        }

        $this->info("Ditemukan " . count($files) . " file. Memulai proses bulk import...");
        $totalImported = 0;

        foreach ($files as $file) {
            $this->line("Memproses file: " . basename($file));
            
            $content = file_get_contents($file);
            
            // Fix missing html tags for DOMDocument
            if (stripos($content, '<html') === false) {
                $content = '<html><body>' . $content . '</body></html>';
            }

            // Suppress warnings due to malformed HTML
            libxml_use_internal_errors(true);
            $dom = new \DOMDocument();
            $dom->loadHTML($content);
            libxml_clear_errors();

            $tables = $dom->getElementsByTagName('table');
            if ($tables->length === 0) {
                $this->warn(" -> Tidak ada tag <table> di file ini, melewati...");
                continue;
            }

            $table = $tables->item(0);
            $rows = $table->getElementsByTagName('tr');
            
            $isFirst = true;
            $fileImported = 0;
            
            foreach ($rows as $row) {
                if ($isFirst) { // Skip header
                    $isFirst = false;
                    continue;
                }

                $cols = $row->getElementsByTagName('td');
                if ($cols->length < 15) {
                    continue; // Skip invalid rows
                }

                $nik = trim(str_replace('_', '', $cols->item(1)->nodeValue));
                $nama = trim($cols->item(3)->nodeValue);
                $tempat_lahir = trim($cols->item(4)->nodeValue);
                $tanggal_lahir = trim($cols->item(5)->nodeValue);
                $jk = trim($cols->item(6)->nodeValue);
                // Title case for JK (Laki-laki / Perempuan)
                $jk = ucfirst(strtolower($jk));
                if ($jk == 'Laki-laki' || $jk == 'Laki-Laki') $jk = 'Laki-laki';

                $agama = trim($cols->item(7)->nodeValue);
                $status = trim($cols->item(8)->nodeValue);
                $pendidikan = trim($cols->item(9)->nodeValue);
                $pekerjaan = trim($cols->item(10)->nodeValue);
                $dusun = trim($cols->item(13)->nodeValue);
                
                $rtrw = trim($cols->item(14)->nodeValue);
                $rt = null;
                $rw = null;
                if (!empty($rtrw) && strpos($rtrw, '/') !== false) {
                    $parts = explode('/', $rtrw);
                    if (count($parts) == 2) {
                        $rt = trim($parts[0]);
                        $rw = trim($parts[1]);
                    }
                }

                // Tempat, Tanggal Lahir (Combined)
                $ttl = $tempat_lahir;
                if (!empty($tanggal_lahir)) {
                    $ttl .= ', ' . $tanggal_lahir;
                }

                // If NIK is empty but Nama is present, we still insert it, but updateOrCreate needs keys
                if (empty($nik) && empty($nama)) {
                    continue; // Skip completely empty
                }

                $matchKeys = ['nik' => $nik];
                if (empty($nik)) {
                    // if NIK is empty, try to match by name
                    $matchKeys = ['nama_lengkap' => $nama];
                }

                \App\Models\DataDesa::updateOrCreate(
                    $matchKeys,
                    [
                        'nik' => $nik,
                        'nama_lengkap' => $nama,
                        'jenis_kelamin' => $jk,
                        'tempat_tanggal_lahir' => $ttl,
                        'pendidikan' => $pendidikan,
                        'pekerjaan' => $pekerjaan,
                        'agama' => $agama,
                        'status_perkawinan' => $status,
                        'dusun' => $dusun,
                        'rt' => $rt,
                        'rw' => $rw,
                    ]
                );
                
                $fileImported++;
                $totalImported++;
            }
            
            $this->info(" -> Berhasil memproses $fileImported baris dari file ini.");
        }

        $this->info("Selesai! Total $totalImported data penduduk telah diimport/update.");
    }
}
