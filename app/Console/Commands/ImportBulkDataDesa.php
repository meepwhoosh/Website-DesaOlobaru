<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DataDesa;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\IOFactory;
use DOMDocument;

class ImportBulkDataDesa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-bulk-data-desa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import multiple Excel files from Data-Excel-Desa folder to DataDesa table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $folderPath = base_path('Data-Excel-Desa');
        
        if (!File::exists($folderPath)) {
            $this->error("Folder {$folderPath} does not exist.");
            return;
        }

        $files = File::files($folderPath);
        if (empty($files)) {
            $this->warn("No files found in {$folderPath}.");
            return;
        }

        $this->info("Found " . count($files) . " files. Starting import...");

        $totalImported = 0;
        $totalSkipped = 0;
        
        // Cache existing NIKs to avoid redundant queries if possible, but updateOrCreate is fine.
        
        foreach ($files as $file) {
            $filePath = $file->getPathname();
            $extension = strtolower($file->getExtension());
            $this->info("Processing file: " . $file->getFilename());

            $data = [];

            if ($extension === 'xls') {
                $data = $this->parseHtmlXls($filePath);
            } elseif ($extension === 'xlsx' || $extension === 'csv') {
                $data = $this->parseXlsx($filePath);
            } else {
                $this->warn("Skipping unsupported file type: " . $file->getFilename());
                continue;
            }

            if (empty($data)) {
                $this->warn("No data found or failed to parse " . $file->getFilename());
                continue;
            }

            $headers = array_shift($data);
            
            // Try to find column indexes
            $colMap = $this->mapColumns($headers);
            if ($colMap['nik'] === -1 && $colMap['nama'] === -1) {
                $this->warn("Could not find NIK or Nama column in " . $file->getFilename() . ". Skipping.");
                continue;
            }

            $countFile = 0;
            foreach ($data as $row) {
                if (empty($row) || count($row) < 3) continue;

                $nik = $colMap['nik'] !== -1 ? (isset($row[$colMap['nik']]) ? $this->cleanNik($row[$colMap['nik']]) : null) : null;
                $nama = $colMap['nama'] !== -1 ? (isset($row[$colMap['nama']]) ? trim($row[$colMap['nama']]) : null) : null;

                if (empty($nama)) continue;

                $jkRaw = $colMap['jk'] !== -1 ? (isset($row[$colMap['jk']]) ? trim($row[$colMap['jk']]) : null) : null;
                $jk = $this->normalizeJk($jkRaw);

                $tempatLahir = $colMap['tempat_lahir'] !== -1 ? (isset($row[$colMap['tempat_lahir']]) ? trim($row[$colMap['tempat_lahir']]) : '') : '';
                $tglLahir = $colMap['tgl_lahir'] !== -1 ? (isset($row[$colMap['tgl_lahir']]) ? trim($row[$colMap['tgl_lahir']]) : '') : '';
                
                // Combine Tempat, Tanggal Lahir
                $ttl = trim($tempatLahir . ($tempatLahir && $tglLahir ? ', ' : '') . $tglLahir);
                // If there's a pre-combined column
                if ($colMap['ttl'] !== -1 && empty($ttl)) {
                    $ttl = isset($row[$colMap['ttl']]) ? trim($row[$colMap['ttl']]) : '';
                }

                $pendidikan = $colMap['pendidikan'] !== -1 ? (isset($row[$colMap['pendidikan']]) ? trim($row[$colMap['pendidikan']]) : null) : null;
                $pekerjaan = $colMap['pekerjaan'] !== -1 ? (isset($row[$colMap['pekerjaan']]) ? trim($row[$colMap['pekerjaan']]) : null) : null;
                $dusun = $colMap['dusun'] !== -1 ? (isset($row[$colMap['dusun']]) ? trim($row[$colMap['dusun']]) : null) : null;

                $agama = $colMap['agama'] !== -1 ? (isset($row[$colMap['agama']]) ? trim($row[$colMap['agama']]) : null) : null;
                $status = $colMap['status'] !== -1 ? (isset($row[$colMap['status']]) ? trim($row[$colMap['status']]) : null) : null;

                // Update or Create
                $matchAttr = [];
                if (!empty($nik)) {
                    $matchAttr['nik'] = $nik;
                } else {
                    $matchAttr['nama_lengkap'] = $nama;
                    if (!empty($dusun)) {
                        $matchAttr['dusun'] = $dusun;
                    }
                }

                $fillAttr = [
                    'nama_lengkap' => $nama,
                    'jenis_kelamin' => $jk,
                    'agama' => $agama,
                    'status_perkawinan' => $status,
                    'tempat_tanggal_lahir' => $ttl,
                    'pendidikan' => $pendidikan,
                    'pekerjaan' => $pekerjaan,
                    'dusun' => $dusun,
                ];
                if (!empty($nik)) {
                    $fillAttr['nik'] = $nik;
                }

                DataDesa::updateOrCreate($matchAttr, $fillAttr);
                $countFile++;
                $totalImported++;
            }
            
            $this->line("Imported {$countFile} rows from " . $file->getFilename());
        }

        $this->info("Import completed! Total data processed: {$totalImported}");
    }

    private function parseHtmlXls($filePath)
    {
        $html = file_get_contents($filePath);
        if (stripos($html, '<html>') === false) {
            $html = '<html><head><meta charset="utf-8"></head><body>' . $html . '</body></html>';
        }
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $rows = $dom->getElementsByTagName('tr');
        $data = [];
        foreach ($rows as $row) {
            $rowData = [];
            foreach ($row->childNodes as $cell) {
                if ($cell->nodeName === 'td' || $cell->nodeName === 'th') {
                    $rowData[] = trim($cell->textContent);
                }
            }
            if (!empty($rowData)) $data[] = $rowData;
        }
        return $data;
    }

    private function parseXlsx($filePath)
    {
        try {
            $spreadsheet = IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray();
            
            // Clean empty rows and find the header row (sometimes row 0 is just a title)
            $cleanData = [];
            $headerFound = false;
            foreach ($data as $row) {
                if (empty(array_filter($row))) continue;
                
                // If it's the first non-empty row but it only has 1 column filled, it's a title, skip it
                if (!$headerFound) {
                    $filledCols = array_filter($row, fn($v) => !is_null($v) && trim($v) !== '');
                    if (count($filledCols) <= 1) {
                        continue; // Skip title row
                    }
                    $headerFound = true;
                }
                $cleanData[] = $row;
            }
            return $cleanData;
        } catch (\Exception $e) {
            $this->error("PhpSpreadsheet Error: " . $e->getMessage());
            return [];
        }
    }

    private function mapColumns($headers)
    {
        $map = [
            'nik' => -1,
            'nama' => -1,
            'jk' => -1,
            'agama' => -1,
            'status' => -1,
            'tempat_lahir' => -1,
            'tgl_lahir' => -1,
            'ttl' => -1, // combined
            'pendidikan' => -1,
            'pekerjaan' => -1,
            'dusun' => -1,
        ];

        foreach ($headers as $index => $header) {
            $header = strtolower(trim($header));
            if (empty($header)) continue;

            if (strpos($header, 'nik') !== false || strpos($header, 'ktp') !== false) $map['nik'] = $index;
            elseif (strpos($header, 'nama lengkap') !== false || $header === 'nama') $map['nama'] = $index;
            elseif (strpos($header, 'jenis kelamin') !== false || $header === 'jk') $map['jk'] = $index;
            elseif (strpos($header, 'agama') !== false) $map['agama'] = $index;
            elseif (strpos($header, 'status') !== false) $map['status'] = $index;
            elseif (strpos($header, 'tempat lahir') !== false) $map['tempat_lahir'] = $index;
            elseif (strpos($header, 'tanggal lahir') !== false || strpos($header, 'tgl lahir') !== false) $map['tgl_lahir'] = $index;
            elseif (strpos($header, 'tempat') !== false && strpos($header, 'lahir') !== false) $map['ttl'] = $index;
            elseif (strpos($header, 'pendidikan') !== false) $map['pendidikan'] = $index;
            elseif (strpos($header, 'pekerjaan') !== false) $map['pekerjaan'] = $index;
            elseif (strpos($header, 'dusun') !== false) $map['dusun'] = $index;
        }
        return $map;
    }

    private function cleanNik($nik)
    {
        if (!$nik) return null;
        $nik = trim($nik);
        $nik = ltrim($nik, "_'"); // Remove leading _ or '
        // Keep only numbers
        $nik = preg_replace('/[^0-9]/', '', $nik);
        return $nik;
    }

    private function normalizeJk($jk)
    {
        if (!$jk) return null;
        $jk = strtolower(trim($jk));
        if ($jk === 'l' || $jk === 'lk' || strpos($jk, 'laki') !== false) {
            return 'Laki-laki';
        }
        if ($jk === 'p' || $jk === 'pr' || strpos($jk, 'perempuan') !== false) {
            return 'Perempuan';
        }
        return null;
    }
}
