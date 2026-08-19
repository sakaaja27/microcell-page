import api from '../lib/api';

export interface Product {
  id: number;
  nama: string;
  spesifikasi: string;
  deskripsi: string;
  stock: number;
}

// Temporary Mock Data Fallback while API is not ready
const mockProducts: Product[] = [
  {
    id: 1,
    nama: "Microcell Tower Type A",
    spesifikasi: "Tinggi 20m, Beban 500kg, Galvanis",
    deskripsi: "Tower microcell standar untuk area perkotaan padat penduduk.",
    stock: 12,
  },
  {
    id: 2,
    nama: "Microcell Pole Type B",
    spesifikasi: "Tinggi 15m, Beban 300kg, Monopole",
    deskripsi: "Tiang monopole estetis untuk area perumahan.",
    stock: 5,
  },
  {
    id: 3,
    nama: "Smart Pole Type C",
    spesifikasi: "Tinggi 10m, Terintegrasi CCTV & Lampu",
    deskripsi: "Smart pole multifungsi untuk smart city.",
    stock: 20,
  }
];

export const productService = {
  async getProducts(): Promise<Product[]> {
    try {
      // Attempt real API call
      // const response = await api.get('/products');
      // return response.data;

      // Mock delay
      return new Promise((resolve) => {
        setTimeout(() => resolve(mockProducts), 500);
      });
    } catch (error) {
      console.error('Error fetching products', error);
      throw error;
    }
  },

  async deleteProduct(id: number): Promise<void> {
    try {
      // await api.delete(`/products/${id}`);
      return new Promise((resolve) => setTimeout(resolve, 300));
    } catch (error) {
      console.error(`Error deleting product ${id}`, error);
      throw error;
    }
  }
};
