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
        $galeris = \App\Models\Galeri::latest()->take(6)->get();
        
        $allData = \App\Models\DataDesa::all();
        $totalPenduduk = $allData->count();
        $lakiLaki = $allData->where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = $allData->where('jenis_kelamin', 'Perempuan')->count();
        $totalDusun = $allData->groupBy('dusun')->count();
        
        return view('welcome', compact('beritas', 'umkms', 'wisatas', 'galeris', 'totalPenduduk', 'lakiLaki', 'perempuan', 'totalDusun'));
    }

    public function profil()
    {
        $sejarahs = \App\Models\Sejarah::orderBy('tahun', 'asc')->get();
        $misis = \App\Models\Misi::orderBy('urutan', 'asc')->get();
        $pemdes = \App\Models\PerangkatDesa::where('kategori', 'pemdes')->get();
        $bpd = \App\Models\PerangkatDesa::where('kategori', 'bpd')->get();
        $mantanKades = \App\Models\MantanKades::orderBy('urutan', 'asc')->get();
        return view('profil', compact('sejarahs', 'misis', 'pemdes', 'bpd', 'mantanKades'));
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

        if ($request->filled('rt')) {
            $query->where('rt', $request->rt);
        }

        if ($request->filled('rw')) {
            $query->where('rw', $request->rw);
        }

        // Apply query to stats so charts reflect the selected filter
        $allData = (clone $query)->get();

        $dataDesa = $query->paginate(20)->withQueryString();
        
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

        // Use full data for dropdown lists so options don't disappear on filter
        $fullData = \App\Models\DataDesa::all();
        $rtList = $fullData->pluck('rt')->filter()->unique()->sort();
        $rwList = $fullData->pluck('rw')->filter()->unique()->sort();
        $dusunList = $fullData->pluck('dusun')->filter()->unique()->sort();

        return view('data-desa', compact('dataDesa', 'totalPenduduk', 'lakiLaki', 'perempuan', 'pendidikan', 'pekerjaan', 'dusun', 'agama', 'status_perkawinan', 'umur', 'rtList', 'rwList', 'dusunList'));
    }

    public function apbdes(Request $request)
    {
        $tahunList = \App\Models\Apbdes::select('tahun_anggaran')->distinct()->orderBy('tahun_anggaran', 'desc')->pluck('tahun_anggaran');
        $tahun = $request->input('tahun', $tahunList->first() ?? date('Y'));

        $apbdesData = \App\Models\Apbdes::where('tahun_anggaran', $tahun)->orderBy('urutan')->get();

        $totalPendapatan = $apbdesData->where('jenis', 'pendapatan')->where('level', 1)->sum('anggaran');
        $totalBelanja = $apbdesData->where('jenis', 'belanja')->where('level', 0)->sum('anggaran');
        $totalPembiayaan = $apbdesData->where('jenis', 'pembiayaan')->whereIn('level', [1, 2])->first()?->anggaran ?? 0;

        $pendapatanData = $apbdesData->where('jenis', 'pendapatan')->where('level', 1)->values();
        $belanjaData = $apbdesData->where('jenis', 'belanja')->where('level', 0)->values();

        return view('apbdes', compact('tahunList', 'tahun', 'apbdesData', 'totalPendapatan', 'totalBelanja', 'totalPembiayaan', 'pendapatanData', 'belanjaData'));
    }


    public function kontak()
    {
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        session(['captcha_result' => $num1 + $num2]);

        return view('kontak', compact('num1', 'num2'));
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function visitorStatsAjax(Request $request)
    {
        $query = \App\Models\Visitor::query();
        
        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }
        
        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->month);
        }
        
        if ($request->filled('day')) {
            $query->whereDay('created_at', $request->day);
        }
        
        $count = $query->count();
        
        return response()->json([
            'count' => $count,
            'formatted' => number_format($count, 0, ',', '.')
        ]);
    }

    public function incrementBeritaView(Request $request, $id)
    {
        $berita = \App\Models\Berita::find($id);
        if ($berita) {
            $ip = $request->ip();
            $cacheKey = 'berita_view_' . $id . '_' . $ip;

            // Jika belum ada di cache (berarti belum view dalam 24 jam terakhir)
            if (!cache()->has($cacheKey)) {
                $berita->increment('views');
                // Simpan di cache selama 24 jam
                cache()->put($cacheKey, true, now()->addHours(24));
            }
            
            return response()->json(['success' => true, 'views' => $berita->views]);
        }
        return response()->json(['success' => false], 404);
    }
}
