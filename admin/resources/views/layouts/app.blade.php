<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AdminPanel') - MicroCell Admin</title>
    @vite(['resources/css/app.css'])
    <script src="https://unpkg.com/lucide@0.546.0/dist/umd/lucide.min.js"></script>
</head>
<body class="bg-slate-50 font-sans text-slate-900">
    <div class="flex min-h-screen bg-slate-50 font-sans text-slate-900">
        <aside class="w-64 bg-slate-900 text-white min-h-screen flex flex-col shadow-xl shrink-0">
            <div class="h-16 flex items-center px-6 border-b border-slate-800">
                <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-emerald-400 to-green-400">
                    AdminPanel
                </span>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-1">
                @php
                    $menuItems = [
                        ['name' => 'Dashboard Admin', 'icon' => 'layout-dashboard', 'path' => '/admin', 'exact' => true],
                        ['name' => 'Product', 'icon' => 'package', 'path' => '/admin/product'],
                        ['name' => 'Skema dan Harga', 'icon' => 'tags', 'path' => '/admin/skema-harga'],
                        ['name' => 'Pesanan', 'icon' => 'shopping-cart', 'path' => '/admin/pesanan'],
                        ['name' => 'Customer', 'icon' => 'users', 'path' => '/admin/customer'],
                        ['name' => 'Metode Pembayaran', 'icon' => 'credit-card', 'path' => '/admin/metode-pembayaran'],
                    ];
                @endphp
                @foreach ($menuItems as $item)
                    @php $isActive = $item['exact'] ?? false ? request()->is('admin') : request()->is(ltrim($item['path'], '/')); @endphp
                    <a href="{{ url($item['path']) }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ $isActive ? 'bg-emerald-600/10 text-emerald-400' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5 transition-transform duration-200 {{ $isActive ? 'scale-110' : 'group-hover:scale-110' }}"></i>
                        <span class="font-medium">{{ $item['name'] }}</span>
                        @if ($isActive)
                            <div class="ml-auto w-1.5 h-1.5 rounded-full bg-emerald-400"></div>
                        @endif
                    </a>
                @endforeach
            </nav>
            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-800/50">
                    <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white font-bold text-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</span>
                        <span class="text-xs text-slate-400 truncate">{{ auth()->user()->email }}</span>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition-all duration-200 group">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        <span class="font-medium">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-end px-8 shadow-sm shrink-0">
                <div class="text-sm font-medium text-slate-500">
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                </div>
            </header>

            <div class="flex-1 overflow-auto p-8">
                @if (session('success'))
                    <div class="mb-6 bg-emerald-50 text-emerald-700 border border-emerald-200 p-4 rounded-xl">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 text-red-600 border border-red-200 p-4 rounded-xl space-y-1">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>

    <div id="confirmModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
            <div class="p-6 border-b border-slate-100">
                <h2 class="text-lg font-bold text-slate-900">Konfirmasi Hapus</h2>
            </div>
            <div class="p-6">
                <p class="text-sm text-slate-600">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="p-6 border-t border-slate-100 flex justify-end gap-3 bg-slate-50">
                <button onclick="closeModal('confirmModal')" class="px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <form id="confirmForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-xl hover:bg-red-700 transition-colors shadow-sm">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function openModal(id) {
            const el = document.getElementById(id);
            el.classList.remove('hidden');
            el.classList.add('flex');
        }

        function closeModal(id) {
            const el = document.getElementById(id);
            el.classList.add('hidden');
            el.classList.remove('flex');
        }

        function openConfirmModal(actionUrl) {
            document.getElementById('confirmForm').action = actionUrl;
            openModal('confirmModal');
        }
    </script>
    @stack('scripts')
</body>
</html>