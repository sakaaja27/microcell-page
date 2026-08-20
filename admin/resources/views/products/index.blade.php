@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Manajemen Produk</h1>
            <button onclick="openProductModal()" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors shadow-sm">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Produk
            </button>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-slate-500 uppercase bg-slate-50/50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 font-medium">Nama Product</th>
                            <th class="px-6 py-4 font-medium">Spesifikasi</th>
                            <th class="px-6 py-4 font-medium min-w-[250px]">Deskripsi</th>
                            <th class="px-6 py-4 font-medium">Stock</th>
                            <th class="px-6 py-4 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($products as $product)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-900">{{ $product->nama }}</td>
                                <td class="px-6 py-4 text-slate-600 truncate max-w-[250px]">{{ $product->spesifikasi }}</td>
                                <td class="px-6 py-4 text-slate-600 truncate max-w-[250px]">{{ $product->deskripsi }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center justify-center min-w-[2rem] h-6 px-2 rounded-full text-xs font-medium bg-slate-100 text-slate-700">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button onclick="openProductModal({{ $product->id }}, '{{ $product->nama }}', '{{ $product->spesifikasi }}', '{{ $product->deskripsi }}', {{ $product->stock }})" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Edit">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="openConfirmModal('{{ route('admin.products.destroy', $product) }}')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
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

    <div id="productModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden flex flex-col max-h-[90vh]">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <h2 id="productModalTitle" class="text-lg font-bold text-slate-900">Tambah Produk</h2>
                <button onclick="closeModal('productModal')" class="text-slate-400 hover:text-slate-600 p-2 hover:bg-slate-100 rounded-full transition-colors">
                    ✕
                </button>
            </div>
            <form id="productForm" method="POST" action="{{ route('admin.products.store') }}">
                @csrf
                <div class="p-6 overflow-y-auto space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Product</label>
                        <input type="text" name="nama" id="productNama" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" placeholder="Microcell Tower Type A" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Spesifikasi</label>
                        <input type="text" name="spesifikasi" id="productSpesifikasi" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" placeholder="Tinggi 20m, Beban 500kg" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi</label>
                        <textarea name="deskripsi" id="productDeskripsi" rows="3" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" placeholder="Deskripsi produk..." required></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Stock</label>
                        <input type="number" name="stock" id="productStock" min="0" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" placeholder="12" required />
                    </div>
                </div>
                <div class="p-6 border-t border-slate-100 flex justify-end gap-3 bg-slate-50">
                    <button type="button" onclick="closeModal('productModal')" class="px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors">
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
    function openModal(id) {
        const modal = document.getElementById(id);

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal(id) {
        const modal = document.getElementById(id);

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function openProductModal(id = null, nama = '', spesifikasi = '', deskripsi = '', stock = '') {
        const form = document.getElementById('productForm');

        // Bersihkan method PUT lama
        form.querySelector('input[name="_method"]')?.remove();

        if (id) {
            form.action = '/admin/product/' + id;

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';

            form.appendChild(methodInput);

            document.getElementById('productModalTitle').textContent = 'Edit Produk';
        } else {
            form.action = '{{ route('admin.products.store') }}';

            document.getElementById('productModalTitle').textContent = 'Tambah Produk';
        }

        document.getElementById('productNama').value = nama;
        document.getElementById('productSpesifikasi').value = spesifikasi;
        document.getElementById('productDeskripsi').value = deskripsi;
        document.getElementById('productStock').value = stock;

        openModal('productModal');
    }
    function openProductModal(id = null, nama = '', spesifikasi = '', deskripsi = '', stock = '') {
        const form = document.getElementById('productForm');
        if (id) {
            form.action = '/admin/product/' + id;
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);
            document.getElementById('productModalTitle').textContent = 'Edit Produk';
        } else {
            form.action = '{{ route('admin.products.store') }}';
            form.querySelector('input[name="_method"]')?.remove();
            document.getElementById('productModalTitle').textContent = 'Tambah Produk';
        }
        document.getElementById('productNama').value = nama;
        document.getElementById('productSpesifikasi').value = spesifikasi;
        document.getElementById('productDeskripsi').value = deskripsi;
        document.getElementById('productStock').value = stock;
        openModal('productModal');
    }
</script>
@endpush