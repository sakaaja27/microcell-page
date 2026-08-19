import { Link } from "react-router-dom";
import { ArrowLeft } from "lucide-react";

export function LoginPage() {
  return (
    <div className="min-h-screen bg-[#041706] flex items-center justify-center p-4">
      <div className="max-w-md w-full bg-emerald-950/40 backdrop-blur-xl border border-emerald-500/20 rounded-3xl p-8 shadow-2xl">
        <Link to="/" className="inline-flex items-center gap-2 text-emerald-400 hover:text-emerald-300 transition-colors mb-8 text-sm font-medium">
          <ArrowLeft className="w-4 h-4" /> Kembali ke Beranda
        </Link>
        
        <div className="text-center mb-8">
          <h1 className="text-3xl font-extrabold text-white tracking-tight mb-2">Selamat Datang</h1>
          <p className="text-emerald-200/70 text-sm">Masuk ke akun MicroCell Anda</p>
        </div>

        <form className="space-y-5" onSubmit={(e) => e.preventDefault()}>
          <div>
            <label className="block text-sm font-medium text-emerald-100 mb-2">Email</label>
            <input 
              type="email" 
              className="w-full bg-[#041706]/50 border border-emerald-500/30 text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent block p-3.5 transition-all outline-none" 
              placeholder="admin@microcell.com" 
            />
          </div>
          <div>
            <label className="block text-sm font-medium text-emerald-100 mb-2">Password</label>
            <input 
              type="password" 
              className="w-full bg-[#041706]/50 border border-emerald-500/30 text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent block p-3.5 transition-all outline-none" 
              placeholder="••••••••" 
            />
          </div>
          <div className="flex items-center justify-between text-sm">
            <label className="flex items-center gap-2 cursor-pointer group">
              <input type="checkbox" className="rounded bg-[#041706] border-emerald-500/30 text-emerald-500 focus:ring-emerald-500/50" />
              <span className="text-emerald-200/70 group-hover:text-emerald-200 transition-colors">Ingat saya</span>
            </label>
            <a href="#" className="text-emerald-400 hover:text-emerald-300 font-medium transition-colors">Lupa Password?</a>
          </div>
          
          <button className="w-full bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-bold rounded-xl py-3.5 transition-all shadow-[0_0_20px_rgba(16,185,129,0.3)] hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] active:scale-[0.98]">
            Masuk Sekarang
          </button>
        </form>

        <p className="text-center mt-8 text-sm text-emerald-200/60">
          Belum punya akun? <Link to="/register" className="text-emerald-400 font-medium hover:text-emerald-300 transition-colors">Daftar disini</Link>
        </p>
      </div>
    </div>
  );
}
