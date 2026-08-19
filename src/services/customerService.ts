import api from '../lib/api';

export interface Customer {
  id: number;
  nama: string;
  email: string;
  phone: string;
}

const mockCustomers: Customer[] = [
  { id: 1, nama: "Budi Santoso", email: "budi.s@example.com", phone: "081234567890" },
  { id: 2, nama: "Siti Aminah", email: "siti.a@example.com", phone: "081987654321" },
  { id: 3, nama: "Andi Wijaya", email: "andi.w@example.com", phone: "085678901234" }
];

export const customerService = {
  async getCustomers(): Promise<Customer[]> {
    try {
      // return (await api.get('/customers')).data;
      return new Promise((resolve) => setTimeout(() => resolve(mockCustomers), 500));
    } catch (error) {
      console.error('Error fetching customers', error);
      throw error;
    }
  }
};
