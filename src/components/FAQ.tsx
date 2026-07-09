import React, { useState } from 'react';
import { ChevronDown, HelpCircle } from 'lucide-react';

export default function FAQ() {
  const [activeIndex, setActiveIndex] = useState<number | null>(null);

  const faqItems = [
    {
      question: 'Berapa lama sistem ini dapat bertahan?',
      answer: 'Sistem Microbial Fuel Cell (MFC) MicroCell dirancang untuk ketahanan jangka panjang hingga 8-10 tahun dengan perawatan minimal. Kompartemen anoda dan katoda menggunakan bahan komposit tahan korosi, sementara biofilm koloni bakteri memiliki kemampuan meregenerasi populasinya sendiri secara alami selama asupan bahan organik dari limbah cair tetap terjaga harian.',
    },
    {
      question: 'Apakah ada bau yang tidak sedap selama proses konversi?',
      answer: 'Sama sekali tidak. Proses biodegradasi limbah organik di ruang anoda berjalan dalam kondisi tertutup rapat tanpa udara (anaerobik). Karakteristik bioreaktor tertutup ini justru menurunkan kadar hidrogen sulfida dan senyawa volatil bau lainnya secara drastis sebesar 92%, sehingga limbah yang dikeluarkan dari sistem tidak lagi mengeluarkan aroma kotoran mentah yang menyengat.',
    },
    {
      question: 'Apakah sistem bisa dipasang di dataran tinggi yang berhawa dingin?',
      answer: 'Ya, modul MicroCell dilengkapi dengan pelindung termal pasif pintar dan sensor suhu terintegrasi. Hal ini menjaga suhu operasi mikroba tetap konstan dalam rentang mesofilik ideal (30°C hingga 38°C) meskipun suhu lingkungan di dataran tinggi atau pegunungan menurun tajam pada malam hari.',
    },
  ];

  const toggleAccordion = (index: number) => {
    setActiveIndex(activeIndex === index ? null : index);
  };

  return (
    <section className="py-24 bg-white text-[#041706]" id="faq">
      <div className="max-w-4xl mx-auto px-6">
        
        {/* Header */}
        <div className="text-center mb-16">
          <span className="text-[10px] bg-emerald-500/10 text-emerald-600 border border-emerald-500/20 px-3 py-1 rounded-full font-bold uppercase tracking-widest">
            Bantuan &amp; Informasi
          </span>
          <h2 className="mt-4 font-sans text-3xl sm:text-4xl font-extrabold text-emerald-950 tracking-tight mb-4">
            Pertanyaan Umum
          </h2>
          <p className="font-sans text-sm sm:text-base text-emerald-800 max-w-xl mx-auto leading-relaxed">
            Temukan jawaban cepat atas aspek teknis, operasional, dan efisiensi sistem konversi energi kami.
          </p>
        </div>

        {/* Accordion Questions List */}
        <div className="space-y-4">
          {faqItems.map((item, index) => {
            const isOpen = activeIndex === index;
            return (
              <div 
                key={index}
                className={`border border-emerald-500/10 rounded-2xl overflow-hidden transition-all duration-300 ${
                  isOpen 
                    ? 'shadow-lg shadow-emerald-900/5 bg-emerald-50/20 border-l-4 border-l-emerald-600 translate-x-0.5' 
                    : 'bg-white hover:bg-emerald-50/10'
                }`}
              >
                {/* Accordion Toggle Header */}
                <button
                  type="button"
                  onClick={() => toggleAccordion(index)}
                  className="w-full flex items-center justify-between p-6 text-left focus:outline-none cursor-pointer"
                >
                  <span className="font-sans text-sm sm:text-base font-bold text-emerald-950 pr-4">
                    {item.question}
                  </span>
                  <div className={`h-8 w-8 rounded-full flex items-center justify-center bg-emerald-100/50 text-emerald-600 transition-transform duration-300 ${
                    isOpen ? 'rotate-180 bg-emerald-600 text-white' : ''
                  }`}>
                    <ChevronDown size={18} />
                  </div>
                </button>

                {/* Collapsible Answer Pane */}
                <div 
                  className={`transition-all duration-300 ease-in-out ${
                    isOpen 
                      ? 'max-h-[300px] border-t border-emerald-500/5 opacity-100 py-5 px-6' 
                      : 'max-h-0 overflow-hidden opacity-0 py-0 px-6'
                  }`}
                >
                  <p className="text-sm text-emerald-800 leading-relaxed font-sans">
                    {item.answer}
                  </p>
                </div>
              </div>
            );
          })}
        </div>

      </div>
    </section>
  );
}
