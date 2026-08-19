import { Eye, FileImage, Loader2 } from "lucide-react";
import { useState } from "react";
import { useOrders } from "../hooks/useOrders";
import { Order } from "../services/orderService";

export function PesananPage() {
  const { orders, isLoading, error, updateStatus } = useOrders();
  const [selectedOrder, setSelectedOrder] = useState<Order | null>(null);

  const handleUpdateStatus = (newStatus: string) => {
    if (selectedOrder) {
      updateStatus(selectedOrder.id, newStatus);
      setSelectedOrder(prev => prev ? { ...prev, status: newStatus } : null);
    }
  };

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-2xl font-bold tracking-tight text-slate-900">Pesanan</h1>
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
                  <th className="px-6 py-4 font-medium">Kode Order</th>
                  <th className="px-6 py-4 font-medium">Pelanggan</th>
                  <th className="px-6 py-4 font-medium">Skema</th>
                  <th className="px-6 py-4 font-medium">Qty</th>
                  <th className="px-6 py-4 font-medium">Total Harga</th>
                  <th className="px-6 py-4 font-medium">Status</th>
                  <th className="px-6 py-4 font-medium">Tanggal</th>
                  <th className="px-6 py-4 font-medium text-right">Aksi</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-slate-100">
                {orders.map((order) => (
                  <tr key={order.id} className="hover:bg-slate-50/50 transition-colors">
                    <td className="px-6 py-4 font-medium text-slate-900">{order.id}</td>
                    <td className="px-6 py-4 text-slate-700">{order.customer}</td>
                    <td className="px-6 py-4 text-slate-600">{order.skema}</td>
                    <td className="px-6 py-4 text-slate-600">{order.qty}</td>
                    <td className="px-6 py-4 font-semibold text-slate-700">{order.total}</td>
                    <td className="px-6 py-4">
                    <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                      order.status === 'Selesai' ? 'bg-emerald-100 text-emerald-700' :
                      order.status === 'Proses' ? 'bg-emerald-100 text-emerald-700' :
                      order.status === 'Menunggu' ? 'bg-amber-100 text-amber-700' :
                      'bg-red-100 text-red-700'
                    }`}>
                      {order.status}
                    </span>
                  </td>
                  <td className="px-6 py-4 text-slate-500 whitespace-nowrap">{order.tanggal}</td>
                  <td className="px-6 py-4 text-right">
                    <button 
                      onClick={() => setSelectedOrder(order)}
                      className="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors border border-transparent hover:border-emerald-100" 
                      title="Detail"
                    >
                      <Eye className="w-4 h-4" />
                      <span>Detail</span>
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
        </div>
      )}

      {/* Detail Modal Overlay */}
      {selectedOrder && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
          <div className="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden flex flex-col max-h-[90vh]">
            <div className="p-6 border-b border-slate-100 flex items-center justify-between">
              <h2 className="text-lg font-bold text-slate-900">Detail Pesanan</h2>
              <button 
                onClick={() => setSelectedOrder(null)}
                className="text-slate-400 hover:text-slate-600 p-2 hover:bg-slate-100 rounded-full transition-colors"
              >
                ✕
              </button>
            </div>
            
            <div className="p-6 overflow-y-auto space-y-6">
              <div className="grid grid-cols-2 gap-4 text-sm">
                <div>
                  <p className="text-slate-500 mb-1">Kode Order</p>
                  <p className="font-semibold text-slate-900">{selectedOrder.id}</p>
                </div>
                <div>
                  <p className="text-slate-500 mb-1">Pelanggan</p>
                  <p className="font-semibold text-slate-900">{selectedOrder.customer}</p>
                </div>
                <div>
                  <p className="text-slate-500 mb-1">Total</p>
                  <p className="font-semibold text-slate-900">{selectedOrder.total}</p>
                </div>
                <div>
                  <p className="text-slate-500 mb-1">Tanggal</p>
                  <p className="font-semibold text-slate-900">{selectedOrder.tanggal}</p>
                </div>
              </div>

              <div className="space-y-3">
                <label className="block text-sm font-medium text-slate-700">Ubah Status</label>
                <select 
                  className="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-3"
                  value={selectedOrder.status}
                  onChange={(e) => handleUpdateStatus(e.target.value)}
                >
                  <option value="Menunggu">Menunggu</option>
                  <option value="Proses">Proses</option>
                  <option value="Selesai">Selesai</option>
                  <option value="Dibatalkan">Dibatalkan</option>
                </select>
              </div>

              <div className="space-y-3">
                <label className="block text-sm font-medium text-slate-700 flex items-center gap-2">
                  <FileImage className="w-4 h-4" /> Bukti Pembayaran
                </label>
                <div className="border-2 border-dashed border-slate-200 rounded-xl p-2 bg-slate-50">
                  <img src={selectedOrder.image} alt="Bukti Transfer" className="w-full h-auto max-h-64 object-contain rounded-lg" />
                </div>
              </div>
            </div>
            
            <div className="p-6 border-t border-slate-100 flex justify-end gap-3 bg-slate-50">
              <button 
                onClick={() => setSelectedOrder(null)}
                className="px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors"
              >
                Batal
              </button>
              <button 
                onClick={() => setSelectedOrder(null)}
                className="px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition-colors shadow-sm"
              >
                Simpan Perubahan
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
