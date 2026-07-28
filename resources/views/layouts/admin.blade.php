<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Desa Olobaru</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-square.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-serif { font-family: 'Merriweather', serif !important; }
    </style>
    <!-- Dark Mode Init Script -->
    <script>
        if (localStorage.getItem('admin-color-theme') === 'dark' || (!('admin-color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-[#F8F9FA] dark:bg-[#0f0f0f] min-h-screen font-sans antialiased text-slate-900 dark:text-white flex">
    
    <!-- Sidebar -->
    <aside class="w-72 bg-white dark:bg-[#1a1a1a] border-r border-slate-200 dark:border-white/5 min-h-screen hidden md:flex flex-col flex-shrink-0 sticky top-0 h-screen overflow-y-auto transition-all duration-300">
        <!-- Logo Area -->
        <div class="h-20 flex items-center px-8 border-b border-slate-100 dark:border-white/5">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 flex items-center justify-center shrink-0">
                    <img src="{{ asset('images/logo-parigi.png') }}" alt="Logo Parigi Selatan" class="w-full h-full object-contain drop-shadow-sm">
                </div>
                <div>
                    <h2 class="font-bold text-lg text-slate-900 dark:text-white leading-tight">Admin Portal</h2>
                </div>
            </div>
        </div>
        
        <nav class="p-4 space-y-6 flex-1">
            <!-- Platform -->
            <div>
                <p class="text-xs font-semibold text-slate-400 dark:text-white mb-3 px-4 uppercase tracking-wider">Platform</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-100 dark:bg-white/10 text-slate-900 dark:text-white font-semibold shadow-sm' : 'text-slate-500 dark:text-white hover:text-slate-900 dark:text-white dark:hover:text-white hover:bg-slate-50 dark:bg-slate-900/50 dark:hover:bg-white/5' }}">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('admin.berita.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('admin.berita.*') ? 'bg-slate-100 dark:bg-white/10 text-slate-900 dark:text-white font-semibold shadow-sm' : 'text-slate-500 dark:text-white hover:text-slate-900 dark:text-white dark:hover:text-white hover:bg-slate-50 dark:bg-slate-900/50 dark:hover:bg-white/5' }}">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        Kelola Berita
                    </a>

                    <a href="{{ route('admin.perangkat.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('admin.perangkat.*') ? 'bg-slate-100 dark:bg-white/10 text-slate-900 dark:text-white font-semibold shadow-sm' : 'text-slate-500 dark:text-white hover:text-slate-900 dark:text-white dark:hover:text-white hover:bg-slate-50 dark:bg-slate-900/50 dark:hover:bg-white/5' }}">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Perangkat Desa
                    </a>
                    


                    <a href="{{ route('admin.galeri.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('admin.galeri.*') ? 'bg-slate-100 dark:bg-white/10 text-slate-900 dark:text-white font-semibold shadow-sm' : 'text-slate-500 dark:text-white hover:text-slate-900 dark:text-white dark:hover:text-white hover:bg-slate-50 dark:bg-slate-900/50 dark:hover:bg-white/5' }}">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Galeri Desa
                    </a>
                    <a href="{{ route('admin.data-desa.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('admin.data-desa.*') ? 'bg-slate-100 dark:bg-white/10 text-slate-900 dark:text-white font-semibold shadow-sm' : 'text-slate-500 dark:text-white hover:text-slate-900 dark:text-white dark:hover:text-white hover:bg-slate-50 dark:bg-slate-900/50 dark:hover:bg-white/5' }}">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Data Penduduk
                    </a>
                    <a href="{{ route('admin.apbdes.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('admin.apbdes.*') ? 'bg-slate-100 dark:bg-white/10 text-slate-900 dark:text-white font-semibold shadow-sm' : 'text-slate-500 dark:text-white hover:text-slate-900 dark:text-white dark:hover:text-white hover:bg-slate-50 dark:bg-slate-900/50 dark:hover:bg-white/5' }}">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Kelola APBDes
                    </a>
                    <a href="{{ route('admin.pesan.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('admin.pesan.*') ? 'bg-slate-100 dark:bg-white/10 text-slate-900 dark:text-white font-semibold shadow-sm' : 'text-slate-500 dark:text-white hover:text-slate-900 dark:text-white dark:hover:text-white hover:bg-slate-50 dark:bg-slate-900/50 dark:hover:bg-white/5' }}">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Pesan Masuk
                        @php
                            $unreadCount = \App\Models\Pesan::where('status', 'Belum Dibaca')->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="ml-auto bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $unreadCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.pengunjung.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('admin.pengunjung.*') ? 'bg-slate-100 dark:bg-white/10 text-slate-900 dark:text-white font-semibold shadow-sm' : 'text-slate-500 dark:text-white hover:text-slate-900 dark:text-white dark:hover:text-white hover:bg-slate-50 dark:bg-slate-900/50 dark:hover:bg-white/5' }}">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        Riwayat Pengunjung
                    </a>
                </div>
            </div>

            <!-- Profil Desa -->
            <div>
                <p class="text-xs font-semibold text-slate-400 dark:text-white mb-3 px-4 uppercase tracking-wider">Profil Desa</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.sejarah.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('admin.sejarah.*') ? 'bg-slate-100 dark:bg-white/10 text-slate-900 dark:text-white font-semibold shadow-sm' : 'text-slate-500 dark:text-white hover:text-slate-900 dark:text-white dark:hover:text-white hover:bg-slate-50 dark:bg-slate-900/50 dark:hover:bg-white/5' }}">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Sejarah Desa
                    </a>
                    <a href="{{ route('admin.misi.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('admin.misi.*') ? 'bg-slate-100 dark:bg-white/10 text-slate-900 dark:text-white font-semibold shadow-sm' : 'text-slate-500 dark:text-white hover:text-slate-900 dark:text-white dark:hover:text-white hover:bg-slate-50 dark:bg-slate-900/50 dark:hover:bg-white/5' }}">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        Misi Desa
                    </a>
                    <a href="{{ route('admin.mantankades.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 hover:translate-x-1 {{ request()->routeIs('admin.mantankades.*') ? 'bg-slate-100 dark:bg-white/10 text-slate-900 dark:text-white font-semibold shadow-sm' : 'text-slate-500 dark:text-white hover:text-slate-900 dark:text-white dark:hover:text-white hover:bg-slate-50 dark:bg-slate-900/50 dark:hover:bg-white/5' }}">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Riwayat Kades
                    </a>
                </div>
            </div>


        </nav>
        
        <div class="p-4 mt-auto">
            <div class="bg-slate-50 dark:bg-[#0f0f0f] rounded-2xl p-4 flex items-center justify-between border border-slate-100 dark:border-white/5">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/50 flex items-center justify-center text-green-700 dark:text-green-300 font-bold text-sm">
                        AD
                    </div>
                    <span class="text-sm font-semibold text-slate-900 dark:text-white">Admin Olobaru</span>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-slate-600 hover:text-red-500 transition-colors p-1" title="Logout">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 bg-slate-50 dark:bg-[#0f0f0f]">
        
        <!-- Topbar -->
        <header class="h-20 bg-white dark:bg-[#1a1a1a] border-b border-slate-200 dark:border-white/5 px-6 sm:px-8 flex items-center justify-between sticky top-0 z-20">
            <!-- Mobile Menu Toggle -->
            <div class="md:hidden flex items-center gap-4">
                <div class="w-8 h-8 flex items-center justify-center shrink-0">
                    <img src="{{ asset('images/logo-parigi.png') }}" alt="Logo Parigi Selatan" class="w-full h-full object-contain drop-shadow-sm">
                </div>
                <span class="font-bold text-slate-900 dark:text-white text-lg font-serif">Admin</span>
            </div>

            <!-- Desktop Breadcrumb or Title Area -->
            <div class="hidden md:flex items-center gap-3 text-sm">
                <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 dark:bg-white/5 text-slate-500 dark:text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-slate-500 dark:text-white font-medium">Dashboard</span>
                <span class="text-slate-300 dark:text-slate-200 dark:text-white">/</span>
                <span class="text-slate-900 dark:text-white font-bold font-serif tracking-tight">@yield('title', 'Overview')</span>
            </div>

            <!-- Profile & Actions -->
            <div class="flex items-center gap-4 ml-auto">
                <!-- Theme Toggle Button -->
                <button id="admin-theme-toggle" class="w-9 h-9 flex items-center justify-center rounded-lg bg-slate-100 dark:bg-white/5 text-slate-500 dark:text-white hover:bg-slate-200 dark:hover:bg-white/10 transition-colors focus:outline-none">
                    <!-- Dark mode icon -->
                    <svg id="admin-theme-toggle-dark-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    <!-- Light mode icon -->
                    <svg id="admin-theme-toggle-light-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </button>

                <form action="{{ route('admin.logout') }}" method="POST" class="md:hidden">
                    @csrf
                    <button type="submit" class="text-sm font-bold text-slate-900 dark:text-white bg-slate-100 dark:bg-white/5 px-4 py-2 rounded-lg">Logout</button>
                </form>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 p-6 sm:p-8 lg:p-10 max-w-7xl w-full mx-auto animate-fade-in-up">
            @yield('content')
        </main>
    </div>

    <!-- Theme Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggleBtn = document.getElementById('admin-theme-toggle');
            const darkIcon = document.getElementById('admin-theme-toggle-dark-icon');
            const lightIcon = document.getElementById('admin-theme-toggle-light-icon');

            if (document.documentElement.classList.contains('dark')) {
                lightIcon.classList.remove('hidden');
            } else {
                darkIcon.classList.remove('hidden');
            }

            themeToggleBtn.addEventListener('click', function() {
                darkIcon.classList.toggle('hidden');
                lightIcon.classList.toggle('hidden');

                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('admin-color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('admin-color-theme', 'dark');
                }
            });
        });
    </script>

    <!-- SweetAlert2 for Modern Confirmations -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('form[onsubmit*="return confirm"]');
            deleteForms.forEach(form => {
                const match = form.getAttribute('onsubmit').match(/confirm\(['"]([^'"]+)['"]\)/);
                const message = match ? match[1] : 'Apakah Anda yakin ingin menghapus data ini?';
                
                form.removeAttribute('onsubmit');
                
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        text: message,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444', 
                        cancelButtonColor: '#64748b',  
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#ffffff',
                        color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#0f172a',
                        customClass: {
                            popup: 'rounded-2xl border dark:border-slate-700/50',
                            confirmButton: 'px-5 py-2.5 rounded-xl font-bold',
                            cancelButton: 'px-5 py-2.5 rounded-xl font-bold'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    <!-- Modals Stack -->
    @stack('modals')

</body>
</html>
