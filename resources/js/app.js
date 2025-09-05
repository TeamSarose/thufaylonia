import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Navbar scroll shadow toggle
window.addEventListener('scroll', () => {
    const nav = document.querySelector('.navbar-modern');
    if (!nav) return;
    if (window.scrollY > 10) {
        nav.classList.add('scrolled');
    } else {
        nav.classList.remove('scrolled');
    }
});
