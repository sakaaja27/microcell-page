import api from '../lib/api';

export interface DashboardMetrics {
  totalAlat: string;
  totalPengguna: string;
  totalPendapatan: string;
  pesananTerbaru: string;
  transactionData: { name: string; total: number }[];
  schemaData: { name: string; value: number }[];
  recentOrders: { id: string; customer: string; schema: string; total: string; status: string }[];
  agendas: { title: string; date: string; time: string }[];
}

const mockMetrics: DashboardMetrics = {
  totalAlat: "1,245",
  totalPengguna: "8,432",
  totalPendapatan: "Rp 450M",
  pesananTerbaru: "156",
  transactionData: [
    { name: "Jan", total: 4000 },
    { name: "Feb", total: 3000 },
    { name: "Mar", total: 5000 },
    { name: "Apr", total: 4500 },
    { name: "May", total: 6000 },
    { name: "Jun", total: 5500 },
    { name: "Jul", total: 7000 },
    { name: "Aug", total: 8000 },
    { name: "Sep", total: 7500 },
    { name: "Oct", total: 8500 },
    { name: "Nov", total: 9000 },
    { name: "Dec", total: 10000 },
  ],
  schemaData: [
    { name: "Sewa Unit", value: 400 },
    { name: "Pembelian Langsung", value: 300 },
    { name: "Layanan Instalasi", value: 300 },
  ],
  recentOrders: [
    { id: "MC001-29-2026", customer: "Budi Santoso", schema: "Sewa Unit", total: "Rp 700.000", status: "Selesai" },
    { id: "MC002-29-2026", customer: "Siti Aminah", schema: "Pembelian Langsung", total: "Rp 5.500.000", status: "Proses" },
    { id: "MC003-29-2026", customer: "Andi Wijaya", schema: "Layanan Instalasi", total: "Rp 1.200.000", status: "Menunggu" },
    { id: "MC004-29-2026", customer: "Rina Kusuma", schema: "Sewa Unit", total: "Rp 700.000", status: "Selesai" },
    { id: "MC005-29-2026", customer: "Joko Supriyanto", schema: "Sewa Unit", total: "Rp 700.000", status: "Dibatalkan" },
  ],
  agendas: [
    { title: "Instalasi Server Klien A", date: "20-Aug-2026", time: "09:00 WIB" },
    { title: "Maintenance Berkala", date: "22-Aug-2026", time: "13:00 WIB" },
    { title: "Meeting Vendor", date: "25-Aug-2026", time: "10:00 WIB" },
  ]
};

export const dashboardService = {
  async getMetrics(): Promise<DashboardMetrics> {
    try {
      // return (await api.get('/dashboard')).data;
      return new Promise((resolve) => setTimeout(() => resolve(mockMetrics), 500));
    } catch (error) {
      console.error('Error fetching dashboard metrics', error);
      throw error;
    }
  }
};
