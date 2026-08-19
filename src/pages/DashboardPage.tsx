import {
  LineChart,
  Line,
  XAxis,
  YAxis,
  CartesianGrid,
  Tooltip,
  ResponsiveContainer,
  PieChart,
  Pie,
  Cell,
  Legend
} from "recharts";
import { Activity, Users, DollarSign, ShoppingBag, Loader2 } from "lucide-react";
import { useDashboard } from "../hooks/useDashboard";

const COLORS = ["#10b981", "#059669", "#34d399"];

export function DashboardPage() {
  const { metrics, isLoading, error } = useDashboard();

  if (isLoading) {
    return (
      <div className="flex justify-center items-center h-[80vh]">
        <Loader2 className="w-10 h-10 animate-spin text-emerald-500" />
      </div>
    );
  }

  if (error || !metrics) {
    return <div className="bg-red-50 text-red-600 p-4 rounded-xl">{error || 'Failed to load metrics'}</div>;
  }

  return (
    <div className="space-y-6">
      <h1 className="text-2xl font-bold tracking-tight text-slate-900">Dashboard Overview</h1>
      
      {/* Top Cards */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <StatCard title="Total Alat" value={metrics.totalAlat} icon={Activity} color="text-emerald-600" bg="bg-emerald-100" />
        <StatCard title="Total Pengguna" value={metrics.totalPengguna} icon={Users} color="text-green-600" bg="bg-green-100" />
        <StatCard title="Total Pendapatan" value={metrics.totalPendapatan} icon={DollarSign} color="text-emerald-600" bg="bg-emerald-100" />
        <StatCard title="Pesanan Terbaru" value={metrics.pesananTerbaru} icon={ShoppingBag} color="text-emerald-600" bg="bg-emerald-100" />
      </div>

      {/* Charts */}
      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div className="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
          <h2 className="text-lg font-semibold mb-4 text-slate-800">Transaksi Selama Setahun</h2>
          <div className="h-80">
            <ResponsiveContainer width="100%" height="100%">
              <LineChart data={metrics.transactionData}>
                <CartesianGrid strokeDasharray="3 3" vertical={false} stroke="#e2e8f0" />
                <XAxis dataKey="name" axisLine={false} tickLine={false} tick={{ fill: '#64748b' }} />
                <YAxis axisLine={false} tickLine={false} tick={{ fill: '#64748b' }} />
                <Tooltip 
                  contentStyle={{ borderRadius: '12px', border: 'none', boxShadow: '0 4px 6px -1px rgb(0 0 0 / 0.1)' }}
                />
                <Line type="monotone" dataKey="total" stroke="#10b981" strokeWidth={3} dot={{ r: 4, strokeWidth: 2 }} activeDot={{ r: 6 }} />
              </LineChart>
            </ResponsiveContainer>
          </div>
        </div>
        <div className="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
          <h2 className="text-lg font-semibold mb-4 text-slate-800">Sebaran Skema Pengguna</h2>
          <div className="h-80">
            <ResponsiveContainer width="100%" height="100%">
              <PieChart>
                <Pie
                  data={metrics.schemaData}
                  cx="50%"
                  cy="45%"
                  innerRadius={80}
                  outerRadius={110}
                  paddingAngle={5}
                  dataKey="value"
                >
                  {metrics.schemaData.map((entry, index) => (
                    <Cell key={`cell-${index}`} fill={COLORS[index % COLORS.length]} />
                  ))}
                </Pie>
                <Tooltip 
                  contentStyle={{ borderRadius: '12px', border: 'none', boxShadow: '0 4px 6px -1px rgb(0 0 0 / 0.1)' }}
                />
                <Legend verticalAlign="bottom" height={36} iconType="circle" />
              </PieChart>
            </ResponsiveContainer>
          </div>
        </div>
      </div>

      {/* Tables */}
      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div className="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
          <div className="p-6 border-b border-slate-100">
            <h2 className="text-lg font-semibold text-slate-800">5 Pesanan Terbaru</h2>
          </div>
          <div className="overflow-x-auto">
            <table className="w-full text-sm text-left">
              <thead className="text-xs text-slate-500 uppercase bg-slate-50/50">
                <tr>
                  <th className="px-6 py-4 font-medium">Kode Order</th>
                  <th className="px-6 py-4 font-medium">Pelanggan</th>
                  <th className="px-6 py-4 font-medium">Skema</th>
                  <th className="px-6 py-4 font-medium">Total</th>
                  <th className="px-6 py-4 font-medium">Status</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-slate-100">
                {metrics.recentOrders.map((order) => (
                  <tr key={order.id} className="hover:bg-slate-50/50 transition-colors">
                    <td className="px-6 py-4 font-medium text-slate-900">{order.id}</td>
                    <td className="px-6 py-4">{order.customer}</td>
                    <td className="px-6 py-4">
                      <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                        {order.schema}
                      </span>
                    </td>
                    <td className="px-6 py-4 font-medium text-slate-700">{order.total}</td>
                    <td className="px-6 py-4">
                      <StatusBadge status={order.status} />
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
        <div className="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
          <div className="p-6 border-b border-slate-100">
            <h2 className="text-lg font-semibold text-slate-800">Agenda Terkait</h2>
          </div>
          <div className="p-6 space-y-4">
            {metrics.agendas.map((agenda, i) => (
              <div key={i} className="flex items-start gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100 hover:border-emerald-200 hover:shadow-md transition-all">
                <div className="w-12 h-12 rounded-lg bg-emerald-100 flex flex-col items-center justify-center shrink-0">
                  <span className="text-xs font-bold text-emerald-600">{agenda.date.split('-')[0]}</span>
                  <span className="text-[10px] font-medium text-emerald-500 uppercase">{agenda.date.split('-')[1]}</span>
                </div>
                <div>
                  <h3 className="text-sm font-semibold text-slate-900">{agenda.title}</h3>
                  <p className="text-xs text-slate-500 mt-1">{agenda.time}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </div>
  );
}

// Helper Components
function StatCard({ title, value, icon: Icon, color, bg }: { title: string, value: string, icon: any, color: string, bg: string }) {
  return (
    <div className="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-md transition-shadow">
      <div className={`w-14 h-14 rounded-xl ${bg} flex items-center justify-center shrink-0`}>
        <Icon className={`w-7 h-7 ${color}`} />
      </div>
      <div>
        <p className="text-sm font-medium text-slate-500">{title}</p>
        <h3 className="text-2xl font-bold text-slate-900 mt-1">{value}</h3>
      </div>
    </div>
  );
}

function StatusBadge({ status }: { status: string }) {
  const styles = {
    Selesai: "bg-emerald-100 text-emerald-700",
    Proses: "bg-amber-100 text-amber-700",
    Menunggu: "bg-slate-100 text-slate-700",
    Dibatalkan: "bg-red-100 text-red-700",
  }[status] || "bg-slate-100 text-slate-700";

  return (
    <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${styles}`}>
      {status}
    </span>
  );
}
