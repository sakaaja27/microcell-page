import React, { useState } from 'react';
import Header from '../components/layout/Header';
import Footer from '../components/layout/Footer';
import Hero from '../features/landing/Hero';
import About from '../features/landing/About';
import HowItWorks from '../features/landing/HowItWorks';
import Benefits from '../features/landing/Benefits';
import ScaleSolutions from '../features/landing/ScaleSolutions';
import FAQ from '../features/landing/FAQ';

import CalculatorModal from '../features/modals/CalculatorModal';
import DashboardSimulatorModal from '../features/modals/DashboardSimulatorModal';
import SurveyModal from '../features/modals/SurveyModal';

export default function Home() {
  const [isCalculatorOpen, setIsCalculatorOpen] = useState(false);
  const [isSimulatorOpen, setIsSimulatorOpen] = useState(false);
  const [isSurveyOpen, setIsSurveyOpen] = useState(false);

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
