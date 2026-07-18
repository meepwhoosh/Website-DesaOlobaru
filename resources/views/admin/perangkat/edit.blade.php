@extends('layouts.admin')

@section('title', 'Edit Perangkat Desa')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900">Edit Data Anggota</h1>
        <p class="text-slate-500 mt-1">Lakukan perubahan pada data aparatur desa ini.</p>
    </div>
    <a href="{{ route('admin.perangkat.index') }}" class="text-slate-500 hover:text-slate-700 font-medium text-sm flex items-center gap-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Batal
    </a>
</div>

<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden max-w-2xl">
    <form action="{{ route('admin.perangkat.update', $perangkat->id) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <!-- Nama -->
            <div>
                <label for="nama" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $perangkat->nama) }}" required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700">
                @error('nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Jabatan -->
                <div>
                    <label for="jabatan" class="block text-sm font-semibold text-slate-700 mb-1.5">Jabatan <span class="text-red-500">*</span></label>
                    <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $perangkat->jabatan) }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700">
                    @error('jabatan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label for="kategori" class="block text-sm font-semibold text-slate-700 mb-1.5">Kelompok (Kategori) <span class="text-red-500">*</span></label>
                    <select name="kategori" id="kategori" required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700 bg-white">
                        <option value="pemdes" {{ (old('kategori') ?? $perangkat->kategori) == 'pemdes' ? 'selected' : '' }}>Pemerintah Desa (Pemdes)</option>
                        <option value="bpd" {{ (old('kategori') ?? $perangkat->kategori) == 'bpd' ? 'selected' : '' }}>Badan Permusyawaratan Desa (BPD)</option>
                    </select>
                    @error('kategori') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>



            <!-- Gambar / Foto -->
            <x-admin.image-upload name="gambar" label="Ganti Foto Profil" helper="Biarkan kosong jika tidak ingin mengubah foto." :currentImage="$perangkat->gambar" />

            <!-- Tombol Simpan -->
            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-semibold shadow-sm transition-all duration-200 hover:-translate-y-0.5">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
