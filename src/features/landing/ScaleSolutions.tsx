import React from 'react';
import { CheckCircle2, RefreshCw, PawPrint, Wrench, Star } from 'lucide-react';
import { generateWhatsAppLink } from '../../config/constants';

interface ScaleSolutionsProps {
  onOpenSurvey: () => void;
}

export default function ScaleSolutions({ onOpenSurvey }: ScaleSolutionsProps) {
  return (
    <section className="py-24 bg-white text-emerald-950" id="products">
      <div className="max-w-7xl mx-auto px-6">

        {/* Section Header */}
        <div className="text-center mb-16">
          <div className="inline-flex items-center justify-center border border-emerald-500/20 bg-emerald-50 rounded-full px-4 py-1.5 mb-6">
            <span className="text-xs font-bold text-emerald-700 tracking-widest uppercase">Produk & Layanan</span>
          </div>
          <h2 className="font-sans text-4xl md:text-5xl font-extrabold text-emerald-950 tracking-tight mb-6 max-w-4xl mx-auto leading-tight">
            Pilih Skema yang Sesuai Kebutuhanmu
          </h2>
          <p className="font-sans text-base md:text-lg text-emerald-800 max-w-3xl mx-auto leading-relaxed">
            MicroCell tersedia dalam tiga skema kepemilikan dan layanan fleksibel sesuai skala peternakan Anda.
          </p>
        </div>

        {/* 3 Columns Grid */}
        <div className="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 mb-12 items-stretch">

          {/* Card 1: Sewa Alat */}
          <div className="group relative flex h-full min-h-[560px] flex-col overflow-hidden rounded-[32px] border border-emerald-800/50 bg-[#0A2F1D] p-8 shadow-lg transition-all duration-300 ease-out hover:-translate-y-3 hover:border-emerald-500/60 hover:shadow-[0_28px_70px_rgba(4,55,34,0.28)] md:p-10">
            <div className="absolute inset-0 bg-gradient-to-br from-emerald-400/0 via-emerald-400/0 to-emerald-400/0 opacity-0 transition-opacity duration-300 group-hover:opacity-100 group-hover:from-emerald-400/8 group-hover:via-transparent group-hover:to-transparent" />
            <div className="flex justify-between items-start mb-8">
              <div className="bg-emerald-200 text-emerald-950 font-bold text-xs px-4 py-1.5 rounded-full">
                Sewa Alat
              </div>
              <div className="w-10 h-10 bg-emerald-900/50 rounded-full flex items-center justify-center text-emerald-400 shrink-0 ml-2">
                <RefreshCw size={18} />
              </div>
            </div>

            <div className="relative z-10 flex flex-1 flex-col">
              <h3 className="font-sans text-2xl font-bold text-white mb-2 pr-4">Sewa Unit MicroCell</h3>
              <p className="text-emerald-200/80 text-sm mb-6">Tanpa modal besar di awal</p>

              <div className="mb-8">
                <span className="text-2xl font-bold text-emerald-400">Rp 700.000</span>
                <span className="block text-emerald-400/80 text-sm mt-1">/ bulan</span>
              </div>

              <ul className="space-y-4 flex-1 mb-10">
                {[
                  'Tidak perlu membeli unit secara penuh',
                  'Perangkat tetap dirawat dan dikelola tim kami',
                  'Cocok untuk peternak yang ingin coba dulu',
                  'Kontrak fleksibel sesuai kebutuhan',
                  'Termasuk instalasi awal dan pendampingan'
                ].map((item, i) => (
                  <li key={i} className="flex items-start gap-3">
                    <CheckCircle2 size={18} className="text-emerald-400 mt-0.5 flex-shrink-0 transition-transform duration-300 group-hover:scale-110" />
                    <span className="text-sm text-emerald-100/90 leading-relaxed">{item}</span>
                  </li>
                ))}
              </ul>

              <a
                href={generateWhatsAppLink('RENTAL')}
                target="_blank"
                rel="noopener noreferrer"
                className="block text-center w-full border-2 border-emerald-600 text-emerald-400 hover:bg-emerald-600 hover:text-white py-4 rounded-2xl font-bold text-sm transition-all duration-300 group-hover:border-emerald-400 group-hover:shadow-[0_0_24px_rgba(16,185,129,0.18)]"
              >
                Hubungi Kami
              </a>
            </div>
          </div>

          {/* Card 2: Beli Unit MicroCell (Highlighted) */}
          <div className="group relative flex h-full min-h-[560px] flex-col overflow-hidden rounded-[32px] border border-emerald-500/30 bg-[#115E2E] p-8 shadow-2xl transition-all duration-300 ease-out hover:-translate-y-6 hover:scale-[1.01] hover:border-emerald-300/70 hover:shadow-[0_32px_80px_rgba(16,185,129,0.28)] md:p-10 lg:-translate-y-4">
            <div className="absolute inset-0 bg-gradient-to-br from-white/0 via-white/0 to-white/0 opacity-0 transition-opacity duration-300 group-hover:opacity-100 group-hover:from-white/10 group-hover:via-transparent group-hover:to-transparent" />
            <div className="relative z-10 flex justify-between items-start mb-6">
              <div>
                <div className="flex items-center gap-1.5 text-amber-300 font-bold text-xs mb-3">
                  <Star size={14} fill="currentColor" /> Rekomendasi
                </div>
                <div className="border border-white/30 bg-white/10 text-white font-bold text-xs px-4 py-1.5 rounded-full inline-block backdrop-blur-sm">
                  B2C Peternak
                </div>
              </div>
              <div className="w-10 h-10 bg-white rounded-full flex items-center justify-center text-emerald-800 shrink-0 ml-2">
                <PawPrint size={18} fill="currentColor" />
              </div>
            </div>

            <div className="relative z-10 flex flex-1 flex-col">
              <h3 className="font-sans text-2xl font-bold text-white mb-2">Beli Unit MicroCell</h3>
              <p className="text-emerald-100/90 text-sm mb-6">Kepemilikan penuh, sekali bayar</p>

              <div className="mb-6">
                <span className="text-2xl font-bold text-emerald-300">Rp 6.000.000</span>
                <span className="block text-emerald-300/80 text-sm mt-1">/ unit · bayar tunai</span>
              </div>

              <div className="mb-8 border-t border-emerald-400/30 pt-4">
                <span className="text-[10px] text-emerald-300/80 font-bold tracking-wider mb-2 block uppercase">ATAU</span>
                <div className="flex justify-between items-center text-white mb-2">
                  <span className="font-bold text-sm md:text-base">Rp 500.000</span>
                  <span className="text-xs text-emerald-100/70">/ bln (12 bln)</span>
                </div>
                <div className="flex justify-between items-center text-white">
                  <span className="font-bold text-sm md:text-base">Rp 1.000.000</span>
                  <span className="text-xs text-emerald-100/70">/ bln (6 bln)</span>
                </div>
              </div>

              <ul className="space-y-4 flex-1 mb-10">
                {[
                  'Unit MicroCell menjadi milik Anda sepenuhnya',
                  'Target: peternak sapi skala 10-100 ekor',
                  'Garansi hardware 1 tahun',
                  'Instalasi awal termasuk dalam paket',
                  'Pendampingan teknis di awal penggunaan'
                ].map((item, i) => (
                  <li key={i} className="flex items-start gap-3">
                    <CheckCircle2 size={18} className="text-white mt-0.5 flex-shrink-0 transition-transform duration-300 group-hover:scale-110" />
                    <span className="text-sm text-emerald-50 leading-relaxed">{item}</span>
                  </li>
                ))}
              </ul>

              <a
                href={generateWhatsAppLink('PURCHASE')}
                target="_blank"
                rel="noopener noreferrer"
                className="block text-center w-full bg-white text-emerald-900 hover:bg-emerald-100 hover:shadow-[0_0_20px_rgba(255,255,255,0.3)] py-4 rounded-2xl font-extrabold text-sm transition-all duration-300 group-hover:shadow-[0_0_28px_rgba(255,255,255,0.38)]"
              >
                Beli Sekarang
              </a>
            </div>
          </div>

          {/* Card 3: Layanan & After-Sales */}
          <div className="group relative flex h-full min-h-[560px] flex-col overflow-hidden rounded-[32px] border border-emerald-800/50 bg-[#0A2F1D] p-8 shadow-lg transition-all duration-300 ease-out hover:-translate-y-3 hover:border-emerald-500/60 hover:shadow-[0_28px_70px_rgba(4,55,34,0.28)] md:p-10">
            <div className="absolute inset-0 bg-gradient-to-br from-emerald-400/0 via-emerald-400/0 to-emerald-400/0 opacity-0 transition-opacity duration-300 group-hover:opacity-100 group-hover:from-emerald-400/8 group-hover:via-transparent group-hover:to-transparent" />
            <div className="relative z-10 flex justify-between items-start mb-8">
              <div className="bg-white/10 border border-white/20 text-emerald-100 font-bold text-xs px-4 py-1.5 rounded-full inline-block">
                Untuk Semua Pembeli & Penyewa
              </div>
              <div className="w-10 h-10 bg-emerald-900/50 rounded-full flex items-center justify-center text-emerald-400 shrink-0 ml-2">
                <Wrench size={18} />
              </div>
            </div>

            <div className="relative z-10 flex flex-1 flex-col">
              <h3 className="font-sans text-2xl font-bold text-white mb-2 pr-4">Layanan Instalasi & After-Sales Service</h3>

              <div className="mb-2 mt-4">
                <span className="text-2xl font-bold text-emerald-400">Rp 300.000</span>
                <span className="block text-emerald-400/80 text-sm mt-1">/ kunjungan servis</span>
              </div>

              <ul className="space-y-4 flex-1 mb-10">
                {[
                  'Tersedia untuk seluruh pengguna unit MicroCell',
                  'Kunjungan teknisi prioritas ke lokasi',
                  'Cek dan penggantian komponen',
                  'Laporan kondisi sistem setiap kunjungan'
                ].map((item, i) => (
                  <li key={i} className="flex items-start gap-3">
                    <CheckCircle2 size={18} className="text-emerald-400 mt-0.5 flex-shrink-0 transition-transform duration-300 group-hover:scale-110" />
                    <span className="text-sm text-emerald-100/90 leading-relaxed">{item}</span>
                  </li>
                ))}
              </ul>

              <a
                href={generateWhatsAppLink('SERVICE')}
                target="_blank"
                rel="noopener noreferrer"
                className="block text-center w-full border-2 border-emerald-600 text-emerald-400 hover:bg-emerald-600 hover:text-white py-4 rounded-2xl font-bold text-sm transition-all duration-300 group-hover:border-emerald-400 group-hover:shadow-[0_0_24px_rgba(16,185,129,0.18)]"
              >
                Hubungi Kami
              </a>
            </div>
          </div>

        </div>

        <div className="bg-white border border-emerald-500 rounded-3xl p-6 md:p-8 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6 md:gap-5 shadow-md shadow-emerald-900/5 mt-8 w-full">

          <div className="flex flex-col">
            <span className="text-[9px] text-emerald-500 uppercase tracking-wider font-bold">Bahan Baku</span>
            <span className="text-xs sm:text-sm font-bold text-emerald-950 mt-1 font-sans">Limbah Ternak</span>
          </div>

          <div className="flex flex-col md:border-l md:border-emerald-100 md:pl-4">
            <span className="text-[9px] text-emerald-500 uppercase tracking-wider font-bold">Output Daya</span>
            <span className="text-xs sm:text-sm font-bold text-emerald-950 mt-1 font-sans">AC 220V / DC 12V</span>
          </div>

          <div className="flex flex-col md:border-l md:border-emerald-100 md:pl-4">
            <span className="text-[9px] text-emerald-500 uppercase tracking-wider font-bold">Format Desain</span>
            <span className="text-xs sm:text-sm font-bold text-emerald-950 mt-1 font-sans">Stackable Modular</span>
          </div>

          <div className="flex flex-col md:border-l md:border-emerald-100 md:pl-4">
            <span className="text-[9px] text-emerald-500 uppercase tracking-wider font-bold">Penyimpanan</span>
            <span className="text-xs sm:text-sm font-bold text-emerald-950 mt-1 font-sans">Baterai 12V</span>
          </div>

          <div className="flex flex-col md:border-l md:border-emerald-100 md:pl-4">
            <span className="text-[9px] text-emerald-500 uppercase tracking-wider font-bold">Kategori Dampak</span>
            <span className="text-xs sm:text-sm font-bold text-emerald-950 mt-1 font-sans">Circular Economy</span>
          </div>

        </div>

      </div>
    </section>
  );
}
