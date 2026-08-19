import { useState, useEffect } from 'react';
import { orderService, Order } from '../services/orderService';

export function useOrders() {
  const [orders, setOrders] = useState<Order[]>([]);
  const [isLoading, setIsLoading] = useState<boolean>(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    orderService.getOrders()
      .then(setOrders)
      .catch((err) => setError(err.message))
      .finally(() => setIsLoading(false));
  }, []);

  const updateStatus = async (id: string, newStatus: string) => {
    try {
      await orderService.updateOrderStatus(id, newStatus);
      setOrders(prev => prev.map(o => o.id === id ? { ...o, status: newStatus } : o));
    } catch (err) {
      alert("Gagal update status");
    }
  }

  return { orders, isLoading, error, updateStatus };
}
