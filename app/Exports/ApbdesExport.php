<?php

namespace App\Exports;

use App\Models\Apbdes;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ApbdesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $tahun;

    public function __construct($tahun)
    {
        $this->tahun = $tahun;
    }

    public function collection()
    {
        return Apbdes::where('tahun_anggaran', $this->tahun)->orderBy('urutan')->get();
    }

    public function headings(): array
    {
        return [
            'Kode Rekening',
            'Uraian',
            'Anggaran (Rp)',
            'Sumber Dana',
            'Kategori'
        ];
    }

    public function map($row): array
    {
        // Add indentation for export? Excel can't do HTML spaces easily, but we can prefix spaces.
        $indent = str_repeat('   ', $row->level);
        return [
            $row->kode_rekening,
            $indent . $row->uraian,
            $row->anggaran,
            $row->sumber_dana,
            ucfirst($row->jenis)
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
