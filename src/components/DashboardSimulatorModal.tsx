import React, { useState, useEffect, useRef } from 'react';
import { X, Smartphone, Activity, Thermometer, Battery, Cpu, RefreshCw, Layers, ShieldCheck, Play } from 'lucide-react';

interface DashboardSimulatorModalProps {
  isOpen: boolean;
  onClose: () => void;
}

interface LogEntry {
  time: string;
  message: string;
  type: 'info' | 'success' | 'warning';
}

export default function DashboardSimulatorModal({ isOpen, onClose }: DashboardSimulatorModalProps) {
  const [voltage, setVoltage] = useState<number>(223.5);
  const [bacteriaHealth, setBacteriaHealth] = useState<number>(98.6);
  const [temperature, setTemperature] = useState<number>(34.2);
  const [batteryLevel, setBatteryLevel] = useState<number>(84);
  const [isOptimizing, setIsOptimizing] = useState<boolean>(false);
  const [isCleaning, setIsCleaning] = useState<boolean>(false);
  const [logs, setLogs] = useState<LogEntry[]>([
    { time: '09:40:12', message: 'Inisialisasi sensor pembacaan anoda berhasil.', type: 'info' },
    { time: '09:41:00', message: 'Koloni bakteri Geobacter mendeteksi substrat organik baru.', type: 'success' },
    { time: '09:43:45', message: 'Sistem Power Management mengonversi DC 1.2V ke AC 220V.', type: 'info' },
    { time: '09:45:02', message: 'Tegangan sirkuit stabil pada rentang operasi normal.', type: 'success' },
  ]);

  const logEndRef = useRef<HTMLDivElement>(null);

  // Auto scroll logs
  useEffect(() => {
    if (logEndRef.current) {
      logEndRef.current.scrollIntoView({ behavior: 'smooth' });
    }
  }, [logs]);

  // Real-time fluctuating simulation
  useEffect(() => {
    if (!isOpen) return;

    const interval = setInterval(() => {
      // Random walk for voltage
      setVoltage(prev => {
        const diff = (Math.random() - 0.5) * 1.2;
        const next = prev + diff;
        return parseFloat(Math.min(Math.max(next, 218), 226).toFixed(1));
      });

      // Bacteria health minor drift
      setBacteriaHealth(prev => {
        const diff = (Math.random() - 0.5) * 0.2;
        const next = prev + diff;
        return parseFloat(Math.min(Math.max(next, 97.5), 100).toFixed(1));
      });

      // Temperature fluctuation
      setTemperature(prev => {
        const diff = (Math.random() - 0.5) * 0.1;
        const next = prev + diff;
        return parseFloat(Math.min(Math.max(next, 33.5), 35.5).toFixed(1));
      });

      // Slowly increment battery if below 100
      setBatteryLevel(prev => {
        if (prev >= 100) return 100;
        return Math.random() > 0.7 ? prev + 1 : prev;
      });

      // Random logs
      if (Math.random() > 0.75) {
        const logMessages = [
          { message: 'Bakteri aktif mentransfer elektron ke elektroda karbon.', type: 'success' as const },
          { message: 'Arus anoda terdeteksi stabil.', type: 'info' as const },
          { message: 'Filtrasi bioreaktor tingkat 1 berjalan.', type: 'info' as const },
          { message: 'Suhu optimal bioreaktor terjaga pada kondisi mesofilik.', type: 'success' as const },
        ];
        const randomLog = logMessages[Math.floor(Math.random() * logMessages.length)];
        const timeStr = new Date().toTimeString().split(' ')[0];
        
        setLogs(prev => [...prev, { time: timeStr, message: randomLog.message, type: randomLog.type }]);
      }

    }, 3000);

    return () => clearInterval(interval);
  }, [isOpen]);

  const triggerOptimization = () => {
    if (isOptimizing) return;
    setIsOptimizing(true);
    
    const timeStr = new Date().toTimeString().split(' ')[0];
    setLogs(prev => [...prev, { time: timeStr, message: 'Menjalankan stimulasi mikro-elektrik untuk meningkatkan motilitas bakteri...', type: 'warning' }]);

    setTimeout(() => {
      setIsOptimizing(false);
      setBacteriaHealth(99.8);
      const doneTimeStr = new Date().toTimeString().split(' ')[0];
      setLogs(prev => [
        ...prev, 
        { time: doneTimeStr, message: 'Stimulasi selesai! Kesehatan bakteri meningkat ke 99.8% dan aktivitas metabolisme terakselerasi.', type: 'success' }
      ]);
    }, 2500);
  };

  const triggerSelfCleaning = () => {
    if (isCleaning) return;
    setIsCleaning(true);
    
    const timeStr = new Date().toTimeString().split(' ')[0];
    setLogs(prev => [...prev, { time: timeStr, message: 'Memulai sirkulasi pencucian balik (backwash) membran katoda otomatis...', type: 'warning' }]);

    setTimeout(() => {
      setIsCleaning(false);
      const doneTimeStr = new Date().toTimeString().split(' ')[0];
      setLogs(prev => [
        ...prev, 
        { time: doneTimeStr, message: 'Saringan dan katoda berhasil dibersihkan. Hambatan aliran hidrolik menurun.', type: 'success' }
      ]);
    }, 3000);
  };

  if (!isOpen) return null;

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-4">
      {/* Backdrop */}
      <div 
        className="absolute inset-0 bg-emerald-950/70 backdrop-blur-md" 
        onClick={onClose} 
      />

      {/* Simulator Frame (Simulates Smartphone Screen inside a cool UI container) */}
      <div className="relative w-full max-w-md overflow-hidden rounded-[40px] border-[8px] border-emerald-900 bg-emerald-950 p-1 text-emerald-100 shadow-2xl">
        {/* Notch decoration */}
        <div className="absolute top-0 left-1/2 z-20 h-5 w-32 -translate-x-1/2 rounded-b-xl bg-emerald-900 flex justify-center items-center">
          <div className="h-1.5 w-12 rounded-full bg-emerald-800" />
        </div>

        {/* Home Indicator decoration */}
        <div className="absolute bottom-1 left-1/2 z-20 h-1 w-24 -translate-x-1/2 rounded-full bg-emerald-800" />

        {/* App Content */}
        <div className="rounded-[32px] bg-[#041706] px-4 pt-8 pb-6 h-[600px] overflow-y-auto flex flex-col no-scrollbar">
          
          {/* Header */}
          <div className="flex items-center justify-between mb-4 mt-2">
            <div className="flex items-center gap-1.5">
              <Smartphone size={16} className="text-emerald-400" />
              <span className="text-xs font-semibold text-emerald-300">MicroCell App v1.2</span>
            </div>
            <div className="flex items-center gap-2">
              <span className="flex h-2 w-2 items-center justify-center">
                <span className="absolute inline-flex h-2.5 w-2.5 animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                <span className="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
              </span>
              <span className="text-[10px] font-bold text-emerald-400 font-mono">ONLINE</span>
              <button 
                onClick={onClose}
                className="h-6 w-6 flex items-center justify-center rounded-full bg-emerald-900/40 text-emerald-400 hover:bg-emerald-800"
              >
                <X size={14} />
              </button>
            </div>
          </div>

          {/* Device Info */}
          <div className="mb-4 rounded-xl bg-emerald-950/30 border border-emerald-500/10 p-3 flex justify-between items-center">
            <div>
              <div className="text-[10px] text-emerald-500 font-semibold uppercase tracking-wider">Device ID</div>
              <div className="text-xs font-bold text-white font-mono">MC-MFC-00924</div>
            </div>
            <div className="text-right">
              <div className="text-[10px] text-emerald-500 font-semibold uppercase tracking-wider">LOKASI</div>
              <div className="text-xs font-bold text-white">Blitar, Jatim</div>
            </div>
          </div>

          {/* Grid Metrics */}
          <div className="grid grid-cols-2 gap-3 mb-4">
            
            {/* Voltage */}
            <div className="rounded-2xl bg-emerald-950/40 border border-emerald-500/5 p-4 flex flex-col justify-between h-28">
              <div className="flex items-center justify-between">
                <span className="text-[10px] text-emerald-400 font-medium">TEGANGAN BOOSTER</span>
                <Activity size={14} className="text-amber-400" />
              </div>
              <div>
                <span className="text-2xl font-bold font-mono text-white">{voltage}</span>
                <span className="text-xs text-emerald-400 ml-1">VAC</span>
              </div>
              <span className="text-[9px] text-emerald-500">Standar PLN (220V AC)</span>
            </div>

            {/* Microbe Health */}
            <div className="rounded-2xl bg-emerald-950/40 border border-emerald-500/5 p-4 flex flex-col justify-between h-28">
              <div className="flex items-center justify-between">
                <span className="text-[10px] text-emerald-400 font-medium">KESEHATAN BAKTERI</span>
                <ShieldCheck size={14} className="text-emerald-400" />
              </div>
              <div>
                <span className="text-2xl font-bold font-mono text-emerald-300">{bacteriaHealth}%</span>
              </div>
              <span className="text-[9px] text-emerald-400 bg-emerald-500/10 px-1.5 py-0.5 rounded w-max">Sangat Stabil</span>
            </div>

            {/* Core Temp */}
            <div className="rounded-2xl bg-emerald-950/40 border border-emerald-500/5 p-4 flex flex-col justify-between h-28">
              <div className="flex items-center justify-between">
                <span className="text-[10px] text-emerald-400 font-medium">SUHU REAKTOR</span>
                <Thermometer size={14} className="text-red-400" />
              </div>
              <div>
                <span className="text-2xl font-bold font-mono text-white">{temperature}</span>
                <span className="text-xs text-emerald-400 ml-1">°C</span>
              </div>
              <span className="text-[9px] text-emerald-500">Meso: 30°C - 38°C</span>
            </div>

            {/* Battery Storage */}
            <div className="rounded-2xl bg-emerald-950/40 border border-emerald-500/5 p-4 flex flex-col justify-between h-28">
              <div className="flex items-center justify-between">
                <span className="text-[10px] text-emerald-400 font-medium">KAPASITAS BATERAI</span>
                <Battery size={14} className="text-emerald-400" />
              </div>
              <div>
                <span className="text-2xl font-bold font-mono text-emerald-300">{batteryLevel}%</span>
              </div>
              <span className="text-[9px] text-emerald-500">LiFePO4 Optimized</span>
            </div>

          </div>

          {/* Logs Terminal */}
          <div className="flex-1 min-h-[140px] rounded-2xl bg-black/70 border border-emerald-500/10 p-3 flex flex-col font-mono text-[10px] mb-4">
            <div className="flex items-center justify-between text-emerald-500 border-b border-emerald-950 pb-1.5 mb-1.5">
              <span className="font-bold flex items-center gap-1">
                <Cpu size={10} /> FEED AKTIVITAS REAKTOR
              </span>
              <span className="text-[8px] opacity-75">LIVE FEED</span>
            </div>
            
            <div className="flex-1 overflow-y-auto space-y-1.5 pr-1 no-scrollbar max-h-[110px]">
              {logs.map((log, index) => (
                <div key={index} className="leading-normal">
                  <span className="text-emerald-600 mr-1">[{log.time}]</span>
                  <span className={
                    log.type === 'success' ? 'text-emerald-300' :
                    log.type === 'warning' ? 'text-amber-400' : 'text-emerald-100'
                  }>
                    {log.message}
                  </span>
                </div>
              ))}
              <div ref={logEndRef} />
            </div>
          </div>

          {/* Interactive Controls */}
          <div className="space-y-2 mt-auto">
            <div className="text-[10px] text-emerald-400 font-semibold uppercase tracking-wider px-1">Tindakan Cepat IoT</div>
            <div className="grid grid-cols-2 gap-2">
              <button 
                onClick={triggerOptimization}
                disabled={isOptimizing}
                className="flex items-center justify-center gap-1.5 rounded-xl bg-emerald-900/60 hover:bg-emerald-800 border border-emerald-500/20 py-2.5 text-xs font-bold text-white transition-all active:scale-95 disabled:opacity-50"
              >
                <RefreshCw size={12} className={isOptimizing ? 'animate-spin text-emerald-400' : 'text-emerald-400'} />
                {isOptimizing ? 'Mestimulasi...' : 'Stimulasi Bakteri'}
              </button>
              <button 
                onClick={triggerSelfCleaning}
                disabled={isCleaning}
                className="flex items-center justify-center gap-1.5 rounded-xl bg-emerald-900/60 hover:bg-emerald-800 border border-emerald-500/20 py-2.5 text-xs font-bold text-white transition-all active:scale-95 disabled:opacity-50"
              >
                <Layers size={12} className={isCleaning ? 'animate-bounce text-emerald-400' : 'text-emerald-400'} />
                {isCleaning ? 'Mencuci...' : 'Self-Cleaning'}
              </button>
            </div>
          </div>

          {/* App Demo Banner Footer */}
          <div className="mt-4 text-center">
            <p className="text-[9px] text-emerald-500 leading-normal">
              Aplikasi pendamping tersinkronisasi otomatis dengan MicroCell IoT Hub menggunakan konektivitas hybrid (Bluetooth &amp; Wi-Fi).
            </p>
          </div>

        </div>
      </div>
    </div>
  );
}
