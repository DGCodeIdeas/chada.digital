<!-- WhatsApp Chat Widget -->
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
    <i class="bi bi-whatsapp" style="font-size: 1.75rem; color: white;"></i>
</a>
@endif
