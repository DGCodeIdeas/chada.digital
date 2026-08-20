<section class="border-t border-border/40 bg-card/40 px-6 py-20 md:py-28" id="testimonials">
    <div class="mx-auto max-w-7xl">
        <x-section-header
            label="Client Words"
            title="What Our Partners Say"
            subtitle="Real feedback from the teams we've worked with."
            center
        />

        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            {{-- Testimonial 1 --}}
            <div class="rounded-2xl border border-border bg-background p-8">
                <div class="flex gap-1 text-primary">
                    @for($i = 0; $i < 5; $i++)
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    @endfor
                </div>
                <p class="mt-5 text-sm leading-relaxed text-muted-foreground">"Chada Digital transformed our online presence completely. The new site doesn't just look better — it actually brings in qualified project inquiries every week."</p>
                <div class="mt-6 flex items-center gap-3">
                    <div class="inline-flex size-10 items-center justify-center rounded-full bg-primary/15 text-primary font-display text-sm font-bold">SV</div>
                    <div>
                        <p class="text-sm font-semibold">Sterling & Vale Team</p>
                        <p class="text-xs text-muted-foreground">Construction, Lagos</p>
                    </div>
                </div>
            </div>

            {{-- Testimonial 2 --}}
            <div class="rounded-2xl border border-border bg-background p-8">
                <div class="flex gap-1 text-primary">
                    @for($i = 0; $i < 5; $i++)
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    @endfor
                </div>
                <p class="mt-5 text-sm leading-relaxed text-muted-foreground">"The booking system they built eliminated our reliance on OTAs. We're now capturing 40% of reservations directly — that's real money back in our business."</p>
                <div class="mt-6 flex items-center gap-3">
                    <div class="inline-flex size-10 items-center justify-center rounded-full bg-primary/15 text-primary font-display text-sm font-bold">E</div>
                    <div>
                        <p class="text-sm font-semibold">ELYSIAN Management</p>
                        <p class="text-xs text-muted-foreground">Hospitality, Lagos</p>
                    </div>
                </div>
            </div>

            {{-- Testimonial 3 --}}
            <div class="rounded-2xl border border-border bg-background p-8">
                <div class="flex gap-1 text-primary">
                    @for($i = 0; $i < 5; $i++)
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    @endfor
                </div>
                <p class="mt-5 text-sm leading-relaxed text-muted-foreground">"Our trial conversion rate went from 22% to 68% after Chada rebuilt our landing funnel. The automation they set up still runs without us touching it."</p>
                <div class="mt-6 flex items-center gap-3">
                    <div class="inline-flex size-10 items-center justify-center rounded-full bg-primary/15 text-primary font-display text-sm font-bold">AF</div>
                    <div>
                        <p class="text-sm font-semibold">ApexFlow Product Team</p>
                        <p class="text-xs text-muted-foreground">SaaS, Remote</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
