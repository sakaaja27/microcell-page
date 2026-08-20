<!DOCTYPE html>
<html lang="id" style="font-size: 90%;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microcell - @yield('title', 'Admin Panel')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans text-slate-900 antialiased" x-data>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 text-white min-h-screen flex flex-col shadow-xl shrink-0">
            <div class="h-16 flex items-center px-6 border-b border-slate-800">
                <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-emerald-400 to-green-400">
                    AdminPanel
                </span>
            </div>
            
            <nav class="flex-1 px-4 py-6 space-y-1">
                @php
                    $menuItems = [
                        ['name' => 'Dashboard Admin', 'icon' => 'layout-dashboard', 'route' => 'admin.dashboard'],
                        ['name' => 'Product', 'icon' => 'package', 'route' => 'admin.products'],
                        ['name' => 'Skema dan Harga', 'icon' => 'tags', 'route' => 'admin.schemas'],
                        ['name' => 'Pesanan', 'icon' => 'shopping-cart', 'route' => 'admin.orders'],
                        ['name' => 'Langganan', 'icon' => 'calendar-clock', 'route' => 'admin.subscriptions'],
                        ['name' => 'Customer', 'icon' => 'users', 'route' => 'admin.customers'],
                        ['name' => 'Metode Pembayaran', 'icon' => 'credit-card', 'route' => 'admin.payments'],
                        ['name' => 'Agenda', 'icon' => 'calendar', 'route' => 'admin.agendas'],
                    ];
                @endphp

                @foreach($menuItems as $item)
                    <a href="{{ route($item['route']) }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs($item['route']) ? 'bg-emerald-600/10 text-emerald-400' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5 transition-transform duration-200 {{ request()->routeIs($item['route']) ? 'scale-110' : 'group-hover:scale-110' }}"></i>
                        <span class="font-medium">{{ $item['name'] }}</span>
                        @if(request()->routeIs($item['route']))
                            <div class="ml-auto w-1.5 h-1.5 rounded-full bg-emerald-400"></div>
                        @endif
                    </a>
                @endforeach
            </nav>

            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-800/50">
                    <div class="w-8 h-8 rounded-full bg-emerald-500 flex items-center justify-center text-white font-bold text-sm">
                        A
                    </div>
                    <div class="flex flex-col">
                        <span class="text-sm font-medium text-white">Admin User</span>
                        <span class="text-xs text-slate-400">admin@microcell.com</span>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            <!-- Header -->
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-end px-8 shadow-sm shrink-0">
                <div class="text-sm font-medium text-slate-500">
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </div>
            </header>
            
            <!-- Page Content -->
            <div class="flex-1 overflow-auto p-8">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Global Delete Confirmation Modal -->
    <div id="globalConfirmModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm overflow-hidden flex flex-col">
            <div class="p-6 text-center">
                <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="alert-triangle" class="w-8 h-8 text-red-600"></i>
                </div>
                <h2 class="text-xl font-bold text-slate-900 mb-2">Konfirmasi Hapus</h2>
                <p class="text-sm text-slate-500">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="p-4 border-t border-slate-100 flex gap-3 bg-slate-50">
                <button type="button" onclick="closeConfirmModal()" class="flex-1 px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <form id="globalDeleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-xl hover:bg-red-700 transition-colors shadow-sm">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openConfirmModal(actionUrl) {
            const form = document.getElementById('globalDeleteForm');
            form.action = actionUrl;
            
            const modal = document.getElementById('globalConfirmModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeConfirmModal() {
            const modal = document.getElementById('globalConfirmModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function openModal(id) {
            const modal = document.getElementById(id);
            if(modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if(modal) {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        }

        function searchTable() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toLowerCase();
            const table = document.getElementById("dataTable");
            if(!table) return;
            const tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i++) {
                const tds = tr[i].getElementsByClassName("search-target");
                if (tds.length === 0) continue; // Skip header or empty rows without targets
                let found = false;
                for (let j = 0; j < tds.length; j++) {
                    if (tds[j]) {
                        const txtValue = tds[j].textContent || tds[j].innerText;
                        if (txtValue.toLowerCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                tr[i].style.display = found ? "" : "none";
            }
        }
    </script>

    @stack('scripts')
</body>
</html>
