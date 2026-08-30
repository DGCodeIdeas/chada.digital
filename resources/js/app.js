import './bootstrap';

// Bootstrap 5 JavaScript
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

// Material Design 3 Web Components
import '@material/web/all.js';

// jQuery modules (existing)
import './modules/toast';
import './modules/mobile-nav';
import './modules/contact-form';
import './modules/showcase-filters';

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    // Bootstrap tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    // Bootstrap popovers
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
});
