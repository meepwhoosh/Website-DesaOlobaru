<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Desa Olobaru</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
        
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-[#0f0f0f] dark:bg-slate-900 min-h-screen flex items-center justify-center font-sans antialiased relative overflow-hidden">
    <!-- Animated Background Shapes -->
    <div class="absolute inset-0 w-full h-full pointer-events-none flex justify-center items-center z-0">
        <div class="absolute top-10 lg:top-20 left-10 lg:left-1/3 w-64 h-64 bg-green-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob dark:bg-green-900/50 dark:mix-blend-screen"></div>
        <div class="absolute top-20 right-10 lg:right-1/3 w-64 h-64 bg-emerald-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-2000 dark:bg-emerald-900/50 dark:mix-blend-screen"></div>
        <div class="absolute -bottom-8 left-20 lg:left-1/2 w-64 h-64 bg-teal-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-4000 dark:bg-teal-900/50 dark:mix-blend-screen"></div>
    </div>

    <div class="max-w-md w-full px-6 relative z-10 animate-fade-in-up">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold font-serif text-slate-900 dark:text-white">Admin Portal</h1>
            <p class="text-slate-500 dark:text-slate-300 dark:text-white mt-2">Masuk untuk mengelola data dan informasi desa.</p>
        </div>

        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/50 dark:border-slate-700/50 overflow-hidden transition-all hover:shadow-green-900/5 dark:hover:shadow-green-900/20">
            <div class="p-8">
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-700 text-sm border border-red-100">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="space-y-5">
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1.5">Alamat Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700 dark:text-slate-200 dark:bg-slate-800 dark:text-white dark:border-slate-700">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1.5">Kata Sandi</label>
                            <input type="password" name="password" id="password" required
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700 dark:text-slate-200 dark:bg-slate-800 dark:text-white dark:border-slate-700">
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="w-full py-3 px-4 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white rounded-xl font-bold shadow-lg shadow-green-600/30 transition-all duration-300 hover:-translate-y-1 hover:shadow-green-600/50 dark:shadow-green-900/30 flex justify-center items-center gap-2 group">
                                Masuk ke Sistem
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="bg-slate-50 dark:bg-[#0f0f0f]/50 dark:bg-slate-800/50 py-4 text-center border-t border-slate-100 dark:border-slate-700/50">
                <a href="{{ route('home') }}" class="text-sm text-green-700 hover:text-green-800 font-medium inline-flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>
