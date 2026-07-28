@extends('layouts.app')

@section('title', 'Transparansi APBDes - Desa Olobaru')

@section('content')
<div class="bg-[#f8faf7] dark:bg-slate-900 min-h-screen pb-20">
    <!-- Hero Section -->
    <section class="relative pt-12 pb-16 lg:pt-20 lg:pb-24 overflow-hidden">
        <div class="absolute inset-0 bg-green-900 dark:bg-green-950">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
            <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-[#f8faf7] dark:from-slate-900 to-transparent"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
            <span class="inline-block py-1 px-3 rounded-full bg-green-800/50 text-green-200 text-sm font-semibold tracking-wider mb-4 border border-green-700/50 backdrop-blur-sm">
                INFORMASI KEUANGAN
            </span>
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-white mb-6 font-serif tracking-tight drop-shadow-lg">
                Transparansi <span class="text-green-400">APBDes</span>
            </h1>
            <p class="mt-4 text-lg md:text-xl text-green-100/90 max-w-2xl mx-auto font-medium">
                Wujud komitmen keterbukaan informasi publik Pemerintah Desa Olobaru dalam pengelolaan Anggaran Pendapatan dan Belanja Desa.
            </p>
            
            <form method="GET" action="{{ route('apbdes') }}" class="mt-8 inline-flex items-center gap-3 bg-white/10 p-2 rounded-2xl backdrop-blur-md border border-white/20">
                <select name="tahun" onchange="this.form.submit()" class="bg-white dark:bg-slate-800 text-slate-800 dark:text-white font-bold px-4 py-2 rounded-xl outline-none border-0 shadow-sm focus:ring-2 focus:ring-green-400">
                    @foreach($tahunList as $t)
                        <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>Tahun Anggaran {{ $t }}</option>
                    @endforeach
                </select>
            </form>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
        @if($apbdesData->count() > 0)
        <!-- Ringkasan Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" data-aos="fade-up" data-aos-delay="100">
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-700">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Pendapatan</p>
                        <h3 class="text-2xl font-black text-slate-800 dark:text-white">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-700">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-red-600 dark:text-red-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Belanja</p>
                        <h3 class="text-2xl font-black text-slate-800 dark:text-white">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-700">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pembiayaan Netto</p>
                        <h3 class="text-2xl font-black text-slate-800 dark:text-white">Rp {{ number_format($totalPembiayaan, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-12">
            <!-- Pendapatan Chart -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-700" data-aos="fade-up" data-aos-delay="200">
                <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-6 border-b border-slate-100 dark:border-slate-700 pb-4">Proporsi Pendapatan Desa</h3>
                <div class="h-[300px] relative flex justify-center items-center">
                    <canvas id="pendapatanChart"></canvas>
                </div>
            </div>
            
            <!-- Belanja Chart -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-700" data-aos="fade-up" data-aos-delay="300">
                <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-6 border-b border-slate-100 dark:border-slate-700 pb-4">Proporsi Belanja Berdasarkan Bidang</h3>
                <div class="h-[300px] relative flex justify-center items-center">
                    <canvas id="belanjaChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Ringkasan APBDes & Tombol Toggle -->
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 lg:p-8 shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-700 text-center mb-8" data-aos="fade-up" data-aos-delay="400">
            <h3 class="text-2xl font-bold text-slate-800 dark:text-white mb-6 font-serif">Ringkasan APBDes TA {{ $tahun }}</h3>
            
            <div class="flex flex-col md:flex-row justify-center items-center gap-6 md:gap-12 mb-8">
                <div>
                    <p class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Pendapatan</p>
                    <p class="text-xl font-black text-blue-600 dark:text-blue-400">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
                <div class="hidden md:block w-px h-12 bg-slate-200 dark:bg-slate-700"></div>
                <div>
                    <p class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Belanja</p>
                    <p class="text-xl font-black text-red-600 dark:text-red-400">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</p>
                </div>
                <div class="hidden md:block w-px h-12 bg-slate-200 dark:bg-slate-700"></div>
                <div>
                    <p class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Pembiayaan</p>
                    <p class="text-xl font-black text-green-600 dark:text-green-400">Rp {{ number_format($totalPembiayaan, 0, ',', '.') }}</p>
                </div>
            </div>

            <button id="toggleRincianBtn" onclick="toggleRincian()" class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-medium transition-all shadow-md shadow-green-600/20 hover:shadow-green-600/40">
                <span id="toggleText">Lihat Rincian APBDes</span>
                <svg id="toggleIcon" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
        </div>

        <!-- Rincian APBDes (Tabel) -->
        <div id="rincianContainer" class="hidden bg-white dark:bg-slate-800 rounded-3xl p-6 lg:p-8 shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-700 overflow-hidden" data-aos="fade-up">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-6">
                <h3 class="text-xl font-bold text-slate-800 dark:text-white font-serif">Rincian Lengkap</h3>
                
                <div class="flex flex-wrap gap-3 w-full lg:w-auto">
                    <!-- Search -->
                    <div class="relative flex-grow lg:flex-grow-0">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari uraian..." class="w-full pr-4 py-2 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:ring-2 focus:ring-green-400 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-white outline-none transition-colors" style="padding-left: 2.5rem;">
                    </div>
                    <!-- Filter -->
                    <select id="filterKategori" onchange="filterTable()" class="px-4 py-2 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:ring-2 focus:ring-green-400 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-white outline-none transition-colors cursor-pointer">
                        <option value="semua">Semua Kategori</option>
                        <option value="pendapatan">Pendapatan</option>
                        <option value="belanja">Belanja</option>
                        <option value="pembiayaan">Pembiayaan</option>
                    </select>
                    <!-- Download Buttons -->
                    <div class="flex gap-2">
                        <a href="{{ route('apbdes.export.pdf', ['tahun' => $tahun]) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-red-50 text-red-700 hover:bg-red-100 rounded-xl text-sm font-semibold transition-colors border border-red-200 dark:bg-red-900/30 dark:border-red-800/50 dark:text-red-400 dark:hover:bg-red-900/50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            PDF
                        </a>
                        <a href="{{ route('apbdes.export.excel', ['tahun' => $tahun]) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-green-50 text-green-700 hover:bg-green-100 rounded-xl text-sm font-semibold transition-colors border border-green-200 dark:bg-green-900/30 dark:border-green-800/50 dark:text-green-400 dark:hover:bg-green-900/50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Excel
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm" id="apbdesTable">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900/50 text-left">
                            <th class="px-4 py-3.5 font-semibold text-slate-600 dark:text-slate-300 rounded-l-xl w-32">Kode Rekening</th>
                            <th class="px-4 py-3.5 font-semibold text-slate-600 dark:text-slate-300">Uraian Anggaran</th>
                            <th class="px-4 py-3.5 font-semibold text-slate-600 dark:text-slate-300 text-right w-48">Jumlah Anggaran (Rp)</th>
                            <th class="px-4 py-3.5 font-semibold text-slate-600 dark:text-slate-300 rounded-r-xl w-28 text-center">Sumber Dana</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                        @foreach($apbdesData as $item)
                        <tr class="apbdes-row hover:bg-slate-50 dark:hover:bg-slate-900/30 transition-colors {{ $item->level == 0 ? 'bg-green-50/30 dark:bg-green-900/10 font-bold' : '' }}" data-jenis="{{ $item->jenis }}">
                            <td class="px-4 py-3 text-slate-500 dark:text-slate-400 font-mono text-xs">
                                {{ $item->level <= 1 ? $item->kode_rekening : '' }}
                            </td>
                            <td class="px-4 py-3 text-slate-800 dark:text-white uraian-text" style="padding-left: {{ 16 + ($item->level * 24) }}px;">
                                @if($item->level == 0)
                                    <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                @elseif($item->level == 1)
                                    <span class="inline-block text-slate-400 dark:text-slate-500 mr-1.5 font-mono">↳</span>
                                @elseif($item->level == 2)
                                    <span class="inline-block text-slate-400/70 dark:text-slate-500/70 mr-1.5 font-mono">↳</span>
                                @else
                                    <span class="inline-block text-slate-400/50 dark:text-slate-500/50 mr-1.5 font-mono">-</span>
                                @endif
                                {{ $item->uraian }}
                            </td>
                            <td class="px-4 py-3 text-right font-mono {{ $item->level <= 1 ? 'font-bold text-slate-900 dark:text-white' : 'text-slate-600 dark:text-slate-400' }}">
                                {{ number_format($item->anggaran, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($item->sumber_dana)
                                <span class="inline-flex px-2 py-1 rounded-md text-xs font-bold tracking-wide
                                    {{ str_contains($item->sumber_dana, 'DDS') || str_contains($item->sumber_dana, 'DD') ? 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-400' :
                                       (str_contains($item->sumber_dana, 'ADD') ? 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400' :
                                       (str_contains($item->sumber_dana, 'PBH') ? 'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400' :
                                       (str_contains($item->sumber_dana, 'DII') || str_contains($item->sumber_dana, 'DLL') ? 'bg-purple-100 dark:bg-purple-900/40 text-purple-700 dark:text-purple-400' :
                                       'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400'))) }}">
                                    {{ $item->sumber_dana }}
                                </span>
                                @else
                                <span class="text-slate-300 dark:text-slate-600">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @else
        <div class="bg-white dark:bg-slate-800 p-12 lg:p-20 rounded-3xl border border-slate-200 dark:border-slate-700 text-center shadow-xl shadow-slate-200/50 dark:shadow-none" data-aos="fade-up">
            <div class="w-24 h-24 bg-slate-100 dark:bg-slate-900 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-800 dark:text-white mb-2">Data Belum Tersedia</h3>
            <p class="text-slate-500 dark:text-slate-400 font-medium max-w-md mx-auto">Data APBDes untuk tahun anggaran {{ $tahun }} belum diunggah oleh Pemerintah Desa.</p>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
@if($apbdesData->count() > 0)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const isDark = document.documentElement.classList.contains('dark');
        const textColor = isDark ? '#f8fafc' : '#1e293b';
        
        Chart.defaults.color = textColor;
        Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";

        // --- Pendapatan Donut Chart ---
        const ctxPendapatan = document.getElementById('pendapatanChart').getContext('2d');
        const pendapatanLabels = {!! json_encode($pendapatanData->pluck('uraian')) !!};
        const pendapatanData = {!! json_encode($pendapatanData->pluck('anggaran')) !!};
        
        new Chart(ctxPendapatan, {
            type: 'doughnut',
            data: {
                labels: pendapatanLabels,
                datasets: [{
                    data: pendapatanData,
                    backgroundColor: [
                        '#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#06b6d4'
                    ],
                    borderWidth: 2,
                    borderColor: isDark ? '#1e293b' : '#ffffff',
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'right' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) label += ': ';
                                if (context.parsed !== null) {
                                    label += 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed);
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // --- Belanja Polar/Pie Chart ---
        const ctxBelanja = document.getElementById('belanjaChart').getContext('2d');
        // Bersihkan uraian (hilangkan "BIDANG ")
        const belanjaLabels = {!! json_encode($belanjaData->pluck('uraian')->map(fn($u) => str_ireplace('BIDANG ', '', $u))) !!};
        const belanjaData = {!! json_encode($belanjaData->pluck('anggaran')) !!};
        
        new Chart(ctxBelanja, {
            type: 'pie',
            data: {
                labels: belanjaLabels,
                datasets: [{
                    data: belanjaData,
                    backgroundColor: [
                        '#ef4444', '#f59e0b', '#10b981', '#3b82f6', '#8b5cf6', '#ec4899', '#14b8a6'
                    ],
                    borderWidth: 2,
                    borderColor: isDark ? '#1e293b' : '#ffffff',
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'right' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) label += ': ';
                                if (context.parsed !== null) {
                                    label += 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed);
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Observe theme change to update chart colors dynamically
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === "class") {
                    const dark = document.documentElement.classList.contains('dark');
                    const color = dark ? '#f8fafc' : '#1e293b';
                    const border = dark ? '#1e293b' : '#ffffff';
                    
                    Chart.instances.forEach(chart => {
                        chart.options.plugins.legend.labels.color = color;
                        chart.data.datasets.forEach(dataset => {
                            dataset.borderColor = border;
                        });
                        chart.update();
                    });
                }
            });
        });
        observer.observe(document.documentElement, { attributes: true });
    });

    // --- Interactive Table Scripts ---
    function toggleRincian() {
        const container = document.getElementById('rincianContainer');
        const icon = document.getElementById('toggleIcon');
        const text = document.getElementById('toggleText');
        
        if (container.classList.contains('hidden')) {
            container.classList.remove('hidden');
            icon.classList.add('rotate-180');
            text.innerText = 'Tutup Rincian APBDes';
        } else {
            container.classList.add('hidden');
            icon.classList.remove('rotate-180');
            text.innerText = 'Lihat Rincian APBDes';
        }
    }

    function filterTable() {
        const searchVal = document.getElementById('searchInput').value.toLowerCase();
        const catVal = document.getElementById('filterKategori').value;
        const rows = document.querySelectorAll('.apbdes-row');
        
        rows.forEach(row => {
            const uraian = row.querySelector('.uraian-text').innerText.toLowerCase();
            const jenis = row.getAttribute('data-jenis');
            
            const matchSearch = uraian.includes(searchVal);
            const matchCat = catVal === 'semua' || jenis === catVal;
            
            if (matchSearch && matchCat) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endif
@endsection
