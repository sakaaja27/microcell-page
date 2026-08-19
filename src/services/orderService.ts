import api from '../lib/api';

export interface Order {
  id: string;
  customer: string;
  skema: string;
  qty: number;
  total: string;
  status: string;
  tanggal: string;
  image: string;
}

const mockOrders: Order[] = [
  { id: "MC001-29-2026", customer: "Budi Santoso", skema: "Sewa Unit", qty: 2, total: "Rp 1.400.000", status: "Menunggu", tanggal: "19-Aug-2026", image: "https://images.unsplash.com/photo-1611099687311-b1e779c67db5?w=200&h=300&fit=crop" },
  { id: "MC002-29-2026", customer: "Siti Aminah", skema: "Pembelian Langsung", qty: 1, total: "Rp 35.000.000", status: "Proses", tanggal: "18-Aug-2026", image: "https://images.unsplash.com/photo-1611099687311-b1e779c67db5?w=200&h=300&fit=crop" }
];

export const orderService = {
  async getOrders(): Promise<Order[]> {
    try {
      // return (await api.get('/orders')).data;
      return new Promise((resolve) => setTimeout(() => resolve(mockOrders), 500));
    } catch (error) {
      console.error('Error fetching orders', error);
      throw error;
    }
  },
  async updateOrderStatus(id: string, newStatus: string): Promise<void> {
    try {
      // await api.put(`/orders/${id}/status`, { status: newStatus });
      return new Promise((resolve) => setTimeout(resolve, 300));
    } catch (error) {
      throw error;
    }
  }
};
