<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Desa Olobaru</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-serif { font-family: 'Merriweather', serif !important; }
    </style>
</head>
<body class="bg-[#F8F9FA] min-h-screen font-sans antialiased text-[#333333] flex">
    
    <!-- Sidebar -->
    <aside class="w-72 bg-[#2D5A27] text-white border-r-0 min-h-screen hidden md:flex flex-col flex-shrink-0 sticky top-0 h-screen overflow-y-auto shadow-2xl shadow-[#2D5A27]/20 z-30 transition-all duration-300">
        <!-- Logo Area -->
        <div class="h-20 flex items-center px-8 border-b border-white/10 relative overflow-hidden">
            <!-- Decorative circle -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
            <div class="flex items-center gap-3 relative z-10">
                <div class="w-10 h-10 rounded-xl bg-[#D4A373] border border-white/20 flex items-center justify-center font-bold text-[#333333] shadow-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div>
                    <h2 class="font-bold text-lg text-white leading-tight font-serif tracking-tight drop-shadow-sm">Admin Portal</h2>
                    <span class="text-[11px] font-semibold text-[#D4A373] uppercase tracking-widest">Desa Olobaru</span>
                </div>
            </div>
        </div>
        
        <nav class="p-6 space-y-8 flex-1 relative z-10">
            <!-- Menu Utama -->
            <div>
                <p class="text-xs font-bold text-[#D4A373] uppercase tracking-widest mb-4 px-3">Menu Utama</p>
                <div class="space-y-1.5">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-[#D4A373] text-[#333333] font-bold shadow-lg' : 'text-white/80 hover:bg-[#D4A373]/20 hover:text-white hover:translate-x-1' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-[#333333]' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('admin.berita.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.berita.*') ? 'bg-[#D4A373] text-[#333333] font-bold shadow-lg' : 'text-white/80 hover:bg-[#D4A373]/20 hover:text-white hover:translate-x-1' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.berita.*') ? 'text-[#333333]' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        Kelola Berita
                    </a>

                    <a href="{{ route('admin.perangkat.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.perangkat.*') ? 'bg-[#D4A373] text-[#333333] font-bold shadow-lg' : 'text-white/80 hover:bg-[#D4A373]/20 hover:text-white hover:translate-x-1' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.perangkat.*') ? 'text-[#333333]' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Perangkat Desa
                    </a>
                    <a href="{{ route('admin.umkm.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.umkm.*') ? 'bg-[#D4A373] text-[#333333] font-bold shadow-lg' : 'text-white/80 hover:bg-[#D4A373]/20 hover:text-white hover:translate-x-1' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.umkm.*') ? 'text-[#333333]' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Produk UMKM
                    </a>
                    <a href="{{ route('admin.wisata.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.wisata.*') ? 'bg-[#D4A373] text-[#333333] font-bold shadow-lg' : 'text-white/80 hover:bg-[#D4A373]/20 hover:text-white hover:translate-x-1' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.wisata.*') ? 'text-[#333333]' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Wisata Desa
                    </a>
                    <a href="{{ route('admin.galeri.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.galeri.*') ? 'bg-[#D4A373] text-[#333333] font-bold shadow-lg' : 'text-white/80 hover:bg-[#D4A373]/20 hover:text-white hover:translate-x-1' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.galeri.*') ? 'text-[#333333]' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Galeri Desa
                    </a>
                    <a href="{{ route('admin.data-desa.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.data-desa.*') ? 'bg-[#D4A373] text-[#333333] font-bold shadow-lg' : 'text-white/80 hover:bg-[#D4A373]/20 hover:text-white hover:translate-x-1' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.data-desa.*') ? 'text-[#333333]' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Data Penduduk
                    </a>
                </div>
            </div>

            <!-- Profil Desa -->
            <div>
                <p class="text-xs font-bold text-[#D4A373] uppercase tracking-widest mb-4 px-3">Profil Desa</p>
                <div class="space-y-1.5">
                    <a href="{{ route('admin.sejarah.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.sejarah.*') ? 'bg-[#D4A373] text-[#333333] font-bold shadow-lg' : 'text-white/80 hover:bg-[#D4A373]/20 hover:text-white hover:translate-x-1' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.sejarah.*') ? 'text-[#333333]' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Sejarah Desa
                    </a>
                    <a href="{{ route('admin.misi.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.misi.*') ? 'bg-[#D4A373] text-[#333333] font-bold shadow-lg' : 'text-white/80 hover:bg-[#D4A373]/20 hover:text-white hover:translate-x-1' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.misi.*') ? 'text-[#333333]' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        Misi Desa
                    </a>
                </div>
            </div>
        </nav>
        
        <div class="p-6 relative z-10 border-t border-white/10 mt-auto">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 text-white/80 hover:bg-[#D4A373] hover:text-[#333333] px-4 py-3 rounded-xl transition-all duration-300 font-semibold border border-transparent hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 bg-slate-50/50">
        
        <!-- Topbar Desktop & Mobile -->
        <header class="h-20 bg-white/90 backdrop-blur-md border-b border-slate-200/80 px-6 sm:px-8 flex items-center justify-between sticky top-0 z-20 shadow-[0_2px_10px_rgba(0,0,0,0.02)]">
            <!-- Mobile Menu Toggle -->
            <div class="md:hidden flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-[#2D5A27] flex items-center justify-center font-bold text-[#D4A373] shadow-md">
                    A
                </div>
                <span class="font-bold text-[#333333] text-lg font-serif">Admin</span>
            </div>

            <!-- Desktop Breadcrumb or Title Area -->
            <div class="hidden md:flex items-center gap-2 text-sm">
                <span class="text-[#6C757D] font-medium">Dashboard</span>
                <span class="text-slate-300">/</span>
                <span class="text-[#333333] font-bold font-serif">@yield('title', 'Overview')</span>
            </div>

            <!-- Profile & Actions -->
            <div class="flex items-center gap-4 ml-auto">
                <div class="hidden sm:flex items-center gap-3 pr-4 border-r border-slate-200">
                    <span class="text-sm font-semibold text-[#333333]">Administrator</span>
                </div>
                
                <form action="{{ route('admin.logout') }}" method="POST" class="md:hidden">
                    @csrf
                    <button type="submit" class="text-sm font-bold text-[#D4A373] bg-[#2D5A27] px-4 py-2 rounded-lg">Logout</button>
                </form>

                <div class="w-10 h-10 rounded-full bg-[#F8F9FA] border border-[#6C757D]/30 overflow-hidden hidden md:flex items-center justify-center text-[#6C757D]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 p-6 sm:p-8 lg:p-10 max-w-7xl w-full mx-auto">
            @yield('content')
        </main>
    </div>
</body>
</html>
