@extends('layouts.app')

@section('title', 'Data Desa - Website Resmi Desa Olobaru')

@section('content')
<!-- Header Banner -->
<section data-aos="fade-in" class="relative py-16 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=1200&auto=format&fit=crop" 
             alt="Data Desa" 
             class="w-full h-full object-cover object-center opacity-30" />
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-slate-900/80"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <span class="text-xs font-bold text-green-400 uppercase tracking-widest block mb-2">Statistik & Kependudukan</span>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold tracking-tight">Data Desa Olobaru</h1>
    </div>
</section>

<!-- Content Body -->
<section data-aos="fade-in" class="py-12 bg-slate-50/50 dark:bg-slate-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <div class="mb-2">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Dashboard</h2>
            <p class="text-slate-500 dark:text-white text-sm mt-1">Ringkasan data kependudukan Desa Olobaru</p>
        </div>

        <!-- Top Overview Cards -->
        <div data-aos="fade-up" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1: Total Penduduk -->
            <div data-aos="fade-up" class="bg-white dark:bg-[#1e293b] p-6 rounded-2xl border border-slate-200 dark:border-slate-700/50 shadow-sm flex items-center gap-6">
                <div class="w-16 h-16 rounded-2xl bg-[#e6fcf5] text-[#0ca678] flex items-center justify-center shrink-0">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-500 dark:text-white uppercase tracking-widest mb-1">Total Penduduk</p>
                    <h3 class="text-3xl font-black text-slate-800 dark:text-white">{{ number_format($totalPenduduk, 0, ',', '.') }}</h3>
                </div>
            </div>

            <!-- Card 2: Laki-Laki -->
            <div data-aos="fade-up" class="bg-white dark:bg-[#1e293b] p-6 rounded-2xl border border-slate-200 dark:border-slate-700/50 shadow-sm flex items-center gap-6">
                <div class="w-16 h-16 rounded-2xl bg-[#e7f5ff] text-[#339af0] flex items-center justify-center shrink-0">
                    <!-- Male Icon -->
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <circle cx="10" cy="14" r="6" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.24 9.76L21 3m-5 0h5v5" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-500 dark:text-white uppercase tracking-widest mb-1">Laki-Laki</p>
                    <h3 class="text-3xl font-black text-slate-800 dark:text-white">{{ number_format($lakiLaki, 0, ',', '.') }}</h3>
                </div>
            </div>

            <!-- Card 3: Perempuan -->
            <div data-aos="fade-up" class="bg-white dark:bg-[#1e293b] p-6 rounded-2xl border border-slate-200 dark:border-slate-700/50 shadow-sm flex items-center gap-6">
                <div class="w-16 h-16 rounded-2xl bg-[#fff0f6] text-[#f06595] flex items-center justify-center shrink-0">
                    <!-- Female Icon -->
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <circle cx="12" cy="10" r="6" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v7m-3-3h6" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-500 dark:text-white uppercase tracking-widest mb-1">Perempuan</p>
                    <h3 class="text-3xl font-black text-slate-800 dark:text-white">{{ number_format($perempuan, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <!-- Section: Tren & Distribusi -->
        <div class="mt-10">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2 mb-4 border-b border-slate-200 dark:border-slate-700/50 pb-3">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                Tren & Distribusi Kependudukan
            </h3>

            <div data-aos="fade-up" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Line: Kelompok Umur -->
                <div data-aos="fade-up" class="bg-white dark:bg-[#1e293b] p-6 rounded-2xl border border-slate-200 dark:border-slate-700/50 shadow-sm">
                    <h4 class="text-base font-bold text-slate-800 dark:text-white mb-6">Tren Kelompok Umur</h4>
                    <div class="relative h-64 w-full">
                        <canvas id="chartUmur"></canvas>
                    </div>
                </div>

                <!-- Pie: Status Perkawinan -->
                <div data-aos="fade-up" class="bg-white dark:bg-[#1e293b] p-6 rounded-2xl border border-slate-200 dark:border-slate-700/50 shadow-sm">
                    <h4 class="text-base font-bold text-slate-800 dark:text-white mb-6 text-center">Status Perkawinan</h4>
                    <div class="relative h-72 w-full flex items-center justify-center max-w-sm mx-auto">
                        <canvas id="chartStatus"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Infrastruktur / Wilayah & Pendidikan -->
        <div class="mt-8">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2 mb-4 border-b border-slate-200 dark:border-slate-700/50 pb-3">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                Distribusi Dusun & Pendidikan
            </h3>

            <div data-aos="fade-up" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Bar: Distribusi Dusun -->
                <div data-aos="fade-up" class="bg-white dark:bg-[#1e293b] p-6 rounded-2xl border border-slate-200 dark:border-slate-700/50 shadow-sm flex flex-col">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="text-base font-bold text-slate-800 dark:text-white">Distribusi Per Dusun</h4>
                        <span class="text-xs font-semibold text-slate-600">{{ array_sum($dusun->toArray()) }} Total Jiwa</span>
                    </div>
                    <div class="relative h-64 w-full flex-grow">
                        <canvas id="chartDusun"></canvas>
                    </div>
                </div>

                <!-- Horizontal Bar: Pendidikan -->
                <div data-aos="fade-up" class="bg-white dark:bg-[#1e293b] p-6 rounded-2xl border border-slate-200 dark:border-slate-700/50 shadow-sm flex flex-col">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="text-base font-bold text-slate-800 dark:text-white">Tingkat Pendidikan</h4>
                    </div>
                    <div class="relative h-80 w-full flex-grow">
                        <canvas id="chartPendidikan"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Section: Lainnya (Agama & Pekerjaan) -->
        <div class="mt-8 pb-12">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2 mb-4 border-b border-slate-200 dark:border-slate-700/50 pb-3">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Agama & Profesi Pekerjaan
            </h3>

            <div data-aos="fade-up" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Donut: Agama -->
                <div data-aos="fade-up" class="bg-white dark:bg-[#1e293b] p-6 rounded-2xl border border-slate-200 dark:border-slate-700/50 shadow-sm">
                    <h4 class="text-base font-bold text-slate-800 dark:text-white mb-6 text-center">Agama</h4>
                    <div class="relative h-72 w-full flex items-center justify-center max-w-sm mx-auto">
                        <canvas id="chartAgama"></canvas>
                    </div>
                </div>

                <!-- Bar Chart: Pekerjaan (Scrollable Horizontal) -->
                <div data-aos="fade-up" class="bg-white dark:bg-[#1e293b] p-6 rounded-2xl border border-slate-200 dark:border-slate-700/50 shadow-sm flex flex-col h-96 overflow-hidden">
                    <h4 class="text-base font-bold text-slate-800 dark:text-white mb-2 shrink-0">Jenis Pekerjaan</h4>
                    <div class="overflow-x-auto flex-grow custom-scrollbar">
                        <div class="relative h-full" style="width: max(100%, {{ count($pekerjaan) * 45 }}px);">
                            <canvas id="chartPekerjaan"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@section('scripts')
<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // Common Chart Defaults
        Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
        Chart.defaults.color = '#94a3b8'; // slate-400 for ticks
        Chart.defaults.plugins.tooltip.backgroundColor = 'rgba(15, 23, 42, 0.9)';
        Chart.defaults.plugins.tooltip.padding = 10;
        Chart.defaults.plugins.tooltip.cornerRadius = 8;
        
        // Data from Controller
        const agamaRawData = @json($agama->filter(fn($val, $key) => trim((string)$key) !== '' && trim((string)$key) !== '-')->toArray());
        const agamaLabelsRaw = Object.keys(agamaRawData);
        const agamaData = Object.values(agamaRawData);
        const agamaLabels = agamaLabelsRaw.map((lbl, i) => lbl + ' (' + agamaData[i] + ')');

        const statusLabelsRaw = @json(array_keys($status_perkawinan->toArray()));
        const statusData = @json(array_values($status_perkawinan->toArray()));
        const statusLabels = statusLabelsRaw.map((lbl, i) => lbl + ' (' + statusData[i] + ')');
        
        const umurLabelsRaw = @json(array_keys($umur));
        const umurData = @json(array_values($umur));
        const umurLabels = umurLabelsRaw.map((lbl, i) => lbl + ' (' + umurData[i] + ')');

        const dusunLabelsRaw = @json(array_keys($dusun->toArray()));
        const dusunData = @json(array_values($dusun->toArray()));
        const dusunLabels = dusunLabelsRaw.map((lbl, i) => lbl + ' (' + dusunData[i] + ')');

        const pendidikanLabelsRaw = @json(array_keys($pendidikan->toArray()));
        const pendidikanData = @json(array_values($pendidikan->toArray()));
        const pendidikanLabels = pendidikanLabelsRaw.map((lbl, i) => lbl + ' (' + pendidikanData[i] + ')');

        @php
            $pekerjaanSorted = collect($pekerjaan)->sortDesc();
        @endphp
        const pekerjaanLabelsRaw = @json(array_keys($pekerjaanSorted->toArray()));
        const pekerjaanData = @json(array_values($pekerjaanSorted->toArray()));
        const pekerjaanLabels = pekerjaanLabelsRaw.map((lbl, i) => lbl + ' (' + pekerjaanData[i] + ')');

        // Donut Chart Plugin for inner border (optional but makes it look thick like the screenshot)
        // Set cutout to '75%' or '80%' to make it thick bordered.
        const donutOptions = { 
            responsive: true, 
            maintainAspectRatio: false,
            // Thick border look. Changed from 75% to 60% so small slices (like Hindu) are physically thicker and more visible radially.
            cutout: '60%', 
            plugins: { 
                legend: { 
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        boxWidth: 10,
                        padding: 20,
                        font: { size: 12, weight: 'bold' },
                        color: '#475569'
                    }
                } 
            },
            layout: { padding: 10 }
        };

        const pieOptions = { 
            responsive: true, 
            maintainAspectRatio: false, 
            plugins: { 
                legend: { 
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        boxWidth: 10,
                        padding: 20,
                        font: { size: 12, weight: 'bold' },
                        color: '#475569'
                    }
                } 
            },
            layout: { padding: 10 }
        };

        // Pie: Status
        if(document.getElementById('chartStatus')) {
            new Chart(document.getElementById('chartStatus'), {
                type: 'pie',
                data: {
                    labels: statusLabels,
                    datasets: [{
                        data: statusData,
                        backgroundColor: ['#f59e0b', '#ef4444', '#3b82f6', '#10b981', '#6366f1'],
                        borderWidth: 0,
                        hoverOffset: 12
                    }]
                },
                options: pieOptions
            });
        }

        // Pie: Agama
        if(document.getElementById('chartAgama')) {
            new Chart(document.getElementById('chartAgama'), {
                type: 'pie',
                data: {
                    labels: agamaLabels,
                    datasets: [{
                        data: agamaData,
                        backgroundColor: ['#10b981', '#f59e0b', '#3b82f6', '#8b5cf6', '#ef4444', '#64748b'],
                        borderWidth: 0,
                        hoverOffset: 12
                    }]
                },
                options: pieOptions
            });
        }

        // Line: Umur (like the green one in screenshot)
        if(document.getElementById('chartUmur')) {
            const ctx = document.getElementById('chartUmur').getContext('2d');
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(16, 185, 129, 0.2)'); // Green fade
            gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: umurLabels,
                    datasets: [{
                        label: 'Jumlah Penduduk',
                        data: umurData,
                        borderColor: '#10b981', // emerald-500
                        backgroundColor: gradient,
                        borderWidth: 3,
                        tension: 0.4, // Smooth curve
                        fill: true,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#10b981',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { color: 'rgba(148, 163, 184, 0.2)', borderDash: [5, 5] },
                            border: { display: false }
                        },
                        x: { 
                            grid: { display: false },
                            border: { display: false }
                        }
                    }
                }
            });
        }

        // Bar: Dusun
        if(document.getElementById('chartDusun')) {
            new Chart(document.getElementById('chartDusun'), {
                type: 'bar',
                data: {
                    labels: dusunLabels,
                    datasets: [{
                        label: 'Penduduk',
                        data: dusunData,
                        backgroundColor: ['#ef4444', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6'], // Multi colors for bars
                        borderRadius: 6,
                        barPercentage: 0.5 // Thinner bars
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { color: 'rgba(148, 163, 184, 0.2)', borderDash: [5, 5] },
                            border: { display: false }
                        },
                        x: { 
                            grid: { display: false },
                            border: { display: false }
                        }
                    }
                }
            });
        }

        // Bar: Pendidikan (Horizontal like the green one in screenshot)
        if(document.getElementById('chartPendidikan')) {
            new Chart(document.getElementById('chartPendidikan'), {
                type: 'bar',
                data: {
                    labels: pendidikanLabels,
                    datasets: [{
                        label: 'Penduduk',
                        data: pendidikanData,
                        backgroundColor: '#10b981', // emerald-500
                        borderRadius: 6,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    indexAxis: 'y', // Horizontal
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { 
                            beginAtZero: true, 
                            grid: { color: 'rgba(148, 163, 184, 0.2)', borderDash: [5, 5] },
                            border: { display: false }
                        },
                        y: { 
                            grid: { display: false },
                            border: { display: false },
                            ticks: { font: { size: 11 } }
                        }
                    }
                }
            });
        }

        // Bar: Pekerjaan
        if(document.getElementById('chartPekerjaan')) {
            new Chart(document.getElementById('chartPekerjaan'), {
                type: 'bar',
                data: {
                    labels: pekerjaanLabels,
                    datasets: [{
                        label: 'Penduduk',
                        data: pekerjaanData,
                        backgroundColor: '#3b82f6', // blue-500
                        borderRadius: 4,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { color: 'rgba(148, 163, 184, 0.2)', borderDash: [5, 5] },
                            border: { display: false }
                        },
                        x: { 
                            grid: { display: false },
                            border: { display: false },
                            ticks: { 
                                maxRotation: 45,
                                minRotation: 45,
                                font: { size: 10 }
                            }
                        }
                    }
                }
            });
        }

        // Scrollbar Style for the table
        const style = document.createElement('style');
        style.innerHTML = `
            .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
            .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
            .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(148, 163, 184, 0.5); border-radius: 4px; }
            .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(148, 163, 184, 0.8); }
        `;
        document.head.appendChild(style);

    });
</script>
@endsection
