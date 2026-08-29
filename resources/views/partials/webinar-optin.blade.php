@php
    $webinar = config('placeholders.webinar');
@endphp

@if(! empty($webinar['enabled']))
    <section class="px-6 py-20 md:py-28" id="webinar">
        <div class="mx-auto max-w-5xl overflow-hidden rounded-2xl border border-border bg-card">
            <div class="grid md:grid-cols-2">
                <div class="p-10 md:p-12">
                    <x-section-badge>{{ data_get($webinar, 'subhead') ?? \App\Support\Lorem::title('webinar.subhead', 3) }}</x-section-badge>
                    <x-section-heading class="mt-4">{{ data_get($webinar, 'headline') ?? \App\Support\Lorem::title('webinar.headline', 6) }}</x-section-heading>
                    <p class="mt-4 text-sm leading-relaxed text-muted-foreground">{{ data_get($webinar, 'body') ?? \App\Support\Lorem::paragraph('webinar.body', 2, 10) }}</p>
                </div>
                <div class="border-t border-border bg-background/40 p-10 md:border-l md:border-t-0 md:p-12">
                    <form action="{{ route('contact.submit') }}" method="POST" class="chada-form space-y-4" data-form-type="webinar">
                        @csrf
                        <input type="hidden" name="form_type" value="webinar" />
                        <p class="chada-honeypot">
                            <label>Don't fill this out: <input name="bot-field" /></label>
                        </p>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <input type="text" name="first_name" placeholder="First Name" required class="w-full rounded-xl border border-border bg-card px-4 py-3 text-sm" />
                            <input type="text" name="last_name" placeholder="Last Name" required class="w-full rounded-xl border border-border bg-card px-4 py-3 text-sm" />
                        </div>
                        <input type="email" name="email" placeholder="Email Address" required class="w-full rounded-xl border border-border bg-card px-4 py-3 text-sm" />
                        <input type="tel" name="phone" placeholder="Phone Number" class="w-full rounded-xl border border-border bg-card px-4 py-3 text-sm" />
                        <div class="grid gap-4 sm:grid-cols-2">
                            <input type="text" name="company" placeholder="Company" class="w-full rounded-xl border border-border bg-card px-4 py-3 text-sm" />
                            <input type="text" name="job_title" placeholder="Job Title" class="w-full rounded-xl border border-border bg-card px-4 py-3 text-sm" />
                        </div>
                        <button type="submit" class="w-full rounded-full bg-primary px-6 py-3.5 text-xs font-semibold uppercase tracking-widest text-primary-foreground transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30">
                            {{ $webinar['cta_label'] ?? 'Get the Replay' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endif