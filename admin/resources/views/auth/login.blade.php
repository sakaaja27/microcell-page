<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - MicroCell</title>
    @vite(['resources/css/app.css'])
    <script src="https://unpkg.com/lucide@0.546.0/dist/umd/lucide.min.js"></script>
</head>
<body class="bg-[#041706] font-sans">
    <div class="min-h-screen bg-[#041706] flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-emerald-950/40 backdrop-blur-xl border border-emerald-500/20 rounded-3xl p-8 shadow-2xl">
            <a href="http://localhost:3000" class="inline-flex items-center gap-2 text-emerald-400 hover:text-emerald-300 transition-colors mb-8 text-sm font-medium">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Beranda
            </a>

            <div class="text-center mb-8">
                <h1 class="text-3xl font-extrabold text-white tracking-tight mb-2">Selamat Datang</h1>
                <p class="text-emerald-200/70 text-sm">Masuk ke akun MicroCell Anda</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-500/10 border border-red-500/30 text-red-300 text-sm rounded-xl p-4">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login.attempt') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-emerald-100 mb-2">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full bg-[#041706]/50 border border-emerald-500/30 text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent block p-3.5 transition-all outline-none"
                        placeholder="admin@microcell.com"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium text-emerald-100 mb-2">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="w-full bg-[#041706]/50 border border-emerald-500/30 text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent block p-3.5 transition-all outline-none"
                        placeholder="••••••••"
                        required
                    />
                </div>
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="remember" class="rounded bg-[#041706] border-emerald-500/30 text-emerald-500 focus:ring-emerald-500/50" />
                        <span class="text-emerald-200/70 group-hover:text-emerald-200 transition-colors">Ingat saya</span>
                    </label>
                    <a href="#" class="text-emerald-400 hover:text-emerald-300 font-medium transition-colors">Lupa Password?</a>
                </div>

                <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-bold rounded-xl py-3.5 transition-all shadow-[0_0_20px_rgba(16,185,129,0.3)] hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] active:scale-[0.98]">
                    Masuk Sekarang
                </button>
            </form>

            <p class="text-center mt-8 text-sm text-emerald-200/60">
                Belum punya akun? <a href="http://localhost:3000/register" class="text-emerald-400 font-medium hover:text-emerald-300 transition-colors">Daftar disini</a>
            </p>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>