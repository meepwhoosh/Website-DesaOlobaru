@extends('layouts.admin')

@section('title', 'Kelola APBDes')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Kelola APBDes</h1>
        <p class="text-slate-500 dark:text-slate-400 mt-1">Import dan kelola data Anggaran Pendapatan dan Belanja Desa.</p>
    </div>
    <button onclick="document.getElementById('importModal').classList.remove('hidden')" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-xl font-medium transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
        Import Excel
    </button>
</div>

@if(session('success'))
<div class="mb-6 p-4 rounded-xl bg-green-50 text-green-700 border border-green-200 flex items-start gap-3">
    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    <p class="font-medium">{{ session('success') }}</p>
</div>
@endif

@if(session('error'))
<div class="mb-6 p-4 rounded-xl bg-red-50 text-red-700 border border-red-200 flex items-start gap-3">
    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    <p class="font-medium">{{ session('error') }}</p>
</div>
@endif

<div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
    <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
        <h2 class="text-lg font-bold text-slate-800 dark:text-white">Data APBDes Terimport</h2>
    </div>

    @if($years->count() > 0)
    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach($years as $tahun)
        <div class="bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl p-5 flex justify-between items-center">
            <div>
                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Tahun Anggaran</p>
                <p class="text-3xl font-black text-green-600 dark:text-green-500">{{ $tahun }}</p>
            </div>
            <form action="{{ route('admin.apbdes.delete-excel', $tahun) }}" method="POST" onsubmit="return confirm('Hapus seluruh data APBDes untuk Tahun {{ $tahun }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-2.5 text-red-500 hover:text-red-700 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/40 rounded-xl transition-colors" title="Hapus Data">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </form>
        </div>
        @endforeach
    </div>
    @else
    <div class="p-12 text-center">
        <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-400">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
        </div>
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1">Belum ada data APBDes</h3>
        <p class="text-slate-500 dark:text-slate-400 mb-6">Silakan import data dari file Excel (Lamp 1b) untuk menampilkan APBDes.</p>
        <button onclick="document.getElementById('importModal').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-700 dark:text-white rounded-lg font-medium transition-colors">
            Import Excel Sekarang
        </button>
    </div>
    @endif
</div>

<!-- Import Modal -->
<div id="importModal" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="document.getElementById('importModal').classList.add('hidden')"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md">
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl overflow-hidden">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Import Data APBDes</h3>
                <button onclick="document.getElementById('importModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form action="{{ route('admin.apbdes.import') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Tahun Anggaran</label>
                    <input type="number" name="tahun_anggaran" value="{{ date('Y') }}" required placeholder="Contoh: 2026"
                        class="block w-full px-4 py-3 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:ring-2 focus:ring-green-400 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-white outline-none transition-colors">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">File Excel (Lamp 1b)</label>
                    <input type="file" name="file_excel" accept=".xlsx,.xls" required
                        class="block w-full text-sm text-slate-500 dark:text-slate-400
                        file:mr-4 file:py-2.5 file:px-4
                        file:rounded-xl file:border-0
                        file:text-sm file:font-semibold
                        file:bg-green-50 file:text-green-700
                        hover:file:bg-green-100 dark:file:bg-green-900/30 dark:file:text-green-400 border border-slate-200 dark:border-slate-700 rounded-xl cursor-pointer">
                    <p class="text-xs text-slate-500 mt-2">Pastikan file memiliki format yang sama dengan Lampiran 1b APBDes.</p>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('importModal').classList.add('hidden')" class="px-4 py-2 text-slate-600 font-medium hover:bg-slate-100 rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-xl transition-colors">Import Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
