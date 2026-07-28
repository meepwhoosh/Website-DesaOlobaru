@extends('layouts.admin')

@section('title', 'Kelola UMKM & Produk Desa')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white">Produk UMKM</h1>
        <p class="text-slate-500 dark:text-slate-300 dark:text-white mt-1">Kelola data produk unggulan warga untuk Pasar Desa.</p>
    </div>
    <a href="{{ route('admin.umkm.create') }}" class="inline-flex items-center justify-center gap-2 bg-green-700 hover:bg-green-800 text-white px-5 py-2.5 rounded-xl font-semibold shadow-sm transition-all duration-200 hover:-translate-y-0.5">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Produk
    </a>
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

<div class="bg-white dark:bg-[#1a1a1a] border border-slate-200 dark:border-white/10 rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-[#0f0f0f] dark:bg-[#141414] border-b border-slate-200 dark:border-white/10 text-sm text-slate-600 dark:text-slate-300 dark:text-white uppercase tracking-wider">
                    <th class="px-6 py-4 font-semibold">Produk</th>
                    <th class="px-6 py-4 font-semibold">Toko & Kategori</th>
                    <th class="px-6 py-4 font-semibold">Harga</th>
                    <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-white/10">
                @forelse($umkms as $umkm)
                <tr class="hover:bg-slate-50 dark:bg-[#0f0f0f] dark:bg-slate-800 dark:hover:bg-[#202020] transition-colors">
                    <td class="px-6 py-4 flex items-center gap-4">
                        @if($umkm->gambar)
                            <img src="{{ asset('storage/' . $umkm->gambar) }}" alt="{{ $umkm->nama_produk }}" class="w-14 h-14 rounded-lg object-cover border border-slate-200 dark:border-white/10">
                        @else
                            <div class="w-14 h-14 rounded-lg bg-slate-100 dark:bg-white/10 border border-slate-200 dark:border-white/10 flex items-center justify-center text-slate-600 dark:text-slate-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <div>
                            <p class="font-bold text-slate-900 dark:text-white">{{ $umkm->nama_produk }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-300 dark:text-white line-clamp-1 max-w-[200px]">{{ $umkm->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <p class="font-bold text-slate-900 dark:text-white">{{ $umkm->nama_penjual }}</p>
                        <span class="inline-block mt-1 px-2.5 py-0.5 bg-green-50 dark:bg-green-900/30 text-green-700 font-semibold rounded-full text-[10px] uppercase tracking-wide border border-green-100">
                            {{ $umkm->kategori }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <p class="font-bold text-green-800">Rp {{ number_format($umkm->harga, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-300 dark:text-white">{{ $umkm->unit }}</p>
                    </td>
                    <td class="px-6 py-4 text-right whitespace-nowrap">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.umkm.edit', $umkm->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors">Edit</a>
                            
                            <form action="{{ route('admin.umkm.destroy', $umkm->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
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
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <h3 class="font-bold text-slate-700 dark:text-slate-200 dark:text-white text-lg">Belum ada data UMKM</h3>
                            <p class="text-slate-500 dark:text-slate-300 dark:text-white mt-1 max-w-sm">Anda belum menambahkan produk jualan warga desa.</p>
                            <a href="{{ route('admin.umkm.create') }}" class="mt-4 text-green-700 font-semibold hover:underline">Tambah Produk Pertama</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
