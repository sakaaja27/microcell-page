import axios from 'axios';

// Get base URL from environment variables, or use a default
const baseURL = (import.meta as any).env.VITE_API_URL || 'http://localhost:8000/api';

const api = axios.create({
  baseURL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
});

// Request Interceptor
api.interceptors.request.use(
  (config) => {
    // If you have a token stored (e.g. in localStorage), attach it here
    const token = localStorage.getItem('token');
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

// Response Interceptor
api.interceptors.response.use(
  (response) => response,
  (error) => {
    // Handle global errors like 401 Unauthorized here
    if (error.response && error.response.status === 401) {
      // e.g. redirect to login, clear local storage
      console.warn('Unauthorized. Please login again.');
      localStorage.removeItem('token');
    }
    return Promise.reject(error);
  }
);

export default api;
