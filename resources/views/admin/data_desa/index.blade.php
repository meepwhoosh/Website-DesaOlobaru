@extends('layouts.admin')

@section('title', 'Data Desa')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white">Data Penduduk Desa</h1>
        <p class="text-slate-500 dark:text-slate-300 dark:text-white mt-1">Kelola arsip data penduduk dari file Excel.</p>
    </div>
    <div class="flex items-center gap-3">
        <button onclick="document.getElementById('importModal').classList.remove('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-semibold shadow-sm transition-all duration-200 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
            Import Excel Baru
        </button>
    </div>
</div>

<!-- Statistik Singkat -->
<div class="bg-white dark:bg-[#1a1a1a] p-6 rounded-2xl border border-slate-200 dark:border-white/10 shadow-sm mb-6 flex items-center gap-6">
    <div class="w-16 h-16 rounded-2xl bg-green-50 dark:bg-green-900/30 text-green-600 flex items-center justify-center shrink-0">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
    </div>
    <div>
        <p class="text-sm font-semibold text-slate-500 dark:text-slate-300 dark:text-white uppercase tracking-widest mb-1">Total Data Masuk di Database</p>
        <h3 class="text-3xl font-black text-slate-800 dark:text-white">{{ number_format($dataDesaCount, 0, ',', '.') }} <span class="text-base font-medium text-slate-500 dark:text-slate-300 dark:text-white normal-case">Jiwa</span></h3>
    </div>
</div>

<!-- Daftar File Excel -->
<div class="bg-white dark:bg-[#1a1a1a] border border-slate-200 dark:border-white/10 rounded-2xl shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-[#0f0f0f] dark:bg-[#141414]/50 dark:bg-white/10">
        <h2 class="text-lg font-bold text-slate-800 dark:text-white">Arsip File Excel Penduduk</h2>
        <p class="text-sm text-slate-500 dark:text-slate-300 dark:text-white mt-1">Daftar file rekapitulasi data penduduk yang telah tersimpan di sistem.</p>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-[#0f0f0f] dark:bg-[#141414] border-b border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-300 dark:text-white text-sm">
                    <th class="px-6 py-4 font-semibold">Nama File</th>
                    <th class="px-6 py-4 font-semibold">Ukuran</th>
                    <th class="px-6 py-4 font-semibold">Terakhir Diubah</th>
                    <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700 dark:text-slate-200 dark:text-white">
                @forelse($excelFiles as $file)
                <tr class="hover:bg-slate-50 dark:bg-[#0f0f0f] dark:bg-slate-800 dark:hover:bg-[#202020] transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $file['name'] }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm">{{ $file['size'] }}</td>
                    <td class="px-6 py-4 text-sm">{{ $file['modified_at'] }}</td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col sm:flex-row items-end sm:items-center justify-end gap-2">
                            <!-- Tombol Download -->
                            <a href="{{ route('admin.data-desa.download-excel', $file['name']) }}" class="inline-flex items-center justify-center px-3 py-1.5 rounded-lg text-sm font-semibold text-blue-700 bg-blue-100 hover:bg-blue-200 transition-colors" title="Download Excel">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Download
                            </a>
                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.data-desa.delete-excel', $file['name']) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus file Excel ini? (Data di database tidak akan terhapus, hanya file)');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center px-3 py-1.5 rounded-lg text-sm font-semibold text-red-700 bg-red-100 hover:bg-red-200 transition-colors" title="Hapus Excel">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-slate-500 dark:text-slate-300 dark:text-white">
                        <svg class="mx-auto h-12 w-12 text-slate-600 dark:text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Belum ada file Excel yang tersimpan di server.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Info Banner -->
<div class="mt-6 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl p-4 flex gap-4">
    <svg class="w-6 h-6 text-slate-500 dark:text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    <div>
        <h4 class="font-semibold text-slate-900 dark:text-white">Mengapa Tabel Data Detail Tidak Ditampilkan?</h4>
        <p class="text-sm text-slate-700 dark:text-slate-300 mt-1">
            Mengingat tingginya sensitivitas privasi data penduduk (NIK, dll), kami menyembunyikan tabel data individu di antarmuka ini. Anda dapat menggunakan tombol <strong>Import Excel Baru</strong> untuk memperbarui data di Database yang akan langsung tersinkronisasi ke visualisasi Grafik Dashboard Website. Untuk mengedit secara individual, ubah data di file Excel lokal Anda dan lakukan proses re-import (sistem akan otomatis me-*replace* data tanpa duplikat).
        </p>
    </div>
</div>

@push('modals')
<!-- Modal Import Excel -->
<div id="importModal" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white dark:bg-[#1a1a1a] rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-white/5 flex items-center justify-between">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Import Data dari Excel</h3>
            <button type="button" onclick="document.getElementById('importModal').classList.add('hidden')" class="text-slate-600 dark:text-slate-300 hover:text-slate-600 dark:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <form action="{{ route('admin.data-desa.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="p-6 space-y-4">
                <p class="text-sm text-slate-600 dark:text-slate-300">Unggah file Excel untuk memperbarui database. Jika Anda mengunggah nama/NIK yang sudah ada, data lama akan ditimpa (di-update).</p>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Pilih File Excel (.xlsx, .xls, .csv)</label>
                    <input type="file" name="file_excel" accept=".xlsx,.xls,.csv" required class="w-full text-sm text-slate-500 dark:text-slate-300 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-green-50 dark:bg-green-900/30 file:text-green-700 hover:file:bg-green-100 border border-slate-200 dark:border-white/10 rounded-xl">
                </div>
            </div>
            <div class="px-6 py-4 bg-slate-50 dark:bg-[#0f0f0f] border-t border-slate-100 dark:border-white/5 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('importModal').classList.add('hidden')" class="px-4 py-2 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-slate-800 dark:hover:text-white transition-colors">Batal</button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl font-semibold shadow-sm transition-colors text-sm">
                    Mulai Import
                </button>
            </div>
        </form>
    </div>
</div>
@endpush
@endsection
