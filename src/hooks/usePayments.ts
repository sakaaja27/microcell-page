import { useState, useEffect } from 'react';
import { paymentService, PaymentMethod } from '../services/paymentService';

export function usePayments() {
  const [payments, setPayments] = useState<PaymentMethod[]>([]);
  const [isLoading, setIsLoading] = useState<boolean>(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    paymentService.getPaymentMethods()
      .then(setPayments)
      .catch((err) => setError(err.message))
      .finally(() => setIsLoading(false));
  }, []);

  return { payments, isLoading, error };
}
