import React, { useEffect } from 'react';
import AOS from 'aos';
import 'aos/dist/aos.css';
import Home from './pages/Home';

export default function App() {
  useEffect(() => {
    AOS.init({
      duration: 800,
      once: true,
      easing: 'ease-in-out',
    });
  }, []);

  return <Home />;
}
