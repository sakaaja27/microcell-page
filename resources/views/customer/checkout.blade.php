<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - {{ $schema->skema }}</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-[#041706] font-sans text-slate-200">
    <!-- Navbar -->
    <nav class="fixed top-0 inset-x-0 z-50 bg-[#041706]/80 backdrop-blur-md border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-emerald-400 font-bold text-xl tracking-tight hover:text-emerald-300 transition-colors">
                <i data-lucide="leaf" class="w-6 h-6"></i> MicroCell
            </a>
            <div class="flex items-center gap-4">
                <a href="{{ route('customer.history') }}" class="text-sm font-semibold text-emerald-100/70 hover:text-white transition-colors">Riwayat Transaksi</a>
            </div>
        </div>
    </nav>

    <div class="pt-32 pb-24 max-w-5xl mx-auto px-6">
        <div class="mb-10 text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">Selesaikan Pesanan Anda</h1>
            <p class="text-emerald-100/70">Pastikan detail pesanan sudah sesuai sebelum melakukan pembayaran.</p>
        </div>

        @if (session('error'))
            <div class="mb-8 p-4 bg-red-500/10 border border-red-500/30 rounded-2xl flex items-center gap-3 text-red-400">
                <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>
                <p class="font-medium text-sm">{{ session('error') }}</p>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-8 p-4 bg-emerald-500/10 border border-emerald-500/30 rounded-2xl flex items-center gap-3 text-emerald-400">
                <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
                <p class="font-medium text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <form action="{{ route('customer.checkout.store', $schema) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            @csrf
            
            <!-- Kiri: Detail Produk -->
            <div class="lg:col-span-7 space-y-6">
                <!-- Rincian -->
                <div class="bg-[#0A2F1D] border border-emerald-800/50 rounded-[24px] p-8 shadow-xl">
                    <h2 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                        <i data-lucide="package" class="w-5 h-5 text-emerald-400"></i> Detail Paket
                    </h2>
                    
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-5 bg-[#041706]/50 rounded-2xl border border-emerald-900/30">
                        <div>
                            <div class="text-xs font-bold text-emerald-400 mb-1 tracking-wider uppercase">{{ $schema->badge ?? 'Paket' }}</div>
                            <h3 class="text-xl font-bold text-white">{{ $schema->skema }}</h3>
                            <p class="text-emerald-100/60 text-sm mt-1">{{ $schema->subtitle }}</p>
                        </div>
                        <div class="mt-4 md:mt-0 text-right">
                            <div class="text-2xl font-black text-emerald-300">Rp {{ number_format($schema->harga, 0, ',', '.') }}</div>
                            <div class="text-xs text-emerald-100/50 mt-1">{{ $schema->satuan }}</div>
                        </div>
                    </div>

                    @if(isset($subscription) && $subscription)
                        <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
                        <input type="hidden" name="qty" id="qty" value="{{ $subscription->order->qty ?? 1 }}">
                        <input type="hidden" name="duration" id="duration" value="{{ $subscription->order->duration ?? 1 }}">
                        <div class="mt-6 p-4 bg-[#041706]/80 border border-emerald-800/50 rounded-xl space-y-2 text-sm text-emerald-100/80">
                            <p class="font-bold text-emerald-400 mb-3"><i data-lucide="info" class="w-4 h-4 inline-block mr-1"></i> Pembayaran Tagihan Sewa</p>
                            <div class="flex justify-between border-b border-emerald-900/50 pb-2">
                                <span>Jumlah Alat</span>
                                <strong class="text-white">{{ $subscription->order->qty ?? 1 }} Unit</strong>
                            </div>
                            <div class="flex justify-between pt-1">
                                <span>Total Kontrak</span>
                                <strong class="text-white">{{ $subscription->total_months }} Bulan</strong>
                            </div>
                        </div>
                    @elseif(stripos($schema->skema, 'sewa') !== false || stripos($schema->satuan, 'bulan') !== false)
                        <div class="mt-6 space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-emerald-100 mb-2">Jumlah Alat</label>
                                <input type="number" name="qty" id="qty" value="1" min="1" class="w-32 bg-[#041706] border border-emerald-800/50 text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent p-3 text-center text-lg font-bold" required onchange="updateTotal()">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-emerald-100 mb-2">Durasi Sewa (Bulan)</label>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    <button type="button" onclick="setDuration(1)" class="px-4 py-2 bg-[#041706] border border-emerald-800/50 rounded-xl text-sm font-bold text-emerald-100 hover:bg-emerald-900/50 transition-colors">1 Bulan</button>
                                    <button type="button" onclick="setDuration(5)" class="px-4 py-2 bg-[#041706] border border-emerald-800/50 rounded-xl text-sm font-bold text-emerald-100 hover:bg-emerald-900/50 transition-colors">5 Bulan</button>
                                    <button type="button" onclick="setDuration(12)" class="px-4 py-2 bg-[#041706] border border-emerald-800/50 rounded-xl text-sm font-bold text-emerald-100 hover:bg-emerald-900/50 transition-colors">12 Bulan</button>
                                </div>
                                <input type="number" name="duration" id="duration" value="1" min="1" class="w-full bg-[#041706] border border-emerald-800/50 text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent p-3 text-lg font-bold" required onchange="updateTotal()" placeholder="Atau isi jumlah bulan">
                            </div>
                        </div>
                    @else
                        <div class="mt-6">
                            <label class="block text-sm font-bold text-emerald-100 mb-2">Jumlah (Qty)</label>
                            <input type="number" name="qty" id="qty" value="1" min="1" class="w-32 bg-[#041706] border border-emerald-800/50 text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent p-3 text-center text-lg font-bold" required onchange="updateTotal()">
                        </div>
                    @endif
                </div>

                <!-- Metode Pembayaran -->
                <div class="bg-[#0A2F1D] border border-emerald-800/50 rounded-[24px] p-8 shadow-xl">
                    <h2 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                        <i data-lucide="credit-card" class="w-5 h-5 text-emerald-400"></i> Pilih Metode Pembayaran
                    </h2>
                    <div class="space-y-3">
                        @foreach ($paymentMethods as $payment)
                        @php
                            $qrUrl = $payment->qr ? (str_starts_with($payment->qr, 'http') ? $payment->qr : asset('storage/' . $payment->qr)) : '';
                        @endphp
                        <label class="relative flex items-center p-4 border border-emerald-800/50 rounded-2xl cursor-pointer hover:bg-emerald-900/20 transition-colors">
                            <input type="radio" name="payment_method_id" value="{{ $payment->id }}" class="peer sr-only" required onchange="showPaymentInfo('{{ $qrUrl }}')">
                            <div class="w-5 h-5 rounded-full border-2 border-emerald-700 peer-checked:border-emerald-400 peer-checked:bg-emerald-400 mr-4 flex items-center justify-center transition-colors">
                                <div class="w-2 h-2 rounded-full bg-[#0A2F1D]"></div>
                            </div>
                            <div class="flex-1">
                                <div class="font-bold text-white">{{ $payment->nama }}</div>
                                <div class="text-sm text-emerald-200/60">{{ $payment->jenis }} - {{ $payment->va }}</div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Bukti Pembayaran -->
                <div class="bg-[#0A2F1D] border border-emerald-800/50 rounded-[24px] p-8 shadow-xl">
                    <h2 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                        <i data-lucide="upload-cloud" class="w-5 h-5 text-emerald-400"></i> Upload Bukti Pembayaran
                    </h2>

                    <!-- Tampilan QR Code (Dinamis) -->
                    <div id="qrCodeContainer" class="hidden mb-6 flex flex-col items-center justify-center p-4 bg-white rounded-2xl w-fit">
                        <p class="text-emerald-950 font-bold mb-2 text-sm text-center">Scan QR Code ini</p>
                        <img id="qrCodeImage" src="" alt="QR Code" class="w-48 h-48 object-contain">
                    </div>

                    <p class="text-sm text-emerald-100/70 mb-4">Silakan transfer sesuai nominal total ke metode yang dipilih, lalu unggah struk di sini.</p>
                    <input type="file" name="image" accept="image/*" required class="block w-full text-sm text-emerald-100/70 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-emerald-500 file:text-emerald-950 hover:file:bg-emerald-400 cursor-pointer bg-[#041706] rounded-full border border-emerald-800/50">
                    @error('image')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Kanan: Summary -->
            <div class="lg:col-span-5 sticky top-28">
                <div class="bg-emerald-950/40 backdrop-blur-xl border border-emerald-500/30 rounded-[32px] p-8 shadow-2xl relative overflow-hidden">
                    <div class="absolute -top-24 -right-24 w-48 h-48 bg-emerald-500/20 blur-[60px] rounded-full"></div>
                    
                    <h3 class="text-xl font-bold text-white mb-6 relative z-10">Ringkasan Pesanan</h3>
                    
                    <div class="space-y-4 mb-6 relative z-10">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-emerald-100/70">Harga Satuan</span>
                            <span class="font-bold text-white" id="hargaSatuan" data-harga="{{ $schema->harga }}">Rp {{ number_format($schema->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-emerald-100/70">Jumlah</span>
                            <span class="font-bold text-white" id="qtyText">1x</span>
                        </div>
                        <div class="h-px bg-emerald-800/50 w-full my-4"></div>
                        <div class="flex justify-between items-end">
                            <span class="font-bold text-emerald-100">Total Pembayaran</span>
                            <span class="text-3xl font-black text-emerald-400" id="totalHarga">Rp {{ number_format($schema->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <button type="submit" class="relative z-10 w-full bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-bold rounded-2xl py-4 transition-all shadow-[0_0_20px_rgba(16,185,129,0.3)] hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] active:scale-[0.98]">
                        Kirim Pesanan Sekarang
                    </button>
                    
                    <p class="text-center text-xs text-emerald-200/50 mt-4 relative z-10">
                        Pesanan akan diproses maksimal 1x24 jam kerja setelah pembayaran dikonfirmasi.
                    </p>
                </div>
            </div>
        </form>
    </div>

    <script>
        lucide.createIcons();

        function setDuration(val) {
            document.getElementById('duration').value = val;
            updateTotal();
        }

        function updateTotal() {
            const qty = parseInt(document.getElementById('qty').value) || 1;
            const durationInput = document.getElementById('duration');
            const duration = durationInput ? (parseInt(durationInput.value) || 1) : 1;
            
            const harga = parseInt(document.getElementById('hargaSatuan').getAttribute('data-harga'));
            const total = qty * harga; // Pay per month
            
            let qtyText = qty + 'x';
            if (durationInput) {
                qtyText = qty + ' Unit (Kontrak ' + duration + ' Bulan)';
            }
            
            document.getElementById('qtyText').innerText = qtyText;
            document.getElementById('totalHarga').innerText = 'Rp ' + total.toLocaleString('id-ID');
        }

        function showPaymentInfo(qrUrl) {
            const container = document.getElementById('qrCodeContainer');
            const img = document.getElementById('qrCodeImage');
            if (qrUrl) {
                img.src = qrUrl;
                container.classList.remove('hidden');
            } else {
                container.classList.add('hidden');
                img.src = '';
            }
        }
    </script>
</body>
</html>
