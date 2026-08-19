import { Link } from "react-router-dom";
import { ArrowLeft } from "lucide-react";

export function RegisterPage() {
  return (
    <div className="min-h-screen bg-[#041706] flex items-center justify-center p-4">
      <div className="max-w-md w-full bg-emerald-950/40 backdrop-blur-xl border border-emerald-500/20 rounded-3xl p-8 shadow-2xl">
        <Link to="/" className="inline-flex items-center gap-2 text-emerald-400 hover:text-emerald-300 transition-colors mb-8 text-sm font-medium">
          <ArrowLeft className="w-4 h-4" /> Kembali ke Beranda
        </Link>
        
        <div className="text-center mb-8">
          <h1 className="text-3xl font-extrabold text-white tracking-tight mb-2">Buat Akun</h1>
          <p className="text-emerald-200/70 text-sm">Bergabung dengan MicroCell hari ini</p>
        </div>

        <form className="space-y-4" onSubmit={(e) => e.preventDefault()}>
          <div>
            <label className="block text-sm font-medium text-emerald-100 mb-1.5">Nama Lengkap</label>
            <input 
              type="text" 
              className="w-full bg-[#041706]/50 border border-emerald-500/30 text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent block p-3 transition-all outline-none" 
              placeholder="Budi Santoso" 
            />
          </div>
          <div>
            <label className="block text-sm font-medium text-emerald-100 mb-1.5">Email</label>
            <input 
              type="email" 
              className="w-full bg-[#041706]/50 border border-emerald-500/30 text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent block p-3 transition-all outline-none" 
              placeholder="budi@example.com" 
            />
          </div>
          <div>
            <label className="block text-sm font-medium text-emerald-100 mb-1.5">Password</label>
            <input 
              type="password" 
              className="w-full bg-[#041706]/50 border border-emerald-500/30 text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent block p-3 transition-all outline-none" 
              placeholder="••••••••" 
            />
          </div>
          
          <button className="w-full bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-bold rounded-xl py-3.5 mt-2 transition-all shadow-[0_0_20px_rgba(16,185,129,0.3)] hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] active:scale-[0.98]">
            Daftar Sekarang
          </button>
        </form>

        <p className="text-center mt-8 text-sm text-emerald-200/60">
          Sudah punya akun? <Link to="/login" className="text-emerald-400 font-medium hover:text-emerald-300 transition-colors">Masuk disini</Link>
        </p>
      </div>
    </div>
  );
}
