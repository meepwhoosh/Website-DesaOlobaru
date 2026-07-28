@extends('layouts.admin')

@section('title', 'Tambah Riwayat Kades')

@section('content')
<div class="mb-8">
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.mantankades.index') }}" class="w-10 h-10 bg-white dark:bg-[#1a1a1a] rounded-full flex items-center justify-center text-slate-500 hover:text-green-700 hover:bg-green-50 shadow-sm transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Tambah Riwayat</h1>
            <p class="text-slate-500 dark:text-slate-300 dark:text-white text-sm mt-1">Tambahkan data mantan Kepala Desa baru.</p>
        </div>
    </div>
</div>

<div class="bg-white dark:bg-[#1a1a1a] rounded-2xl shadow-sm border border-slate-200 dark:border-white/10 p-6 sm:p-8 max-w-3xl">
    <form action="{{ route('admin.mantankades.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="nama" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white" required>
                @error('nama') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
            
            <div class="space-y-2">
                <label for="masa_jabatan" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Masa Jabatan</label>
                <input type="text" name="masa_jabatan" id="masa_jabatan" value="{{ old('masa_jabatan') }}" placeholder="Contoh: Tahun 1966 s/d 1971" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white" required>
                @error('masa_jabatan') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="status" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Status (Opsional)</label>
                <input type="text" name="status" id="status" value="{{ old('status') }}" placeholder="Contoh: Pejabat Sementara" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white">
                @error('status') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
            
            <div class="space-y-2">
                <label for="urutan" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Urutan (Angka)</label>
                <input type="number" name="urutan" id="urutan" value="{{ old('urutan') }}" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white" required>
                @error('urutan') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-span-1 sm:col-span-2">
            <x-admin.image-upload name="foto" label="Foto Profil (Opsional)" helper="Format: JPG, PNG, JPEG. Maksimal 1MB." />
        </div>
        
        <div class="pt-4 border-t border-slate-100 dark:border-white/10 flex justify-end gap-3 col-span-1 sm:col-span-2">
            <a href="{{ route('admin.mantankades.index') }}" class="px-5 py-2.5 rounded-xl text-slate-600 dark:text-slate-300 font-semibold hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">Batal</a>
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-green-700 text-white font-semibold hover:bg-green-800 transition-colors shadow-sm">Simpan Riwayat</button>
        </div>
    </form>
</div>
@endsection
