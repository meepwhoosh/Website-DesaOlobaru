@extends('layouts.admin')

@section('title', 'Tambah Data Desa')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white">Tambah Data Penduduk</h1>
        <p class="text-slate-500 dark:text-slate-300 dark:text-white mt-1">Masukkan data penduduk secara manual.</p>
    </div>
    <a href="{{ route('admin.data-desa.index') }}" class="text-slate-500 dark:text-slate-300 dark:text-white hover:text-slate-700 dark:text-slate-200 font-medium text-sm flex items-center gap-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
</div>

<div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm overflow-hidden max-w-3xl">
    <form action="{{ route('admin.data-desa.store') }}" method="POST" class="p-6 md:p-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- NIK -->
            <div>
                <label for="nik" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">NIK / No. KTP</label>
                <input type="text" name="nik" id="nik" value="{{ old('nik') }}"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700 dark:text-slate-200 dark:bg-slate-800 dark:text-white dark:border-slate-700"
                    placeholder="Masukkan NIK">
                @error('nik') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Nama Lengkap -->
            <div>
                <label for="nama_lengkap" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700 dark:text-slate-200 dark:bg-slate-800 dark:text-white dark:border-slate-700"
                    placeholder="Nama Lengkap">
                @error('nama_lengkap') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Jenis Kelamin -->
            <div>
                <label for="jenis_kelamin" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Jenis Kelamin <span class="text-red-500">*</span></label>
                <select name="jenis_kelamin" id="jenis_kelamin" required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-900">
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Tempat Tanggal Lahir -->
            <div>
                <label for="tempat_tanggal_lahir" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Tempat, Tanggal Lahir</label>
                <input type="text" name="tempat_tanggal_lahir" id="tempat_tanggal_lahir" value="{{ old('tempat_tanggal_lahir') }}"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700 dark:text-slate-200 dark:bg-slate-800 dark:text-white dark:border-slate-700"
                    placeholder="Contoh: Parigi, 17 Agustus 1990">
                @error('tempat_tanggal_lahir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Pendidikan -->
            <div>
                <label for="pendidikan" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Pendidikan Terakhir</label>
                <input type="text" name="pendidikan" id="pendidikan" value="{{ old('pendidikan') }}"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700 dark:text-slate-200 dark:bg-slate-800 dark:text-white dark:border-slate-700"
                    placeholder="Contoh: SMA / S1">
                @error('pendidikan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Pekerjaan -->
            <div>
                <label for="pekerjaan" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Pekerjaan</label>
                <input type="text" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700 dark:text-slate-200 dark:bg-slate-800 dark:text-white dark:border-slate-700"
                    placeholder="Contoh: Petani / PNS / Wiraswasta">
                @error('pekerjaan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Dusun -->
            <div class="md:col-span-2">
                <label for="dusun" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">Dusun / Alamat</label>
                <input type="text" name="dusun" id="dusun" value="{{ old('dusun') }}"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700 dark:text-slate-200 dark:bg-slate-800 dark:text-white dark:border-slate-700"
                    placeholder="Contoh: Dusun 1">
                @error('dusun') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- RT -->
            <div>
                <label for="rt" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">RT</label>
                <input type="text" name="rt" id="rt" value="{{ old('rt') }}"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700 dark:text-slate-200 dark:bg-slate-800 dark:text-white dark:border-slate-700"
                    placeholder="Contoh: 001">
                @error('rt') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- RW -->
            <div>
                <label for="rw" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1.5">RW</label>
                <input type="text" name="rw" id="rw" value="{{ old('rw') }}"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700 dark:text-slate-200 dark:bg-slate-800 dark:text-white dark:border-slate-700"
                    placeholder="Contoh: 002">
                @error('rw') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="pt-6 mt-6 border-t border-slate-100 dark:border-slate-700 flex justify-end">
            <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-8 py-3 rounded-xl font-semibold shadow-sm transition-all duration-200 hover:-translate-y-0.5">
                Simpan Data
            </button>
        </div>
    </form>
</div>
@endsection
