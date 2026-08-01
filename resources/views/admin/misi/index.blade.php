@extends('layouts.admin')

@section('title', 'Kelola Misi Desa')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white">Misi Desa</h1>
        <p class="text-slate-500 dark:text-slate-300 dark:text-white mt-1">Kelola daftar poin Misi untuk mencapai Visi pembangunan desa.</p>
    </div>
    <div class="flex items-center gap-3">
        <button type="button" id="bulkDeleteBtn" disabled class="opacity-50 cursor-not-allowed inline-flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl font-semibold shadow-sm transition-all duration-200 hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            Hapus Terpilih
        </button>
        <a href="{{ route('admin.misi.create') }}" class="inline-flex items-center justify-center gap-2 bg-green-700 hover:bg-green-800 text-white px-5 py-2.5 rounded-xl font-semibold shadow-sm transition-all duration-200 hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Misi
        </a>
    </div>
</div>

@if(session('success'))
<div class="mb-6 p-4 rounded-xl bg-green-50 dark:bg-green-900/30 border border-green-100 flex items-start gap-3">
    <div class="text-green-600 mt-0.5">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    </div>
    <div>
        <h4 class="text-sm font-semibold text-green-800">Berhasil!</h4>
        <p class="text-sm text-green-700">{{ session('success') }}</p>
    </div>
</div>
@endif

<form id="bulkDeleteForm" action="{{ route('admin.misi.bulk-destroy') }}" method="POST">
    @csrf
    @method('DELETE')
<div class="bg-white dark:bg-[#1a1a1a] border border-slate-200 dark:border-white/10 rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-[#0f0f0f] dark:bg-[#141414] border-b border-slate-200 dark:border-white/10 text-sm text-slate-600 dark:text-slate-300 dark:text-white uppercase tracking-wider">
                    <th class="w-10 px-6 py-4 font-semibold"><input type="checkbox" class="selectAllCheckbox rounded border-slate-300 dark:border-slate-600 text-blue-600 shadow-sm focus:ring-blue-500 dark:bg-slate-700"></th>
                    <th class="px-6 py-4 font-semibold w-24 text-center">Nomor</th>
                    <th class="px-6 py-4 font-semibold">Isi Misi Desa</th>
                    <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-white/10">
                @forelse($misis as $misi)
                <tr class="hover:bg-slate-50 dark:bg-[#0f0f0f] dark:bg-slate-800 dark:hover:bg-[#202020] transition-colors">
                    <td class="px-6 py-4">
                        <input type="checkbox" name="ids[]" value="{{ $misi->id }}" class="item-checkbox rounded border-slate-300 dark:border-slate-600 text-blue-600 shadow-sm focus:ring-blue-500 dark:bg-slate-700">
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex w-8 h-8 items-center justify-center bg-slate-100 dark:bg-white/10 text-slate-700 dark:text-slate-200 dark:text-white font-bold rounded-full border border-slate-200 dark:border-white/10">
                            {{ $misi->urutan }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-slate-700 dark:text-slate-200 dark:text-white leading-relaxed font-medium">{{ $misi->konten }}</p>
                    </td>
                    <td class="px-6 py-4 text-right whitespace-nowrap">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.misi.edit', $misi->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors">Edit</a>
                            
                            <form action="{{ route('admin.misi.destroy', $misi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus poin misi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold transition-colors">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-slate-100 dark:bg-white/10 rounded-full flex items-center justify-center text-slate-600 dark:text-slate-300 mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            </div>
                            <h3 class="font-bold text-slate-700 dark:text-slate-200 dark:text-white text-lg">Belum ada data misi</h3>
                            <p class="text-slate-500 dark:text-slate-300 dark:text-white mt-1 max-w-sm">Anda belum menambahkan poin-poin misi pembangunan desa.</p>
                            <a href="{{ route('admin.misi.create') }}" class="mt-4 text-green-700 font-semibold hover:underline">Tambah Misi Pertama</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</form>
@endsection
