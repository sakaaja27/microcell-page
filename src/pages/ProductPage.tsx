import { Edit, Trash2, Plus, Loader2 } from "lucide-react";
import { useProducts } from "../hooks/useProducts";

export function ProductPage() {
  const { products, isLoading, error, deleteProduct } = useProducts();

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-2xl font-bold tracking-tight text-slate-900">Manajemen Produk</h1>
        <button className="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors shadow-sm">
          <Plus className="w-4 h-4" />
          Tambah Produk
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
                  <th className="px-6 py-4 font-medium">Nama Product</th>
                  <th className="px-6 py-4 font-medium">Spesifikasi</th>
                  <th className="px-6 py-4 font-medium min-w-[250px]">Deskripsi</th>
                  <th className="px-6 py-4 font-medium">Stock</th>
                  <th className="px-6 py-4 font-medium text-right">Aksi</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-slate-100">
                {products.map((product) => (
                  <tr key={product.id} className="hover:bg-slate-50/50 transition-colors">
                    <td className="px-6 py-4 font-medium text-slate-900">{product.nama}</td>
                    <td className="px-6 py-4 text-slate-600">{product.spesifikasi}</td>
                    <td className="px-6 py-4 text-slate-600 truncate max-w-[250px]">{product.deskripsi}</td>
                    <td className="px-6 py-4">
                      <span className="inline-flex items-center justify-center min-w-[2rem] h-6 px-2 rounded-full text-xs font-medium bg-slate-100 text-slate-700">
                        {product.stock}
                      </span>
                    </td>
                    <td className="px-6 py-4 text-right space-x-2">
                      <button className="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Edit">
                        <Edit className="w-4 h-4" />
                      </button>
                      <button 
                        onClick={() => {
                          if (window.confirm("Hapus produk ini?")) deleteProduct(product.id);
                        }}
                        className="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete"
                      >
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
