import React from 'react';
import { Instagram, Mail, MessageSquare } from 'lucide-react';

interface FooterProps {
  onOpenSurvey: () => void;
}

export default function Footer({ onOpenSurvey }: FooterProps) {
  return (
    <footer className="bg-emerald-950 text-emerald-100 pt-20 pb-10 border-t border-emerald-500/10">
      <div className="max-w-6xl mx-auto px-6">

        {/* Upper Footer section */}
        <div className="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">

          {/* Col 1: Bio */}
          <div className="md:col-span-1">
            <div className="flex items-center gap-2 mb-6">
              <img src="/assets/images/logo.png" alt="MicroCell Logo" className="h-8 w-8 rounded-lg object-cover shadow-md" />
              <span className="font-sans text-lg font-black text-white tracking-tight">
                Micro<span className="text-emerald-400">Cell</span>
              </span>
            </div>
            <p className="text-xs text-emerald-300/70 leading-relaxed font-sans mb-6">
              Membangun kedaulatan energi nasional mandiri melalui inovasi teknologi biokimia berkelanjutan berbasis kearifan lokal peternakan Nusantara.
            </p>

            <div className="flex gap-3">
              <a href="https://www.instagram.com/microcell.id/" target="_blank" rel="noopener noreferrer" className="w-9 h-9 bg-emerald-900/40 hover:bg-emerald-500 hover:text-[#041706] rounded-full flex items-center justify-center transition-colors duration-200">
                <Instagram size={16} />
              </a>
              <a href="mailto:info@microcell.id" className="w-9 h-9 bg-emerald-900/40 hover:bg-emerald-500 hover:text-[#041706] rounded-full flex items-center justify-center transition-colors duration-200">
                <Mail size={16} />
              </a>
            </div>
          </div>

          {/* Col 2: Navigation Links */}
          <div>
            <h4 className="font-sans text-sm font-bold text-white mb-6 tracking-wide">Navigasi</h4>
            <ul className="space-y-3 text-xs text-emerald-300/70 font-sans">
              <li><a href="#about" className="hover:text-emerald-400 hover:underline transition-all">Tentang Kami</a></li>
              <li><a href="#how-it-works" className="hover:text-emerald-400 hover:underline transition-all">Cara Kerja Sistem</a></li>
              <li><a href="#benefits" className="hover:text-emerald-400 hover:underline transition-all">Manfaat Sosio-Ekologis</a></li>
              <li><a href="#products" className="hover:text-emerald-400 hover:underline transition-all">Pilihan Skala Solusi</a></li>
              <li><a href="#faq" className="hover:text-emerald-400 hover:underline transition-all">FAQ</a></li>
            </ul>
          </div>

          {/* Col 3: SDG Support */}
          <div>
            <h4 className="font-sans text-sm font-bold text-white mb-6 tracking-wide">Dukungan Target SDG</h4>
            <div className="flex flex-col gap-2 mb-4">
              <div className="bg-[#F39200] text-white px-3 py-1.5 rounded text-[10px] font-extrabold uppercase tracking-wide w-max shadow-sm">
                SDG 7: Affordable Energy
              </div>
              <div className="bg-[#BF8B2E] text-white px-3 py-1.5 rounded text-[10px] font-extrabold uppercase tracking-wide w-max shadow-sm">
                SDG 12: Responsible Consumption
              </div>
              <div className="bg-[#3F7E44] text-white px-3 py-1.5 rounded text-[10px] font-extrabold uppercase tracking-wide w-max shadow-sm">
                SDG 13: Climate Action
              </div>
            </div>
            <p className="text-[10px] text-emerald-400 italic">
              Berkomitmen penuh mempercepat transisi dekarbonisasi global dari hulu ke hilir.
            </p>
          </div>

          {/* Col 4: Contact info */}
          <div>
            <h4 className="font-sans text-sm font-bold text-white mb-6 tracking-wide">Hubungi Kami</h4>
            <p className="text-xs text-emerald-300/70 mb-6 font-sans leading-relaxed">
              Ada pertanyaan terkait kelayakan teknis atau ingin merancang survei peternakan komunal Anda?
            </p>
            <a
              href="https://wa.me/6281234567890?text=Halo%20MicroCell,%20saya%20tertarik%20dengan%20sistem%20elektrifikasi%20limbah%20kotoran%20sapi%20dan%20ingin%20berkonsultasi%20..."
              target="_blank"
              rel="noopener noreferrer"
              className="inline-flex items-center gap-2 bg-[#16A34A] hover:bg-emerald-500 text-white hover:text-white hover:shadow-[0_0_15px_rgba(22,163,74,0.4)] px-5 py-3 rounded-full text-xs font-bold transition-all"
            >
              <MessageSquare size={16} />
              Kontak Via WhatsApp
            </a>
          </div>

        </div>

        {/* Lower Footer section */}
        <div className="pt-8 border-t border-emerald-900 flex flex-col md:flex-row justify-between items-center gap-4 text-[11px] text-emerald-500 font-sans">
          <p>© 2026 MicroCell. Regenerative Energy for a Greener Future. All rights reserved.</p>

          <div className="flex gap-6">
            <a href="#" className="hover:text-emerald-300 hover:underline">Kebijakan Privasi</a>
            <a href="#" className="hover:text-emerald-300 hover:underline">Syarat &amp; Ketentuan</a>
          </div>
        </div>

      </div>
    </footer>
  );
}
