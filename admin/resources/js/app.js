import './bootstrap';
import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';
import { createIcons, icons } from 'lucide';

window.Alpine = Alpine;
window.Chart = Chart;

Alpine.start();

// Initialize Lucide icons globally when Alpine initializes or when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    createIcons({ icons });
});
