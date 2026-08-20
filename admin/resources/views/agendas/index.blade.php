@extends('layouts.admin')

@section('title', 'Manajemen Agenda')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Manajemen Agenda</h1>
            <button onclick="openAgendaModal()" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors shadow-sm">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Agenda
            </button>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl p-4 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <div class="relative max-w-sm w-full">
                    <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" id="searchInput" placeholder="Cari agenda..." class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 text-sm rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all shadow-sm" onkeyup="searchTable()">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left" id="dataTable">
                    <thead class="text-xs text-slate-500 uppercase bg-slate-50/50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 font-medium w-16">No</th>
                            <th class="px-6 py-4 font-medium">Judul Agenda</th>
                            <th class="px-6 py-4 font-medium">Tanggal</th>
                            <th class="px-6 py-4 font-medium">Waktu</th>
                            <th class="px-6 py-4 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($agendas as $agenda)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-medium text-slate-900 search-target">
                                    {{ $agenda->title }}
                                </td>
                                <td class="px-6 py-4 text-slate-600 search-target">
                                    {{ \Carbon\Carbon::parse($agenda->date)->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-6 py-4 text-slate-600 search-target">
                                    {{ $agenda->time }}
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button onclick="openAgendaModal({{ $agenda->id }}, '{{ $agenda->title }}', '{{ $agenda->date }}', '{{ $agenda->time }}')" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Edit">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="openConfirmModal('{{ route('admin.agendas.destroy', $agenda) }}')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                    Belum ada data agenda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="agendaModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden flex flex-col max-h-[90vh]">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <h2 id="agendaModalTitle" class="text-lg font-bold text-slate-900">Tambah Agenda</h2>
                <button onclick="closeModal('agendaModal')" class="text-slate-400 hover:text-slate-600 p-2 hover:bg-slate-100 rounded-full transition-colors">
                    ✕
                </button>
            </div>
            <form id="agendaForm" method="POST" action="{{ route('admin.agendas.store') }}">
                @csrf
                <div class="p-6 overflow-y-auto space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Judul Agenda</label>
                        <input type="text" name="title" id="agendaTitle" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" placeholder="Rapat Rutin Bulanan" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal</label>
                        <input type="date" name="date" id="agendaDate" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Waktu</label>
                        <input type="text" name="time" id="agendaTime" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3" placeholder="10:00 - 12:00 WIB" required />
                    </div>
                </div>
                <div class="p-6 border-t border-slate-100 flex justify-end gap-3 bg-slate-50">
                    <button type="button" onclick="closeModal('agendaModal')" class="px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors">
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
    function openAgendaModal(id = null, title = '', date = '', time = '') {
        const form = document.getElementById('agendaForm');
        if (id) {
            form.action = '/admin/agenda/' + id;
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);
            document.getElementById('agendaModalTitle').textContent = 'Edit Agenda';
        } else {
            form.action = '{{ route('admin.agendas.store') }}';
            form.querySelector('input[name="_method"]')?.remove();
            document.getElementById('agendaModalTitle').textContent = 'Tambah Agenda';
        }
        
        document.getElementById('agendaTitle').value = title;
        // The date format from DB might be '25-Sep', which doesn't fit standard input type="date".
        // Luckily, we will save dates as standard YYYY-MM-DD format moving forward.
        // For existing mock data, it might not populate correctly in the edit form, 
        // but new data will work perfectly.
        if (date && date.includes('-') && !date.match(/^\d{4}-\d{2}-\d{2}$/)) {
           // It's the old mock format "DD-MMM"
           document.getElementById('agendaDate').value = '';
        } else {
           document.getElementById('agendaDate').value = date;
        }

        document.getElementById('agendaTime').value = time;
        openModal('agendaModal');
    }
</script>
@endpush
