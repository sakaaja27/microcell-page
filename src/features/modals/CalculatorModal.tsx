import React, { useState } from 'react';
import { X, Zap, Leaf, DollarSign, Sparkles, Scale, Info } from 'lucide-react';
import { motion, AnimatePresence } from 'motion/react';

interface CalculatorModalProps {
  isOpen: boolean;
  onClose: () => void;
}

export default function CalculatorModal({ isOpen, onClose }: CalculatorModalProps) {
  const [cows, setCows] = useState<number>(10);

  // Constants for calculation
  const wastePerCowPerDay = 15; // kg of wet manure
  const whPerKg = 160; // Wh generated per kg via MicroCell MFC technology
  const electricityTariff = 1444.70; // IDR per kWh (B1/subsidy tariff or standard household)
  const co2ReductionPerCowPerYear = 438; // kg CO2 equivalent captured/mitigated per cow per year via anaerobic stabilization

  // Calculated values
  const dailyWaste = cows * wastePerCowPerDay; // kg/day
  const dailyEnergyWh = dailyWaste * whPerKg; // Wh/day
  const dailyEnergyKwh = dailyEnergyWh / 1000; // kWh/day
  const continuousPower = dailyEnergyWh / 24; // Watts continuous
  const ledBulbs = Math.floor(continuousPower / 10); // Number of 10W LED bulbs powered 24/7
  const monthlySavings = Math.round(dailyEnergyKwh * 30 * electricityTariff); // IDR/month
  const annualCO2Reduced = Math.round(cows * co2ReductionPerCowPerYear); // kg CO2/year

  const formatRupiah = (num: number) => {
    return 'Rp ' + num.toLocaleString('id-ID');
  };

  if (!isOpen) return null;

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-4">
      {/* Backdrop */}
      <div 
        className="absolute inset-0 bg-emerald-950/70 backdrop-blur-md" 
        onClick={onClose} 
      />

      {/* Modal Container */}
      <div className="relative w-full max-w-2xl overflow-hidden rounded-3xl border border-emerald-500/20 bg-[#0c200d] text-emerald-100 shadow-2xl">
        {/* Banner header decoration */}
        <div className="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-500 via-teal-400 to-emerald-500" />
        
        {/* Close Button */}
        <button 
          onClick={onClose}
          className="absolute top-4 right-4 flex h-10 w-10 items-center justify-center rounded-full border border-emerald-500/20 bg-emerald-900/30 text-emerald-300 hover:bg-emerald-500 hover:text-[#041706] transition-all duration-200"
        >
          <X size={20} />
        </button>

        {/* Content */}
        <div className="p-6 md:p-8">
          <div className="mb-6 flex items-center gap-3">
            <div className="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/20 text-emerald-400">
              <Zap size={24} className="animate-pulse" />
            </div>
            <div>
              <h3 className="font-sans text-xl font-bold text-white md:text-2xl">Kalkulator Potensi Energi</h3>
              <p className="text-xs text-emerald-400">Estimasi hasil listrik & dampak ekonomi peternakan Anda</p>
            </div>
          </div>

          {/* Slider Input */}
          <div className="mb-8 rounded-2xl border border-emerald-500/10 bg-emerald-950/40 p-5">
            <div className="mb-4 flex items-center justify-between">
              <label className="text-sm font-medium text-emerald-300 flex items-center gap-2">
                <Scale size={16} className="text-emerald-400" />
                Jumlah Sapi Peternakan:
              </label>
              <span className="font-mono text-2xl font-bold text-white bg-emerald-500/20 px-3 py-1 rounded-lg">
                {cows} <span className="text-xs font-normal text-emerald-400">Ekor</span>
              </span>
            </div>
            <input 
              type="range" 
              min="2" 
              max="150" 
              value={cows} 
              onChange={(e) => setCows(parseInt(e.target.value) || 2)}
              className="h-2 w-full cursor-pointer appearance-none rounded-lg bg-emerald-900 accent-emerald-500 focus:outline-none"
            />
            <div className="mt-2 flex justify-between text-xs text-emerald-500">
              <span>2 Ekor (Rumah Tangga)</span>
              <span>150 Ekor (Koperasi Besar)</span>
            </div>
          </div>

          {/* Dynamic calculations grid */}
          <div className="grid grid-cols-1 gap-4 sm:grid-cols-2">
            
            {/* Input estimate */}
            <div className="rounded-xl border border-emerald-500/5 bg-emerald-950/20 p-4">
              <div className="text-xs text-emerald-400">Estimasi Limbah Cair / Hari</div>
              <div className="mt-1 font-mono text-xl font-bold text-white">
                {dailyWaste} <span className="text-sm font-normal text-emerald-300">kg</span>
              </div>
              <div className="mt-1 text-[10px] text-emerald-500">Bahan baku basah harian</div>
            </div>

            {/* Generated output electricity */}
            <div className="rounded-xl border border-emerald-500/10 bg-emerald-900/10 p-4">
              <div className="text-xs text-emerald-400 flex items-center gap-1">
                Output Energi Listrik
                <Sparkles size={12} className="text-emerald-400" />
              </div>
              <div className="mt-1 font-mono text-xl font-bold text-emerald-300">
                {dailyEnergyKwh.toFixed(2)} <span className="text-sm font-normal text-emerald-400">kWh / hari</span>
              </div>
              <div className="mt-1 text-[10px] text-emerald-500">Output daya: {continuousPower.toFixed(0)}W kontinu</div>
            </div>

            {/* Equivalencies */}
            <div className="rounded-xl border border-emerald-500/5 bg-emerald-950/20 p-4">
              <div className="text-xs text-emerald-400">Lampu LED Menyala 24 Jam</div>
              <div className="mt-1 font-mono text-xl font-bold text-white flex items-baseline gap-1">
                {ledBulbs} <span className="text-sm font-normal text-emerald-300">Buah</span>
              </div>
              <div className="mt-1 text-[10px] text-emerald-500">Menggunakan lampu LED hemat daya 10W</div>
            </div>

            {/* CO2 reduction */}
            <div className="rounded-xl border border-emerald-500/10 bg-emerald-900/10 p-4">
              <div className="text-xs text-emerald-400 flex items-center gap-1">
                Reduksi Gas Metana & CO2
                <Leaf size={12} className="text-emerald-400" />
              </div>
              <div className="mt-1 font-mono text-xl font-bold text-emerald-300 flex items-baseline gap-1">
                {annualCO2Reduced.toLocaleString('id-ID')} <span className="text-sm font-normal text-emerald-400">kg / thn</span>
              </div>
              <div className="mt-1 text-[10px] text-emerald-500">Mencegah gas rumah kaca terlepas bebas</div>
            </div>

            {/* Monthly saving large block */}
            <div className="sm:col-span-2 rounded-2xl border border-emerald-500/20 bg-emerald-950/60 p-5 flex flex-col sm:flex-row justify-between items-center gap-4">
              <div>
                <div className="text-xs text-emerald-400 flex items-center gap-1">
                  <DollarSign size={14} /> Est. Penghematan Biaya Listrik
                </div>
                <div className="mt-1 font-sans text-2xl font-bold text-white">
                  {formatRupiah(monthlySavings)} <span className="text-xs font-normal text-emerald-400">/ bulan</span>
                </div>
              </div>
              <div className="rounded-lg bg-emerald-500 text-[#041706] px-4 py-2 text-center text-xs font-bold">
                Meningkatkan Profitibilitas Sampingan
              </div>
            </div>

          </div>

          <div className="mt-6 flex items-start gap-2 text-[11px] text-emerald-500 leading-relaxed">
            <Info size={14} className="mt-0.5 flex-shrink-0 text-emerald-400" />
            <p>
              *Kalkulasi bersifat estimasi rata-rata berdasarkan asupan pakan standar dan efisiensi konversi Microbial Fuel Cell (MFC) MicroCell sebesar 82%. Biaya dihitung menggunakan tarif dasar listrik rumah tangga nonsubsidi.
            </p>
          </div>

          {/* Action buttons */}
          <div className="mt-8 flex flex-col gap-3 sm:flex-row">
            <button 
              onClick={onClose}
              className="w-full rounded-full border border-emerald-500/20 bg-emerald-950 px-6 py-3 text-center text-sm font-bold text-emerald-300 hover:bg-emerald-900/50 transition-all duration-200"
            >
              Tutup Kalkulator
            </button>
            <a 
              href="https://wa.me/6281234567890?text=Halo%20MicroCell,%20saya%20sudah%20mencoba%20kalkulator%20dan%20ingin%20konsultasi%20untuk%20peternakan%20saya%20dengan%20kapasitas%20sapinya%20tertera%20..."
              target="_blank"
              rel="noopener noreferrer"
              className="w-full rounded-full bg-emerald-500 px-6 py-3 text-center text-sm font-bold text-[#041706] hover:bg-emerald-400 hover:shadow-[0_0_15px_rgba(16,185,129,0.4)] transition-all duration-200"
            >
              Konsultasikan Desain Saya
            </a>
          </div>
        </div>
      </div>
    </div>
  );
}
