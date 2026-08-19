import { useState, useEffect } from 'react';
import { dashboardService, DashboardMetrics } from '../services/dashboardService';

export function useDashboard() {
  const [metrics, setMetrics] = useState<DashboardMetrics | null>(null);
  const [isLoading, setIsLoading] = useState<boolean>(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    dashboardService.getMetrics()
      .then(setMetrics)
      .catch((err) => setError(err.message))
      .finally(() => setIsLoading(false));
  }, []);

  return { metrics, isLoading, error };
}
