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
      question: 'Berapa lama waktu yang dibutuhkan agar sistem dapat bekerja secara optimal?',
      answer: 'Setelah instalasi awal, sistem membutuhkan waktu sekitar 1–3 minggu masa inkubasi bagi koloni bakteri dalam biofilm untuk membangun densitas sel yang optimal dan stabil. Selama periode ini, produksi tegangan akan meningkat secara bertahap seiring pertumbuhan komunitas mikroba. Setelah masa inkubasi selesai, sistem akan beroperasi secara mandiri dan berkelanjutan dengan produksi listrik yang stabil dan dapat diprediksi, tergantung pada volume dan komposisi limbah yang dialirkan harian.'
    },
    // {
    //   question: 'Bagaimana jika saya berada di luar wilayah Jember? Apakah MicroCell dapat dikirim dan dipasang?',
    //   answer: 'Tentu saja bisa! Meskipun MicroCell dirancang khusus untuk peternak di wilayah Jember, tim kami menyediakan layanan pengiriman unit ke luar kota atau bahkan provinsi dengan kemasan khusus yang aman untuk transport. Untuk proses instalasi awal di lokasi baru, kami dapat memandu tim teknisi lokal atau petugas peternakan Anda melalui video call troubleshooting dan panduan instalasi jarak jauh yang terstruktur, memastikan sistem tetap bekerja optimal sejak hari pertama.'
    // },
    {
      question: 'Apakah sistem sulit untuk dioperasikan?',
      answer: 'Sama sekali tidak! Sistem MicroCell dirancang untuk kemudahan operasional bagi peternak. Setelah proses instalasi awal selesai dan sistem mencapai tahap inkubasi optimal, operasional harian hanya membutuhkan aktivitas sederhana yang terintegrasi dengan rutinitas peternakan: memasukkan limbah ternak ke dalam kompartemen anoda. Tidak ada tombol yang perlu ditekan atau parameter elektrik yang perlu diatur secara rutin. Sistem bekerja secara mandiri dan berkelanjutan.'
    }
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
