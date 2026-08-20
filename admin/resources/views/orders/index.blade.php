@extends('layouts.admin')

@section('title', 'Pesanan')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Pesanan</h1>
            <button onclick="openOrderModal()" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors shadow-sm">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Pesanan
            </button>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <div class="relative max-w-sm w-full">
                    <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" id="searchInput" placeholder="Cari pesanan..." class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 text-sm rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all shadow-sm" onkeyup="searchTable()">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left" id="dataTable">
                    <thead class="text-xs text-slate-500 uppercase bg-slate-50/50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 font-medium w-16">No</th>
                            <th class="px-6 py-4 font-medium">Kode Order</th>
                            <th class="px-6 py-4 font-medium">Pelanggan</th>
                            <th class="px-6 py-4 font-medium">Skema</th>
                            <th class="px-6 py-4 font-medium">Qty</th>
                            <th class="px-6 py-4 font-medium">Total Harga</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 font-medium">Tanggal</th>
                            <th class="px-6 py-4 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($orders as $order)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-medium text-slate-900 search-target">{{ $order->id }}</td>
                                <td class="px-6 py-4 text-slate-700 search-target">{{ $order->customer }}</td>
                                <td class="px-6 py-4 text-slate-600 search-target">{{ $order->skema }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $order->qty }}</td>
                                <td class="px-6 py-4 font-semibold text-slate-700">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 search-target">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->status === 'Selesai' || $order->status === 'Proses' ? 'bg-emerald-100 text-emerald-700' : ($order->status === 'Menunggu' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-500 whitespace-nowrap search-target">{{ $order->tanggal }}</td>
                                <td class="px-6 py-4 text-right space-x-1 whitespace-nowrap">
                                    <button onclick="openDetailModal(this)" data-id="{{ $order->id }}" data-customer="{{ $order->customer->nama ?? 'Unknown' }}" data-total="Rp {{ number_format($order->total, 0, ',', '.') }}" data-tanggal="{{ $order->tanggal }}" data-status="{{ $order->status }}" data-image="{{ $order->image }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-slate-600 hover:bg-slate-50 rounded-lg transition-colors border border-transparent hover:border-slate-200" title="Detail">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                        <span>Detail</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($orders->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $orders->links() }}
            </div>
            @endif
        </div>
    </div>

    <div id="detailModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden flex flex-col max-h-[90vh]">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-900">Detail Pesanan</h2>
                <button onclick="closeModal('detailModal')" class="text-slate-400 hover:text-slate-600 p-2 hover:bg-slate-100 rounded-full transition-colors">
                    ✕
                </button>
            </div>

            <div class="p-6 overflow-y-auto space-y-6">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-slate-500 mb-1">Kode Order</p>
                        <p class="font-semibold text-slate-900" id="modalId"></p>
                    </div>
                    <div>
                        <p class="text-slate-500 mb-1">Pelanggan</p>
                        <p class="font-semibold text-slate-900" id="modalCustomer"></p>
                    </div>
                    <div>
                        <p class="text-slate-500 mb-1">Total</p>
                        <p class="font-semibold text-slate-900" id="modalTotal"></p>
                    </div>
                    <div>
                        <p class="text-slate-500 mb-1">Tanggal</p>
                        <p class="font-semibold text-slate-900" id="modalTanggal"></p>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-medium text-slate-700">Ubah Status</label>
                    <select id="modalStatus" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3">
                        <option value="Menunggu">Menunggu</option>
                        <option value="Proses">Proses</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Dibatalkan">Dibatalkan</option>
                    </select>
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-medium text-slate-700 flex items-center gap-2">
                        <i data-lucide="file-image" class="w-4 h-4"></i> Bukti Pembayaran
                    </label>
                    <div class="border-2 border-dashed border-slate-200 rounded-xl p-2 bg-slate-50">
                        <img id="modalImage" src="" alt="Bukti Transfer" class="w-full h-auto max-h-64 object-contain rounded-lg" />
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-slate-100 flex justify-end gap-3 bg-slate-50">
                <button onclick="closeModal('detailModal')" class="px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <button onclick="saveStatus()" class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition-colors shadow-sm">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </div>

    <form id="statusForm" method="POST" action="" class="hidden">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" id="statusInput" />
    </form>
@endsection

@push('scripts')
<script>
    let currentOrderId = null;

    function openDetailModal(btn) {
        currentOrderId = btn.dataset.id;
        document.getElementById('modalId').textContent = btn.dataset.id;
        document.getElementById('modalCustomer').textContent = btn.dataset.customer;
        document.getElementById('modalTotal').textContent = btn.dataset.total;
        document.getElementById('modalTanggal').textContent = btn.dataset.tanggal;
        document.getElementById('modalStatus').value = btn.dataset.status;
        
        const img = document.getElementById('modalImage');
        if (btn.dataset.image) {
            img.src = btn.dataset.image;
            img.parentElement.style.display = 'block';
        } else {
            img.src = '';
            img.parentElement.style.display = 'none';
        }
        
        openModal('detailModal');
        lucide.createIcons();
    }

    function saveStatus() {
        const form = document.getElementById('statusForm');
        form.action = '/admin/pesanan/' + currentOrderId + '/status';
        document.getElementById('statusInput').value = document.getElementById('modalStatus').value;
        form.submit();
    }
</script>
@endpush