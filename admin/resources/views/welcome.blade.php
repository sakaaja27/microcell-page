@extends('layouts.app')
@section('title', 'Solusi Infrastruktur Telekomunikasi')

@section('content')
<div 
    x-data="{ 
        scrolled: false, 
        mobileMenuOpen: false, 
        isCalculatorOpen: false, 
        isSimulatorOpen: false, 
        isSurveyOpen: false,
        activeIndex: null
    }" 
    @scroll.window="scrolled = (window.pageYOffset > 40)"
    class="overflow-x-hidden min-h-screen bg-[#041706] text-emerald-100 selection:bg-emerald-500 selection:text-emerald-950 font-sans antialiased"
>

    <!-- Header -->
    <nav :class="scrolled ? 'py-3 bg-emerald-950/95 backdrop-blur-md shadow-lg border-b border-emerald-500/10' : 'py-5 bg-transparent border-b border-transparent'" class="fixed top-0 left-0 right-0 z-40 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between md:justify-center md:gap-12 lg:gap-20">
            <a href="#" class="flex items-center gap-2 group">
                <img src="/assets/images/logo.png" alt="MicroCell Logo" class="h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-110" />
                <span class="font-sans text-xl font-extrabold text-white tracking-tight">
                    Micro<span class="text-emerald-400">Cell</span>
                </span>
            </a>

            <div class="hidden md:flex items-center gap-8">
                <a href="#about" class="text-sm font-semibold text-emerald-200/80 hover:text-white hover:underline decoration-emerald-500 underline-offset-4 transition-all">Tentang</a>
                <a href="#how-it-works" class="text-sm font-semibold text-emerald-200/80 hover:text-white hover:underline decoration-emerald-500 underline-offset-4 transition-all">Cara Kerja</a>
                <a href="#benefits" class="text-sm font-semibold text-emerald-200/80 hover:text-white hover:underline decoration-emerald-500 underline-offset-4 transition-all">Manfaat</a>
                <a href="#products" class="text-sm font-semibold text-emerald-200/80 hover:text-white hover:underline decoration-emerald-500 underline-offset-4 transition-all">Produk</a>
                <a href="#faq" class="text-sm font-semibold text-emerald-200/80 hover:text-white hover:underline decoration-emerald-500 underline-offset-4 transition-all">FAQ</a>
            </div>

            <div class="hidden md:flex items-center gap-4">
                @auth
                    <a href="{{ route('customer.history') }}" class="text-sm font-bold text-white hover:text-emerald-400 transition-colors">Riwayat Transaksi</a>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-emerald-200 hover:text-white transition-colors">Admin Panel</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-bold bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/30 px-5 py-2 rounded-full transition-all">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-white hover:text-emerald-400 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="text-sm font-bold bg-emerald-500 hover:bg-emerald-400 text-emerald-950 px-5 py-2 rounded-full transition-all shadow-[0_0_15px_rgba(16,185,129,0.3)] hover:shadow-[0_0_25px_rgba(16,185,129,0.5)]">Register</a>
                @endauth
            </div>

            <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 text-emerald-200 md:hidden hover:text-white focus:outline-none">
                <i data-lucide="menu" x-show="!mobileMenuOpen"></i>
                <i data-lucide="x" x-show="mobileMenuOpen" style="display: none;"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" style="display: none;" class="md:hidden absolute top-full left-0 w-full h-[100vh] bg-[#041706] z-50 p-6 border-t border-emerald-500/10 flex flex-col">
            <div class="space-y-6">
                <a href="#about" @click="mobileMenuOpen = false" class="block text-lg font-bold text-emerald-200 hover:text-white">Tentang</a>
                <a href="#how-it-works" @click="mobileMenuOpen = false" class="block text-lg font-bold text-emerald-200 hover:text-white">Cara Kerja</a>
                <a href="#benefits" @click="mobileMenuOpen = false" class="block text-lg font-bold text-emerald-200 hover:text-white">Manfaat</a>
                <a href="#products" @click="mobileMenuOpen = false" class="block text-lg font-bold text-emerald-200 hover:text-white">Produk</a>
                <a href="#faq" @click="mobileMenuOpen = false" class="block text-lg font-bold text-emerald-200 hover:text-white">FAQ</a>
            </div>
            <div class="mt-8 space-y-4">
                @auth
                    <a href="{{ route('customer.history') }}" class="block w-full text-center py-3 rounded-xl font-bold text-emerald-100 bg-[#0A2F1D] border border-emerald-800/50 hover:bg-emerald-900/40 transition-colors">Riwayat Transaksi</a>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="block w-full text-center py-3 rounded-xl font-bold text-emerald-100 bg-[#0A2F1D] border border-emerald-800/50 hover:bg-emerald-900/40 transition-colors">Admin Panel</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-center py-3 rounded-xl font-bold text-red-400 bg-red-500/10 border border-red-500/30 hover:bg-red-500/20 transition-colors">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block w-full text-center py-3 rounded-xl font-bold text-white bg-emerald-900/50 border border-emerald-500/30 hover:bg-emerald-800/60 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="block w-full text-center py-3 rounded-xl font-bold text-emerald-950 bg-emerald-500 hover:bg-emerald-400 transition-colors">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="relative min-h-screen flex items-center justify-center pt-24 pb-20 overflow-hidden bg-emerald-950">
        <div class="absolute inset-0 w-full h-full">
            <canvas id="heroCanvas" class="w-full h-full block"></canvas>
            <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/20 via-transparent to-[#041706]"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
            <!-- <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-400/20 text-emerald-400 mb-8">
                <span class="text-sm">🌿</span>
                <span class="font-sans text-xs font-bold tracking-wider uppercase">Inovasi Energi Terbarukan Berbasis Mikroba</span>
            </div> -->

            <h1 class="font-sans text-4xl sm:text-5xl md:text-6xl font-extrabold text-white tracking-tight leading-[1.1] mb-6 max-w-4xl mx-auto drop-shadow-sm">
                Ubah Limbah Kotoran Sapi Menjadi <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-green-400">Energi Listrik</span>
            </h1>

            <p class="font-sans text-base sm:text-lg md:text-xl text-emerald-100/90 mb-10 max-w-3xl mx-auto leading-relaxed">
                MicroCell mengkonversi limbah kotoran ternak menjadi energi listrik terbarukan melalui teknologi bioelektrokimia MFC + BPFC yang terintegrasi IoT langsung di kandang Anda.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                <a href="#" target="_blank" rel="noopener noreferrer" class="bg-[#16A34A] text-white px-8 py-4 rounded-full font-bold text-sm tracking-wide hover:bg-emerald-500 hover:shadow-[0_0_20px_rgba(22,163,74,0.4)] active:scale-95 transition-all duration-200 flex items-center justify-center">
                    Konsultasi Gratis
                </a>
                <a href="#how-it-works" class="flex items-center justify-center gap-2 border border-white/30 text-white px-8 py-4 rounded-full font-bold text-sm hover:bg-white/10 active:scale-95 transition-all duration-200">
                    <i data-lucide="zap" class="w-4 h-4 text-emerald-400"></i>
                    Cara Kerja MicroCell
                </a>
            </div>
        </div>
    </section>

    <!-- About -->
    <section class="py-24 bg-[#E5E5E5]" id="about">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-16 mb-24">
                <div class="w-full md:w-1/2 flex justify-center">
                    <div class="relative w-full max-w-xl">
                        <img src="/assets/images/prototipe.png" alt="Prototipe MicroCell" class="w-full h-auto object-contain drop-shadow-xl hover:scale-105 transition-transform duration-500" />
                        <img src="/assets/images/dashboard.png" alt="Mobile Dashboard" class="absolute -right-4 md:-right-6 -bottom-4 md:-bottom-2 w-[20%] md:w-[20%] max-w-[150px] object-contain drop-shadow-2xl hover:-translate-y-2 transition-transform duration-500" />
                    </div>
                </div>

                <div class="w-full md:w-1/2">
                    <span class="text-gray-600 uppercase tracking-[0.2em] text-sm font-bold">Tentang</span>
                    <h2 class="font-sans text-5xl md:text-6xl font-bold text-emerald-800 mt-2 mb-6 tracking-tight">MicroCell</h2>
                    <p class="font-sans text-lg text-gray-700 leading-relaxed max-w-xl">
                        MicroCell mengolah limbah kotoran sapi menjadi energi listrik terbarukan melalui bioelektrokimia, dilengkapi monitoring IoT berbasis mobile. Dirancang untuk peternak skala kecil hingga menengah di Jember.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-10 rounded-[36px] shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <h3 class="font-sans text-xl font-bold text-emerald-800 mb-4">Teknologi DualCell MFC + BPFC</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">Menggabungkan Microbial Fuel Cell dan Biophotofuel Cell dalam satu sistem terintegrasi untuk menghasilkan energi listrik secara optimal dari limbah kotoran sapi.</p>
                </div>
                <div class="bg-white p-10 rounded-[36px] shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <h3 class="font-sans text-xl font-bold text-emerald-800 mb-4">Smart Monitoring IoT</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">Pantau suhu, tegangan, arus, intensitas cahaya, dan performa sistem kapan saja via aplikasi mobile MicroCell.</p>
                </div>
                <div class="bg-white p-10 rounded-[36px] shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <h3 class="font-sans text-xl font-bold text-emerald-800 mb-4">Modular & Plug And Play</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">Unit reaktor modular yang mudah dipasang tanpa keahlian teknis. Cukup masukkan limbah sistem bekerja otomatis dengan kontrol berbasis sensor dan mikrokontroler.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-24 bg-emerald-950 text-white" id="how-it-works">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-20">
                <span class="text-[10px] bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-3 py-1 rounded-full font-bold uppercase tracking-widest">Siklus Biokimia Cerdas</span>
                <h2 class="mt-4 font-sans text-3xl sm:text-4xl font-extrabold tracking-tight mb-4">Alur Kerja Regeneratif</h2>
                <p class="font-sans text-sm sm:text-base text-emerald-200/80 max-w-2xl mx-auto leading-relaxed">Dari limbah kotoran ternak hingga menyalakan peralatan listrik rumah tangga Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Steps -->
                @php
                    $steps = [
                        ['num' => '01', 'emoji' => '🐄', 'title' => 'Pengumpulan', 'desc' => 'Limbah dari kotoran peternakan disalurkan ke chamber anoda, di mana mikroba mulai memetabolisme limbah organik dan memisahkan elektron dan proton.'],
                        ['num' => '02', 'emoji' => '🧫', 'title' => 'Bioreaktor MFC', 'desc' => 'Substrat cair masuk ke ruang anoda anaerobik, di mana koloni aktif mikroba memetabolisme asam organik dan memicu transfer elektron.'],
                        ['num' => '03', 'emoji' => '⚡', 'title' => 'Aliran Elektron', 'desc' => 'Elektron mengalir melintasi sirkuit eksternal ke ruang katoda, menghasilkan beda potensial listrik searah (DC) yang stabil.'],
                        ['num' => '04', 'emoji' => '☀️', 'title' => 'Regulasi Booster', 'desc' => 'Booster cerdas melipatgandakan milivolt biologi menjadi tegangan standar yang siap disalurkan ke peralatan rumah tangga.'],
                        ['num' => '05', 'emoji' => '🔋', 'title' => 'Baterai Penyimpan', 'desc' => 'Daya listrik yang dihasilkan disimpan dalam bank baterai untuk mensuplai beban listrik.'],
                        ['num' => '06', 'emoji' => '📱', 'title' => 'Visualisasi IoT', 'desc' => 'Konektivitas nirkabel mengirim data performa ke aplikasi mobile secara real-time dan transparan.']
                    ];
                @endphp
                @foreach ($steps as $step)
                <div class="bg-emerald-900/20 border border-emerald-500/20 backdrop-blur p-8 rounded-[28px] relative overflow-hidden group transition-all duration-300 hover:border-emerald-500/30 hover:-translate-y-1.5">
                    <div class="absolute -right-3 -top-6 text-8xl font-black text-emerald-500/5 select-none transition-all duration-300 group-hover:text-emerald-400/10 group-hover:scale-110 font-mono">
                        {{ $step['num'] }}
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-900/30 border border-emerald-500/10 flex items-center justify-center text-2xl mb-6 shadow-inner">
                        {{ $step['emoji'] }}
                    </div>
                    <h3 class="font-sans text-lg font-bold text-white mb-3 group-hover:text-emerald-400 transition-colors">
                        {{ $step['title'] }}
                    </h3>
                    <p class="text-sm text-emerald-200/70 leading-relaxed font-sans">
                        {{ $step['desc'] }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Benefits -->
    <section class="py-24 bg-white text-emerald-950" id="benefits">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <div class="inline-flex items-center justify-center border border-emerald-500/30 rounded-full px-4 py-1 mb-6">
                    <span class="text-xs font-bold text-emerald-700 tracking-widest uppercase">Manfaat</span>
                </div>
                <h2 class="font-sans text-4xl md:text-5xl font-extrabold text-emerald-900 tracking-tight mb-6 max-w-4xl mx-auto leading-tight">
                    Dirancang untuk Kebutuhan Nyata Peternak
                </h2>
                <p class="font-sans text-base md:text-lg text-emerald-700/80 max-w-3xl mx-auto leading-relaxed">
                    MicroCell hadir sebagai solusi terpadu yang memberikan manfaat nyata dari sisi lingkungan, ekonomi, dan operasional peternakan sehari-hari.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Card 1 -->
                <div class="bg-[#0A2F1D] text-emerald-50 rounded-[32px] p-8 md:p-10 shadow-lg relative overflow-hidden flex flex-col group">
                    <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center mb-6 text-emerald-400">
                        <i data-lucide="recycle" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-sans text-2xl font-bold mb-6 text-white leading-snug">Atasi Limbah Kotoran Sapi</h3>
                    <ul class="space-y-4 flex-1">
                        @foreach (['Limbah kotoran sapi dimanfaatkan menjadi energi listrik', 'Kandang lebih bersih dan bebas bau menyengat', 'Tidak memerlukan operator teknis khusus'] as $item)
                        <li class="flex items-start gap-3">
                            <i data-lucide="circle-check" class="w-5 h-5 text-emerald-400 mt-1 flex-shrink-0"></i>
                            <span class="text-sm md:text-base text-emerald-100/90 leading-relaxed">{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Card 2 -->
                <div class="bg-[#16A34A] text-white rounded-[32px] p-8 md:p-10 shadow-xl relative overflow-hidden flex flex-col md:-translate-y-4 group">
                    <div class="absolute top-6 right-6 bg-white/20 px-3 py-1 rounded-full backdrop-blur-sm">
                        <span class="text-xs font-bold text-white uppercase tracking-wider">Manfaat Utama</span>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mb-6 text-white backdrop-blur-sm">
                        <i data-lucide="zap" class="w-6 h-6 fill-white"></i>
                    </div>
                    <h3 class="font-sans text-2xl font-bold mb-6 text-white leading-snug">Kurangi Biaya Listrik Operasional</h3>
                    <ul class="space-y-4 flex-1">
                        @foreach (['Hasilkan energi listrik sendiri dari dalam kandang', 'Kurangi ketergantungan pada listrik dari luar', 'Investasi jangka panjang yang menguntungkan'] as $item)
                        <li class="flex items-start gap-3">
                            <i data-lucide="circle-check" class="w-5 h-5 text-white mt-1 flex-shrink-0"></i>
                            <span class="text-sm md:text-base text-emerald-50 leading-relaxed">{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Card 3 -->
                <div class="bg-[#0A2F1D] text-emerald-50 rounded-[32px] p-8 md:p-10 shadow-lg relative overflow-hidden flex flex-col group">
                    <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center mb-6 text-emerald-400">
                        <i data-lucide="globe" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-sans text-2xl font-bold mb-6 text-white leading-snug">Dampak Lingkungan & Sosial</h3>
                    <ul class="space-y-4 flex-1">
                        @foreach (['Kurangi emisi gas metana dari limbah ternak', 'Tingkatkan citra usaha peternakan', 'Berkontribusi pada SDG 7, SDG 12, dan SDG 13'] as $item)
                        <li class="flex items-start gap-3">
                            <i data-lucide="circle-check" class="w-5 h-5 text-emerald-400 mt-1 flex-shrink-0"></i>
                            <span class="text-sm md:text-base text-emerald-100/90 leading-relaxed">{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="bg-[#0A2F1D] rounded-3xl md:rounded-full px-6 py-8 md:px-12 md:py-8 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl mx-auto max-w-5xl">
                <div class="text-center md:text-left">
                    <h3 class="font-sans text-xl md:text-2xl font-bold text-white mb-2 md:mb-1">Siap Mengubah Limbah Menjadi Energi Listrik?</h3>
                    <p class="text-emerald-200/80 text-sm md:text-base">Konsultasikan instalasi MicroCell untuk peternakan Anda sekarang.</p>
                </div>
                <a href="#" target="_blank" rel="noopener noreferrer" class="w-full md:w-auto text-center whitespace-nowrap bg-emerald-300 hover:bg-emerald-400 text-emerald-950 font-bold px-8 py-4 rounded-full transition-colors duration-300 flex-shrink-0 shadow-lg shadow-emerald-400/20">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Scale Solutions -->
    <section class="py-24 bg-white text-emerald-950" id="products">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <div class="inline-flex items-center justify-center border border-emerald-500/20 bg-emerald-50 rounded-full px-4 py-1.5 mb-6">
                    <span class="text-xs font-bold text-emerald-700 tracking-widest uppercase">Produk & Layanan</span>
                </div>
                <h2 class="font-sans text-4xl md:text-5xl font-extrabold text-emerald-950 tracking-tight mb-6 max-w-4xl mx-auto leading-tight">
                    Pilih Skema yang Sesuai Kebutuhanmu
                </h2>
                <p class="font-sans text-base md:text-lg text-emerald-800 max-w-3xl mx-auto leading-relaxed">
                    MicroCell tersedia dalam tiga skema kepemilikan dan layanan fleksibel sesuai skala peternakan Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 mb-12 items-stretch">
                @foreach ($schemas as $schema)
                    @if ($schema->is_recommended)
                        <!-- Recommended Card (Middle style) -->
                        <div class="group relative flex h-full min-h-[560px] flex-col overflow-hidden rounded-[32px] border border-emerald-500/30 bg-[#115E2E] p-8 shadow-2xl transition-all duration-300 hover:-translate-y-6 hover:scale-[1.01] md:p-10 lg:-translate-y-4">
                            <div class="relative z-10 flex justify-between items-start mb-6">
                                <div>
                                    <div class="flex items-center gap-1.5 text-amber-300 font-bold text-xs mb-3">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i> Rekomendasi
                                    </div>
                                    @if ($schema->badge)
                                    <div class="border border-white/30 bg-white/10 text-white font-bold text-xs px-4 py-1.5 rounded-full inline-block backdrop-blur-sm">{{ $schema->badge }}</div>
                                    @endif
                                </div>
                                @if ($schema->icon)
                                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-emerald-800 shrink-0 ml-2">
                                    <i data-lucide="{{ $schema->icon }}" class="w-5 h-5 fill-current"></i>
                                </div>
                                @endif
                            </div>
                            <div class="relative z-10 flex flex-1 flex-col">
                                <h3 class="font-sans text-2xl font-bold text-white mb-2">{{ $schema->skema }}</h3>
                                <p class="text-emerald-100/90 text-sm mb-6">{{ $schema->subtitle }}</p>
                                <div class="mb-6">
                                    <span class="text-2xl font-bold text-emerald-300">Rp {{ number_format($schema->harga, 0, ',', '.') }}</span>
                                    <span class="block text-emerald-300/80 text-sm mt-1">{{ $schema->satuan }}</span>
                                </div>
                                <ul class="space-y-4 flex-1 mb-10 border-t border-emerald-400/30 pt-4">
                                    @php
                                        $features = is_string($schema->features) ? json_decode($schema->features, true) : (is_array($schema->features) ? $schema->features : []);
                                    @endphp
                                    @if($features)
                                        @foreach ($features as $item)
                                        <li class="flex items-start gap-3">
                                            <i data-lucide="circle-check" class="w-5 h-5 text-emerald-300 mt-0.5 flex-shrink-0"></i>
                                            <span class="text-sm text-emerald-50 leading-relaxed">{{ $item }}</span>
                                        </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <a href="{{ route('customer.checkout', $schema) }}" class="block text-center w-full bg-white text-emerald-900 hover:bg-emerald-100 py-4 rounded-2xl font-extrabold text-sm transition-all duration-300">{{ $schema->cta_text ?? 'Hubungi Kami' }}</a>
                            </div>
                        </div>
                    @else
                        <!-- Regular Card -->
                        <div class="group relative flex h-full min-h-[560px] flex-col overflow-hidden rounded-[32px] border border-emerald-800/50 bg-[#0A2F1D] p-8 shadow-lg transition-all duration-300 hover:-translate-y-3 hover:border-emerald-500/60 hover:shadow-[0_28px_70px_rgba(4,55,34,0.28)] md:p-10">
                            <div class="flex justify-between items-start mb-8">
                                @if ($schema->badge)
                                    @if ($loop->iteration == 3)
                                        <div class="bg-white/10 border border-white/20 text-emerald-100 font-bold text-xs px-4 py-1.5 rounded-full inline-block">{{ $schema->badge }}</div>
                                    @else
                                        <div class="bg-emerald-200 text-emerald-950 font-bold text-xs px-4 py-1.5 rounded-full">{{ $schema->badge }}</div>
                                    @endif
                                @else
                                    <div></div>
                                @endif
                                @if ($schema->icon)
                                <div class="w-10 h-10 bg-emerald-900/50 rounded-full flex items-center justify-center text-emerald-400 shrink-0 ml-2">
                                    <i data-lucide="{{ $schema->icon }}" class="w-5 h-5"></i>
                                </div>
                                @endif
                            </div>
                            <div class="relative z-10 flex flex-1 flex-col">
                                <h3 class="font-sans text-2xl font-bold text-white mb-2 pr-4">{{ $schema->skema }}</h3>
                                <p class="text-emerald-200/80 text-sm mb-6">{{ $schema->subtitle }}</p>
                                <div class="mb-8">
                                    <span class="text-2xl font-bold text-emerald-400">Rp {{ number_format($schema->harga, 0, ',', '.') }}</span>
                                    <span class="block text-emerald-400/80 text-sm mt-1">{{ $schema->satuan }}</span>
                                </div>
                                <ul class="space-y-4 flex-1 mb-10">
                                    @php
                                        $features = is_string($schema->features) ? json_decode($schema->features, true) : (is_array($schema->features) ? $schema->features : []);
                                    @endphp
                                    @if($features)
                                        @foreach ($features as $item)
                                        <li class="flex items-start gap-3">
                                            <i data-lucide="circle-check" class="w-5 h-5 text-emerald-400 mt-0.5 flex-shrink-0"></i>
                                            <span class="text-sm text-emerald-100/90 leading-relaxed">{{ $item }}</span>
                                        </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <a href="{{ route('customer.checkout', $schema) }}" class="block text-center w-full border-2 border-emerald-600 text-emerald-400 hover:bg-emerald-600 hover:text-white py-4 rounded-2xl font-bold text-sm transition-all duration-300">{{ $schema->cta_text ?? 'Hubungi Kami' }}</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-24 bg-white text-[#041706]" id="faq">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-12">
                <span class="text-[10px] bg-emerald-500/10 text-emerald-600 border border-emerald-500/25 px-3 py-1 rounded-full font-bold uppercase tracking-widest">Bantuan &amp; Informasi</span>
                <h2 class="mt-3 font-sans text-3xl sm:text-4xl font-extrabold text-emerald-950 tracking-tight mb-3">Pertanyaan Umum</h2>
                <p class="font-sans text-sm sm:text-base text-emerald-800 max-w-xl mx-auto leading-relaxed">Temukan jawaban cepat atas aspek teknis, operasional, dan efisiensi sistem konversi energi kami.</p>
            </div>

            <div class="space-y-4">
                @php
                    $faqs = [
                        ['q' => 'Berapa banyak kotoran sapi yang dibutuhkan?', 'a' => 'Untuk satu unit MicroCell standar, kami merekomendasikan limbah dari 2-5 ekor sapi (sekitar 30-50 kg limbah basah per hari) untuk menghasilkan daya listrik optimal.'],
                        ['q' => 'Berapa lama alat ini bertahan (lifespan)?', 'a' => 'Komponen utama seperti tabung reaktor dan panel surya (BPFC) dirancang bertahan hingga 10-15 tahun. Komponen elektroda (anoda/katoda) dan baterai mungkin perlu diganti setiap 3-5 tahun sekali.'],
                        ['q' => 'Apakah butuh perawatan harian yang rumit?', 'a' => 'Tidak. Sistem MicroCell bekerja secara kontinyu. Anda hanya perlu menyalurkan limbah baru ke dalam saluran input dan membuang lumpur sisa (sludge) yang sudah tidak aktif sebulan sekali (yang dapat dijadikan pupuk kompos berkualitas tinggi).'],
                        ['q' => 'Bagaimana jika saya tidak mengerti teknologi IoT?', 'a' => 'Sangat mudah digunakan! Tim kami akan melakukan instalasi dan setup awal hingga aplikasi MicroCell terhubung ke handphone Anda. Anda hanya perlu membuka aplikasi untuk melihat status daya layaknya mengecek sisa baterai HP.'],
                    ];
                @endphp
                @foreach ($faqs as $i => $faq)
                <div class="border-2 border-emerald-500/20 rounded-2xl overflow-hidden transition-all duration-300" :class="activeIndex === {{ $i }} ? 'bg-emerald-50 border-emerald-500/40 shadow-md' : 'bg-white hover:border-emerald-500/40'">
                    <button @click="activeIndex = activeIndex === {{ $i }} ? null : {{ $i }}" type="button" class="w-full flex items-center justify-between p-6 text-left focus:outline-none cursor-pointer">
                        <span class="font-sans text-sm sm:text-base font-bold text-emerald-950 pr-4">{{ $faq['q'] }}</span>
                        <div class="h-8 w-8 rounded-full flex items-center justify-center bg-emerald-100/50 text-emerald-600 transition-transform duration-300" :class="activeIndex === {{ $i }} ? 'rotate-180 bg-emerald-500 text-white' : ''">
                            <i data-lucide="chevron-down" class="w-5 h-5"></i>
                        </div>
                    </button>
                    <div x-show="activeIndex === {{ $i }}" x-collapse style="display: none;" class="transition-all duration-300 ease-in-out">
                        <div class="p-6 pt-0">
                            <p class="text-sm text-emerald-800 leading-relaxed font-sans">{{ $faq['a'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-emerald-950 text-emerald-100 pt-20 pb-10 border-t border-emerald-500/10">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="md:col-span-1">
                    <div class="flex items-center gap-2 mb-6">
                        <img src="/assets/images/logo.png" alt="MicroCell Logo" class="h-8 w-8 rounded-lg object-cover shadow-md" />
                        <span class="font-sans text-lg font-black text-white tracking-tight">Micro<span class="text-emerald-400">Cell</span></span>
                    </div>
                    <p class="text-xs text-emerald-300/70 leading-relaxed font-sans mb-6">
                        Membangun kedaulatan energi nasional mandiri melalui inovasi teknologi biokimia berkelanjutan berbasis kearifan lokal peternakan Nusantara.
                    </p>
                </div>
                <div>
                    <h4 class="font-sans text-sm font-bold text-white mb-6 tracking-wide">Navigasi</h4>
                    <ul class="space-y-3 text-xs text-emerald-300/70 font-sans">
                        <li><a href="#about" class="hover:text-emerald-400 hover:underline transition-all">Tentang Kami</a></li>
                        <li><a href="#how-it-works" class="hover:text-emerald-400 hover:underline transition-all">Cara Kerja Sistem</a></li>
                        <li><a href="#benefits" class="hover:text-emerald-400 hover:underline transition-all">Manfaat Sosio-Ekologis</a></li>
                        <li><a href="#products" class="hover:text-emerald-400 hover:underline transition-all">Pilihan Skala Solusi</a></li>
                        <li><a href="#faq" class="hover:text-emerald-400 hover:underline transition-all">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-sans text-sm font-bold text-white mb-6 tracking-wide">Dukungan Target SDG</h4>
                    <div class="flex flex-col gap-2 mb-4">
                        <div class="bg-[#F39200] text-white px-3 py-1.5 rounded text-[10px] font-extrabold uppercase tracking-wide w-max shadow-sm">SDG 7: Affordable Energy</div>
                        <div class="bg-[#BF8B2E] text-white px-3 py-1.5 rounded text-[10px] font-extrabold uppercase tracking-wide w-max shadow-sm">SDG 12: Responsible Consumption</div>
                        <div class="bg-[#3F7E44] text-white px-3 py-1.5 rounded text-[10px] font-extrabold uppercase tracking-wide w-max shadow-sm">SDG 13: Climate Action</div>
                    </div>
                </div>
                <div>
                    <h4 class="font-sans text-sm font-bold text-white mb-6 tracking-wide">Hubungi Kami</h4>
                    <p class="text-xs text-emerald-300/70 mb-6 font-sans leading-relaxed">Ada pertanyaan terkait kelayakan teknis atau ingin merancang survei peternakan komunal Anda?</p>
                    <a href="#" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-[#16A34A] hover:bg-emerald-500 text-white px-5 py-3 rounded-full text-xs font-bold transition-all">
                        Kontak Via WhatsApp
                    </a>
                </div>
            </div>
            <div class="pt-8 border-t border-emerald-900 flex flex-col md:flex-row justify-between items-center gap-4 text-[11px] text-emerald-500 font-sans">
                <p>© 2026 MicroCell. Regenerative Energy for a Greener Future. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-emerald-300 hover:underline">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-emerald-300 hover:underline">Syarat &amp; Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

</div>
@endsection

@push('scripts')
<script>
    // Hero Canvas Animation
    const canvas = document.getElementById('heroCanvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        let width = canvas.width = canvas.offsetWidth;
        let height = canvas.height = canvas.offsetHeight;
        let particles = [];
        
        function initParticles() {
            particles = [];
            const count = Math.min(Math.floor(width / 20), 45);
            for (let i = 0; i < count; i++) {
                particles.push({
                    x: Math.random() * width,
                    y: Math.random() * height,
                    radius: Math.random() * 4 + 1.5,
                    color: i % 2 === 0 ? '74, 222, 128' : '45, 212, 191',
                    speedY: -(Math.random() * 0.5 + 0.2),
                    speedX: (Math.random() - 0.5) * 0.3,
                    alpha: Math.random() * 0.5 + 0.2,
                    pulseSpeed: Math.random() * 0.02 + 0.01,
                });
            }
        }
        initParticles();

        let mouse = { x: -1000, y: -1000 };
        canvas.addEventListener('mousemove', e => {
            const rect = canvas.getBoundingClientRect();
            mouse.x = e.clientX - rect.left;
            mouse.y = e.clientY - rect.top;
        });
        canvas.addEventListener('mouseleave', () => { mouse = { x: -1000, y: -1000 }; });

        function animate() {
            ctx.clearRect(0, 0, width, height);
            particles.forEach(p => {
                p.alpha += p.pulseSpeed;
                if (p.alpha > 0.8 || p.alpha < 0.1) p.pulseSpeed = -p.pulseSpeed;
                p.y += p.speedY; p.x += p.speedX;
                if (p.y < -20) { p.y = height + 20; p.x = Math.random() * width; }
                if (p.x < -20 || p.x > width + 20) p.speedX = -p.speedX;

                const dx = p.x - mouse.x;
                const dy = p.y - mouse.y;
                const dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 120) {
                    const force = (120 - dist) / 120;
                    p.x += (dx / dist) * force * 1.5;
                    p.y += (dy / dist) * force * 1.5;
                }

                ctx.beginPath();
                const radGrad = ctx.createRadialGradient(p.x, p.y, 0, p.x, p.y, p.radius * 2);
                radGrad.addColorStop(0, `rgba(${p.color}, ${p.alpha})`);
                radGrad.addColorStop(1, `rgba(${p.color}, 0)`);
                ctx.fillStyle = radGrad;
                ctx.arc(p.x, p.y, p.radius * 3, 0, Math.PI * 2);
                ctx.fill();
            });

            ctx.strokeStyle = 'rgba(52, 211, 153, 0.05)';
            ctx.lineWidth = 0.8;
            for (let i = 0; i < particles.length; i++) {
                for (let j = i + 1; j < particles.length; j++) {
                    const dx = particles[i].x - particles[j].x;
                    const dy = particles[i].y - particles[j].y;
                    const d = Math.sqrt(dx * dx + dy * dy);
                    if (d < 100) {
                        ctx.beginPath();
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        ctx.stroke();
                    }
                }
            }
            requestAnimationFrame(animate);
        }
        animate();
        window.addEventListener('resize', () => {
            width = canvas.width = canvas.offsetWidth;
            height = canvas.height = canvas.offsetHeight;
            initParticles();
        });
    }
</script>
@endpush
