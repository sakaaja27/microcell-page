const fs = require('fs');
const path = require('path');

const projectRoot = 'd:\\msi\\project\\microcell\\src';

const filesToConvert = [
    'components/layout/Header.tsx',
    'features/landing/Hero.tsx',
    'features/landing/About.tsx',
    'features/landing/HowItWorks.tsx',
    'features/landing/Benefits.tsx',
    'features/landing/ScaleSolutions.tsx',
    'features/landing/FAQ.tsx',
    'components/layout/Footer.tsx',
    'features/modals/CalculatorModal.tsx',
    'features/modals/DashboardSimulatorModal.tsx',
    'features/modals/SurveyModal.tsx'
];

let finalHtml = `
@extends('layouts.app')
@section('title', 'Solusi Infrastruktur Telekomunikasi')
@section('content')
<div class="overflow-x-hidden min-h-screen bg-[#041706] text-emerald-100 selection:bg-emerald-500 selection:text-emerald-950 font-sans antialiased">
`;

for (const relPath of filesToConvert) {
    const fullPath = path.join(projectRoot, relPath);
    if (fs.existsSync(fullPath)) {
        let content = fs.readFileSync(fullPath, 'utf-8');
        
        // Extract the return (...) block roughly
        const returnMatch = content.match(/return\s*\(\s*([\s\S]*?)\s*\);/);
        if (returnMatch) {
            let jsx = returnMatch[1];
            
            // Basic JSX to HTML conversions
            jsx = jsx.replace(/className=/g, 'class=');
            jsx = jsx.replace(/htmlFor=/g, 'for=');
            jsx = jsx.replace(/onClick=\{[^}]*\}/g, '');
            jsx = jsx.replace(/onChange=\{[^}]*\}/g, '');
            jsx = jsx.replace(/onSubmit=\{[^}]*\}/g, '');
            jsx = jsx.replace(/\{[^{}]*\}/g, ''); // Remove simple {} bindings
            jsx = jsx.replace(/<([A-Z][a-zA-Z0-9]*)[^>]*\/>/g, ''); // Remove empty React components
            jsx = jsx.replace(/<([A-Z][a-zA-Z0-9]*)[^>]*>[\s\S]*?<\/\1>/g, ''); // Remove React components with children
            
            finalHtml += `\n<!-- Section from ${path.basename(relPath)} -->\n`;
            finalHtml += jsx + '\n';
        }
    }
}

finalHtml += `</div>\n@endsection\n`;

fs.writeFileSync('d:\\msi\\project\\microcell\\admin\\resources\\views\\welcome.blade.php', finalHtml);
console.log('Successfully generated welcome.blade.php');
