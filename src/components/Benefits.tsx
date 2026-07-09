import React from 'react';
import { BarChart3, HelpCircle, ArrowRight } from 'lucide-react';

interface BenefitsProps {
  onOpenSurvey: () => void;
  onOpenCalculator: () => void;
}

export default function Benefits({ onOpenSurvey, onOpenCalculator }: BenefitsProps) {
  return (
    <section className="py-24 bg-white text-[#041706]" id="benefits">
      <div className="max-w-6xl mx-auto px-6">
        
        {/* Section Header */}
        <div className="text-center mb-16">
          <span className="text-[10px] bg-emerald-500/10 text-emerald-600 border border-emerald-500/20 px-3 py-1 rounded-full font-bold uppercase tracking-widest">
            Dampak Sosio-Ekologis
          </span>
          <h2 className="mt-4 font-sans text-3xl sm:text-4xl font-extrabold text-emerald-950 tracking-tight mb-4">
            Keuntungan Berkelanjutan
          </h2>
          <p className="font-sans text-sm sm:text-base text-emerald-800 max-w-2xl mx-auto leading-relaxed">
            Investasi cerdas yang tidak hanya mengamankan kebutuhan daya Anda harian, namun juga menghidupkan kelestarian tanah air jangka panjang.
          </p>
        </div>

        {/* 3-Column Visual Layout */}
        <div className="grid grid-cols-1 lg:grid-cols-3 gap-6 items-center mb-20">
          
          {/* Card Left: Mandiri Energi */}
          <div className="bg-white p-8 md:p-10 rounded-[32px] border border-emerald-500/10 shadow-sm transition-all duration-300 hover:shadow-md hover:border-emerald-500/20 h-full flex flex-col justify-between">
            <div>
              <div className="text-3xl mb-6">🔌</div>
              <h3 className="font-sans text-xl font-bold text-emerald-950 mb-4">Mandiri Energi</h3>
              <p className="text-sm text-emerald-800 leading-relaxed font-sans">
                Membebaskan peternakan Anda dari ketergantungan jaringan listrik pusat konvensional. Solusi handal di kawasan rural yang rentan mengalami pemadaman bergilir atau belum terjangkau tiang listrik.
              </p>
            </div>
            <div className="mt-8 pt-4 border-t border-emerald-500/10 flex items-center text-xs font-semibold text-emerald-600">
              Kedaulatan Daya 100%
            </div>
          </div>

          {/* Card Center: High-Contrast Showcase Card */}
          <div className="bg-gradient-to-br from-emerald-950 to-[#021808] p-8 md:p-10 rounded-[36px] shadow-xl shadow-emerald-950/20 text-white lg:scale-105 border border-emerald-500/20 relative z-10 flex flex-col justify-between min-h-[420px]">
            <div>
              <span className="inline-block px-3 py-1 rounded bg-emerald-500 text-[#041706] font-sans text-[10px] font-extrabold uppercase tracking-widest mb-6">
                UNGGULAN UTAMA
              </span>
              <h3 className="font-sans text-2xl md:text-3xl font-extrabold text-white mb-4 leading-tight">
                Zero Waste &amp; Zero Emission
              </h3>
              <p className="text-sm text-emerald-200/80 leading-relaxed font-sans">
                Mengonversi polutan organik berbahaya menjadi aliran elektron bersih secara alami, meniadakan emisi gas buang berbahaya, sekaligus menghilangkan aroma kotoran menyengat di kawasan hunian.
              </p>
            </div>

            <div className="mt-8 space-y-4">
              <button 
                onClick={onOpenCalculator}
                className="w-full bg-emerald-500 hover:bg-emerald-400 text-[#041706] py-3.5 px-6 rounded-xl font-bold text-sm transition-all duration-200 flex items-center justify-center gap-2"
              >
                Simulasikan Hasil Daya Anda
                <ArrowRight size={16} />
              </button>
            </div>
          </div>

          {/* Card Right: Sisa Organik */}
          <div className="bg-white p-8 md:p-10 rounded-[32px] border border-emerald-500/10 shadow-sm transition-all duration-300 hover:shadow-md hover:border-emerald-500/20 h-full flex flex-col justify-between">
            <div>
              <div className="text-3xl mb-6">🌱</div>
              <h3 className="font-sans text-xl font-bold text-emerald-950 mb-4">Sisa Organik</h3>
              <p className="text-sm text-emerald-800 leading-relaxed font-sans">
                Limbah keluaran (effluent) hasil metabolisme bakteri anaerobik telah terstabilisasi penuh secara higienis, menjadikannya pupuk organik cair bermutu tinggi yang kaya unsur hara makro/mikro.
              </p>
            </div>
            <div className="mt-8 pt-4 border-t border-emerald-500/10 flex items-center text-xs font-semibold text-emerald-600">
              Pupuk Cair Nilai Tambah
            </div>
          </div>

        </div>

        {/* Bottom Call-to-Action Banner */}
        <div className="bg-emerald-50 rounded-3xl p-6 md:p-8 border border-emerald-500/10 flex flex-col md:flex-row items-center justify-between gap-6">
          <div className="flex items-center gap-4">
            <div className="w-12 h-12 bg-white rounded-full flex items-center justify-center text-emerald-600 border border-emerald-200 shadow-sm flex-shrink-0">
              <BarChart3 size={20} />
            </div>
            <div>
              <p className="font-sans font-bold text-base text-emerald-950">
                Ingin tahu seberapa besar potensi energi dari peternakan Anda?
              </p>
              <p className="text-xs text-emerald-800 font-sans mt-0.5">
                Cari tahu perkiraan watt kontinu dan pupuk organik cair yang bisa diproduksi harian.
              </p>
            </div>
          </div>
          
          <div className="flex gap-3 w-full md:w-auto flex-col sm:flex-row">
            <button 
              onClick={onOpenCalculator}
              className="bg-white border border-emerald-500/20 hover:bg-emerald-500 hover:text-white text-emerald-700 font-bold px-6 py-3 rounded-full text-xs transition-all w-full md:w-auto cursor-pointer"
            >
              Mulai Hitung Cepat
            </button>
            
            <button 
              onClick={onOpenSurvey}
              className="bg-emerald-900 hover:bg-[#041706] text-white font-bold px-6 py-3 rounded-full text-xs transition-all w-full md:w-auto"
            >
              Isi Survei &amp; Undang Tim
            </button>
          </div>
        </div>

      </div>
    </section>
  );
}
