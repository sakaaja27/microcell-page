@extends('layouts.admin')

@section('title', 'Skema & Harga')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Skema & Harga</h1>
            <button onclick="openSchemaModal()" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors shadow-sm">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Skema
            </button>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <div class="relative max-w-sm w-full">
                    <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" id="searchInput" placeholder="Cari skema..." class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 text-sm rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all shadow-sm" onkeyup="searchTable()">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left" id="dataTable">
                    <thead class="text-xs text-slate-500 uppercase bg-slate-50/50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 font-medium w-16">No</th>
                            <th class="px-6 py-4 font-medium">Skema</th>
                            <th class="px-6 py-4 font-medium">Harga</th>
                            <th class="px-6 py-4 font-medium">Satuan Paket (Price Unit)</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 font-medium">Total Order</th>
                            <th class="px-6 py-4 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($schemas as $schema)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-medium text-slate-900 search-target">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center">
                                            <span class="text-green-600 font-bold text-xs">{{ strtoupper(substr($schema->skema, 0, 1)) }}</span>
                                        </div>
                                        {{ $schema->skema }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-slate-700">Rp {{ number_format($schema->harga, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-slate-600 search-target">{{ $schema->satuan }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $schema->status === 'Aktif' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $schema->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-600">{{ $schema->orders_count }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    @php
                                        $featuresList = is_string($schema->features) ? implode("\n", json_decode($schema->features, true) ?? []) : implode("\n", $schema->features ?? []);
                                    @endphp
                                    <button onclick='openSchemaModal({{ $schema->id }}, @json($schema->skema), @json($schema->subtitle), @json($schema->badge), @json($schema->icon), {{ $schema->harga }}, @json($schema->satuan), @json($schema->status), @json($featuresList), {{ $schema->is_recommended ? 'true' : 'false' }}, @json($schema->cta_text), @json($schema->cta_link))' class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Edit">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="openConfirmModal('{{ route('admin.schemas.destroy', $schema) }}')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($schemas->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $schemas->links() }}
            </div>
            @endif
        </div>
    </div>

    <div id="schemaModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <h2 id="schemaModalTitle" class="text-lg font-bold text-slate-900">Tambah Skema</h2>
                <button type="button" onclick="closeModal('schemaModal')" class="text-slate-400 hover:text-slate-600 p-2 hover:bg-slate-100 rounded-full transition-colors">
                    ✕
                </button>
            </div>
            <form id="schemaForm" method="POST" action="{{ route('admin.schemas.store') }}">
                @csrf
                <div class="p-6 overflow-y-auto max-h-[60vh] space-y-5">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Judul Skema</label>
                            <input type="text" name="skema" id="schemaSkema" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" required />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Subtitle</label>
                            <input type="text" name="subtitle" id="schemaSubtitle" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" />
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Harga (Rp)</label>
                            <input type="number" name="harga" id="schemaHarga" min="0" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" required />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Satuan Paket</label>
                            <input type="text" name="satuan" id="schemaSatuan" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" required />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Teks Badge (Label atas)</label>
                            <input type="text" name="badge" id="schemaBadge" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Icon (contoh: refresh-cw, star)</label>
                            <input type="text" name="icon" id="schemaIcon" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Fitur (1 baris untuk 1 fitur)</label>
                        <textarea name="features" id="schemaFeatures" rows="4" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Teks Tombol (CTA)</label>
                            <input type="text" name="cta_text" id="schemaCtaText" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Link URL Tombol (CTA)</label>
                            <input type="text" name="cta_link" id="schemaCtaLink" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Status</label>
                            <select name="status" id="schemaStatus" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3">
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="flex items-center pt-8">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_recommended" id="schemaIsRecommended" value="1" class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                                <span class="ml-3 text-sm font-medium text-slate-700">Tandai Rekomendasi (Highlight Hijau)</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="p-6 border-t border-slate-100 flex justify-end gap-3 bg-slate-50">
                    <button type="button" onclick="closeModal('schemaModal')" class="px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors">
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

    function openSchemaModal(id = null, skema = '', subtitle = '', badge = '', icon = '', harga = '', satuan = '', status = 'Aktif', features = '', is_recommended = false, cta_text = 'Hubungi Kami', cta_link = '#') {
        const form = document.getElementById('schemaForm');
        
        form.querySelector('input[name="_method"]')?.remove();

        if (id) {
            form.action = '/admin/skema-harga/' + id;
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);
            document.getElementById('schemaModalTitle').textContent = 'Edit Skema';
        } else {
            form.action = '{{ route('admin.schemas.store') }}';
            document.getElementById('schemaModalTitle').textContent = 'Tambah Skema';
        }
        
        document.getElementById('schemaSkema').value = skema;
        document.getElementById('schemaSubtitle').value = subtitle;
        document.getElementById('schemaBadge').value = badge;
        document.getElementById('schemaIcon').value = icon;
        document.getElementById('schemaHarga').value = harga;
        document.getElementById('schemaSatuan').value = satuan;
        document.getElementById('schemaStatus').value = status;
        document.getElementById('schemaFeatures').value = features;
        document.getElementById('schemaIsRecommended').checked = is_recommended;
        document.getElementById('schemaCtaText').value = cta_text;
        document.getElementById('schemaCtaLink').value = cta_link;
        
        openModal('schemaModal');
    }
</script>
@endpush