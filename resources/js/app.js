import './bootstrap';

// Alpine.js & Plugins
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import sort from '@alpinejs/sort';

// SweetAlert2
import Swal from 'sweetalert2';
window.Swal = Swal;

// Custom Components Imports
// (এই ফাইলগুলো নিচে তৈরি করে দেওয়া হয়েছে)
import DarkModeToggle from './components/DarkModeToggle';
import AuthForm from './components/AuthForm';
import { Dashboard } from './pages/admin/Dashboard';

// Plugins Register
Alpine.plugin(collapse);
Alpine.plugin(sort);

// Alpine.js কম্পোনেন্ট রেজিস্টার
Alpine.data('darkModeToggle', DarkModeToggle);
Alpine.data('authForm', AuthForm);

document.addEventListener('alpine:init', () => {
    window.Alpine.data('dashboard', Dashboard);
});

// Alpine.js ইনিশিয়ালাইজ
window.Alpine = Alpine;
Alpine.start();