import { useState, useEffect } from 'react';
import { customerService, Customer } from '../services/customerService';

export function useCustomers() {
  const [customers, setCustomers] = useState<Customer[]>([]);
  const [isLoading, setIsLoading] = useState<boolean>(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    customerService.getCustomers()
      .then(setCustomers)
      .catch((err) => setError(err.message))
      .finally(() => setIsLoading(false));
  }, []);

  return { customers, isLoading, error };
}
