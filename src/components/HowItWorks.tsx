import React from 'react';

export default function HowItWorks() {
  const steps = [
    {
      num: '01',
      emoji: '🐄',
      title: 'Pengumpulan',
      desc: 'Limbah cair dari kotoran peternakan disalurkan ke bak ekualisasi primer untuk homogenisasi dan penstabilan pH awal.',
    },
    {
      num: '02',
      emoji: '🧫',
      title: 'Bioreaktor MFC',
      desc: 'Substrat cair masuk ke ruang anoda anaerobik, di mana koloni aktif mikroba memetabolisme asam organik dan memicu transfer elektron.',
    },
    {
      num: '03',
      emoji: '⚡',
      title: 'Aliran Elektron',
      desc: 'Elektron mengalir melintasi sirkuit eksternal ke ruang katoda aerobik, menghasilkan beda potensial listrik searah (DC) yang stabil.',
    },
    {
      num: '04',
      emoji: '☀️',
      title: 'Regulasi Booster',
      desc: 'Booster cerdas melipatgandakan milivolt biologi menjadi tegangan standar yang siap disalurkan ke peralatan rumah tangga.',
    },
    {
      num: '05',
      emoji: '🔋',
      title: 'Baterai Penyimpan',
      desc: 'Kelebihan daya disimpan aman ke dalam bank baterai LiFePO4 pintar untuk mensuplai beban puncak listrik, terutama di malam hari.',
    },
    {
      num: '06',
      emoji: '📱',
      title: 'Visualisasi IoT',
      desc: 'Konektivitas nirkabel mengirim data performa sirkuit dan viabilitas mikroba ke aplikasi mobile secara real-time dan transparan.',
    },
  ];

  return (
    <section className="py-24 bg-emerald-950 text-white" id="how-it-works">
      <div className="max-w-6xl mx-auto px-6">
        
        {/* Header */}
        <div className="text-center mb-20">
          <span className="text-[10px] bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-3 py-1 rounded-full font-bold uppercase tracking-widest">
            Siklus Biokimia Cerdas
          </span>
          <h2 className="mt-4 font-sans text-3xl sm:text-4xl font-extrabold tracking-tight mb-4">
            Alur Kerja Regeneratif
          </h2>
          <p className="font-sans text-sm sm:text-base text-emerald-200/80 max-w-2xl mx-auto leading-relaxed">
            Dari pembersihan kandang hingga menyalakan peralatan listrik rumah tangga Anda, temukan alur konversi bersih tanpa limbah sisa berbahaya.
          </p>
        </div>

        {/* Steps Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {steps.map((step, idx) => (
            <div 
              key={idx}
              className="glass-card p-8 rounded-[28px] relative overflow-hidden group transition-all duration-300 hover:border-emerald-500/30 hover:-translate-y-1.5"
            >
              {/* Massive glowing index back numbers */}
              <div className="absolute -right-3 -top-6 text-8xl font-black text-emerald-500/5 select-none transition-all duration-300 group-hover:text-emerald-400/10 group-hover:scale-110 font-mono">
                {step.num}
              </div>

              {/* Emoji Badge */}
              <div className="w-12 h-12 rounded-2xl bg-emerald-900/30 border border-emerald-500/10 flex items-center justify-center text-2xl mb-6 shadow-inner">
                {step.emoji}
              </div>

              <h3 className="font-sans text-lg font-bold text-white mb-3 group-hover:text-emerald-400 transition-colors">
                {step.title}
              </h3>
              
              <p className="text-sm text-emerald-200/70 leading-relaxed font-sans">
                {step.desc}
              </p>
            </div>
          ))}
        </div>

      </div>
    </section>
  );
}
