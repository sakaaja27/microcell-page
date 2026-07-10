import React, { useRef, useEffect } from 'react';
import { Play, Sparkles, Smartphone, Sliders, Settings, Layers, Zap } from 'lucide-react';

interface HeroProps {
  onOpenSurvey: () => void;
  onOpenSimulator: () => void;
  onOpenCalculator: () => void;
}

export default function Hero({ onOpenSurvey, onOpenSimulator, onOpenCalculator }: HeroProps) {
  const canvasRef = useRef<HTMLCanvasElement>(null);

  useEffect(() => {
    const canvas = canvasRef.current;
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    let animationFrameId: number;
    let width = (canvas.width = canvas.offsetWidth);
    let height = (canvas.height = canvas.offsetHeight);

    const particles: Array<{
      x: number;
      y: number;
      radius: number;
      color: string;
      speedY: number;
      speedX: number;
      alpha: number;
      pulseSpeed: number;
    }> = [];

    const createParticles = () => {
      const count = Math.min(Math.floor(width / 20), 45);
      for (let i = 0; i < count; i++) {
        particles.push({
          x: Math.random() * width,
          y: Math.random() * height,
          radius: Math.random() * 4 + 1.5,
          color: i % 2 === 0 ? '74, 222, 128' : '45, 212, 191', // Emerald vs Teal
          speedY: -(Math.random() * 0.5 + 0.2),
          speedX: (Math.random() - 0.5) * 0.3,
          alpha: Math.random() * 0.5 + 0.2,
          pulseSpeed: Math.random() * 0.02 + 0.01,
        });
      }
    };

    createParticles();

    // Mouse interactive tracking
    let mouse = { x: -1000, y: -1000 };
    const handleMouseMove = (e: MouseEvent) => {
      const rect = canvas.getBoundingClientRect();
      mouse.x = e.clientX - rect.left;
      mouse.y = e.clientY - rect.top;
    };

    const handleMouseLeave = () => {
      mouse.x = -1000;
      mouse.y = -1000;
    };

    canvas.addEventListener('mousemove', handleMouseMove);
    canvas.addEventListener('mouseleave', handleMouseLeave);

    const animate = () => {
      ctx.clearRect(0, 0, width, height);

      // Gradient background inside canvas
      const bgGrad = ctx.createLinearGradient(0, 0, 0, height);
      bgGrad.addColorStop(0, '#022c22'); // very deep green teal
      bgGrad.addColorStop(1, '#021e17');
      ctx.fillStyle = bgGrad;
      ctx.fillRect(0, 0, width, height);

      // Draw and update particles
      particles.forEach((p) => {
        // Slowly pulse alpha
        p.alpha += p.pulseSpeed;
        if (p.alpha > 0.8 || p.alpha < 0.1) {
          p.pulseSpeed = -p.pulseSpeed;
        }

        // Float upwards
        p.y += p.speedY;
        p.x += p.speedX;

        // Reset particle if it drifts off the screen
        if (p.y < -20) {
          p.y = height + 20;
          p.x = Math.random() * width;
        }
        if (p.x < -20 || p.x > width + 20) {
          p.speedX = -p.speedX;
        }

        // Mouse attraction/repulsion micro-effect
        const dx = p.x - mouse.x;
        const dy = p.y - mouse.y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < 120) {
          const force = (120 - dist) / 120;
          p.x += (dx / dist) * force * 1.5;
          p.y += (dy / dist) * force * 1.5;
        }

        // Draw particle
        ctx.beginPath();
        const radGrad = ctx.createRadialGradient(p.x, p.y, 0, p.x, p.y, p.radius * 2);
        radGrad.addColorStop(0, `rgba(${p.color}, ${p.alpha})`);
        radGrad.addColorStop(1, `rgba(${p.color}, 0)`);
        ctx.fillStyle = radGrad;
        ctx.arc(p.x, p.y, p.radius * 3, 0, Math.PI * 2);
        ctx.fill();
      });

      // Draw subtle connection lines between nearby particles
      ctx.strokeStyle = 'rgba(52, 211, 153, 0.05)';
      ctx.lineWidth = 0.8;
      for (let i = 0; i < particles.length; i++) {
        for (let j = i + 1; j < particles.length; j++) {
          const dx = particles[i].x - particles[j].x;
          const dy = particles[i].y - particles[j].y;
          const d = Math.sqrt(dx * dx + dy * dy);
          if (d < 100) {
            ctx.beginPath();
            ctx.moveTo(particles[i].x, particles[i].y);
            ctx.lineTo(particles[j].x, particles[j].y);
            ctx.stroke();
          }
        }
      }

      animationFrameId = requestAnimationFrame(animate);
    };

    animate();

    const handleResize = () => {
      width = canvas.width = canvas.offsetWidth;
      height = canvas.height = canvas.offsetHeight;
      particles.length = 0;
      createParticles();
    };

    window.addEventListener('resize', handleResize);

    return () => {
      canvas.removeEventListener('mousemove', handleMouseMove);
      canvas.removeEventListener('mouseleave', handleMouseLeave);
      window.removeEventListener('resize', handleResize);
      cancelAnimationFrame(animationFrameId);
    };
  }, []);

  return (
    <section className="relative min-h-screen flex items-center justify-center pt-24 pb-20 overflow-hidden bg-emerald-950">
      
      {/* Dynamic Animated Bio-electric Background */}
      <div className="absolute inset-0 w-full h-full">
        <canvas ref={canvasRef} className="w-full h-full block" />
        <div className="absolute inset-0 bg-gradient-to-b from-emerald-950/20 via-transparent to-[#041706]" />
      </div>

      {/* Main Content Container */}
      <div className="relative z-10 max-w-5xl mx-auto px-6 text-center">
        
        {/* Animated Badge */}
        <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-400/20 text-emerald-400 mb-8">
          <span className="text-sm">🌿</span>
          <span className="font-sans text-xs font-bold tracking-wider uppercase">Inovasi Energi Terbarukan Berbasis Mikroba</span>
        </div>

        {/* Dynamic Typography Title */}
        <h1 className="font-sans text-4xl sm:text-5xl md:text-6xl font-extrabold text-white tracking-tight leading-[1.1] mb-6 max-w-4xl mx-auto drop-shadow-sm">
          Ubah Limbah Kotoran Sapi Menjadi <span className="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-green-400">Energi Listrik</span>
        </h1>

        {/* Subtitle description */}
        <p className="font-sans text-base sm:text-lg md:text-xl text-emerald-100/90 mb-10 max-w-3xl mx-auto leading-relaxed">
          MicroCell mengkonversi limbah kotoran ternak menjadi energi listrik terbarukan melalui teknologi bioelektrokimia MFC + BPFC yang terintegrasi IoT langsung di kandang Anda.
        </p>

        {/* Call to Actions */}
        <div className="flex flex-col sm:flex-row gap-4 justify-center mb-12">
          <a 
            href="https://wa.me/6285760199917?text=Halo%20Admin%20MicroCell%2C%20saya%20tertarik%20dan%20ingin%20berkonsultasi%20mengenai%20pemasangan%20sistem%20MicroCell."
            target="_blank"
            rel="noopener noreferrer"
            className="bg-[#16A34A] text-white px-8 py-4 rounded-full font-bold text-sm tracking-wide hover:bg-emerald-500 hover:shadow-[0_0_20px_rgba(22,163,74,0.4)] active:scale-95 transition-all duration-200 flex items-center justify-center"
          >
            Konsultasi Gratis
          </a>
          <a 
            href="#how-it-works"
            className="flex items-center justify-center gap-2 border border-white/30 text-white px-8 py-4 rounded-full font-bold text-sm hover:bg-white/10 active:scale-95 transition-all duration-200"
          >
            <Zap size={16} className="text-emerald-400" />
            Cara Kerja MicroCell
          </a>
        </div>
        {/* Glassmorphism Specification Specs Block */}
        {/* <div className="glass-card rounded-[32px] p-6 md:p-8 max-w-4xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-y-6 gap-x-4 border border-emerald-500/10">
          
          <div className="text-left md:border-r border-emerald-500/10 px-4">
            <p className="text-emerald-400/70 text-[10px] font-bold uppercase tracking-wider mb-1">Output Daya</p>
            <p className="text-white font-sans text-base sm:text-lg font-bold">Stabil &amp; Kontinu</p>
            <span className="text-[10px] text-emerald-500">24 Jam Non-Stop</span>
          </div>

          <div className="text-left md:border-r border-emerald-500/10 px-4">
            <p className="text-emerald-400/70 text-[10px] font-bold uppercase tracking-wider mb-1">Mode Kerja</p>
            <p className="text-white font-sans text-base sm:text-lg font-bold">Full Otomatis</p>
            <span className="text-[10px] text-emerald-500">Auto Smart Regulation</span>
          </div>

          <div className="text-left md:border-r border-emerald-500/10 px-4">
            <p className="text-emerald-400/70 text-[10px] font-bold uppercase tracking-wider mb-1">Instalasi</p>
            <p className="text-white font-sans text-base sm:text-lg font-bold">Modular &amp; Cepat</p>
            <span className="text-[10px] text-emerald-500">Pasang &amp; Aktifkan</span>
          </div>

        </div> */}

      </div>

    </section>
  );
}
