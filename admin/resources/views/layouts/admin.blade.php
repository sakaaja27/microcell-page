<!DOCTYPE html>
<html lang="id">
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
                        ['name' => 'Customer', 'icon' => 'users', 'route' => 'admin.customers'],
                        ['name' => 'Metode Pembayaran', 'icon' => 'credit-card', 'route' => 'admin.payments'],
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
    @stack('scripts')
</body>
</html>
