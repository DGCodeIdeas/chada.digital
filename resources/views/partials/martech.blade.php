<section class="px-6 py-20 md:py-28" id="martech">
    <div class="mx-auto max-w-7xl">
        <x-section-header
            label="Our Stack"
            title="The Tools We Build With"
            subtitle="We don't reinvent the wheel — we integrate the best tools in the industry into systems that work for your business."
            center
        />

        <div class="mt-14 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
            @php
            $categories = [
                'Payments' => ['Paystack', 'Stripe', 'Flutterwave'],
                'Analytics' => ['Google Analytics 4', 'Plausible', 'PostHog'],
                'CRM & Marketing' => ['HubSpot', 'Brevo', 'Mailchimp'],
                'Advertising' => ['Meta Ads', 'Google Ads', 'TikTok Ads'],
                'Automation' => ['Zapier', 'Make', 'n8n'],
                'CMS & E-Commerce' => ['Laravel', 'WordPress', 'Shopify'],
                'SEO' => ['Ahrefs', 'SEMrush', 'RankMath'],
                'Infrastructure' => ['AWS', 'Cloudflare', 'Vercel'],
            ];
            @endphp

            @foreach($categories as $category => $tools)
                <div class="rounded-2xl border border-border bg-card/40 p-6">
                    <h3 class="mb-4 text-xs font-semibold uppercase tracking-widest text-muted-foreground">{{ $category }}</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tools as $tool)
                            <span class="rounded-full border border-border bg-background px-3 py-1.5 text-xs text-muted-foreground">{{ $tool }}</span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <p class="mt-10 text-center text-xs text-muted-foreground">Tool logos are property of their respective owners. Listed tools reflect our standard integration stack.</p>
    </div>
</section>
