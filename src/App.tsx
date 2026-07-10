import React, { useState, useEffect } from 'react';
import AOS from 'aos';
import 'aos/dist/aos.css';
import Header from './components/Header';
import Hero from './components/Hero';
import About from './components/About';
import HowItWorks from './components/HowItWorks';
import Benefits from './components/Benefits';
import ScaleSolutions from './components/ScaleSolutions';
import FAQ from './components/FAQ';
import Footer from './components/Footer';

import CalculatorModal from './components/CalculatorModal';
import DashboardSimulatorModal from './components/DashboardSimulatorModal';
import SurveyModal from './components/SurveyModal';

export default function App() {
  const [isCalculatorOpen, setIsCalculatorOpen] = useState(false);
  const [isSimulatorOpen, setIsSimulatorOpen] = useState(false);
  const [isSurveyOpen, setIsSurveyOpen] = useState(false);

  useEffect(() => {
    AOS.init({
      duration: 800,
      once: true,
      easing: 'ease-in-out',
    });
  }, []);

  return (
    <div className="min-h-screen bg-[#041706] text-emerald-100 selection:bg-emerald-500 selection:text-emerald-950 font-sans antialiased">
      <Header 
        onOpenSurvey={() => setIsSurveyOpen(true)}
        onOpenSimulator={() => setIsSimulatorOpen(true)}
      />
      
      <Hero 
        onOpenSurvey={() => setIsSurveyOpen(true)}
        onOpenSimulator={() => setIsSimulatorOpen(true)}
        onOpenCalculator={() => setIsCalculatorOpen(true)}
      />
      
      <About 
        onOpenSimulator={() => setIsSimulatorOpen(true)}
      />
      
      <HowItWorks />
      
      <Benefits 
        onOpenSurvey={() => setIsSurveyOpen(true)}
        onOpenCalculator={() => setIsCalculatorOpen(true)}
      />
      
      <ScaleSolutions 
        onOpenSurvey={() => setIsSurveyOpen(true)}
      />
      
      <FAQ />
      
      <Footer 
        onOpenSurvey={() => setIsSurveyOpen(true)}
      />

      {/* Interactive Floating/Full-Screen Modals */}
      <CalculatorModal 
        isOpen={isCalculatorOpen}
        onClose={() => setIsCalculatorOpen(false)}
      />
      
      <DashboardSimulatorModal 
        isOpen={isSimulatorOpen}
        onClose={() => setIsSimulatorOpen(false)}
      />
      
      <SurveyModal 
        isOpen={isSurveyOpen}
        onClose={() => setIsSurveyOpen(false)}
      />
    </div>
  );
}
