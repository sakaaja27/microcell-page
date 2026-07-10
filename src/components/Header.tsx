import React, { useState, useEffect } from 'react';
import { Bolt, Menu, X, Smartphone } from 'lucide-react';

interface HeaderProps {
  onOpenSurvey: () => void;
  onOpenSimulator: () => void;
}

export default function Header({ onOpenSurvey, onOpenSimulator }: HeaderProps) {
  const [scrolled, setScrolled] = useState<boolean>(false);
  const [mobileMenuOpen, setMobileMenuOpen] = useState<boolean>(false);

  useEffect(() => {
    const handleScroll = () => {
      if (window.scrollY > 40) {
        setScrolled(true);
      } else {
        setScrolled(false);
      }
    };

    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  return (
    <nav className={`fixed top-0 left-0 right-0 z-40 transition-all duration-300 ${
      scrolled 
        ? 'py-3 bg-emerald-950/95 backdrop-blur-md shadow-lg border-b border-emerald-500/10' 
        : 'py-5 bg-transparent border-b border-transparent'
    }`}>
      <div className="max-w-7xl mx-auto px-6 flex items-center justify-between md:justify-center md:gap-12 lg:gap-20">
        
        {/* Brand Logo */}
        <a href="#" className="flex items-center gap-2 group">
          <img src="/assets/images/logo.png" alt="MicroCell Lodgo" className="h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-110" />
          <span className="font-sans text-xl font-extrabold text-white tracking-tight">
            Micro<span className="text-emerald-400">Cell</span>
          </span>
        </a>

        {/* Desktop Nav Links */}
        <div className="hidden md:flex items-center gap-8">
          <a href="#about" className="text-sm font-semibold text-emerald-200/80 hover:text-white hover:underline decoration-emerald-500 underline-offset-4 transition-all">
            Tentang
          </a>
          <a href="#how-it-works" className="text-sm font-semibold text-emerald-200/80 hover:text-white hover:underline decoration-emerald-500 underline-offset-4 transition-all">
            Cara Kerja
          </a>
          <a href="#benefits" className="text-sm font-semibold text-emerald-200/80 hover:text-white hover:underline decoration-emerald-500 underline-offset-4 transition-all">
            Manfaat
          </a>
          <a href="#products" className="text-sm font-semibold text-emerald-200/80 hover:text-white hover:underline decoration-emerald-500 underline-offset-4 transition-all">
            Produk
          </a>
          <a href="#faq" className="text-sm font-semibold text-emerald-200/80 hover:text-white hover:underline decoration-emerald-500 underline-offset-4 transition-all">
            FAQ
          </a>
        </div>


        {/* Mobile Hamburger Trigger */}
        <button 
          onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
          className="p-2 text-emerald-200 md:hidden hover:text-white focus:outline-none"
        >
          {mobileMenuOpen ? <X size={24} /> : <Menu size={24} />}
        </button>

      </div>

      {/* Mobile Drawer Menu */}
      {mobileMenuOpen && (
        <div className="md:hidden fixed top-[64px] left-0 right-0 bottom-0 bg-[#041706]/98 backdrop-blur-lg z-30 p-6 border-t border-emerald-500/10 flex flex-col justify-between">
          <div className="space-y-6">
            <a 
              href="#about" 
              onClick={() => setMobileMenuOpen(false)}
              className="block text-lg font-bold text-emerald-200 hover:text-white"
            >
              Tentang
            </a>
            <a 
              href="#how-it-works" 
              onClick={() => setMobileMenuOpen(false)}
              className="block text-lg font-bold text-emerald-200 hover:text-white"
            >
              Cara Kerja
            </a>
            <a 
              href="#benefits" 
              onClick={() => setMobileMenuOpen(false)}
              className="block text-lg font-bold text-emerald-200 hover:text-white"
            >
              Manfaat
            </a>
            <a 
              href="#products" 
              onClick={() => setMobileMenuOpen(false)}
              className="block text-lg font-bold text-emerald-200 hover:text-white"
            >
              Produk
            </a>
            <a 
              href="#faq" 
              onClick={() => setMobileMenuOpen(false)}
              className="block text-lg font-bold text-emerald-200 hover:text-white"
            >
              FAQ
            </a>
          </div>

          
        </div>
      )}
    </nav>
  );
}
