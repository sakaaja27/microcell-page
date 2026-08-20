@extends('layouts.admin')

@section('title', 'Metode Pembayaran')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Metode Pembayaran</h1>
            <button onclick="openPaymentModal()" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors shadow-sm">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Metode
            </button>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-slate-500 uppercase bg-slate-50/50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 font-medium">Nama Metode</th>
                            <th class="px-6 py-4 font-medium">Jenis Metode</th>
                            <th class="px-6 py-4 font-medium">VA / Nomor</th>
                            <th class="px-6 py-4 font-medium">QR Code</th>
                            <th class="px-6 py-4 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($payments as $method)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-900">{{ $method->nama }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize {{ $method->jenis === 'Qris' ? 'bg-purple-100 text-purple-700' : ($method->jenis === 'Transfer bank' || $method->jenis === 'e wallet' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700') }}">
                                        {{ $method->jenis }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-600 font-mono text-sm">{{ $method->va }}</td>
                                <td class="px-6 py-4">
                                    @if ($method->qr)
                                        <div class="w-12 h-12 bg-white border border-slate-200 p-1 rounded-lg">
                                            <img src="{{ $method->qr }}" alt="QR Code" class="w-full h-full object-contain" />
                                        </div>
                                    @else
                                        <span class="text-slate-400 text-xs italic">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button onclick="openPaymentModal({{ $method->id }}, '{{ $method->nama }}', '{{ $method->jenis }}', '{{ $method->va }}', '{{ $method->qr }}')" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Edit">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="openConfirmModal('{{ route('admin.payments.destroy', $method) }}')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="paymentModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden flex flex-col max-h-[90vh]">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <h2 id="paymentModalTitle" class="text-lg font-bold text-slate-900">Tambah Metode Pembayaran</h2>
                <button onclick="closeModal('paymentModal')" class="text-slate-400 hover:text-slate-600 p-2 hover:bg-slate-100 rounded-full transition-colors">
                    ✕
                </button>
            </div>
            <form id="paymentForm" method="POST" action="{{ route('admin.payments.store') }}">
                @csrf
                <div class="p-6 overflow-y-auto space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Metode</label>
                        <input type="text" name="nama" id="paymentNama" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" placeholder="BCA Virtual Account" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Jenis Metode</label>
                        <select name="jenis" id="paymentJenis" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3">
                            <option value="Transfer bank">Transfer bank</option>
                            <option value="Qris">Qris</option>
                            <option value="e wallet">e wallet</option>
                            <option value="tunai">tunai</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">VA / Nomor</label>
                        <input type="text" name="va" id="paymentVa" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" placeholder="014 8392 8392" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">QR Code URL (opsional)</label>
                        <input type="url" name="qr" id="paymentQr" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" placeholder="https://..." />
                    </div>
                </div>
                <div class="p-6 border-t border-slate-100 flex justify-end gap-3 bg-slate-50">
                    <button type="button" onclick="closeModal('paymentModal')" class="px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition-colors shadow-sm">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function openPaymentModal(id = null, nama = '', jenis = 'Transfer bank', va = '', qr = '') {
        const form = document.getElementById('paymentForm');
        if (id) {
            form.action = '/admin/metode-pembayaran/' + id;
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);
            document.getElementById('paymentModalTitle').textContent = 'Edit Metode Pembayaran';
        } else {
            form.action = '{{ route('admin.payments.store') }}';
            form.querySelector('input[name="_method"]')?.remove();
            document.getElementById('paymentModalTitle').textContent = 'Tambah Metode Pembayaran';
        }
        document.getElementById('paymentNama').value = nama;
        document.getElementById('paymentJenis').value = jenis;
        document.getElementById('paymentVa').value = va;
        document.getElementById('paymentQr').value = qr;
        openModal('paymentModal');
    }
</script>
@endpush