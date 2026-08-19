<div id="form-success" style="display:none;" class="flex flex-col items-center justify-center text-center py-12">
    <div class="inline-flex size-16 items-center justify-center rounded-full bg-primary/15 text-primary mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="size-7"><path d="M20 6 9 17l-5-5"/></svg>
    </div>
    <h3 class="text-xl font-bold mb-3">Message Sent!</h3>
    <p class="text-muted-foreground max-w-xs">Thank you for reaching out. We'll get back to you within 24 hours.</p>
</div>

<form id="chada-contact-form" class="space-y-6" novalidate>
    <p class="chada-honeypot">
        <label>Don't fill this out: <input name="bot-field" /></label>
    </p>

    <div class="chada-form-group">
        <label class="mb-2 block text-sm font-medium" for="name">Name<span class="ml-0.5 text-primary" aria-hidden="true">*</span></label>
        <input id="name" name="name" type="text" required placeholder="Your name" class="chada-field-input w-full rounded-xl border border-border bg-neutral-50 px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary transition-colors" />
        <p class="chada-error-msg mt-1.5 text-xs font-medium text-red-500" role="alert"></p>
    </div>

    <div class="chada-form-group">
        <label class="mb-2 block text-sm font-medium" for="email">Email<span class="ml-0.5 text-primary" aria-hidden="true">*</span></label>
        <input id="email" name="email" type="email" required placeholder="your@email.com" class="chada-field-input w-full rounded-xl border border-border bg-neutral-50 px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary transition-colors" />
        <p class="chada-error-msg mt-1.5 text-xs font-medium text-red-500" role="alert"></p>
    </div>

    <div class="chada-form-group">
        <label class="mb-2 block text-sm font-medium" for="message">Message<span class="ml-0.5 text-primary" aria-hidden="true">*</span></label>
        <textarea id="message" name="message" rows="5" required placeholder="Tell us about your project..." class="chada-field-input w-full resize-none rounded-xl border border-border bg-neutral-50 px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary transition-colors"></textarea>
        <p class="chada-error-msg mt-1.5 text-xs font-medium text-red-500" role="alert"></p>
    </div>

    <p id="chada-form-error" class="text-sm font-medium text-red-500 text-center" role="alert" aria-live="polite"></p>

    <button type="submit" id="chada-submit-btn" class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-primary px-7 py-3.5 text-xs font-semibold uppercase tracking-widest text-primary-foreground transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30">
        <span id="chada-submit-label">Send Message</span>
        <span id="chada-submit-arrow">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        </span>
        <svg id="chada-submit-spinner" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="size-4 animate-spin" style="display:none;" aria-hidden="true">
            <path d="M21 12a9 9 0 1 1-6.219-8.56" />
        </svg>
    </button>
</form>
