import api from '../lib/api';

export interface PaymentMethod {
  id: number;
  nama: string;
  jenis: string;
  va: string;
  qr: string | null;
}

const mockPayments: PaymentMethod[] = [
  { id: 1, nama: "BCA Virtual Account", jenis: "Transfer bank", va: "014 8392 8392", qr: null },
  { id: 2, nama: "QRIS Merchant Microcell", jenis: "Qris", va: "-", qr: "https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg" },
  { id: 3, nama: "Gopay", jenis: "e wallet", va: "081234567890", qr: null },
  { id: 4, nama: "Bayar di Tempat (COD/Instalasi)", jenis: "tunai", va: "-", qr: null }
];

export const paymentService = {
  async getPaymentMethods(): Promise<PaymentMethod[]> {
    try {
      // return (await api.get('/payments')).data;
      return new Promise((resolve) => setTimeout(() => resolve(mockPayments), 500));
    } catch (error) {
      console.error('Error fetching payment methods', error);
      throw error;
    }
  }
};
