/**
 * Chada Digital — Bootstrap 5 + Material Design 3
 * Multi-page application JavaScript
 */

// jQuery — must be imported BEFORE any code that uses $.
// Previously this was missing, causing "Uncaught ReferenceError: $ is not defined".
import $ from 'jquery';
window.$ = window.jQuery = $;

// Bootstrap 5 JS (depends on jQuery being available for some components)
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

// jQuery modules (preserved from original site)
$(document).ready(function() {
    // Smooth scroll for anchor links
    // Fix: was $('aref^="#"]') — missing [href — now corrected
    $('a[href^="#"]').on('click', function(e) {
        const target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: target.offset().top - 80 }, 600);
        }
    });

    // Header shadow on scroll
    const header = document.querySelector('header');
    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) {
                header.style.boxShadow = '0 4px 12px rgba(0,0,0,0.08)';
            } else {
                header.style.boxShadow = 'none';
            }
        });
    }
});

// Contact form AJAX handler (vanilla JS, no jQuery dependency)
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    if (!contactForm) return;

    contactForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = this;
        const responseDiv = document.getElementById('formResponse');
        const btn = form.querySelector('button[type="submit"]');
        const originalText = btn.textContent;

        btn.disabled = true;
        btn.textContent = 'Sending...';
        responseDiv.style.display = 'none';

        try {
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            const res = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': data._token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            });

            const result = await res.json();
            responseDiv.style.display = 'block';

            if (result.success) {
                responseDiv.className = 'alert alert-success rounded-3 mt-3';
                responseDiv.textContent = result.message;
                form.reset();
            } else {
                responseDiv.className = 'alert alert-danger rounded-3 mt-3';
                responseDiv.textContent = result.message || 'Something went wrong. Please try again.';
            }
        } catch (err) {
            responseDiv.style.display = 'block';
            responseDiv.className = 'alert alert-danger rounded-3 mt-3';
            // Use the email from the data attribute (set by the Blade view from config)
            const fallbackEmail = document.querySelector('[data-contact-email]')?.dataset.contactEmail
                || 'info@chadadigital.com';
            responseDiv.textContent = 'Network error. Please email us directly at ' + fallbackEmail;
        } finally {
            btn.disabled = false;
            btn.textContent = originalText;
        }
    });
});
