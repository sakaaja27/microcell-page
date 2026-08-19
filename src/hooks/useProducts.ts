import { useState, useEffect } from 'react';
import { productService, Product } from '../services/productService';

export function useProducts() {
  const [products, setProducts] = useState<Product[]>([]);
  const [isLoading, setIsLoading] = useState<boolean>(true);
  const [error, setError] = useState<string | null>(null);

  const fetchProducts = async () => {
    setIsLoading(true);
    setError(null);
    try {
      const data = await productService.getProducts();
      setProducts(data);
    } catch (err: any) {
      setError(err.message || 'Gagal memuat produk');
    } finally {
      setIsLoading(false);
    }
  };

  const deleteProduct = async (id: number) => {
    try {
      await productService.deleteProduct(id);
      setProducts(prev => prev.filter(p => p.id !== id));
    } catch (err: any) {
      console.error(err);
      alert('Gagal menghapus produk');
    }
  }

  useEffect(() => {
    fetchProducts();
  }, []);

  return {
    products,
    isLoading,
    error,
    refetch: fetchProducts,
    deleteProduct
  };
}
