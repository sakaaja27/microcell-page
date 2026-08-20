@extends('layouts.admin')

@section('title', 'Data Langganan')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Langganan Aktif</h1>
            <p class="text-sm text-slate-500 mt-1">Pantau status sewa dan jatuh tempo pelanggan.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center gap-3 text-emerald-700">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            <p class="font-medium text-sm">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/80 text-slate-500">
                        <th class="py-4 px-6 font-semibold">Pelanggan</th>
                        <th class="py-4 px-6 font-semibold">Skema Layanan</th>
                        <th class="py-4 px-6 font-semibold">Mulai Sewa</th>
                        <th class="py-4 px-6 font-semibold">Jatuh Tempo</th>
                        <th class="py-4 px-6 font-semibold">Status</th>
                        <th class="py-4 px-6 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($subscriptions as $sub)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-4 px-6">
                                <div class="font-semibold text-slate-900">{{ $sub->customer->nama ?? 'Unknown' }}</div>
                                <div class="text-slate-500 text-xs">{{ $sub->customer->email ?? '' }}</div>
                            </td>
                            <td class="py-4 px-6 font-medium text-slate-700">{{ $sub->schema->skema ?? 'N/A' }}</td>
                            <td class="py-4 px-6 text-slate-600">{{ $sub->started_at ? \Carbon\Carbon::parse($sub->started_at)->format('d M Y') : '-' }}</td>
                            <td class="py-4 px-6">
                                @php
                                    $isPastDue = $sub->next_billing_date && \Carbon\Carbon::parse($sub->next_billing_date)->isPast();
                                @endphp
                                <span class="{{ $isPastDue ? 'text-red-600 font-bold' : 'text-slate-600' }}">
                                    {{ $sub->next_billing_date ? \Carbon\Carbon::parse($sub->next_billing_date)->format('d M Y') : '-' }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    {{ $sub->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <form action="{{ route('admin.subscriptions.bill', $sub) }}" method="POST" onsubmit="return confirm('Buat tagihan bulan berikutnya untuk pelanggan ini?')">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-blue-600 hover:bg-blue-50 rounded-lg transition-colors border border-transparent hover:border-blue-100" title="Buat Tagihan">
                                        <i data-lucide="receipt" class="w-4 h-4"></i>
                                        <span>Buat Tagihan</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i data-lucide="calendar-off" class="w-12 h-12 text-slate-300 mb-3"></i>
                                    <p class="text-base font-medium text-slate-600">Belum ada pelanggan sewa</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
