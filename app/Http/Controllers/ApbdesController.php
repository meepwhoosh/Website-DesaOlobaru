<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apbdes;

class ApbdesController extends Controller
{
    public function index()
    {
        $years = Apbdes::select('tahun_anggaran')->distinct()->orderBy('tahun_anggaran', 'desc')->pluck('tahun_anggaran');
        return view('admin.apbdes.index', compact('years'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls',
            'tahun_anggaran' => 'required|numeric'
        ]);

        $file = $request->file('file_excel');
        
        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getSheet(3); // Lamp 1b
            $rows = $worksheet->toArray();
            
            $tahun_anggaran = $request->tahun_anggaran;
            
            // clear old data for this year
            Apbdes::where('tahun_anggaran', $tahun_anggaran)->delete();
            
            $urutan = 0;

            foreach ($rows as $index => $row) {
                if ($index < 10) continue; // Skip header

                $uraian = $row[3] ?? '';
                if (empty(trim($uraian))) continue;

                $kode = $row[2] ?? '';
                $anggaran = (float) str_replace(['Rp', '.', ',', ' '], '', $row[4] ?? 0);
                $sumber = $row[5] ?? null;

                $jenis = 'pendapatan';
                if (stripos($uraian, 'belanja') !== false || stripos($kode, '2.') === 0) {
                    $jenis = 'belanja';
                }
                if (stripos($uraian, 'pembiayaan') !== false || stripos($kode, '3.') === 0) {
                    $jenis = 'pembiayaan';
                }

                $level = 0;
                if (!empty($kode)) {
                    $level = substr_count($kode, '.');
                }

                Apbdes::create([
                    'tahun_anggaran' => $tahun_anggaran,
                    'kode_rekening' => $kode,
                    'uraian' => $uraian,
                    'anggaran' => $anggaran,
                    'sumber_dana' => $sumber,
                    'jenis' => $jenis,
                    'level' => $level,
                    'urutan' => $urutan++
                ]);
            }

            return back()->with('success', 'Data APBDes berhasil diimport!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deleteExcel($tahun)
    {
        Apbdes::where('tahun_anggaran', $tahun)->delete();
        return back()->with('success', 'Data APBDes Tahun ' . $tahun . ' berhasil dihapus!');
    }

    public function exportExcel(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\ApbdesExport($tahun), 'APBDes-'.$tahun.'.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));
        $apbdesData = Apbdes::where('tahun_anggaran', $tahun)->orderBy('urutan')->get();
        
        $totalPendapatan = $apbdesData->where('jenis', 'pendapatan')->where('level', 1)->sum('anggaran');
        $totalBelanja = $apbdesData->where('jenis', 'belanja')->where('level', 0)->sum('anggaran');
        $totalPembiayaan = $apbdesData->where('jenis', 'pembiayaan')->whereIn('level', [1, 2])->first()?->anggaran ?? 0;

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.apbdes', compact('tahun', 'apbdesData', 'totalPendapatan', 'totalBelanja', 'totalPembiayaan'));
        return $pdf->download('APBDes-'.$tahun.'.pdf');
    }
}
