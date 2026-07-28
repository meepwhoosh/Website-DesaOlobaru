<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataDesa;
use App\Imports\DataDesaImport;
use Maatwebsite\Excel\Facades\Excel;

class DataDesaController extends Controller
{
    public function index(Request $request)
    {
        $query = DataDesa::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        if ($request->filled('dusun')) {
            $query->where('dusun', $request->dusun);
        }

        if ($request->filled('pendidikan')) {
            $query->where('pendidikan', $request->pendidikan);
        }

        if ($request->filled('pekerjaan')) {
            $query->where('pekerjaan', $request->pekerjaan);
        }

        $dataDesaCount = $query->count();
        
        $allData = DataDesa::all();
        $dusunList = $allData->pluck('dusun')->filter()->unique()->sort();
        $pendidikanList = $allData->pluck('pendidikan')->filter()->unique()->sort();
        $pekerjaanList = $allData->pluck('pekerjaan')->filter()->unique()->sort();

        // Ambil daftar file Excel dari folder Data-Excel-Desa
        $excelFiles = [];
        $folderPath = base_path('Data-Excel-Desa');
        if (\Illuminate\Support\Facades\File::exists($folderPath)) {
            $files = \Illuminate\Support\Facades\File::files($folderPath);
            foreach ($files as $file) {
                $excelFiles[] = [
                    'name' => $file->getFilename(),
                    'size' => round($file->getSize() / 1024, 2) . ' KB',
                    'modified_at' => date('Y-m-d H:i:s', $file->getMTime())
                ];
            }
        }

        return view('admin.data_desa.index', compact('dataDesaCount', 'dusunList', 'pendidikanList', 'pekerjaanList', 'excelFiles'));
    }

    public function create()
    {
        return view('admin.data_desa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'nullable|string|max:50',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'nullable|string|max:255',
            'status_perkawinan' => 'nullable|string|max:255',
            'tempat_tanggal_lahir' => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'dusun' => 'nullable|string|max:255',
        ]);

        DataDesa::create($validated);

        return redirect()->route('admin.data-desa.index')->with('success', 'Data Penduduk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = DataDesa::findOrFail($id);
        return view('admin.data_desa.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = DataDesa::findOrFail($id);
        
        $validated = $request->validate([
            'nik' => 'nullable|string|max:50',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'nullable|string|max:255',
            'status_perkawinan' => 'nullable|string|max:255',
            'tempat_tanggal_lahir' => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'dusun' => 'nullable|string|max:255',
        ]);

        $data->update($validated);

        return redirect()->route('admin.data-desa.index')->with('success', 'Data Penduduk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DataDesa::findOrFail($id)->delete();
        return redirect()->route('admin.data-desa.index')->with('success', 'Data Penduduk berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv|max:1024'
        ]);

        try {
            $file = $request->file('file_excel');
            
            // Simpan file ke folder Data-Excel-Desa
            // Sanitasi nama file menggunakan slug dan penanda waktu untuk mencegah karakter berbahaya
            $extension = $file->getClientOriginalExtension();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = \Illuminate\Support\Str::slug($originalName) . '-' . time() . '.' . $extension;
            $folderPath = base_path('Data-Excel-Desa');
            
            if (!\Illuminate\Support\Facades\File::exists($folderPath)) {
                \Illuminate\Support\Facades\File::makeDirectory($folderPath, 0755, true);
            }
            
            $file->move($folderPath, $fileName);
            
            // Proses import ke database
            Excel::import(new DataDesaImport, $folderPath . '/' . $fileName);
            
            return redirect()->route('admin.data-desa.index')->with('success', 'Data Excel berhasil diimport dan disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengimport data: ' . $e->getMessage());
        }
    }

    public function downloadExcel($filename)
    {
        $filename = basename($filename); // Mencegah path traversal
        $filePath = base_path('Data-Excel-Desa/' . $filename);
        if (\Illuminate\Support\Facades\File::exists($filePath)) {
            return response()->download($filePath);
        }
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    public function deleteExcel($filename)
    {
        $filename = basename($filename); // Mencegah path traversal
        $filePath = base_path('Data-Excel-Desa/' . $filename);
        if (\Illuminate\Support\Facades\File::exists($filePath)) {
            \Illuminate\Support\Facades\File::delete($filePath);
            return redirect()->back()->with('success', 'File Excel berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}
