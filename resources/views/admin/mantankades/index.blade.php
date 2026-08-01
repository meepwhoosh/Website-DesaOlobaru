@extends('layouts.admin')

@section('title', 'Kelola Riwayat Kepala Desa')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white">Riwayat Kepala Desa</h1>
        <p class="text-slate-500 dark:text-slate-300 dark:text-white mt-1">Kelola data mantan Kepala Desa Olobaru.</p>
    </div>
    <div class="flex items-center gap-3">
        <button type="button" id="bulkDeleteBtn" disabled class="opacity-50 cursor-not-allowed inline-flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl font-semibold shadow-sm transition-all duration-200 hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            Hapus Terpilih
        </button>
        <a href="{{ route('admin.mantankades.create') }}" class="inline-flex items-center justify-center gap-2 bg-green-700 hover:bg-green-800 text-white px-5 py-2.5 rounded-xl font-semibold shadow-sm transition-all duration-200 hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Riwayat
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

<form id="bulkDeleteForm" action="{{ route('admin.mantankades.bulk-destroy') }}" method="POST">
    @csrf
    @method('DELETE')
<div class="bg-white dark:bg-[#1a1a1a] border border-slate-200 dark:border-white/10 rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-[#0f0f0f] dark:bg-[#141414] border-b border-slate-200 dark:border-white/10 text-sm text-slate-600 dark:text-slate-300 dark:text-white uppercase tracking-wider">
                    <th class="w-10 px-6 py-4 font-semibold"><input type="checkbox" class="selectAllCheckbox rounded border-slate-300 dark:border-slate-600 text-blue-600 shadow-sm focus:ring-blue-500 dark:bg-slate-700"></th>
                    <th class="px-6 py-4 font-semibold w-24">Urutan</th>
                    <th class="px-6 py-4 font-semibold w-16">Foto</th>
                    <th class="px-6 py-4 font-semibold">Nama & Jabatan</th>
                    <th class="px-6 py-4 font-semibold">Status</th>
                    <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-white/10">
                @forelse($kades as $k)
                <tr class="hover:bg-slate-50 dark:bg-[#0f0f0f] dark:bg-slate-800 dark:hover:bg-[#202020] transition-colors">
                    <td class="px-6 py-4">
                        <input type="checkbox" name="ids[]" value="{{ $k->id }}" class="item-checkbox rounded border-slate-300 dark:border-slate-600 text-blue-600 shadow-sm focus:ring-blue-500 dark:bg-slate-700">
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-block px-3 py-1 bg-green-50 text-green-700 font-bold rounded-lg text-sm border border-green-100">
                            {{ $k->urutan }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700">
                            @if($k->foto)
                                <img src="{{ asset('storage/' . $k->foto) }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-full h-full text-slate-300 p-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <p class="font-bold text-slate-900 dark:text-white">{{ $k->nama }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-300 dark:text-white mt-0.5">{{ $k->masa_jabatan }}</p>
                    </td>
                    <td class="px-6 py-4">
                        @if($k->status)
                            <span class="inline-block px-2 py-1 bg-amber-50 text-amber-700 text-[10px] font-bold rounded-md uppercase tracking-wider">{{ $k->status }}</span>
                        @else
                            <span class="text-xs text-slate-400 italic">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right whitespace-nowrap">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.mantankades.edit', $k->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors">Edit</a>
                            
                            <form action="{{ route('admin.mantankades.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mantan kades ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold transition-colors">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-slate-100 dark:bg-white/10 rounded-full flex items-center justify-center text-slate-600 dark:text-slate-300 mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <h3 class="font-bold text-slate-700 dark:text-slate-200 dark:text-white text-lg">Belum ada data</h3>
                            <p class="text-slate-500 dark:text-slate-300 dark:text-white mt-1 max-w-sm">Anda belum menambahkan riwayat Kepala Desa.</p>
                            <a href="{{ route('admin.mantankades.create') }}" class="mt-4 text-green-700 font-semibold hover:underline">Tambah Sekarang</a>
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
