import api from '../lib/api';

export interface Schema {
  id: number;
  skema: string;
  harga: string;
  satuan: string;
  status: string;
}

const mockSchemas: Schema[] = [
  { id: 1, skema: "Sewa Unit Tahunan", harga: "Rp 7.500.000", satuan: "Per Tahun", status: "Aktif" },
  { id: 2, skema: "Sewa Unit Bulanan", harga: "Rp 700.000", satuan: "Per Bulan", status: "Aktif" },
  { id: 3, skema: "Pembelian Langsung", harga: "Rp 35.000.000", satuan: "Sekali Bayar", status: "Tidak Aktif" }
];

export const schemaService = {
  async getSchemas(): Promise<Schema[]> {
    try {
      // return (await api.get('/schemas')).data;
      return new Promise((resolve) => setTimeout(() => resolve(mockSchemas), 500));
    } catch (error) {
      console.error('Error fetching schemas', error);
      throw error;
    }
  }
};
