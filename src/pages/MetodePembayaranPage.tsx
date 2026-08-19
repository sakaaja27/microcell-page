import { Edit, Plus, Trash2, Loader2 } from "lucide-react";
import { usePayments } from "../hooks/usePayments";

export function MetodePembayaranPage() {
  const { payments, isLoading, error } = usePayments();

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-2xl font-bold tracking-tight text-slate-900">Metode Pembayaran</h1>
        <button className="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors shadow-sm">
          <Plus className="w-4 h-4" />
          Tambah Metode
        </button>
      </div>

      {isLoading ? (
        <div className="flex justify-center items-center h-64">
          <Loader2 className="w-8 h-8 animate-spin text-emerald-500" />
        </div>
      ) : error ? (
        <div className="bg-red-50 text-red-600 p-4 rounded-xl">{error}</div>
      ) : (
        <div className="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
          <div className="overflow-x-auto">
            <table className="w-full text-sm text-left">
              <thead className="text-xs text-slate-500 uppercase bg-slate-50/50 border-b border-slate-100">
                <tr>
                  <th className="px-6 py-4 font-medium">Nama Metode</th>
                  <th className="px-6 py-4 font-medium">Jenis Metode</th>
                  <th className="px-6 py-4 font-medium">VA / Nomor</th>
                  <th className="px-6 py-4 font-medium">QR Code</th>
                  <th className="px-6 py-4 font-medium text-right">Aksi</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-slate-100">
                {payments.map((method) => (
                  <tr key={method.id} className="hover:bg-slate-50/50 transition-colors">
                    <td className="px-6 py-4 font-medium text-slate-900">{method.nama}</td>
                    <td className="px-6 py-4">
                      <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize ${
                        method.jenis === 'Qris' ? 'bg-purple-100 text-purple-700' :
                        method.jenis === 'Transfer bank' ? 'bg-emerald-100 text-emerald-700' :
                        method.jenis === 'e wallet' ? 'bg-emerald-100 text-emerald-700' :
                        'bg-slate-100 text-slate-700'
                      }`}>
                        {method.jenis}
                      </span>
                    </td>
                    <td className="px-6 py-4 text-slate-600 font-mono text-sm">{method.va}</td>
                    <td className="px-6 py-4">
                      {method.qr ? (
                        <div className="w-12 h-12 bg-white border border-slate-200 p-1 rounded-lg">
                          <img src={method.qr} alt="QR Code" className="w-full h-full object-contain" />
                        </div>
                      ) : (
                        <span className="text-slate-400 text-xs italic">Tidak ada</span>
                      )}
                    </td>
                    <td className="px-6 py-4 text-right space-x-2">
                      <button className="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Edit">
                        <Edit className="w-4 h-4" />
                      </button>
                      <button className="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                        <Trash2 className="w-4 h-4" />
                      </button>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      )}
    </div>
  );
}
