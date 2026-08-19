import { Edit, Plus, Loader2 } from "lucide-react";
import { useSchemas } from "../hooks/useSchemas";

export function SkemaHargaPage() {
  const { schemas, isLoading, error } = useSchemas();

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-2xl font-bold tracking-tight text-slate-900">Skema & Harga</h1>
        <button className="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors shadow-sm">
          <Plus className="w-4 h-4" />
          Tambah Skema
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
                  <th className="px-6 py-4 font-medium">Skema</th>
                  <th className="px-6 py-4 font-medium">Harga</th>
                  <th className="px-6 py-4 font-medium">Satuan Paket (Price Unit)</th>
                  <th className="px-6 py-4 font-medium">Status</th>
                  <th className="px-6 py-4 font-medium text-right">Aksi</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-slate-100">
                {schemas.map((schema) => (
                  <tr key={schema.id} className="hover:bg-slate-50/50 transition-colors">
                    <td className="px-6 py-4 font-medium text-slate-900">
                      <div className="flex items-center gap-3">
                        <div className="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center">
                          <span className="text-green-600 font-bold text-xs">{schema.skema.charAt(0)}</span>
                        </div>
                        {schema.skema}
                      </div>
                    </td>
                    <td className="px-6 py-4 font-semibold text-slate-700">{schema.harga}</td>
                    <td className="px-6 py-4 text-slate-600">{schema.satuan}</td>
                    <td className="px-6 py-4">
                      <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                        schema.status === 'Aktif' 
                          ? 'bg-emerald-100 text-emerald-700' 
                          : 'bg-slate-100 text-slate-600'
                      }`}>
                        {schema.status}
                      </span>
                    </td>
                    <td className="px-6 py-4 text-right">
                      <button className="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Edit">
                        <Edit className="w-4 h-4" />
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
