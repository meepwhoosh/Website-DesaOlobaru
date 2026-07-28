@extends('layouts.app')

@section('title', 'Hubungi Kami - Website Resmi Desa Olobaru')

@section('content')
<!-- Small Header Banner -->
<section data-aos="fade-in" class="relative py-16 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?q=80&w=1200&auto=format&fit=crop" 
             alt="Hubungi Olobaru" 
             class="w-full h-full object-cover object-center opacity-30" />
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-slate-900/80"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <span class="text-xs font-bold text-green-400 uppercase tracking-widest block mb-2">Hubungi Kami</span>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold tracking-tight">Kontak & Lokasi Kantor Desa</h1>
    </div>
</section>

<!-- Content Body -->
<section data-aos="fade-in" class="py-16 bg-slate-50/50 dark:bg-slate-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div data-aos="fade-up" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            
            <!-- Contact Info & Form (Left) -->
            <div class="lg:col-span-7 space-y-8 flex flex-col justify-between">
                
                <!-- Info cards row -->
                <div data-aos="fade-up" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Card 1: Telepon -->
                    <div data-aos="fade-up" class="bg-white dark:bg-[#1e293b] p-6 rounded-2xl border border-slate-100 dark:border-slate-700/50 shadow-sm flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-green-50 dark:bg-green-900/50 text-green-700 dark:text-green-400 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-slate-600 uppercase tracking-wider">Telepon & WA</h3>
                            <p class="text-sm font-semibold text-slate-800 dark:text-white mt-1">+62 822-xxxx-xxxx</p>
                        </div>
                    </div>

                    <!-- Card 2: Email -->
                    <div data-aos="fade-up" class="bg-white dark:bg-[#1e293b] p-6 rounded-2xl border border-slate-100 dark:border-slate-700/50 shadow-sm flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-green-50 dark:bg-green-900/50 text-green-700 dark:text-green-400 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-slate-600 uppercase tracking-wider">Surel Resmi</h3>
                            <p class="text-sm font-semibold text-slate-800 dark:text-white mt-1 break-all">info@desa-olobaru.id</p>
                        </div>
                    </div>
                </div>

                <!-- Form box -->
                <div data-aos="fade-up" class="bg-white dark:bg-[#1e293b] p-6 sm:p-8 rounded-3xl border border-slate-100 dark:border-slate-700/50 shadow-sm space-y-6">
                    <div class="space-y-1">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">Kirim Pesan Ke Kantor Desa</h2>
                        <p class="text-xs text-slate-600">Pertanyaan umum, penawaran kerjasama, atau konsultasi administrasi.</p>
                    </div>

                    <form action="{{ route('kontak.kirim') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl text-sm relative" role="alert">
                                <span class="block sm:inline font-semibold">{{ session('success') }}</span>
                            </div>
                        @endif

                        <div data-aos="fade-up" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-700 dark:text-white block" for="nama">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama_pengirim" required placeholder="Tulis nama Anda" value="{{ old('nama_pengirim') }}" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700/50 dark:text-white rounded-xl text-sm focus:outline-none focus:bg-white dark:bg-[#1e293b] dark:focus:bg-slate-800 focus:ring-2 focus:ring-green-600 focus:border-transparent transition-all">
                                @error('nama_pengirim') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-700 dark:text-white block" for="kontak">Email / HP Aktif</label>
                                <input type="text" id="kontak" name="email_hp" required placeholder="Alamat kontak" value="{{ old('email_hp') }}" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700/50 dark:text-white rounded-xl text-sm focus:outline-none focus:bg-white dark:bg-[#1e293b] dark:focus:bg-slate-800 focus:ring-2 focus:ring-green-600 focus:border-transparent transition-all">
                                @error('email_hp') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700 dark:text-white block" for="pesan">Pesan atau Pertanyaan</label>
                            <textarea id="pesan" name="isi_pesan" required rows="4" placeholder="Tuliskan pesan Anda..." class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700/50 dark:text-white rounded-xl text-sm focus:outline-none focus:bg-white dark:bg-[#1e293b] dark:focus:bg-slate-800 focus:ring-2 focus:ring-green-600 focus:border-transparent transition-all">{{ old('isi_pesan') }}</textarea>
                            @error('isi_pesan') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <!-- Google reCAPTCHA -->
                        <div class="space-y-1.5 flex flex-col items-center sm:items-start">
                            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                            @error('g-recaptcha-response') <p class="text-[10px] text-red-500 mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" class="w-full py-3 bg-green-900 hover:bg-green-850 text-white rounded-xl font-bold shadow-md transition-colors text-sm mt-4">
                            Kirim Pesan
                        </button>
                    </form>
                </div>

            </div>

            <!-- Map Column (Right) -->
            <div class="lg:col-span-5 bg-white dark:bg-[#1e293b] border border-slate-100 dark:border-slate-700/50 rounded-3xl shadow-sm p-4 flex flex-col justify-between min-h-[400px]">
                <div class="space-y-1.5 pb-3">
                    <h3 class="font-bold text-slate-900 dark:text-white text-sm">Peta Lokasi Kantor Desa</h3>
                    <p class="text-[11px] text-slate-450 dark:text-white">Kantor Kepala Desa Olobaru, Kec. Parigi Selatan, Sulawesi Tengah.</p>
                </div>
                
                <!-- Map Container Box -->
                <div id="map-container" class="flex-grow rounded-2xl overflow-hidden border border-slate-100 dark:border-slate-700/50 z-10 min-h-[300px]">
                    <!-- Map is loaded here dynamically via Leaflet -->
                </div>
            </div>

        </div>

    </div>
</section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Coordinates for Olobaru, Parigi Selatan, Parigi Moutong (Approx)
        const lat = -0.9231;
        const lng = 120.1983;

        // Initialize Leaflet Map
        const map = L.map('map-container').setView([lat, lng], 13);

        // Add OpenStreetMap Tile Layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add Marker
        const marker = L.marker([lat, lng]).addTo(map);
        marker.bindPopup("<b>Kantor Kepala Desa Olobaru</b><br>Parigi Selatan, Parigi Moutong.").openPopup();
    });
</script>
<!-- Google reCAPTCHA Script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
