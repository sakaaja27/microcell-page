@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
    <div class="space-y-6">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Dashboard Overview</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                    <i data-lucide="activity" class="w-7 h-7 text-emerald-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Alat</p>
                    <h3 class="text-2xl font-bold text-slate-900 mt-1">{{ number_format($metrics->total_alat, 0, ',', '.') }}</h3>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center shrink-0">
                    <i data-lucide="users" class="w-7 h-7 text-green-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Pengguna</p>
                    <h3 class="text-2xl font-bold text-slate-900 mt-1">{{ number_format($metrics->total_pengguna, 0, ',', '.') }}</h3>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                    <i data-lucide="dollar-sign" class="w-7 h-7 text-emerald-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Pendapatan</p>
                    <h3 class="text-2xl font-bold text-slate-900 mt-1">Rp {{ number_format(round($metrics->total_pendapatan / 1000000)) }}M</h3>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                    <i data-lucide="shopping-bag" class="w-7 h-7 text-emerald-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Pesanan Terbaru</p>
                    <h3 class="text-2xl font-bold text-slate-900 mt-1">{{ number_format($metrics->pesanan_terbaru, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h2 class="text-lg font-semibold mb-4 text-slate-800">Transaksi Selama Setahun</h2>
                <div class="h-80">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h2 class="text-lg font-semibold mb-4 text-slate-800">Sebaran Skema Pengguna</h2>
                <div class="h-80">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h2 class="text-lg font-semibold text-slate-800">5 Pesanan Terbaru</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-slate-500 uppercase bg-slate-50/50">
                            <tr>
                                <th class="px-6 py-4 font-medium">Kode Order</th>
                                <th class="px-6 py-4 font-medium">Pelanggan</th>
                                <th class="px-6 py-4 font-medium">Skema</th>
                                <th class="px-6 py-4 font-medium">Total</th>
                                <th class="px-6 py-4 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($recentOrders as $order)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-slate-900">{{ $order->id }}</td>
                                    <td class="px-6 py-4">{{ $order->customer }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                            {{ $order->skema }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-slate-700">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusStyles = [
                                                'Selesai' => 'bg-emerald-100 text-emerald-700',
                                                'Proses' => 'bg-amber-100 text-amber-700',
                                                'Menunggu' => 'bg-slate-100 text-slate-700',
                                                'Dibatalkan' => 'bg-red-100 text-red-700',
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusStyles[$order->status] ?? 'bg-slate-100 text-slate-700' }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h2 class="text-lg font-semibold text-slate-800">Agenda Terkait</h2>
                </div>
                <div class="p-6 space-y-4">
                    @foreach ($agendas as $agenda)
                        @php
                            [$day, $month] = explode('-', $agenda->date);
                        @endphp
                        <div class="flex items-start gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100 hover:border-emerald-200 hover:shadow-md transition-all">
                            <div class="w-12 h-12 rounded-lg bg-emerald-100 flex flex-col items-center justify-center shrink-0">
                                <span class="text-xs font-bold text-emerald-600">{{ $day }}</span>
                                <span class="text-[10px] font-medium text-emerald-500 uppercase">{{ $month }}</span>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-slate-900">{{ $agenda->title }}</h3>
                                <p class="text-xs text-slate-500 mt-1">{{ $agenda->time }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
    const lineCtx = document.getElementById('lineChart');
    const pieCtx = document.getElementById('pieChart');

    const lineData = @json($transactionData);
    const pieData = @json($schemaData);

    if (lineCtx) {
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: lineData.map(d => d.name),
                datasets: [{
                    label: 'Total',
                    data: lineData.map(d => d.total),
                    borderColor: '#10b981',
                    borderWidth: 3,
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    fill: false,
                    pointRadius: 4,
                    pointBackgroundColor: '#10b981',
                    pointBorderColor: '#10b981',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#ffffff',
                        titleColor: '#1e293b',
                        bodyColor: '#334155',
                        borderColor: '#e2e8f0',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 12,
                        boxShadow: '0 4px 6px -1px rgb(0 0 0 / 0.1)',
                        displayColors: false
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        border: { display: false },
                        ticks: { color: '#64748b' }
                    },
                    y: {
                        grid: { color: '#e2e8f0', borderDash: [3, 3] },
                        border: { display: false },
                        ticks: { color: '#64748b' }
                    }
                }
            }
        });
    }

    if (pieCtx) {
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: pieData.map(d => d.name),
                datasets: [{
                    data: pieData.map(d => d.value),
                    backgroundColor: ['#10b981', '#059669', '#34d399'],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                spacing: 5,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            boxWidth: 8,
                            padding: 16,
                            color: '#334155'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#ffffff',
                        titleColor: '#1e293b',
                        bodyColor: '#334155',
                        borderColor: '#e2e8f0',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 12,
                        displayColors: true
                    }
                }
            }
        });
    }
</script>
@endpush