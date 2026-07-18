<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $beritas = \App\Models\Berita::latest()->take(3)->get();
        $umkms = \App\Models\Umkm::latest()->take(4)->get();
        $wisatas = \App\Models\Wisata::latest()->take(4)->get();
        
        return view('welcome', compact('beritas', 'umkms', 'wisatas'));
    }

    public function profil()
    {
        $sejarahs = \App\Models\Sejarah::orderBy('tahun', 'asc')->get();
        $misis = \App\Models\Misi::orderBy('urutan', 'asc')->get();
        $pemdes = \App\Models\PerangkatDesa::where('kategori', 'pemdes')->get();
        $bpd = \App\Models\PerangkatDesa::where('kategori', 'bpd')->get();
        return view('profil', compact('sejarahs', 'misis', 'pemdes', 'bpd'));
    }

    public function struktur()
    {
        $pemdes = \App\Models\PerangkatDesa::where('kategori', 'pemdes')->get();
        $bpd = \App\Models\PerangkatDesa::where('kategori', 'bpd')->get();
        return view('struktur', compact('pemdes', 'bpd'));
    }


    public function berita(Request $request)
    {
        $query = \App\Models\Berita::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        $beritas = $query->latest()->paginate(6)->withQueryString();
        return view('berita', compact('beritas'));
    }

    public function galeri()
    {
        $galeris = \App\Models\Galeri::latest()->get();
        return view('galeri', compact('galeris'));
    }

    public function potensi()
    {
        $wisatas = \App\Models\Wisata::latest()->get();
        $umkms = \App\Models\Umkm::latest()->get();
        return view('potensi', compact('wisatas', 'umkms'));
    }

    public function kontak()
    {
        return view('kontak');
    }

    public function dataDesa(Request $request)
    {
        $query = \App\Models\DataDesa::query();

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

        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        if ($request->filled('pendidikan')) {
            $query->where('pendidikan', $request->pendidikan);
        }

        if ($request->filled('pekerjaan')) {
            $query->where('pekerjaan', $request->pekerjaan);
        }

        $dataDesa = $query->paginate(20)->withQueryString();
        
        // Stats using all data (no filter for stats to show full picture)
        $allData = \App\Models\DataDesa::all();
        $totalPenduduk = $allData->count();
        $lakiLaki = $allData->where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = $allData->where('jenis_kelamin', 'Perempuan')->count();
        
        // Grouping
        $pendidikan = $allData->groupBy('pendidikan')->map->count();
        $pekerjaan = $allData->groupBy('pekerjaan')->map->count();
        $dusun = $allData->groupBy('dusun')->map->count();
        $agama = $allData->groupBy('agama')->map->count();
        $status_perkawinan = $allData->groupBy('status_perkawinan')->map->count();

        // Calculate age groups
        $umur = [
            '0-10 Tahun' => 0,
            '11-20 Tahun' => 0,
            '21-30 Tahun' => 0,
            '31-40 Tahun' => 0,
            '41-50 Tahun' => 0,
            '51-60 Tahun' => 0,
            '60+ Tahun' => 0,
            'Tidak Diketahui' => 0
        ];

        foreach ($allData as $data) {
            $ttl = $data->tempat_tanggal_lahir;
            $age = null;
            if ($ttl) {
                // Try to extract date
                $parts = explode(',', $ttl);
                $dateStr = trim(end($parts));
                if (preg_match('/(\d{1,2})[\/\-](\d{1,2})[\/\-](\d{4})/', $dateStr, $m)) {
                    // Try parsing mm/dd/yyyy or dd/mm/yyyy
                    $year = (int)$m[3];
                    $age = 2026 - $year; // Assuming current year is 2026 based on files
                }
            }

            if ($age === null) {
                $umur['Tidak Diketahui']++;
            } elseif ($age <= 10) {
                $umur['0-10 Tahun']++;
            } elseif ($age <= 20) {
                $umur['11-20 Tahun']++;
            } elseif ($age <= 30) {
                $umur['21-30 Tahun']++;
            } elseif ($age <= 40) {
                $umur['31-40 Tahun']++;
            } elseif ($age <= 50) {
                $umur['41-50 Tahun']++;
            } elseif ($age <= 60) {
                $umur['51-60 Tahun']++;
            } else {
                $umur['60+ Tahun']++;
            }
        }
        
        // Remove 'Tidak Diketahui' if 0 to keep chart clean
        if ($umur['Tidak Diketahui'] === 0) unset($umur['Tidak Diketahui']);

        return view('data-desa', compact('dataDesa', 'totalPenduduk', 'lakiLaki', 'perempuan', 'pendidikan', 'pekerjaan', 'dusun', 'agama', 'status_perkawinan', 'umur'));
    }


    public function dashboard()
    {
        return view('dashboard');
    }
}
