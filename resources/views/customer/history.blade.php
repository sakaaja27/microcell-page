<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - MicroCell</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-[#041706] font-sans text-slate-200">
    <!-- Navbar -->
    <nav class="fixed top-0 inset-x-0 z-50 bg-[#041706]/80 backdrop-blur-md border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-emerald-400 font-bold text-xl tracking-tight hover:text-emerald-300 transition-colors">
                <img src="/assets/images/logo.png" alt="MicroCell Logo" class="h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-110" />
                <span class="font-sans text-xl font-extrabold text-white tracking-tight">
                    Micro<span class="text-emerald-400">Cell</span>
                </span>
            </a>
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-sm font-semibold text-emerald-100/70 hover:text-white transition-colors">Beranda</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm font-semibold text-red-400 hover:text-red-300 transition-colors">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="pt-32 pb-24 max-w-5xl mx-auto px-6 min-h-screen">
        <div class="mb-10">
            <h1 class="text-3xl font-extrabold text-white mb-2">Riwayat Transaksi</h1>
            <p class="text-emerald-100/70">Pantau status pesanan MicroCell Anda di sini.</p>
        </div>

        @if (session('success'))
            <div class="mb-8 p-4 bg-emerald-500/10 border border-emerald-500/30 rounded-2xl flex items-center gap-3 text-emerald-300">
                <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
                <p class="font-medium text-sm">{{ session('success') }}</p>
            </div>
        @endif
        
        @php
            $subscriptions = Auth::user()->customer ? Auth::user()->customer->subscriptions()->where('status', 'Aktif')->get() : collect();
        @endphp

        @if($subscriptions->count() > 0)
        <div class="mb-10">
            <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                <i data-lucide="activity" class="w-5 h-5 text-emerald-400"></i> Layanan Aktif (Sewa)
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($subscriptions as $sub)
                    <a href="{{ route('customer.checkout', $sub->schema_id) }}" class="block group {{ $sub->status === 'Selesai' ? 'pointer-events-none' : '' }}">
                        <div class="bg-emerald-900/40 border {{ $sub->status === 'Selesai' ? 'border-blue-700/50' : 'border-emerald-700/50' }} rounded-2xl p-5 relative overflow-hidden transition-all duration-300 group-hover:bg-emerald-800/50 group-hover:border-emerald-500/70 group-hover:shadow-[0_0_20px_rgba(16,185,129,0.2)]">
                            <div class="absolute top-0 right-0 w-20 h-20 {{ $sub->status === 'Selesai' ? 'bg-blue-500/10' : 'bg-emerald-500/10' }} blur-2xl rounded-full transition-transform duration-300 group-hover:scale-150"></div>
                            
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="text-lg font-bold text-white group-hover:text-emerald-300 transition-colors">{{ $sub->schema->skema ?? 'Layanan' }}</h3>
                                @if($sub->status === 'Selesai')
                                    <div class="bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-lg shadow-sm">Lunas</div>
                                @else
                                    <div class="bg-emerald-500 text-emerald-950 text-xs font-bold px-2 py-1 rounded-lg shadow-sm">Bayar Tagihan</div>
                                @endif
                            </div>
                            
                            <p class="text-sm text-emerald-200/70 mb-3">Mulai: {{ \Carbon\Carbon::parse($sub->started_at)->format('d M Y') }}</p>

                            <!-- Progress Bar -->
                            <div class="mb-4">
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-emerald-100/60">Progress Kepemilikan</span>
                                    <span class="font-bold text-emerald-400">{{ $sub->paid_months }} / {{ $sub->total_months }} Bulan</span>
                                </div>
                                <div class="w-full bg-emerald-950/50 rounded-full h-1.5">
                                    @php
                                        $percentage = min(100, ($sub->paid_months / max(1, $sub->total_months)) * 100);
                                    @endphp
                                    <div class="bg-gradient-to-r from-emerald-500 to-teal-400 h-1.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between border-t border-emerald-800/50 pt-3">
                                <span class="text-sm text-emerald-100/60">Jatuh Tempo Berikutnya</span>
                                @if($sub->status === 'Selesai')
                                    <span class="text-sm font-bold text-blue-400">Kepemilikan Penuh</span>
                                @else
                                    <span class="text-sm font-bold {{ \Carbon\Carbon::parse($sub->next_billing_date)->isPast() ? 'text-red-400' : 'text-emerald-400' }}">
                                        {{ \Carbon\Carbon::parse($sub->next_billing_date)->format('d M Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        @endif

        <div class="space-y-6">
            @forelse ($orders as $order)
                <div class="bg-[#0A2F1D] border border-emerald-800/50 rounded-[24px] p-6 lg:p-8 shadow-xl flex flex-col md:flex-row gap-6 items-start md:items-center transition-all hover:border-emerald-700">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-xs font-bold text-emerald-400 bg-emerald-400/10 px-2 py-1 rounded-md">{{ $order->id }}</span>
                            <span class="text-xs text-emerald-100/50">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-1">{{ $order->skema }}</h3>
                        <p class="text-sm text-emerald-200/70">{{ $order->qty }} Unit &bull; Menggunakan {{ $order->paymentMethod->nama ?? 'Transfer' }}</p>
                    </div>
                    
                    <div class="flex-shrink-0 md:text-right">
                        <div class="text-sm text-emerald-100/60 mb-1">Total Pembayaran</div>
                        <div class="text-xl font-black text-emerald-300 mb-3">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                        
                        @php
                            $statusColor = match($order->status) {
                                'Menunggu' => 'bg-amber-500/20 text-amber-300 border-amber-500/30',
                                'Proses' => 'bg-blue-500/20 text-blue-300 border-blue-500/30',
                                'Selesai' => 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30',
                                'Dibatalkan' => 'bg-red-500/20 text-red-300 border-red-500/30',
                                default => 'bg-slate-500/20 text-slate-300 border-slate-500/30'
                            };
                            $statusIcon = match($order->status) {
                                'Menunggu' => 'clock',
                                'Proses' => 'loader',
                                'Selesai' => 'check-circle',
                                'Dibatalkan' => 'x-circle',
                                default => 'circle'
                            };
                        @endphp
                        
                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border text-xs font-bold {{ $statusColor }}">
                            <i data-lucide="{{ $statusIcon }}" class="w-3.5 h-3.5"></i> {{ $order->status }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-[#0A2F1D] border border-emerald-800/50 rounded-[32px]">
                    <div class="w-16 h-16 bg-emerald-900/50 rounded-full flex items-center justify-center mx-auto mb-4 text-emerald-500">
                        <i data-lucide="shopping-bag" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Belum ada transaksi</h3>
                    <p class="text-emerald-100/60 max-w-sm mx-auto mb-6">Anda belum pernah melakukan pemesanan. Jelajahi layanan kami di halaman utama.</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center bg-emerald-500 text-emerald-950 font-bold px-6 py-3 rounded-xl hover:bg-emerald-400 transition-colors">
                        Lihat Layanan
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
