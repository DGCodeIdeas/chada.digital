# Redesign(8).md — Global Chrome: Header, Footer, Chat Widget Wiring, Meta/OG, JSON-LD

> **Series:** Redesign(1)–(9) · **This doc:** #8 of 9
> **Builds:** `resources/views/partials/header.blade.php` (final nav), `resources/views/partials/footer.blade.php` (multi-column), `resources/views/partials/chat-widget.blade.php` (WhatsApp wiring, config-gated), `resources/views/partials/structured-data.blade.php` (schema extensions), `partials/meta.blade.php` (per-page OG defaults, via controllers)
> **Depends on:** Redesign(5).md (routes + anchors exist), Redesign(6).md (`/services` route exists), Redesign(7).md (`#demo-lab` anchor exists)

```
CONSTRAINTS (repeat in your session — from Redesign(1).md §3):
1.  NEVER touch public/demos/.
2.  mix() not @vite(). 3. bun not npm. 4. ZERO new dependencies.
5.  Preserve route names. 6. Keep contact honeypot. 7. PHP 8.2 constructor
    promotion. 8. Blade components for reusable markup. 9. Follow the Chada
    style charter. 10. Placeholder prose is GENERATED ($real ?? Lorem::…).
11. ORIGINALITY: never copy third-party text/names/prices/metrics; never
    fetch or quote the reference site; these docs are the only reference.
12. Escape apostrophes in single-quoted PHP strings.
13. bun run dev clean after every change; bun run prod before phase done.
14. NEVER invent real-sounding content — the chat widget stays a documented
    no-op while placeholders.chat.whatsapp_number is null (Open_Decision Q8).
```

---

## TASK 1 — Final header nav

**Target pattern:** logo left · links center (Work, Services, About, Contact) · "Start a Project" pill CTA right · mobile hamburger with the same four links. The header is already structurally correct from V2 — this task finalizes link targets and adds `/services`.

Replace both nav blocks in `resources/views/partials/header.blade.php` (desktop `nav.hidden.lg:flex` and the mobile menu):

```blade
<nav class="hidden items-center gap-7 lg:flex">
    <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="{{ route('work') }}">Work</a>
    <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="{{ route('services') }}">Services</a>
    <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="{{ url('/#founder') }}">About</a>
    <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="{{ url('/#contact') }}">Contact</a>
</nav>
```

Mobile menu (`#mobile-menu`), same four links + the CTA:

```blade
<nav class="flex flex-col gap-4 border-t border-border/40 bg-background/95 px-6 py-6 backdrop-blur-xl">
    <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="{{ route('work') }}">Work</a>
    <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="{{ route('services') }}">Services</a>
    <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="{{ url('/#founder') }}">About</a>
    <a class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground" href="{{ url('/#contact') }}">Contact</a>
    <a class="inline-flex items-center justify-center gap-2 rounded-full bg-primary px-5 py-2.5 text-xs font-semibold uppercase tracking-widest text-primary-foreground transition-transform hover:-translate-y-0.5" href="{{ url('/#contact') }}">Start a Project</a>
</nav>
```

**Do not touch:** the logo (`chada-logo-horizontal-dark.png`), the sticky/backdrop-blur wrapper, the `nav-toggle` button and its JS bindings (`initMobileNav('nav-toggle', 'mobile-menu', 'nav-icon')`).

---

## TASK 2 — Multi-column footer (4-zone pattern)

**Pattern:** About blurb + contact link · Services column · Explore column · social column · bottom bar.

**Chada adaptation:** same 4-zone layout; the Services column links to the real `/services` tier anchors; the Explore column contains **only what exists** — no dead links (constraint: never ship a link to a page that 404s). Blog/Calculator/Webinar do not exist yet → they are NOT listed until built. All labels are Chada chrome (kind A).

Replace `resources/views/partials/footer.blade.php` in full:

```blade
<footer class="border-t border-border/40 bg-card/40 px-6 py-16">
    <div class="mx-auto max-w-7xl">
        <div class="grid gap-10 md:grid-cols-4">
            {{-- Zone 1: About --}}
            <div>
                <img alt="Chada Digital" class="h-10 w-auto object-contain" src="{{ asset('chada-logo-horizontal-dark.png') }}" />
                <p class="mt-4 text-sm leading-relaxed text-muted-foreground">
                    Chada Digital builds websites, funnels, and automation that turn visitors into customers — for ambitious teams across Nigeria and beyond.
                </p>
                <a href="{{ url('/#contact') }}" class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:underline">
                    Contact us
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-3.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>

            {{-- Zone 2: Services (real tier anchors from Redesign(6)) --}}
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">Services</p>
                <nav class="mt-4 flex flex-col gap-3">
                    <a class="text-sm text-muted-foreground transition-colors hover:text-foreground" href="{{ route('services') }}#advisory">Advisory Sessions</a>
                    <a class="text-sm text-muted-foreground transition-colors hover:text-foreground" href="{{ route('services') }}#builds">Full Builds</a>
                    <a class="text-sm text-muted-foreground transition-colors hover:text-foreground" href="{{ route('services') }}#care">Ongoing Care</a>
                    <a class="text-sm text-muted-foreground transition-colors hover:text-foreground" href="{{ url('/#services-checklist') }}">Everything We Do</a>
                </nav>
            </div>

            {{-- Zone 3: Explore (only what exists) --}}
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">Explore</p>
                <nav class="mt-4 flex flex-col gap-3">
                    <a class="text-sm text-muted-foreground transition-colors hover:text-foreground" href="{{ route('work') }}">Case Studies</a>
                    <a class="text-sm text-muted-foreground transition-colors hover:text-foreground" href="{{ url('/#demo-lab') }}">Interactive Demos</a>
                    <a class="text-sm text-muted-foreground transition-colors hover:text-foreground" href="{{ url('/#workflow-system') }}">System Blueprints</a>
                    <a class="text-sm text-muted-foreground transition-colors hover:text-foreground" href="{{ url('/#testimonials') }}">Testimonials</a>
                </nav>
            </div>

            {{-- Zone 4: Social --}}
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">Follow</p>
                <div class="mt-4 flex gap-3">
                    <a href="#" aria-label="Twitter" class="inline-flex size-10 items-center justify-center rounded-xl border border-border text-muted-foreground transition-colors hover:border-primary hover:text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="size-[18px]"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                    </a>
                    <a href="#" aria-label="LinkedIn" class="inline-flex size-10 items-center justify-center rounded-xl border border-border text-muted-foreground transition-colors hover:border-primary hover:text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="size-[18px]"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                    <a href="#" aria-label="Instagram" class="inline-flex size-10 items-center justify-center rounded-xl border border-border text-muted-foreground transition-colors hover:border-primary hover:text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="size-[18px]"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                    </a>
                </div>
                <p class="mt-4 text-xs leading-relaxed text-muted-foreground">Social links are placeholders until real profiles are supplied.</p>
            </div>
        </div>

        <div class="mt-12 flex flex-col gap-4 border-t border-border/40 pt-8 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-muted-foreground">&copy; {{ date('Y') }} Chada Digital &middot; All rights reserved</p>
            <p class="text-xs text-muted-foreground">Built with Laravel in Lagos, Nigeria.</p>
        </div>
    </div>
</footer>
```

**Deferred (flag, do not build):** a footer currency selector. Chada has no multi-currency content; revisit if/when pricing displays in both currencies.

---

## TASK 3 — Wire the chat widget (config-gated WhatsApp)

**Current state:** a deliberate no-op button with a hover popover (Q8 unresolved). **New behavior:** when `placeholders.chat.whatsapp_number` is set, the button becomes a real `https://wa.me/{number}?text=...` link opening WhatsApp; while null, it stays the documented no-op. Zero guessing of numbers (constraint 14).

Replace `resources/views/partials/chat-widget.blade.php` in full:

```blade
@php
    $chat = config('placeholders.chat');
    $number = $chat['whatsapp_number'] ?? null;
    $prefill = rawurlencode($chat['whatsapp_prefill'] ?? 'Hello Chada Digital!');
    $personaName = $chat['persona_name'] ?? \App\Support\Lorem::name('chat.persona');
    $greeting = $chat['greeting'] ?? \App\Support\Lorem::sentence('chat.greeting', 9);
@endphp

{{-- Open_Decision.md Q8 (tool + persona + number) governs this widget.
     While placeholders.chat.whatsapp_number is null, this is a NO-OP by
     design: the button opens nothing. Setting the number instantly wires
     a real WhatsApp click-to-chat thread — no further code changes.
     Persona name + greeting are generated lorem until Q8 is answered. --}}
<div class="fixed bottom-6 right-6 z-50">
    <div class="group relative">
        @if($number)
            <a
                href="https://wa.me/{{ $number }}?text={{ $prefill }}"
                target="_blank"
                rel="noopener"
                aria-label="Chat with us on WhatsApp"
                class="flex size-14 items-center justify-center rounded-full bg-[#25D366] text-white shadow-xl transition-transform hover:scale-110"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="currentColor" class="size-6"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413"/></svg>
            </a>
        @else
            <button type="button" aria-label="Chat — placeholder" class="flex size-14 items-center justify-center rounded-full bg-primary text-primary-foreground shadow-xl transition-transform hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-6"><path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"/></svg>
            </button>
        @endif

        {{-- Persona popover — shown on hover in both modes --}}
        <div class="absolute bottom-full right-0 mb-3 hidden w-64 rounded-2xl border border-border bg-card p-5 shadow-2xl group-hover:block">
            <span class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">{{ $personaName }}</span>
            <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ $greeting }}</p>
            @if($number)
                <span class="mt-3 inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600">
                    <span class="inline-flex size-1.5 rounded-full bg-emerald-500"></span> Chat with us
                </span>
            @endif
        </div>
    </div>
</div>
```

**When David answers Q8:** set `placeholders.chat.whatsapp_number` to the E.164 number (e.g. `2348012345678`), set `persona_name` to the real person, set `greeting` to a real first-person opener — the widget goes live with zero code changes. Record the decision in `Open_Decision.md` sign-off row 8. The popover action line reads **"Chat with us"** — Chada chrome, first person plural, no borrowed phrasing.

---

## TASK 4 — JSON-LD extensions (`partials/structured-data.blade.php`)

**Additions:** (a) a `Person` node for the founder — **only when founder content is real** (`placeholders.founder.real === true`; a Person schema with generated lorem is worse than none); (b) a `WebPage` node for `/services`.

The existing file is a single `@graph` with two nodes and no Blade conditionals. Merging commas correctly across `@if` boundaries is fiddly — the safest structure is to build the graph array in `@php` and `json_encode` it:

```blade
@php
    $founderIsReal = config('placeholders.founder.real') === true;

    $graph = [
        [
            '@type' => ['Organization', 'LocalBusiness'],
            'name' => 'Chada Digital',
            'url' => 'https://www.chadadigital.com',
            'logo' => 'https://www.chadadigital.com/chada-logo-horizontal.png',
            'image' => 'https://www.chadadigital.com/og-image.jpg',
            'description' => 'We engineer high-performance websites, command-attention brands, and intelligent automation for ambitious teams across Nigeria and beyond.',
            'slogan' => 'Digital Solutions That Scale Businesses',
            'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'Lagos', 'addressCountry' => 'NG'],
            'areaServed' => 'Worldwide',
            'priceRange' => '$$$',
            'openingHoursSpecification' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                'opens' => '09:00',
                'closes' => '18:00',
            ],
            'contactPoint' => ['@type' => 'ContactPoint', 'contactType' => 'Customer Service', 'availableLanguage' => 'English'],
        ],
        [
            '@type' => 'WebSite',
            'name' => 'Chada Digital',
            'url' => 'https://www.chadadigital.com',
            'publisher' => ['@type' => 'Organization', 'name' => 'Chada Digital'],
        ],
    ];

    if ($founderIsReal) {
        $founder = config('placeholders.founder');
        $graph[] = [
            '@type' => 'Person',
            'name' => $founder['name'] ?? '',
            'jobTitle' => $founder['title'] ?? '',
            'worksFor' => ['@type' => 'Organization', 'name' => 'Chada Digital'],
            'url' => 'https://www.chadadigital.com/#founder',
        ];
    }

    if (request()->routeIs('services')) {
        $graph[] = [
            '@type' => 'WebPage',
            'name' => 'Services — Chada Digital',
            'url' => route('services'),
        ];
    }
@endendphp
<script type="application/ld+json">{{ json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) }}</script>
```

This preserves the existing Organization data verbatim while adding the gated nodes. **Gate note:** the founder gate is the boolean `founder.real` flag (added in Redesign(2)) — robust, unlike string-comparing a name against lorem output. Validate after deploy: https://validator.schema.org.

---

## TASK 5 — Meta/OG refresh for the V4 pages

`partials/meta.blade.php` is already comprehensive (title, description, canonical, hreflang, OG, Twitter, icons) and reads `$meta` per page. Two touch-ups:

1. **Home meta title/description** — `PageController::home()` still says "Digital Solutions That Scale Businesses" (V1 positioning). Update the controller meta to a neutral V4 line (final positioning is David's, Open_Decision Q1 — flag, do not decide):

```php
'meta' => [
    'title' => 'Chada Digital — Websites, Funnels & Automation That Convert',
    'description' => 'We build websites, funnels, and automation systems that turn visitors into customers — for ambitious teams across Nigeria and beyond.',
    'canonical' => route('home'),
    'ogImage' => asset('og-image.jpg'),
],
```

2. **`/work` and `/case-study/{slug}` meta descriptions** — `CaseStudyController` passes `title`/`canonical`/`ogImage` but no `description`. Add one neutral line in `index()`:

```php
'meta' => [
    'title' => 'Work — Chada Digital',
    'description' => 'Systems we have designed, built, and shipped — with the results they produced.',
    'canonical' => route('work'),
    'ogImage' => asset('og-image.jpg'),
],
```

And in `show()` (uses the study excerpt when present):

```php
'meta' => [
    'title' => $study['client'].' — Chada Digital',
    'description' => $study['excerpt'] ?? 'A Chada Digital case study.',
    'canonical' => route('case-study.show', $slug),
    'ogImage' => asset($study['thumbnail'] ?? 'og-image.jpg'),
],
```

---

## Verification (run all)

```bash
# 1. Header/footer/chat render on every page
for p in "/" "/work" "/services"; do
  curl -s "http://127.0.0.1:8000$p" > /tmp/page.html
  grep -q '/work' /tmp/page.html || echo "check Work link on $p"
  grep -q "wa.me" /tmp/page.html && echo "FAIL: wa.me rendered while number is null ($p)" || echo "PASS: no wa.me while null ($p)"
done

# 2. Footer links — every footer href must return 200 or be an anchor
curl -s http://127.0.0.1:8000/ | grep -o 'href="[^"]*"' | sort -u
# manually confirm: no href points at /blog, /calculator, /webinar (not built)
# and Services column hits /services#advisory, /services#builds, /services#care

# 3. JSON-LD validity + founder gate
curl -s http://127.0.0.1:8000/ | grep -A2 'application/ld+json' | head -5
curl -s http://127.0.0.1:8000/ | grep -c '"@type": "Person"'   # expect 0 while founder.real is false
# paste full block into https://validator.schema.org — must parse

# 4. Scratch-test the chat wiring: set whatsapp_number to any real number you
#    control in a scratch commit, reload, confirm the green WhatsApp button
#    renders with the correct wa.me href + prefill, popover shows "Chat with
#    us". Revert.

# 5. Mobile nav still works (nav-toggle binding untouched)
bun run dev

# 6. Originality spot-check — no borrowed chrome phrasing in the DOM:
curl -s http://127.0.0.1:8000/ | grep -icE "click to chat|book a strategy" || echo "PASS: original chrome"
```

## Definition of done (this doc)

- [ ] Header (desktop + mobile): Work / Services / About / Contact + CTA; logo and toggle JS untouched
- [ ] Footer: 4-zone layout (About+Contact / Services / Explore / Social); zero links to unbuilt pages; social placeholders documented; Services column hits the three tier anchors
- [ ] Chat widget: no-op while `whatsapp_number` null; scratch-test proved wa.me wiring works when set; popover persona renders generated lorem until Q8
- [ ] JSON-LD: graph rebuilt in PHP with the `founder.real`-gated Person node + services WebPage node; validator passes; no Person node while gated
- [ ] Meta: home/work/case-study descriptions updated; OG defaults sane
- [ ] `bun run dev` clean; committed on `feat/v4-r8` as `feat(v4-r8): global chrome — nav, footer, chat wiring, schema, meta`
- [ ] Originality spot-check passes (no borrowed chrome phrasing)

*End of Redesign(8).md — proceed to Redesign(9).md.*
