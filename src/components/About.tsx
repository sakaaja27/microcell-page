import React from 'react';
import { Dna, Smartphone, Layers, AlertCircle, CheckCircle, ArrowRight } from 'lucide-react';

interface AboutProps {
  onOpenSimulator: () => void;
}

export default function About({ onOpenSimulator }: AboutProps) {
  return (
    <section className="py-24 bg-[#F0FDF4] text-[#041706]" id="about">
      <div className="max-w-6xl mx-auto px-6">
        
        {/* Section Header */}
        <div className="text-center mb-16">
          <h2 className="font-sans text-3xl sm:text-4xl font-extrabold text-emerald-950 tracking-tight mb-4">
            Masa Depan Energi dari Alam
          </h2>
          <p className="font-sans text-sm sm:text-base text-emerald-800 max-w-3xl mx-auto leading-relaxed">
            MicroCell mengintegrasikan teknologi <span className="font-semibold text-emerald-950">Microbial Fuel Cell (MFC)</span> mutakhir untuk memanen energi listrik langsung dari penguraian biologis limbah cair peternakan sapi secara bersih, aman, dan tanpa pembakaran sama sekali.
          </p>
        </div>

        {/* Feature Cards Grid */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
          
          {/* Feature 1 */}
          <div className="bg-white p-8 rounded-3xl border border-emerald-500/10 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:shadow-emerald-900/5 group">
            <div className="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6 text-emerald-600 transition-colors duration-300 group-hover:bg-emerald-600 group-hover:text-white">
              <Dna size={28} />
            </div>
            <h3 className="font-sans text-xl font-bold text-emerald-950 mb-3">Biokatalis Alami</h3>
            <p className="text-sm text-emerald-800 leading-relaxed">
              Mengoptimalkan konsorsium bakteri anaerobik indigenous untuk memetabolisme materi organik dalam limbah, mentransfer elektron langsung ke anoda.
            </p>
          </div>

          {/* Feature 2 */}
          <div className="bg-white p-8 rounded-3xl border border-emerald-500/10 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:shadow-emerald-900/5 group">
            <div className="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6 text-emerald-600 transition-colors duration-300 group-hover:bg-emerald-600 group-hover:text-white">
              <Smartphone size={28} />
            </div>
            <h3 className="font-sans text-xl font-bold text-emerald-950 mb-3">Kendali Pintar</h3>
            <p className="text-sm text-emerald-800 leading-relaxed">
              Dilengkapi sensor nirkabel IoT terintegrasi untuk membaca data tegangan, arus, asupan substrat, dan temperatur reaktor secara langsung.
            </p>
            <button 
              onClick={onOpenSimulator}
              className="mt-4 flex items-center gap-1.5 text-xs font-bold text-emerald-600 hover:text-emerald-700 hover:underline transition-all"
            >
              Uji Coba Demo IoT <ArrowRight size={14} />
            </button>
          </div>

          {/* Feature 3 */}
          <div className="bg-white p-8 rounded-3xl border border-emerald-500/10 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:shadow-emerald-900/5 group">
            <div className="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6 text-emerald-600 transition-colors duration-300 group-hover:bg-emerald-600 group-hover:text-white">
              <Layers size={28} />
            </div>
            <h3 className="font-sans text-xl font-bold text-emerald-950 mb-3">Unit Modular</h3>
            <p className="text-sm text-emerald-800 leading-relaxed">
              Sistem box-modular mandiri yang ringkas, praktis dipasang di segala medan, serta mudah diperluas (scale-up) sesuai kebutuhan listrik.
            </p>
          </div>

        </div>

        {/* Contrast Comparison bar */}
        <div className="bg-white rounded-[32px] overflow-hidden border border-emerald-500/10 shadow-md flex flex-col md:flex-row items-stretch">
          
          {/* Hazards */}
          <div className="flex-1 bg-red-500/5 p-8 md:p-10 flex flex-col justify-center border-b md:border-b-0 md:border-r border-emerald-500/10">
            <h4 className="text-red-700 font-sans text-lg font-bold mb-4 flex items-center gap-2">
              <AlertCircle size={20} className="text-red-600" /> Masalah Lingkungan Sekitar
            </h4>
            <ul className="space-y-4">
              <li className="flex items-start gap-3 text-sm text-emerald-900/80">
                <span className="h-5 w-5 rounded-full bg-red-100 text-red-600 flex items-center justify-center font-bold text-xs flex-shrink-0 mt-0.5">✕</span>
                <span>Pencemaran air tanah, bau menusuk, dan wabah penyakit akibat pembuangan limbah cair kotoran sapi tanpa filtrasi.</span>
              </li>
              <li className="flex items-start gap-3 text-sm text-emerald-900/80">
                <span className="h-5 w-5 rounded-full bg-red-100 text-red-600 flex items-center justify-center font-bold text-xs flex-shrink-0 mt-0.5">✕</span>
                <span>Emisi gas metana (CH₄) dan dinitrogen oksida dari kotoran terbuka yang mempercepat pemanasan global secara masif.</span>
              </li>
            </ul>
          </div>

          {/* Solution */}
          <div className="flex-1 bg-emerald-500/5 p-8 md:p-10 flex flex-col justify-center">
            <h4 className="text-emerald-800 font-sans text-lg font-bold mb-4 flex items-center gap-2">
              <CheckCircle size={20} className="text-emerald-600" /> Solusi Inovatif MicroCell
            </h4>
            <ul className="space-y-4">
              <li className="flex items-start gap-3 text-sm text-emerald-950">
                <span className="h-5 w-5 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-xs flex-shrink-0 mt-0.5">✓</span>
                <span><strong>Filtrasi &amp; Purifikasi Serentak</strong>: Mengolah air limbah kotoran menjadi ramah lingkungan sekaligus memanen listrik kontinu.</span>
              </li>
              <li className="flex items-start gap-3 text-sm text-emerald-950">
                <span className="h-5 w-5 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-xs flex-shrink-0 mt-0.5">✓</span>
                <span><strong>Ekonomi Sirkular Mandiri</strong>: Mengubah beban limbah peternakan harian menjadi aset penghasil daya dan pupuk organik berkualitas tinggi.</span>
              </li>
            </ul>
          </div>

        </div>

      </div>
    </section>
  );
}
