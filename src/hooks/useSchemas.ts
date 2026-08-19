import { useState, useEffect } from 'react';
import { schemaService, Schema } from '../services/schemaService';

export function useSchemas() {
  const [schemas, setSchemas] = useState<Schema[]>([]);
  const [isLoading, setIsLoading] = useState<boolean>(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    schemaService.getSchemas()
      .then(setSchemas)
      .catch((err) => setError(err.message))
      .finally(() => setIsLoading(false));
  }, []);

  return { schemas, isLoading, error };
}
