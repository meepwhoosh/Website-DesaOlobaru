@extends('layouts.admin')

@section('title', 'Kelola Sejarah Desa')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900">Sejarah Desa</h1>
        <p class="text-slate-500 mt-1">Kelola data rekam jejak, asal-usul, dan peristiwa penting desa.</p>
    </div>
    <a href="{{ route('admin.sejarah.create') }}" class="inline-flex items-center justify-center gap-2 bg-green-700 hover:bg-green-800 text-white px-5 py-2.5 rounded-xl font-semibold shadow-sm transition-all duration-200 hover:-translate-y-0.5">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Riwayat
    </a>
</div>

@if(session('success'))
<div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-100 flex items-start gap-3">
    <div class="text-green-600 mt-0.5">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    </div>
    <div>
        <h4 class="text-sm font-semibold text-green-800">Berhasil!</h4>
        <p class="text-sm text-green-700">{{ session('success') }}</p>
    </div>
</div>
@endif

<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-sm text-slate-600 uppercase tracking-wider">
                    <th class="px-6 py-4 font-semibold w-24">Tahun</th>
                    <th class="px-6 py-4 font-semibold w-1/3">Judul Peristiwa</th>
                    <th class="px-6 py-4 font-semibold">Uraian Sejarah</th>
                    <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($sejarahs as $sejarah)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <span class="inline-block px-3 py-1 bg-amber-50 text-amber-700 font-bold rounded-lg text-sm border border-amber-100">
                            {{ $sejarah->tahun }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <p class="font-bold text-slate-900">{{ $sejarah->judul }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">{{ $sejarah->konten }}</p>
                    </td>
                    <td class="px-6 py-4 text-right whitespace-nowrap">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.sejarah.edit', $sejarah->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors">Edit</a>
                            
                            <form action="{{ route('admin.sejarah.destroy', $sejarah->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data sejarah ini?');">
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
                            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="font-bold text-slate-700 text-lg">Belum ada riwayat sejarah</h3>
                            <p class="text-slate-500 mt-1 max-w-sm">Anda belum menambahkan garis waktu (timeline) sejarah desa.</p>
                            <a href="{{ route('admin.sejarah.create') }}" class="mt-4 text-green-700 font-semibold hover:underline">Tambah Sejarah Pertama</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
