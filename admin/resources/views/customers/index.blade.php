@extends('layouts.admin')

@section('title', 'Data Customer')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Data Customer</h1>

            <div class="flex items-center gap-3">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i data-lucide="search" class="w-4 h-4 text-slate-400"></i>
                    </div>
                    <input
                        type="text"
                        id="customerSearch"
                        oninput="filterCustomers(this.value)"
                        class="bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-64 pl-10 p-2.5 shadow-sm"
                        placeholder="Cari customer..."
                    />
                </div>
                <button onclick="openCustomerModal()" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors shadow-sm">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Tambah Customer
                </button>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-slate-500 uppercase bg-slate-50/50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 font-medium">Nama Customer</th>
                            <th class="px-6 py-4 font-medium">Email</th>
                            <th class="px-6 py-4 font-medium">No. Telepon</th>
                            <th class="px-6 py-4 font-medium">Password</th>
                            <th class="px-6 py-4 font-medium">Total Order</th>
                            <th class="px-6 py-4 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="customerTableBody" class="divide-y divide-slate-100">
                        @foreach ($customers as $customer)
                            <tr class="hover:bg-slate-50/50 transition-colors" data-name="{{ strtolower($customer->nama) }}" data-email="{{ strtolower($customer->email) }}">
                                <td class="px-6 py-4 font-medium text-slate-900">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-xs">
                                            {{ strtoupper(substr($customer->nama, 0, 1)) }}
                                        </div>
                                        {{ $customer->nama }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-600">{{ $customer->email }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $customer->phone }}</td>
                                <td class="px-6 py-4 text-slate-400 font-mono tracking-widest">
                                    ********
                                </td>
                                <td class="px-6 py-4 text-slate-600">{{ $customer->orders_count }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button onclick="openCustomerModal({{ $customer->id }}, '{{ $customer->nama }}', '{{ $customer->email }}', '{{ $customer->phone }}')" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Edit">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="openConfirmModal('{{ route('admin.customers.destroy', $customer) }}')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
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

    <div id="customerModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden flex flex-col max-h-[90vh]">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <h2 id="customerModalTitle" class="text-lg font-bold text-slate-900">Tambah Customer</h2>
                <button onclick="closeModal('customerModal')" class="text-slate-400 hover:text-slate-600 p-2 hover:bg-slate-100 rounded-full transition-colors">
                    ✕
                </button>
            </div>
            <form id="customerForm" method="POST" action="{{ route('admin.customers.store') }}">
                @csrf
                <div class="p-6 overflow-y-auto space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Customer</label>
                        <input type="text" name="nama" id="customerNama" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" placeholder="Budi Santoso" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                        <input type="email" name="email" id="customerEmail" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" placeholder="budi@example.com" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">No. Telepon</label>
                        <input type="text" name="phone" id="customerPhone" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" placeholder="081234567890" required />
                    </div>
                </div>
                <div class="p-6 border-t border-slate-100 flex justify-end gap-3 bg-slate-50">
                    <button type="button" onclick="closeModal('customerModal')" class="px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors">
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
    function openCustomerModal(id = null, nama = '', email = '', phone = '') {
        const form = document.getElementById('customerForm');
        if (id) {
            form.action = '/admin/customer/' + id;
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);
            document.getElementById('customerModalTitle').textContent = 'Edit Customer';
        } else {
            form.action = '{{ route('admin.customers.store') }}';
            form.querySelector('input[name="_method"]')?.remove();
            document.getElementById('customerModalTitle').textContent = 'Tambah Customer';
        }
        document.getElementById('customerNama').value = nama;
        document.getElementById('customerEmail').value = email;
        document.getElementById('customerPhone').value = phone;
        openModal('customerModal');
    }

    function filterCustomers(query) {
        const q = query.toLowerCase();
        document.querySelectorAll('#customerTableBody tr').forEach(row => {
            const haystack = row.dataset.name + ' ' + row.dataset.email;
            row.style.display = haystack.includes(q) ? '' : 'none';
        });
    }
</script>
@endpush