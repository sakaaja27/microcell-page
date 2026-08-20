<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - MicroCell Admin</title>
    @vite(['resources/css/app.css'])
    <script src="https://unpkg.com/lucide@0.546.0/dist/umd/lucide.min.js"></script>
</head>
<body class="bg-[#041706] font-sans">
    <div class="min-h-screen bg-[#041706] flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-emerald-950/40 backdrop-blur-xl border border-emerald-500/20 rounded-3xl p-8 shadow-2xl">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-emerald-400 hover:text-emerald-300 transition-colors mb-8 text-sm font-medium">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Beranda
            </a>

            <div class="text-center mb-8">
                <h1 class="text-3xl font-extrabold text-white tracking-tight mb-2">Buat Akun</h1>
                <p class="text-emerald-200/70 text-sm">Bergabung dengan MicroCell hari ini</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-500/10 border border-red-500/30 text-red-300 text-sm rounded-xl p-4 space-y-1">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register.attempt') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-emerald-100 mb-1.5">Nama Lengkap</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full bg-[#041706]/50 border border-emerald-500/30 text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent block p-3 transition-all outline-none"
                        placeholder="Nama Admin"
                        required
                        autofocus
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium text-emerald-100 mb-1.5">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full bg-[#041706]/50 border border-emerald-500/30 text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent block p-3 transition-all outline-none"
                        placeholder="user@gmail.com"
                        required
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium text-emerald-100 mb-1.5">No WhatsApp</label>
                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        class="w-full bg-[#041706]/50 border border-emerald-500/30 text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent block p-3 transition-all outline-none"
                        placeholder="08xxxxxxxxx"
                        required
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium text-emerald-100 mb-1.5">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="w-full bg-[#041706]/50 border border-emerald-500/30 text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent block p-3 transition-all outline-none"
                        placeholder="Minimal 8 karakter"
                        required
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium text-emerald-100 mb-1.5">Konfirmasi Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="w-full bg-[#041706]/50 border border-emerald-500/30 text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent block p-3 transition-all outline-none"
                        placeholder="Ulangi password"
                        required
                    />
                </div>

                <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-bold rounded-xl py-3.5 mt-2 transition-all shadow-[0_0_20px_rgba(16,185,129,0.3)] hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] active:scale-[0.98]">
                    Daftar Sekarang
                </button>
            </form>

            <p class="text-center mt-8 text-sm text-emerald-200/60">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-emerald-400 font-medium hover:text-emerald-300 transition-colors">Masuk disini</a>
            </p>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>