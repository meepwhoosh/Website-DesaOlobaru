<?php

namespace App\Imports;

use App\Models\DataDesa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataDesaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // We expect the Excel to have headings matching the columns (e.g., NIK, Nama Lengkap, dll)
        // By default, WithHeadingRow will snake_case the headings.
        // So 'Nama Lengkap' becomes 'nama_lengkap'
        
        // Skip if nama_lengkap is empty
        if (!isset($row['nama_lengkap']) || empty(trim($row['nama_lengkap']))) {
            return null;
        }

        return new DataDesa([
            'nik' => $row['nik'] ?? null,
            'nama_lengkap' => $row['nama_lengkap'],
            'jenis_kelamin' => $row['jenis_kelamin'] ?? null,
            'tempat_tanggal_lahir' => $row['tempat_tanggal_lahir'] ?? null,
            'pendidikan' => $row['pendidikan'] ?? null,
            'pekerjaan' => $row['pekerjaan'] ?? null,
            'dusun' => $row['dusun'] ?? null,
        ]);
    }
}
