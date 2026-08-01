@extends('layouts.admin')

@section('title', 'Kelola Perangkat Desa')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white">Struktur Organisasi</h1>
        <p class="text-slate-500 dark:text-slate-300 dark:text-white mt-1">Kelola data aparatur Pemerintah Desa.</p>
    </div>
    <div class="flex items-center gap-3">
        <button type="button" id="bulkDeleteBtn" disabled class="opacity-50 cursor-not-allowed inline-flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl font-semibold shadow-sm transition-all duration-200 hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            Hapus Terpilih
        </button>
        <a href="{{ route('admin.perangkat.create') }}" class="inline-flex items-center justify-center gap-2 bg-green-700 hover:bg-green-800 text-white px-5 py-2.5 rounded-xl font-semibold shadow-sm transition-all duration-200 hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Anggota
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

@php
    $pemdes = $perangkats->where('kategori', 'pemdes');
    $bpd = $perangkats->where('kategori', 'bpd');
@endphp

<form id="bulkDeleteForm" action="{{ route('admin.perangkat.bulk-destroy') }}" method="POST">
    @csrf
    @method('DELETE')
    <!-- Bar/Seksi PEMDES -->
    <div class="mb-4">
        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Pemerintah Desa (Pemdes)</h2>
    </div>
    <div class="mb-10">
        <div class="bg-white dark:bg-[#1a1a1a] border border-slate-200 dark:border-white/10 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-[#0f0f0f] dark:bg-[#141414] border-b border-slate-200 dark:border-white/10 text-sm text-slate-600 dark:text-slate-300 dark:text-white uppercase tracking-wider">
                            <th class="w-10 px-6 py-4 font-semibold"><input type="checkbox" class="selectAllCheckbox rounded border-slate-300 dark:border-slate-600 text-blue-600 shadow-sm focus:ring-blue-500 dark:bg-slate-700"></th>
                            <th class="px-6 py-4 font-semibold">Profil</th>
                            <th class="px-6 py-4 font-semibold">Nama & Jabatan</th>
                            <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-white/10">
                        @forelse($pemdes as $perangkat)
                        <tr class="hover:bg-slate-50 dark:bg-[#0f0f0f] dark:bg-slate-800 dark:hover:bg-[#202020] transition-colors">
                            <td class="px-6 py-4">
                                <input type="checkbox" name="ids[]" value="{{ $perangkat->id }}" class="item-checkbox rounded border-slate-300 dark:border-slate-600 text-blue-600 shadow-sm focus:ring-blue-500 dark:bg-slate-700">
                            </td>
                            <td class="px-6 py-4">
                                @if($perangkat->gambar)
                                    <img src="{{ asset('storage/' . $perangkat->gambar) }}" alt="{{ $perangkat->nama }}" class="w-12 h-12 rounded-full object-cover border border-slate-200 dark:border-white/10">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-white/10 border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-600 dark:text-slate-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900 dark:text-white">{{ $perangkat->nama }}</p>
                                <p class="text-sm text-slate-500 dark:text-slate-300 dark:text-white mt-0.5">{{ $perangkat->jabatan }}</p>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.perangkat.edit', $perangkat->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors">Edit</a>
                                    
                                    <form action="{{ route('admin.perangkat.destroy', $perangkat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aparatur ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-500 dark:text-slate-300 dark:text-white">
                                Belum ada data struktur Pemerintah Desa.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bar/Seksi BPD -->
    <div class="mb-4">
        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Badan Permusyawaratan Desa (BPD)</h2>
    </div>
    <div class="mb-8">
        <div class="bg-white dark:bg-[#1a1a1a] border border-slate-200 dark:border-white/10 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-[#0f0f0f] dark:bg-[#141414] border-b border-slate-200 dark:border-white/10 text-sm text-slate-600 dark:text-slate-300 dark:text-white uppercase tracking-wider">
                            <th class="w-10 px-6 py-4 font-semibold"><input type="checkbox" class="selectAllCheckbox rounded border-slate-300 dark:border-slate-600 text-blue-600 shadow-sm focus:ring-blue-500 dark:bg-slate-700"></th>
                            <th class="px-6 py-4 font-semibold">Profil</th>
                            <th class="px-6 py-4 font-semibold">Nama & Jabatan</th>
                            <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-white/10">
                        @forelse($bpd as $perangkat)
                        <tr class="hover:bg-slate-50 dark:bg-[#0f0f0f] dark:bg-slate-800 dark:hover:bg-[#202020] transition-colors">
                            <td class="px-6 py-4">
                                <input type="checkbox" name="ids[]" value="{{ $perangkat->id }}" class="item-checkbox rounded border-slate-300 dark:border-slate-600 text-blue-600 shadow-sm focus:ring-blue-500 dark:bg-slate-700">
                            </td>
                            <td class="px-6 py-4">
                                @if($perangkat->gambar)
                                    <img src="{{ asset('storage/' . $perangkat->gambar) }}" alt="{{ $perangkat->nama }}" class="w-12 h-12 rounded-full object-cover border border-slate-200 dark:border-white/10">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-white/10 border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-600 dark:text-slate-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900 dark:text-white">{{ $perangkat->nama }}</p>
                                <p class="text-sm text-slate-500 dark:text-slate-300 dark:text-white mt-0.5">{{ $perangkat->jabatan }}</p>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.perangkat.edit', $perangkat->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors">Edit</a>
                                    
                                    <form action="{{ route('admin.perangkat.destroy', $perangkat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aparatur ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-500 dark:text-slate-300 dark:text-white">
                                Belum ada data struktur BPD.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>
@endsection
