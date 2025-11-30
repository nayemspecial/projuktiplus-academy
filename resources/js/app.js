import './bootstrap';
import Alpine from 'alpinejs';
import DarkModeToggle from './components/DarkModeToggle';
import AuthForm from './components/AuthForm';
import { Dashboard } from './pages/admin/Dashboard';

// Alpine.js কম্পোনেন্ট রেজিস্টার
Alpine.data('darkModeToggle', DarkModeToggle);
Alpine.data('authForm', AuthForm);
document.addEventListener('alpine:init', () => {
    window.Alpine.data('dashboard', Dashboard);
});

// Alpine.js ইনিশিয়ালাইজ
window.Alpine = Alpine;
Alpine.start();