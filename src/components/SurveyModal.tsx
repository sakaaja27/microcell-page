import React, { useState } from 'react';
import { X, ChevronRight, ChevronLeft, Check, Compass, Eye, ShieldCheck } from 'lucide-react';

interface SurveyModalProps {
  isOpen: boolean;
  onClose: () => void;
}

export default function SurveyModal({ isOpen, onClose }: SurveyModalProps) {
  const [step, setStep] = useState<number>(1);
  const [formData, setFormData] = useState({
    name: '',
    phone: '',
    cowCount: '',
    location: '',
    powerNeed: 'Rumah Tangga (< 1300 VA)',
    currentIssue: 'Sering mati lampu / mati daya',
  });
  const [submitted, setSubmitted] = useState<boolean>(false);

  if (!isOpen) return null;

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({ ...prev, [name]: value }));
  };

  const handleNext = (e: React.FormEvent) => {
    e.preventDefault();
    if (step < 3) {
      setStep(prev => prev + 1);
    } else {
      handleSubmit();
    }
  };

  const handleBack = () => {
    if (step > 1) {
      setStep(prev => prev - 1);
    }
  };

  const handleSubmit = () => {
    setSubmitted(true);
  };

  const handleCloseAndReset = () => {
    onClose();
    // Reset state after transition
    setTimeout(() => {
      setStep(1);
      setSubmitted(false);
      setFormData({
        name: '',
        phone: '',
        cowCount: '',
        location: '',
        powerNeed: 'Rumah Tangga (< 1300 VA)',
        currentIssue: 'Sering mati lampu / mati daya',
      });
    }, 300);
  };

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-4">
      {/* Backdrop */}
      <div 
        className="absolute inset-0 bg-emerald-950/70 backdrop-blur-md" 
        onClick={handleCloseAndReset} 
      />

      {/* Container */}
      <div className="relative w-full max-w-lg overflow-hidden rounded-3xl border border-emerald-500/20 bg-[#0c200d] text-emerald-100 shadow-2xl">
        <div className="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-emerald-500 via-teal-400 to-emerald-500" />
        
        {/* Close Button */}
        <button 
          onClick={handleCloseAndReset}
          className="absolute top-4 right-4 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-900/30 border border-emerald-500/10 text-emerald-300 hover:bg-emerald-500 hover:text-[#041706] transition-all"
        >
          <X size={16} />
        </button>

        <div className="p-6 md:p-8">
          {!submitted ? (
            <form onSubmit={handleNext}>
              {/* Header */}
              <div className="mb-6">
                <span className="text-[10px] bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-2.5 py-1 rounded-full font-bold uppercase tracking-wider">
                  Langkah {step} dari 3
                </span>
                <h3 className="mt-2 text-xl font-bold text-white font-sans">Formulir Survei Potensi Mandiri</h3>
                <p className="text-xs text-emerald-400">Isi data peternakan untuk penilaian kustom gratis oleh tim ahli MicroCell</p>
              </div>

              {/* Progress Bar */}
              <div className="mb-6 h-1 w-full bg-emerald-950 rounded-full overflow-hidden">
                <div 
                  className="h-full bg-emerald-500 transition-all duration-300"
                  style={{ width: `${(step / 3) * 100}%` }}
                />
              </div>

              {/* Step Contents */}
              <div className="space-y-4 min-h-[180px]">
                {step === 1 && (
                  <div className="space-y-4">
                    <div>
                      <label className="block text-xs font-semibold text-emerald-300 mb-1.5">Nama Lengkap / Nama Koperasi</label>
                      <input 
                        required
                        type="text" 
                        name="name"
                        value={formData.name}
                        onChange={handleInputChange}
                        placeholder="Contoh: Bpk. Bambang / KUD Harapan Mulia" 
                        className="w-full rounded-xl bg-emerald-950/50 border border-emerald-500/20 px-4 py-3 text-sm text-white placeholder-emerald-600 focus:border-emerald-400 focus:outline-none"
                      />
                    </div>
                    <div>
                      <label className="block text-xs font-semibold text-emerald-300 mb-1.5">Nomor WhatsApp Aktif</label>
                      <input 
                        required
                        type="tel" 
                        name="phone"
                        value={formData.phone}
                        onChange={handleInputChange}
                        placeholder="Contoh: 081234567890" 
                        className="w-full rounded-xl bg-emerald-950/50 border border-emerald-500/20 px-4 py-3 text-sm text-white placeholder-emerald-600 focus:border-emerald-400 focus:outline-none"
                      />
                    </div>
                  </div>
                )}

                {step === 2 && (
                  <div className="space-y-4">
                    <div>
                      <label className="block text-xs font-semibold text-emerald-300 mb-1.5">Lokasi Peternakan (Kota/Kabupaten &amp; Provinsi)</label>
                      <input 
                        required
                        type="text" 
                        name="location"
                        value={formData.location}
                        onChange={handleInputChange}
                        placeholder="Contoh: Malang, Jawa Timur" 
                        className="w-full rounded-xl bg-emerald-950/50 border border-emerald-500/20 px-4 py-3 text-sm text-white placeholder-emerald-600 focus:border-emerald-400 focus:outline-none"
                      />
                    </div>
                    <div>
                      <label className="block text-xs font-semibold text-emerald-300 mb-1.5">Perkiraan Jumlah Sapi Terkini (Ekor)</label>
                      <input 
                        required
                        type="number" 
                        name="cowCount"
                        value={formData.cowCount}
                        onChange={handleInputChange}
                        placeholder="Contoh: 15" 
                        className="w-full rounded-xl bg-emerald-950/50 border border-emerald-500/20 px-4 py-3 text-sm text-white placeholder-emerald-600 focus:border-emerald-400 focus:outline-none"
                      />
                    </div>
                  </div>
                )}

                {step === 3 && (
                  <div className="space-y-4">
                    <div>
                      <label className="block text-xs font-semibold text-emerald-300 mb-1.5">Kategori Skala Penggunaan Daya</label>
                      <select 
                        name="powerNeed"
                        value={formData.powerNeed}
                        onChange={handleInputChange}
                        className="w-full rounded-xl bg-[#061807] border border-emerald-500/20 px-4 py-3 text-sm text-white focus:border-emerald-400 focus:outline-none"
                      >
                        <option>Rumah Tangga Pribadi (&lt; 1300 VA)</option>
                        <option>Rumah Tangga Menengah (1300 VA - 3500 VA)</option>
                        <option>Peternakan &amp; Kandang Komunal (3500 VA - 6600 VA)</option>
                        <option>Koperasi Unit Desa / Pabrik &gt; 6600 VA</option>
                      </select>
                    </div>
                    <div>
                      <label className="block text-xs font-semibold text-emerald-300 mb-1.5">Tantangan Energi Utama</label>
                      <select 
                        name="currentIssue"
                        value={formData.currentIssue}
                        onChange={handleInputChange}
                        className="w-full rounded-xl bg-[#061807] border border-emerald-500/20 px-4 py-3 text-sm text-white focus:border-emerald-400 focus:outline-none"
                      >
                        <option>Sering mati lampu / mati daya</option>
                        <option>Biaya tagihan listrik bulanan membengkak</option>
                        <option>Bau limbah kotoran mencemari warga sekitar</option>
                        <option>Belum terjangkau jaringan listrik pusat (PLN)</option>
                      </select>
                    </div>
                  </div>
                )}
              </div>

              {/* Navigation Buttons */}
              <div className="mt-8 flex justify-between gap-3">
                <button
                  type="button"
                  onClick={handleBack}
                  disabled={step === 1}
                  className={`flex items-center gap-1 px-4 py-2 text-xs font-bold rounded-xl transition-all ${
                    step === 1 
                      ? 'text-emerald-700 opacity-50 cursor-not-allowed' 
                      : 'text-emerald-300 bg-emerald-950 border border-emerald-500/10 hover:bg-emerald-900/50'
                  }`}
                >
                  <ChevronLeft size={16} /> Kembali
                </button>

                <button
                  type="submit"
                  className="flex items-center gap-1 bg-emerald-500 hover:bg-emerald-400 text-[#041706] px-6 py-2.5 text-xs font-bold rounded-xl transition-all"
                >
                  {step === 3 ? 'Kirim Survei' : 'Lanjut'} <ChevronRight size={16} />
                </button>
              </div>
            </form>
          ) : (
            /* Success screen */
            <div className="py-6 text-center animate-fade-in-up">
              <div className="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-emerald-500/20 text-emerald-400">
                <Check size={32} />
              </div>
              <h3 className="text-2xl font-bold text-white font-sans mb-2">Terima Kasih!</h3>
              <p className="text-sm text-emerald-300 mb-6 leading-relaxed">
                Tanggapan Anda telah kami terima. Tim insinyur biokimia MicroCell akan melakukan analisis awal kapasitas berdasarkan asupan limbah <span className="font-bold font-mono text-white bg-emerald-500/10 px-1.5 py-0.5 rounded">{formData.cowCount} ekor sapi</span> di wilayah <span className="font-bold text-white">{formData.location}</span>.
              </p>

              <div className="rounded-2xl border border-emerald-500/10 bg-emerald-950/40 p-4 text-left space-y-2 mb-6">
                <div className="flex items-center gap-2 text-xs text-emerald-300">
                  <ShieldCheck size={14} className="text-emerald-400 flex-shrink-0" />
                  <span>Garansi Privasi Data Aman</span>
                </div>
                <p className="text-[11px] text-emerald-400 leading-normal">
                  Rencana survei lapangan &amp; kalkulasi kapasitas teknis akan kami kirimkan ke WhatsApp Anda di <span className="font-mono text-white font-semibold">{formData.phone}</span> dalam waktu maksimal 24 jam kerja.
                </p>
              </div>

              <button
                onClick={handleCloseAndReset}
                className="w-full bg-emerald-500 hover:bg-emerald-400 text-[#041706] px-6 py-3 text-sm font-bold rounded-full transition-all"
              >
                Kembali ke Beranda
              </button>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}
