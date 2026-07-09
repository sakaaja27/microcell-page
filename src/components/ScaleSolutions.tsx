import React, { useState } from 'react';
import { Check, Star } from 'lucide-react';

interface ScaleSolutionsProps {
  onOpenSurvey: () => void;
}

export default function ScaleSolutions({ onOpenSurvey }: ScaleSolutionsProps) {
  const [activeTab, setActiveTab] = useState<'b2c' | 'b2b'>('b2c');

  return (
    <section className="py-24 bg-[#F0FDF4] text-[#041706] overflow-hidden" id="products">
      <div className="max-w-6xl mx-auto px-6">
        
        {/* Section Header */}
        <div className="text-center mb-12">
          <span className="text-[10px] bg-emerald-500/10 text-emerald-600 border border-emerald-500/20 px-3 py-1 rounded-full font-bold uppercase tracking-widest">
            Pilihan Implementasi
          </span>
          <h2 className="mt-4 font-sans text-3xl sm:text-4xl font-extrabold text-emerald-950 tracking-tight mb-6">
            Solusi Sesuai Skala
          </h2>
          
          {/* Tab Button Selector */}
          <div className="inline-flex bg-white p-1.5 rounded-full shadow-sm border border-emerald-500/10">
            <button 
              onClick={() => setActiveTab('b2c')}
              className={`px-8 py-2.5 rounded-full font-sans text-xs font-bold transition-all duration-300 cursor-pointer ${
                activeTab === 'b2c' 
                  ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/15' 
                  : 'text-emerald-800 hover:text-emerald-950'
              }`}
            >
              Peternak Individu (B2C)
            </button>
            <button 
              onClick={() => setActiveTab('b2b')}
              className={`px-8 py-2.5 rounded-full font-sans text-xs font-bold transition-all duration-300 cursor-pointer ${
                activeTab === 'b2b' 
                  ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/15' 
                  : 'text-emerald-800 hover:text-emerald-950'
              }`}
            >
              Koperasi &amp; Institusi (B2B)
            </button>
          </div>
        </div>

        {/* Tab Content Cards container */}
        <div className="max-w-4xl mx-auto mb-16">
          
          {/* B2C Layout Container */}
          {activeTab === 'b2c' && (
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6 animate-fade-in-up">
              
              {/* Option 1: Jual Putus */}
              <div className="bg-white p-8 md:p-10 rounded-[32px] border border-emerald-500/10 shadow-sm flex flex-col justify-between">
                <div>
                  <span className="text-[10px] text-emerald-600 font-bold tracking-widest uppercase">Kategori Mandiri</span>
                  <h3 className="font-sans text-2xl font-bold text-emerald-950 mt-1 mb-4">Jual Putus</h3>
                  <p className="text-sm text-emerald-800 leading-relaxed font-sans mb-8">
                    Kepemilikan penuh sistem reaktor MicroCell dengan modul siap pakai bergaransi resmi untuk pemenuhan kebutuhan energi harian rumah tangga.
                  </p>
                  
                  <ul className="space-y-4 mb-10">
                    <li className="flex items-center gap-3 text-sm text-emerald-950">
                      <div className="flex-shrink-0 h-5 w-5 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <Check size={14} strokeWidth={3} />
                      </div>
                      <span>Garansi perangkat utama 3 tahun</span>
                    </li>
                    <li className="flex items-center gap-3 text-sm text-emerald-950">
                      <div className="flex-shrink-0 h-5 w-5 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <Check size={14} strokeWidth={3} />
                      </div>
                      <span>Buku panduan &amp; kit perakitan mandiri</span>
                    </li>
                    <li className="flex items-center gap-3 text-sm text-emerald-950">
                      <div className="flex-shrink-0 h-5 w-5 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <Check size={14} strokeWidth={3} />
                      </div>
                      <span>Free Starter Pack bakteri starter</span>
                    </li>
                  </ul>
                </div>

                <button 
                  onClick={onOpenSurvey}
                  className="w-full border-2 border-emerald-600 text-emerald-600 hover:bg-emerald-600 hover:text-white py-4 rounded-2xl font-bold text-sm transition-all duration-200 cursor-pointer"
                >
                  Pesan Sekarang
                </button>
              </div>

              {/* Option 2: Paket Maintenance (Highlighted Card) */}
              <div className="bg-emerald-950 text-white p-8 md:p-10 rounded-[32px] border border-emerald-500/20 shadow-xl relative flex flex-col justify-between">
                <div className="absolute top-6 right-6 text-amber-400">
                  <Star size={24} fill="currentColor" />
                </div>

                <div>
                  <span className="text-[10px] text-emerald-400 font-bold tracking-widest uppercase">Paket Bebas Repot</span>
                  <h3 className="font-sans text-2xl font-bold text-white mt-1 mb-4">Paket Maintenance</h3>
                  <p className="text-sm text-emerald-200/80 leading-relaxed font-sans mb-8">
                    Layanan terpadu menyeluruh mencakup pemeliharaan reaktivitas bakteri periodik, penanganan teknis, serta pembaruan saringan reaktor otomatis.
                  </p>
                  
                  <ul className="space-y-4 mb-10">
                    <li className="flex items-center gap-3 text-sm">
                      <div className="flex-shrink-0 h-5 w-5 rounded-full bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
                        <Check size={14} strokeWidth={3} />
                      </div>
                      <span>Kunjungan teknisi berkala tiap 4 bulan</span>
                    </li>
                    <li className="flex items-center gap-3 text-sm">
                      <div className="flex-shrink-0 h-5 w-5 rounded-full bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
                        <Check size={14} strokeWidth={3} />
                      </div>
                      <span>Monitoring performa bioreaktor online</span>
                    </li>
                    <li className="flex items-center gap-3 text-sm">
                      <div className="flex-shrink-0 h-5 w-5 rounded-full bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
                        <Check size={14} strokeWidth={3} />
                      </div>
                      <span>Garansi penggantian suku cadang penuh</span>
                    </li>
                  </ul>
                </div>

                <button 
                  onClick={onOpenSurvey}
                  className="w-full bg-emerald-500 hover:bg-emerald-400 text-[#041706] py-4 rounded-2xl font-bold text-sm transition-all duration-200"
                >
                  Pilih Layanan Maintenance
                </button>
              </div>

            </div>
          )}

          {/* B2B Layout Container */}
          {activeTab === 'b2b' && (
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6 animate-fade-in-up">
              
              {/* Option 1: Paket B2B */}
              <div className="bg-white p-8 md:p-10 rounded-[32px] border border-emerald-500/10 shadow-sm flex flex-col justify-between">
                <div>
                  <span className="text-[10px] text-emerald-600 font-bold tracking-widest uppercase">Koperasi / Desa</span>
                  <h3 className="font-sans text-2xl font-bold text-emerald-950 mt-1 mb-4">Paket B2B Komunal</h3>
                  <p className="text-sm text-emerald-800 leading-relaxed font-sans mb-8">
                    Pemasangan unit reaktor raksasa terintegrasi untuk peternakan komunal, koperasi desa, atau badan usaha pertanian dengan pasokan daya listrik tinggi.
                  </p>
                  
                  <ul className="space-y-4 mb-10">
                    <li className="flex items-center gap-3 text-sm text-emerald-950">
                      <div className="flex-shrink-0 h-5 w-5 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <Check size={14} strokeWidth={3} />
                      </div>
                      <span>Rancangan teknis kustom gratis</span>
                    </li>
                    <li className="flex items-center gap-3 text-sm text-emerald-950">
                      <div className="flex-shrink-0 h-5 w-5 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <Check size={14} strokeWidth={3} />
                      </div>
                      <span>Integrasi Smart Central Dashboard IoT</span>
                    </li>
                    <li className="flex items-center gap-3 text-sm text-emerald-950">
                      <div className="flex-shrink-0 h-5 w-5 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <Check size={14} strokeWidth={3} />
                      </div>
                      <span>Pelatihan operator teknis lokal desa</span>
                    </li>
                  </ul>
                </div>

                <button 
                  onClick={onOpenSurvey}
                  className="w-full border-2 border-emerald-600 text-emerald-600 hover:bg-emerald-600 hover:text-white py-4 rounded-2xl font-bold text-sm transition-all duration-200 cursor-pointer"
                >
                  Hubungi Tim Ahli
                </button>
              </div>

              {/* Option 2: Paket Kolaborasi CSR */}
              <div className="bg-emerald-950 text-white p-8 md:p-10 rounded-[32px] border border-emerald-500/20 shadow-xl flex flex-col justify-between">
                <div>
                  <span className="text-[10px] text-emerald-400 font-bold tracking-widest uppercase">Program ESG &amp; CSR</span>
                  <h3 className="font-sans text-2xl font-bold text-white mt-1 mb-4">Paket Kolaborasi ESG</h3>
                  <p className="text-sm text-emerald-200/80 leading-relaxed font-sans mb-8">
                    Kemitraan strategis untuk perusahaan pelaksana CSR yang ingin mendanai elektrifikasi terbarukan berbasis kearifan lokal di desa sasaran.
                  </p>
                  
                  <ul className="space-y-4 mb-10">
                    <li className="flex items-center gap-3 text-sm">
                      <div className="flex-shrink-0 h-5 w-5 rounded-full bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
                        <Check size={14} strokeWidth={3} />
                      </div>
                      <span>Laporan dampak kuantitatif reduksi emisi</span>
                    </li>
                    <li className="flex items-center gap-3 text-sm">
                      <div className="flex-shrink-0 h-5 w-5 rounded-full bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
                        <Check size={14} strokeWidth={3} />
                      </div>
                      <span>Branding eksklusif kemitraan lingkungan</span>
                    </li>
                    <li className="flex items-center gap-3 text-sm">
                      <div className="flex-shrink-0 h-5 w-5 rounded-full bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
                        <Check size={14} strokeWidth={3} />
                      </div>
                      <span>Sertifikat kontribusi dekarbonisasi</span>
                    </li>
                  </ul>
                </div>

                <button 
                  onClick={onOpenSurvey}
                  className="w-full bg-emerald-500 hover:bg-emerald-400 text-[#041706] py-4 rounded-2xl font-bold text-sm transition-all duration-200"
                >
                  Mulai Kemitraan Strategis
                </button>
              </div>

            </div>
          )}

        </div>

        {/* Horizontal Specification Info Bar */}
        <div className="bg-white border border-emerald-500/10 rounded-3xl p-6 md:p-8 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-6 md:gap-4 shadow-sm">
          
          <div className="flex flex-col">
            <span className="text-[9px] text-emerald-500 uppercase tracking-wider font-bold">Bahan Baku</span>
            <span className="text-xs sm:text-sm font-bold text-emerald-950 mt-1 font-sans">Limbah Cair Ternak</span>
          </div>

          <div className="flex flex-col border-l border-emerald-100 pl-4 md:pl-2">
            <span className="text-[9px] text-emerald-500 uppercase tracking-wider font-bold">Output Daya</span>
            <span className="text-xs sm:text-sm font-bold text-emerald-950 mt-1 font-sans">AC 220V / DC 12V</span>
          </div>

          <div className="flex flex-col border-l border-emerald-100 pl-4 md:pl-2">
            <span className="text-[9px] text-emerald-500 uppercase tracking-wider font-bold">Format Desain</span>
            <span className="text-xs sm:text-sm font-bold text-emerald-950 mt-1 font-sans">Stackable Modular</span>
          </div>

          <div className="flex flex-col border-l border-emerald-100 pl-4 md:pl-2">
            <span className="text-[9px] text-emerald-500 uppercase tracking-wider font-bold">Penyimpanan</span>
            <span className="text-xs sm:text-sm font-bold text-emerald-950 mt-1 font-sans">LiFePO4 Optimized</span>
          </div>

          <div className="flex flex-col border-l border-emerald-100 pl-4 md:pl-2">
            <span className="text-[9px] text-emerald-500 uppercase tracking-wider font-bold">Konektivitas</span>
            <span className="text-xs sm:text-sm font-bold text-emerald-950 mt-1 font-sans">Bluetooth / Wi-Fi</span>
          </div>

          <div className="flex flex-col border-l border-emerald-100 pl-4 md:pl-2">
            <span className="text-[9px] text-emerald-500 uppercase tracking-wider font-bold">Kategori Dampak</span>
            <span className="text-xs sm:text-sm font-bold text-emerald-950 mt-1 font-sans">Circular Economy</span>
          </div>

        </div>

      </div>
    </section>
  );
}
