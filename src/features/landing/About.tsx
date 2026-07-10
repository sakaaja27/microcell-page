import React from 'react';

interface AboutProps {
  onOpenSimulator: () => void;
}

export default function About({ onOpenSimulator }: AboutProps) {
  return (
    <section className="py-24 bg-[#E5E5E5]" id="about">
      <div className="max-w-7xl mx-auto px-6">

        {/* Top Section */}
        <div className="flex flex-col md:flex-row items-center gap-16 mb-24">
          <div className="w-full md:w-1/2 flex justify-center">
            <div className="relative w-full max-w-xl">
              <img
                src="/assets/images/prototipe.png"
                alt="Prototipe MicroCell"
                className="w-full h-auto object-contain drop-shadow-xl hover:scale-105 transition-transform duration-500"
              />
              <img
                src="/assets/images/dashboard.png"
                alt="Mobile Dashboard"
                className="absolute -right-4 md:-right-6 -bottom-4 md:-bottom-2 w-[20%] md:w-[20%] max-w-[150px] object-contain drop-shadow-2xl hover:-translate-y-2 transition-transform duration-500"
              />
            </div>
          </div>

          <div className="w-full md:w-1/2">
            <span className="text-gray-600 uppercase tracking-[0.2em] text-sm font-bold">
              Tentang
            </span>
            <h2 className="font-sans text-5xl md:text-6xl font-bold text-emerald-800 mt-2 mb-6 tracking-tight">
              MicroCell
            </h2>
            <p className="font-sans text-lg text-gray-700 leading-relaxed max-w-xl">
              MicroCell mengolah limbah kotoran sapi menjadi energi listrik terbarukan melalui bioelektrokimia, dilengkapi monitoring IoT berbasis mobile. Dirancang untuk peternak skala kecil hingga menengah di Jember.
            </p>
          </div>
        </div>

        {/* Feature Cards Grid */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">

          {/* Card 1 */}
          <div className="bg-white p-10 rounded-[36px] shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <h3 className="font-sans text-xl font-bold text-emerald-800 mb-4">
              Teknologi DualCell MFC + BPFC
            </h3>
            <p className="text-gray-600 leading-relaxed text-sm">
              Menggabungkan Microbial Fuel Cell dan Biophotofuel Cell dalam satu sistem terintegrasi untuk menghasilkan energi listrik secara optimal dari limbah kotoran sapi.
            </p>
          </div>

          {/* Card 2 */}
          <div className="bg-white p-10 rounded-[36px] shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <h3 className="font-sans text-xl font-bold text-emerald-800 mb-4">
              Smart Monitoring IoT
            </h3>
            <p className="text-gray-600 leading-relaxed text-sm">
              Pantau suhu, tegangan, arus, intensitas cahaya, dan performa sistem kapan saja via aplikasi mobile MicroCell.
            </p>
          </div>

          {/* Card 3 */}
          <div className="bg-white p-10 rounded-[36px] shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <h3 className="font-sans text-xl font-bold text-emerald-800 mb-4">
              Modular & Plug And Play
            </h3>
            <p className="text-gray-600 leading-relaxed text-sm">
              Unit reaktor modular yang mudah dipasang tanpa keahlian teknis. Cukup masukkan limbah sistem bekerja otomatis dengan kontrol berbasis sensor dan mikrokontroler.
            </p>
          </div>

        </div>

      </div>
    </section>
  );
}
