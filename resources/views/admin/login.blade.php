<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Desa Olobaru</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center font-sans antialiased">
    <div class="max-w-md w-full px-6">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold font-serif text-slate-900">Admin Portal</h1>
            <p class="text-slate-500 mt-2">Masuk untuk mengelola data dan informasi desa.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
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
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Alamat Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Kata Sandi</label>
                            <input type="password" name="password" id="password" required
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 focus:ring focus:ring-green-600/20 transition-all outline-none text-slate-700">
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="w-full py-3 px-4 bg-green-700 hover:bg-green-800 text-white rounded-xl font-semibold shadow-lg shadow-green-900/20 transition-all duration-200 hover:-translate-y-0.5">
                                Masuk ke Sistem
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="bg-slate-50 py-4 text-center border-t border-slate-100">
                <a href="{{ route('home') }}" class="text-sm text-green-700 hover:text-green-800 font-medium inline-flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>
