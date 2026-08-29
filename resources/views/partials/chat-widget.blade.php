@php
    $chat = config('placeholders.chat');
@endphp

{{-- Placeholder only — Open_Decision.md Q8 (tool + persona) not yet decided.
     Do not wire to a real WhatsApp number or chat SaaS product without that
     decision. This button is a no-op: it does not open any external link or
     chat script. Replace with a real integration once Q8 is resolved. --}}
<div class="fixed bottom-6 right-6 z-50">
    <div class="group relative">
        <button type="button" aria-label="Chat — placeholder" class="flex size-14 items-center justify-center rounded-full bg-primary text-primary-foreground shadow-xl transition-transform hover:scale-110">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-6"><path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"/></svg>
        </button>
        <div class="absolute bottom-full right-0 mb-3 hidden w-64 rounded-2xl border border-border bg-card p-5 shadow-2xl group-hover:block">
            <span class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">{{ $chat['persona_name'] ?? '' }}</span>
            <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ $chat['greeting'] ?? '' }}</p>
        </div>
    </div>
</div>
