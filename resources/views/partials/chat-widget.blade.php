<!-- WhatsApp Chat Widget -->
{{-- Uses config('contact.whatsapp') for the real number. Previously
     hardcoded to 2340000000000 (fake) — a visitor could click it and
     get a broken WhatsApp conversation. Now reads from config so the
     Founder can update the number in one place (config/contact.php). --}}
@php $whatsapp = config('contact.whatsapp'); @endphp
@if($whatsapp)
<a href="https://wa.me/{{ $whatsapp }}?text={{ urlencode('Hi Chada Digital, I would like to discuss a project.') }}"
   target="_blank"
   rel="noopener noreferrer"
   class="position-fixed d-flex align-items-center justify-content-center shadow-lg"
   style="bottom: 24px; right: 24px; width: 56px; height: 56px; background: #25D366; border-radius: 50%; z-index: 1050; text-decoration: none; transition: transform 0.2s ease;"
   aria-label="Chat on WhatsApp"
   onmouseover="this.style.transform='scale(1.1)'"
   onmouseout="this.style.transform='scale(1)'">
    <svg width="28" height="28" fill="white" viewBox="0 0 24 24">
        <path d="M12.04 2C6.58 2 2.06 6.5 2.06 11.95c0 2.06.64 4.04 1.84 5.71L2 22l4.45-1.9c1.52.84 3.25 1.28 5.01 1.28h.04c5.46 0 9.95-4.5 9.95-9.95S17.5 2 12.04 2zm5.6 13.88c-.24.68-1.39 1.28-1.94 1.36-.52.08-1.04.1-1.51-.04-.35-.1-.8-.26-1.36-.52-2.38-1.03-3.93-3.44-4.04-3.59-.11-.15-.97-1.28-.97-2.45 0-1.17.61-1.74.82-1.98.21-.24.47-.3.62-.3.16 0 .31 0 .45.01.14.01.33-.05.52.4.19.44.64 1.53.7 1.64.06.11.01.24-.03.33-.04.09-.09.15-.17.24-.08.09-.17.19-.24.26-.08.08-.16.16-.08.31.08.15.35.58.74.94.51.46.94.61 1.08.67.14.06.23.05.31-.03.08-.08.36-.42.46-.56.09-.15.19-.12.31-.07.12.05.77.36.9.43.14.07.23.1.26.16.04.06.04.35-.2 1.03z"/>
    </svg>
</a>
@endif
