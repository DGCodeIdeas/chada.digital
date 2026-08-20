import './bootstrap';
import $ from 'jquery';

// Make jQuery available globally
window.$ = $;
window.jQuery = $;

// Import modules
import { toast } from './modules/toast';
import { initMobileNav } from './modules/mobile-nav';
import { initChadaContactForm } from './modules/contact-form';
// Expose modules globally for legacy compatibility (Sterling & Vale demo)
window.toast = toast;
window.initMobileNav = initMobileNav;
window.initChadaContactForm = initChadaContactForm;

// Initialize on DOM ready
$(() => {
    // Mobile navigation
    initMobileNav('nav-toggle', 'mobile-menu', 'nav-icon');
    initMobileNav('sv-nav-toggle', 'sv-mobile-menu', 'sv-nav-icon');

    // Contact form
    initChadaContactForm();

    // Showcase category filtering
    initShowcaseFilters();
});

/**
 * Showcase page category filter logic.
 * Toggles visibility of project cards and active state of filter buttons.
 */
function initShowcaseFilters() {
    const $filterBar = $('.showcase-filter-bar');
    const $grid = $('.showcase-filter-grid');
    if (!$filterBar.length || !$grid.length) return;

    const $buttons = $filterBar.find('.filter-btn');
    const $cards = $grid.find('[data-category]');

    $buttons.on('click', function () {
        const $btn = $(this);
        const category = $btn.data('category');

        // Update active button styling
        $buttons.removeClass('bg-primary/10 text-primary border-primary/40');
        $btn.addClass('bg-primary/10 text-primary border-primary/40');

        // Filter cards
        if (category === 'all') {
            $cards.show();
        } else {
            $cards.each(function () {
                const $card = $(this);
                $card.toggle($card.data('category') === category);
            });
        }
    });
}
