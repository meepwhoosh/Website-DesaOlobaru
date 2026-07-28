@extends('layouts.admin')

@section('title', 'Pengaturan Global Website')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white">Pengaturan Global</h1>
    <p class="text-slate-500 dark:text-slate-300 dark:text-white mt-1">Kelola Visi Desa, Sambutan Kepala Desa, Informasi Geografis, dan Kontak/Sosial Media secara terpusat.</p>
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

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    
    <!-- 1. VISI DESA -->
    <div class="bg-white dark:bg-[#1a1a1a] rounded-2xl shadow-sm border border-slate-200 dark:border-white/10 p-6 sm:p-8">
        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            Visi Desa (Halaman Profil)
        </h2>
        <div class="space-y-2">
            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Teks Visi Desa</label>
            <textarea name="visi_desa" rows="3" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white" placeholder="Contoh: Melangkah bersama menuju perubahan...">{{ $settings['visi_desa'] ?? '' }}</textarea>
            <p class="text-xs text-slate-500">Misi desa dapat diatur di menu <strong>Profil Desa > Misi Desa</strong> di sebelah kiri.</p>
        </div>
    </div>

    <!-- 2. SAMBUTAN KEPALA DESA -->
    <div class="bg-white dark:bg-[#1a1a1a] rounded-2xl shadow-sm border border-slate-200 dark:border-white/10 p-6 sm:p-8">
        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
            Sambutan Kepala Desa (Halaman Beranda)
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Nama Kepala Desa</label>
                <input type="text" name="nama_kades" value="{{ $settings['nama_kades'] ?? '' }}" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white">
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Foto Kepala Desa</label>
                @if(isset($settings['foto_kades']) && $settings['foto_kades'] != '')
                    <div class="mb-2 w-16 h-16 rounded-lg overflow-hidden border border-slate-200">
                        <img src="{{ asset('storage/' . $settings['foto_kades']) }}" class="w-full h-full object-cover">
                    </div>
                @endif
                <input type="file" name="foto_kades" accept="image/*" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 text-sm dark:text-white">
                <p class="text-xs text-slate-500">Biarkan kosong jika tidak ingin mengubah foto.</p>
            </div>
        </div>
        <div class="space-y-2">
            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Teks Sambutan</label>
            <textarea name="sambutan_kades" rows="4" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white" placeholder="Contoh: Selamat datang di Website Resmi Desa Olobaru...">{{ $settings['sambutan_kades'] ?? '' }}</textarea>
        </div>
    </div>

    <!-- 3. DATA GEOGRAFIS DESA -->
    <div class="bg-white dark:bg-[#1a1a1a] rounded-2xl shadow-sm border border-slate-200 dark:border-white/10 p-6 sm:p-8">
        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Data Geografis (Halaman Profil)
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Luas Wilayah</label>
                <input type="text" name="luas_wilayah" value="{{ $settings['luas_wilayah'] ?? '' }}" placeholder="Contoh: ±3.013 Ha" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white">
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Ketinggian</label>
                <input type="text" name="ketinggian" value="{{ $settings['ketinggian'] ?? '' }}" placeholder="Contoh: 14 - 18 mdpl" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white">
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Jarak ke Kota</label>
                <input type="text" name="jarak_kota" value="{{ $settings['jarak_kota'] ?? '' }}" placeholder="Contoh: 6 Km" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white">
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Koordinat Peta</label>
                <input type="text" name="koordinat" value="{{ $settings['koordinat'] ?? '' }}" placeholder="Contoh: 120.128789 BT | -0.927364 LS" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white">
            </div>
        </div>
        <div class="space-y-2">
            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Teks Penjelasan Klimatologi & Lahan</label>
            <textarea name="teks_klimatologi" rows="3" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white" placeholder="Contoh: Desa Olobaru memiliki iklim tropis...">{{ $settings['teks_klimatologi'] ?? '' }}</textarea>
        </div>
    </div>

    <!-- 4. KONTAK & SOSIAL MEDIA -->
    <div class="bg-white dark:bg-[#1a1a1a] rounded-2xl shadow-sm border border-slate-200 dark:border-white/10 p-6 sm:p-8">
        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
            Kontak & Sosial Media (Footer & Hubungi Kami)
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Nomor Telepon / WhatsApp</label>
                <input type="text" name="no_hp" value="{{ $settings['no_hp'] ?? '' }}" placeholder="Contoh: 08123456789" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white">
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Email Resmi</label>
                <input type="email" name="email" value="{{ $settings['email'] ?? '' }}" placeholder="Contoh: pemdes@olobaru.desa.id" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white">
            </div>
            <div class="space-y-2 md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Alamat Kantor Desa</label>
                <textarea name="alamat_kantor" rows="2" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white" placeholder="Contoh: Jl. Trans Sulawesi, Desa Olobaru, Parigi">{{ $settings['alamat_kantor'] ?? '' }}</textarea>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Link Facebook</label>
                <input type="url" name="link_facebook" value="{{ $settings['link_facebook'] ?? '' }}" placeholder="https://facebook.com/..." class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white">
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Link Instagram</label>
                <input type="url" name="link_instagram" value="{{ $settings['link_instagram'] ?? '' }}" placeholder="https://instagram.com/..." class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white">
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Link YouTube</label>
                <input type="url" name="link_youtube" value="{{ $settings['link_youtube'] ?? '' }}" placeholder="https://youtube.com/..." class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white">
            </div>
        </div>
    </div>
    
    <!-- 5. MENGENAL DESA (BERANDA) -->
    <div class="bg-white dark:bg-[#1a1a1a] rounded-2xl shadow-sm border border-slate-200 dark:border-white/10 p-6 sm:p-8">
        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Mengenal Desa Olobaru (Halaman Beranda)
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Judul Bagian</label>
                <input type="text" name="mengenal_desa_judul" value="{{ $settings['mengenal_desa_judul'] ?? '' }}" placeholder="Contoh: Membangun Desa Olobaru..." class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white">
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Foto Mengenal Desa</label>
                @if(isset($settings['mengenal_desa_foto']) && $settings['mengenal_desa_foto'] != '')
                    <div class="mb-2 w-24 h-16 rounded-lg overflow-hidden border border-slate-200">
                        <img src="{{ asset('storage/' . $settings['mengenal_desa_foto']) }}" class="w-full h-full object-cover">
                    </div>
                @endif
                <input type="file" name="mengenal_desa_foto" accept="image/*" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 text-sm dark:text-white">
                <p class="text-xs text-slate-500">Pilih gambar bangunan atau kegiatan desa.</p>
            </div>
            <div class="space-y-2 md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Paragraf 1</label>
                <textarea name="mengenal_desa_teks1" rows="3" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white" placeholder="Paragraf penjelasan pertama...">{{ $settings['mengenal_desa_teks1'] ?? '' }}</textarea>
            </div>
            <div class="space-y-2 md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Paragraf 2</label>
                <textarea name="mengenal_desa_teks2" rows="3" class="w-full bg-slate-50 dark:bg-[#0f0f0f] border border-slate-200 dark:border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 dark:text-white" placeholder="Paragraf penjelasan kedua (opsional)...">{{ $settings['mengenal_desa_teks2'] ?? '' }}</textarea>
            </div>
        </div>
    </div>
    
    <div class="flex justify-end pt-4">
        <button type="submit" class="px-8 py-3 rounded-xl bg-green-700 text-white font-bold hover:bg-green-800 transition-colors shadow-sm text-lg flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            Simpan Semua Pengaturan
        </button>
    </div>
</form>

@endsection
