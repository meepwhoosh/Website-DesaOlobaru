@extends('layouts.admin')

@section('title', 'Tambah Perangkat Desa')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white">Tambah Anggota Baru</h1>
        <p class="text-slate-500 dark:text-slate-300 mt-1">Masukkan data aparatur desa atau anggota BPD.</p>
    </div>
    <a href="{{ route('admin.perangkat.index') }}" class="text-slate-500 dark:text-slate-300 hover:text-slate-700 dark:text-slate-200 font-medium text-sm flex items-center gap-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
</div>

<div class="bg-white dark:bg-[#1a1a1a] border border-slate-200 dark:border-white/5 rounded-2xl shadow-sm overflow-hidden max-w-2xl">
    <form action="{{ route('admin.perangkat.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
        @csrf

        <div class="space-y-6">
            <!-- Nama -->
            <div>
                <label for="nama" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-white/10 focus:border-green-600 dark:focus:border-green-500 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700 dark:text-slate-200 dark:text-white bg-white dark:bg-[#0f0f0f]"
                    placeholder="Contoh: Budi Santoso, S.Pd">
                @error('nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Jabatan -->
                <div>
                    <label for="jabatan" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Jabatan <span class="text-red-500">*</span></label>
                    <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan') }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-white/10 focus:border-green-600 dark:focus:border-green-500 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700 dark:text-slate-200 dark:text-white bg-white dark:bg-[#0f0f0f]"
                        placeholder="Contoh: Kepala Desa">
                    @error('jabatan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label for="kategori" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Kelompok (Kategori) <span class="text-red-500">*</span></label>
                    <select name="kategori" id="kategori" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-white/10 focus:border-green-600 dark:focus:border-green-500 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700 dark:text-slate-200 dark:text-white bg-white dark:bg-[#0f0f0f]">
                        <option value="" disabled selected>Pilih kelompok...</option>
                        <option value="pemdes" {{ old('kategori') == 'pemdes' ? 'selected' : '' }}>Pemerintah Desa (Pemdes)</option>
                        <option value="bpd" {{ old('kategori') == 'bpd' ? 'selected' : '' }}>Badan Permusyawaratan Desa (BPD)</option>
                    </select>
                    @error('kategori') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>



            <!-- Gambar / Foto -->
            <x-admin.image-upload name="gambar" label="Foto Profil" helper="Format: JPG, PNG. Pastikan foto formal/wajah terlihat jelas. (Opsional)" />

            <!-- Tombol Simpan -->
            <div class="pt-4 border-t border-slate-100 dark:border-white/5 flex justify-end">
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-8 py-3 rounded-xl font-semibold shadow-sm transition-all duration-200 hover:-translate-y-0.5">
                    Simpan Data
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
