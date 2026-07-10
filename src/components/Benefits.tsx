import React from 'react';
import { Recycle, Zap, Globe, ClipboardList, CheckCircle2 } from 'lucide-react';

interface BenefitsProps {
  onOpenSurvey: () => void;
  onOpenCalculator: () => void;
}

export default function Benefits({ onOpenSurvey }: BenefitsProps) {
  return (
    <section className="py-24 bg-white text-emerald-950" id="benefits">
      <div className="max-w-7xl mx-auto px-6">
        
        {/* Section Header */}
        <div className="text-center mb-16">
          <div className="inline-flex items-center justify-center border border-emerald-500/30 rounded-full px-4 py-1 mb-6">
            <span className="text-xs font-bold text-emerald-700 tracking-widest uppercase">Manfaat</span>
          </div>
          <h2 className="font-sans text-4xl md:text-5xl font-extrabold text-emerald-900 tracking-tight mb-6 max-w-4xl mx-auto leading-tight">
            Dirancang untuk Kebutuhan Nyata Peternak
          </h2>
          <p className="font-sans text-base md:text-lg text-emerald-700/80 max-w-3xl mx-auto leading-relaxed">
            MicroCell hadir sebagai solusi terpadu yang memberikan manfaat nyata dari sisi lingkungan, ekonomi, dan operasional peternakan sehari-hari.
          </p>
        </div>

        {/* 3 Columns Grid */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          
          {/* Card 1: Kiri */}
          <div className="bg-[#0A2F1D] text-emerald-50 rounded-[32px] p-8 md:p-10 shadow-lg relative overflow-hidden flex flex-col group">
            <div className="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center mb-6 text-emerald-400">
              <Recycle size={24} />
            </div>
            <h3 className="font-sans text-2xl font-bold mb-6 text-white leading-snug">
              Atasi Limbah Kotoran Sapi
            </h3>
            <ul className="space-y-4 flex-1">
              {[
                'Limbah kotoran sapi dimanfaatkan menjadi energi listrik',
                'Kandang lebih bersih dan bebas bau menyengat',
                'Tidak memerlukan operator teknis khusus'
              ].map((item, i) => (
                <li key={i} className="flex items-start gap-3">
                  <CheckCircle2 size={18} className="text-emerald-400 mt-1 flex-shrink-0" />
                  <span className="text-sm md:text-base text-emerald-100/90 leading-relaxed">{item}</span>
                </li>
              ))}
            </ul>
            <div className="absolute -bottom-8 -right-8 text-white/5 group-hover:scale-110 transition-transform duration-500">
              <Recycle size={160} />
            </div>
          </div>

          {/* Card 2: Tengah (Utama) */}
          <div className="bg-[#16A34A] text-white rounded-[32px] p-8 md:p-10 shadow-xl relative overflow-hidden flex flex-col md:-translate-y-4 group">
            <div className="absolute top-6 right-6 bg-white/20 px-3 py-1 rounded-full backdrop-blur-sm">
              <span className="text-xs font-bold text-white uppercase tracking-wider">Manfaat Utama</span>
            </div>
            <div className="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mb-6 text-white backdrop-blur-sm">
              <Zap size={24} className="fill-white" />
            </div>
            <h3 className="font-sans text-2xl font-bold mb-6 text-white leading-snug">
              Kurangi Biaya Listrik Operasional
            </h3>
            <ul className="space-y-4 flex-1">
              {[
                'Hasilkan energi listrik sendiri dari dalam kandang',
                'Kurangi ketergantungan pada listrik dari luar',
                'Investasi jangka panjang yang menguntungkan'
              ].map((item, i) => (
                <li key={i} className="flex items-start gap-3">
                  <CheckCircle2 size={18} className="text-white mt-1 flex-shrink-0" />
                  <span className="text-sm md:text-base text-emerald-50 leading-relaxed">{item}</span>
                </li>
              ))}
            </ul>
          </div>

          {/* Card 3: Kanan */}
          <div className="bg-[#0A2F1D] text-emerald-50 rounded-[32px] p-8 md:p-10 shadow-lg relative overflow-hidden flex flex-col group">
            <div className="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center mb-6 text-emerald-400">
              <Globe size={24} />
            </div>
            <h3 className="font-sans text-2xl font-bold mb-6 text-white leading-snug">
              Dampak Lingkungan & Sosial
            </h3>
            <ul className="space-y-4 flex-1">
              {[
                'Kurangi emisi gas metana dari limbah ternak',
                'Tingkatkan citra usaha peternakan',
                'Berkontribusi pada SDG 7, SDG 12, dan SDG 13',
              ].map((item, i) => (
                <li key={i} className="flex items-start gap-3">
                  <CheckCircle2 size={18} className="text-emerald-400 mt-1 flex-shrink-0" />
                  <span className="text-sm md:text-base text-emerald-100/90 leading-relaxed">{item}</span>
                </li>
              ))}
            </ul>
            <div className="absolute -bottom-8 -right-8 text-white/5 group-hover:scale-110 transition-transform duration-500">
              <Globe size={160} />
            </div>
          </div>

        </div>

        {/* Survey Banner */}
        {/* <div className="bg-[#0D3B25] rounded-[32px] p-8 md:p-10 flex flex-col md:flex-row items-center gap-8 mb-8 mx-auto max-w-5xl shadow-lg relative overflow-hidden">
          <div className="w-16 h-16 bg-emerald-500/20 rounded-2xl flex items-center justify-center flex-shrink-0 border border-emerald-500/30">
            <ClipboardList size={32} className="text-emerald-400" />
          </div>
          <div className="flex-1 text-center md:text-left text-emerald-50 relative z-10">
            <p className="font-sans text-sm md:text-base leading-relaxed mb-4">
              Berdasarkan survei lapangan yang kami lakukan kepada peternak di wilayah Jawa Timur — sebagian besar responden menghadapi tantangan pengelolaan limbah dan biaya listrik secara bersamaan, dan menyatakan terbuka terhadap solusi teknologi terjangkau seperti MicroCell.
            </p>
            <div className="inline-block bg-emerald-500/20 px-4 py-1.5 rounded-full border border-emerald-500/30">
              <span className="text-xs font-semibold text-emerald-300">Survei Problem-Solution Fit - Kabupaten Jember - 2024</span>
            </div>
          </div>
        </div> */}

        {/* CTA Banner */}
        <div className="bg-[#0A2F1D] rounded-full px-8 py-6 md:px-12 md:py-8 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl mx-auto max-w-5xl">
          <div className="text-center md:text-left">
            <h3 className="font-sans text-xl md:text-2xl font-bold text-white mb-1">
              Siap Mengubah Limbah Menjadi Berkah?
            </h3>
            <p className="text-emerald-200/80 text-sm md:text-base">
              Konsultasikan instalasi MicroCell untuk peternakan Anda sekarang.
            </p>
          </div>
          <button 
            onClick={onOpenSurvey}
            className="whitespace-nowrap bg-emerald-300 hover:bg-emerald-400 text-emerald-950 font-bold px-8 py-4 rounded-full transition-colors duration-300 flex-shrink-0 shadow-lg shadow-emerald-400/20"
          >
            Hubungi Tim Ahli
          </button>
        </div>

      </div>
    </section>
  );
}
