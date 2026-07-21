# Chada Digital — AI Agent Implementation Prompts

> **Stack:** Laravel 12 + Laravel Mix + Tailwind CSS v3 + Alpine.js + nginx + MySQL/RDS
> **Source Reference:** [`chada-digital-static/`](chada-digital-static/index.html:1)
> **Full Plan:** [`MIGRATION_PLAN.md`](MIGRATION_PLAN.md:1)

---

## 🚨 CRITICAL Constraints

- ⚠️ **NEVER touch `public/demos/`** — all demo files are read-only, fully independent
- ⚠️ **Read from `chada-digital-static/`**, never write to it
- ⚠️ Use `mix()` helper, NOT `@vite()` in Blade
- ⚠️ Use `bun` not `npm` for all package commands
- ⚠️ Run all commands from the project root: `c:/laragon/www/chada_digital`

---

## 1. Master Prompt — Full Migration

> Copy this entire section and paste into an AI agent to implement all phases at once.

````text
You are implementing a Laravel 12 static-to-Blade migration at c:/laragon/www/chada_digital.
The existing Laravel app uses Laravel Mix + Tailwind CSS v3 (NOT Vite).
The static reference site is in chada-digital-static/ (READ ONLY — never modify it).
All demo files live in public/demos/ (READ ONLY — never modify them).
Full implementation plan is in MIGRATION_PLAN.md.

CRITICAL RULES:
- Use mix() helper in all Blade templates (never @vite())
- Use bun for all package commands (never npm)
- New files go in resources/, app/, routes/, config/, services/, tests/, or .github/
- Use Laravel 12 conventions: PHP 8.2+, constructor promotion, enum-like patterns

STACK:
- Asset Pipeline: Laravel Mix (webpack.mix.js already configured)
- CSS: SCSS + Tailwind CSS v3 + PostCSS
- JS: Alpine.js + ES6 modules bundled by Mix
- Server: nginx + PHP 8.2-FPM + MySQL 8.0 / RDS

PHASE 1 — Audit & Setup:
1. Remove `@tailwindcss/vite` from package.json: bun remove @tailwindcss/vite
2. Add Alpine.js: bun add alpinejs && bun add @alpinejs/focus
3. Update tailwind.config.js with Chada design tokens (colors: background=#0e1b2e, primary=#3b82f6, card=#0b1526, muted=#1e293b, muted-foreground=#94a3b8; fonts: display=Outfit, sans=Inter, accent=Playfair Display)
4. Update resources/sass/app.scss: keep @tailwind directives, add .chada-honeypot, .chada-field-input.is-invalid, .chada-error-msg, @keyframes fadeIn, .animate-fade-in, .filter-btn[data-active='true']
5. Update resources/js/app.js to import Alpine + focus plugin + bootstrap, then Alpine.start()
6. Run: bun install && bun run dev
7. ✅ Verify public/css/app.css and public/js/app.js are generated

PHASE 2 — Blade Layout & Components:
Create all files listed below. For partial content, extract HTML from chada-digital-static/index.html (the corresponding line ranges are in MIGRATION_PLAN.md Section 2.4).

FILES TO CREATE:
📁 resources/views/layouts/app.blade.php
  - Master layout: doctype, html lang, head with @include('partials.meta') + @include('partials.fonts') + mix('css/app.css') + @stack('head')
  - Body with @include('partials.header'), <main>@yield('content')</main>, @include('partials.footer'), @include('partials.projects-modal')
  - mix('js/app.js') + @stack('scripts')

📁 resources/views/partials/meta.blade.php
  - SEO meta: charset, viewport, robots, referrer, author, copyright, theme-color(#0e1b2e)
  - Dynamic <title>{{ $meta['title'] ?? config('app.name') }}</title>
  - Dynamic description, canonical, hreflang (en_NG + x-default)
  - Open Graph (og:url, site_name, title, description, type=website, locale=en_NG, image+secure_url+type+width+height+alt)
  - Twitter Card (summary_large_image)
  - Favicon links (favicon.ico, favicon-32.png, apple-touch-icon.png, msapplication-TileColor)

📁 resources/views/partials/fonts.blade.php
  - preconnect + dns-prefetch to fonts.googleapis.com and fonts.gstatic.com
  - preload Google Fonts CSS (Outfit 400-800, Inter 400-600, Playfair Display 500-800) with display=swap
  - stylesheet link for same

📁 resources/views/partials/header.blade.php
  - Extract from chada-digital-static/index.html lines 88-124
  - Sticky header with backdrop-blur, logo (chada-logo-horizontal.png), desktop nav links, mobile toggle button, CTA button

📁 resources/views/partials/footer.blade.php
  - Extract from chada-digital-static/index.html lines 446-484
  - 4-column grid, logo, nav links, copyright with {{ date('Y') }}

📁 resources/views/partials/hero.blade.php (index.html lines 128-150)
📁 resources/views/partials/about.blade.php (index.html lines 153-182)
📁 resources/views/partials/services.blade.php (index.html lines 184-228)
📁 resources/views/partials/portfolio.blade.php (index.html lines 230-295)
📁 resources/views/partials/products.blade.php (index.html lines 297-354)
📁 resources/views/partials/contact.blade.php (index.html lines 356-444)
📁 resources/views/partials/contact-form.blade.php (index.html lines 396-440 — with honeypot .chada-honeypot)
📁 resources/views/partials/project-card.blade.php (index.html lines 258-288)
📁 resources/views/partials/projects-modal.blade.php (index.html lines 488-562 — with Alpine x-data + x-trap)
📁 resources/views/partials/showcase-project-card.blade.php (showcase.html lines 65-83 pattern)
📁 resources/views/partials/structured-data.blade.php (JSON-LD Organization + WebSite)
📁 resources/views/partials/toast-root.blade.php (<div id="toast-root">)

📁 resources/views/components/splash-logo.blade.php — animated SVG Chada logo
  - Circle ring with stroke-dasharray animation, filled dot, "Chada" text, "DIGITAL" subtext, accent bar
  - Props: $size (default 140)

📁 resources/sass/_splash.scss — import into resources/sass/app.scss
  - .splash-logo-ring: stroke-dashoffset → 0 animation (1.2s)
  - .splash-logo-dot: scale(0) → scale(1) (0.5s, delay 1.0s)
  - .splash-logo-text/subtext: fade-in (0.6s, delay 0.8s/0.9s)
  - .splash-logo-accent: slide-in (0.5s, delay 1.1s)
  - .splash-logo-mark: continuous pulse (2.5s, delay 1.5s)
  - .splash-overlay: fixed fullscreen with radial gradients
  - .splash-progress-track/fill: gradient animated progress bar
  - @media (prefers-reduced-motion: reduce): all animations disabled

📁 resources/js/demo-viewer.js
  - Export demoViewerConfig() returning Alpine data object
  - Properties: demo, slug, subpage, showSplash, progress, loadingText, progressInterval, observer, rafId
  - Computed: iframeSrc (builds /demos/{slug}/index.html or /demos/{slug}/{subpage})
  - init(): starts simulateProgress() + watches showSplash for iframe load detection
  - simulateProgress(): requestAnimationFrame-based 0→90% over ~3s with ease-out
  - setupIframeDetection(): PerformanceObserver + iframe.onload fallback, 90%→100% on load
  - close(): redirects to /showcase
  - destroy(): cleanup rafId + observer
  - Import in app.js: Alpine.data('demoViewer', () => demoViewerConfig())

PHASE 3 — Routes, Controllers & Views:

📁 routes/web.php — Replace existing:
```php
<?php
use App\Http\Controllers\PageController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/showcase', [PageController::class, 'showcase'])->name('showcase');
Route::redirect('/showcase.html', '/showcase', 301);
Route::get('/demo/{slug}', [DemoController::class, 'show'])->name('demo.show');
Route::get('/demo/{slug}/{subpage}', [DemoController::class, 'subpage'])->where('subpage', '.*')->name('demo.subpage');
Route::post('/api/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');
````

📁 app/Services/DemoService.php — 5-demo metadata array (apexflow, elysian, hirebase, noir, sterling-vale). Each has: title, description, thumbnail, category. Methods: all(), exists($slug), get($slug), collection(). Register as singleton in AppServiceProvider.

📁 app/Http/Controllers/PageController.php — home(), showcase(), sitemap(). Each returns view with $meta array. Inject DemoService for sitemap.

📁 app/Http/Controllers/DemoController.php — show($slug), subpage($slug, $subpage). Inject DemoService. Returns 404 if demo not found or directory missing. Passes $demo, $slug, $subpage, $meta to view.

📁 app/Http/Controllers/ContactController.php — submit(Request): validates name/email/message, checks honeypot (bot-field), returns JSON. Email sending deferred.

📁 resources/views/pages/home.blade.php — extends layouts.app, @section('content') with @include partials: hero, about, services, portfolio, products, contact

📁 resources/views/pages/showcase.blade.php — extends layouts.app, Alpine x-data="{ category: 'all' }", filter buttons with :class binding, project grid with showcase-project-card partials

📁 resources/views/pages/demo.blade.php — extends layouts.app, Alpine x-data="demoViewer('slug', 'subpage', demo)", splash overlay (x-show="showSplash", x-trap, splash-logo component, title, description, category, thumbnail, progress bar), iframe container (x-show="!showSplash", sandbox attributes, floating close button), @push('scripts') with Alpine.data registration

📁 resources/views/errors/404.blade.php — extends layouts.app, centered 404 with link to home

PHASE 4 — SEO, Sitemap & Performance:

1. PageController@sitemap: returns XML response with all pages + demo routes (changefreq=weekly/monthly, priority=0.8-1.0)
2. Update public/robots.txt Sitemap: to <https://www.chadadigital.com/sitemap.xml>
3. Add mix.version() to webpack.mix.js for cache busting
4. Add loading="lazy" + explicit width/height on all project images
5. Add fetchpriority="high" on hero image

PHASE 5 — Tests & Deployment:

📁 tests/Feature/PageRoutesTest.php — 8 tests: home loads, showcase loads, showcase.html→301, demo page loads, invalid demo→404, 404 page, contact validation (422), contact submit (200), sitemap loads (XML content-type)

📁 tests/Feature/DemoRoutesTest.php — tests for each demo slug, subpage loading, invalid subpage→404

📁 deploy.sh — EC2/Ubuntu provisioning (apt install php8.2-\*, nginx, MySQL; git clone; composer install; bun install; bun run prod; permissions; nginx config; certbot; supervisor)

nginx config block (add to deploy.sh or create nginx.conf):

- server block: listen 80, root /var/www/chada/public
- Security headers: X-Frame-Options SAMEORIGIN, X-Content-Type-Options nosniff
- Static caching: /css/ and /js/ 1y immutable, /assets/images/ 30d
- /demos/ CSP headers
- PHP-FPM passthrough via unix socket
- Deny hidden files

📁 .github/workflows/deploy.yml — GitHub Actions: checkout, setup bun, setup PHP 8.2, composer install, bun install + bun run prod, php artisan test, deploy via SSH

AFTER ALL PHASES:

- Run: bun run prod (production build)
- Run: php artisan test (all tests pass)
- Run: php artisan route:list (verify all routes)
- Visit /, /showcase, /demo/apexflow, /sitemap.xml

````

---

## 2. Phase-by-Phase Prompts

### Phase 1 — Audit & Setup

```text
Fix the asset pipeline for Laravel Mix at c:/laragon/www/chada_digital.

STEPS:
1. Read package.json — remove @tailwindcss/vite dependency:
   bun remove @tailwindcss/vite

2. Add Alpine.js:
   bun add alpinejs
   bun add @alpinejs/focus

3. Read webpack.mix.js — it's already configured correctly (mix.js + mix.sass with Tailwind PostCSS). Keep as-is.

4. Replace tailwind.config.js content with:
   - content: ["./resources/**/*.blade.php", "./resources/**/*.js"]
   - theme.extend.colors: background:'#0e1b2e', foreground:'#f8fafc', card:{DEFAULT:'#0b1526',foreground:'#f8fafc'}, primary:{DEFAULT:'#3b82f6',foreground:'#ffffff'}, muted:{DEFAULT:'#1e293b',foreground:'#94a3b8'}, border:'rgba(148,163,184,0.1)'
   - theme.extend.fontFamily: display:['Outfit','sans-serif'], sans:['Inter','sans-serif'], accent:['Playfair Display','serif']

5. Replace resources/sass/app.scss with:
   @tailwind base;
   @tailwind components;
   @tailwind utilities;
   .chada-honeypot { position:absolute; overflow:hidden; clip:rect(0 0 0 0); height:1px; width:1px; margin:-1px; padding:0; border:0; }
   .chada-field-input.is-invalid { @apply border-red-500 focus:border-red-500 focus:ring-red-500; }
   .chada-error-msg:empty, #chada-form-error:empty { display:none; }
   @keyframes fadeIn { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }
   .animate-fade-in { animation: fadeIn 0.5s ease-out; }
   .filter-btn[data-active='true'] { @apply border-blue-500 bg-blue-500/20 text-blue-500; }

6. Replace resources/js/app.js with:
   import './bootstrap';
   import Alpine from 'alpinejs';
   import focus from '@alpinejs/focus';
   Alpine.plugin(focus);
   window.Alpine = Alpine;
   Alpine.start();

7. Run: bun install && bun run dev

✅ ACCEPTANCE: public/css/app.css and public/js/app.js are generated
````

### Phase 2 — Blade Layout & Components

```text
Create all Blade layout files, partials, and components for the Chada Digital Laravel app.

Project: c:/laragon/www/chada_digital
Reference HTML: chada-digital-static/index.html (READ ONLY)
Reference SCSS: chada-digital-static/scss/

CRITICAL: Use mix() helper everywhere, never @vite().

FILES TO CREATE:

1. resources/views/layouts/app.blade.php — Master layout:
   - <!doctype html><html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   - <head>: @include('partials.meta'), @include('partials.fonts'), <link rel="stylesheet" href="{{ mix('css/app.css') }}">, @stack('head')
   - <body class="bg-background text-foreground antialiased">: @include('partials.header'), <main>@yield('content')</main>, @include('partials.footer'), @include('partials.projects-modal'), <script src="{{ mix('js/app.js') }}"></script>, @stack('scripts')

2. resources/views/partials/meta.blade.php — Full SEO meta using $meta array:
   - charset, viewport, robots, referrer, author="Chada Digital", copyright, theme-color="#0e1b2e"
   - <title>{{ $meta['title'] ?? config('app.name', 'Chada Digital') }}</title>
   - description meta, canonical link, hreflang en_NG + x-default
   - og:url, og:site_name, og:title, og:description, og:type=website, og:locale=en_NG, og:image+secure_url+type+width(1216)+height(640)+alt
   - twitter:card=summary_large_image, twitter:title, twitter:description, twitter:image
   - Favicon: favicon.ico, favicon-32.png, apple-touch-icon.png, msapplication-TileColor

3. resources/views/partials/fonts.blade.php — Google Fonts with preconnect/dns-prefetch/preload:
   - Outfit:400,500,600,700,800 | Inter:400,500,600 | Playfair Display:500,600,700,800
   - display=swap on all

4. resources/views/partials/header.blade.php — Sticky nav (extract from index.html:88-124):
   - Logo img (chada-logo-horizontal.png), desktop nav links (Home, About Us, Services, Our Work, Products, Contact), mobile hamburger, CTA button "Start A Project"

5. resources/views/partials/footer.blade.php — 4-column footer (extract from index.html:446-484):
   - Column 1: logo + description
   - Column 2: Quick Links
   - Column 3: Services
   - Column 4: Contact info
   - Bottom: copyright © {{ date('Y') }} Chada Digital

6. resources/views/partials/hero.blade.php — from index.html:128-150
7. resources/views/partials/about.blade.php — from index.html:153-182
8. resources/views/partials/services.blade.php — from index.html:184-228
9. resources/views/partials/portfolio.blade.php — from index.html:230-295
10. resources/views/partials/products.blade.php — from index.html:297-354
11. resources/views/partials/contact.blade.php — from index.html:356-444
12. resources/views/partials/contact-form.blade.php — Form with honeypot div (.chada-honeypot), name/email/message fields, submit button
13. resources/views/partials/project-card.blade.php — Reusable card: img (aspect-[4/3]), overlay gradient, title, description, category badge
14. resources/views/partials/projects-modal.blade.php — Full modal (from index.html:488-562) with Alpine x-data="{ open: false }", x-show, x-trap="open"
15. resources/views/partials/showcase-project-card.blade.php — Card variant for /showcase grid
16. resources/views/partials/structured-data.blade.php — JSON-LD script: Organization+LocalBusiness + WebSite (extract from index.html:45-84)
17. resources/views/partials/toast-root.blade.php — <div id="toast-root" class="fixed bottom-4 right-4 z-50 flex flex-col gap-2"></div>

18. resources/views/components/splash-logo.blade.php — Animated SVG:
    @props(['size' => 140])
    <svg viewBox="0 0 400 120" width="{{ $size }}" height="{{ $size * 0.3 }}" class="splash-logo" role="img" aria-label="Chada Digital">
      <g class="splash-logo-mark">
        <circle cx="60" cy="60" r="48" fill="none" stroke="#3b82f6" stroke-width="6" stroke-linecap="round" class="splash-logo-ring" style="--draw-length: 302px"/>
        <circle cx="60" cy="60" r="18" fill="#3b82f6" class="splash-logo-dot"/>
      </g>
      <text x="140" y="50" font-family="'Outfit',sans-serif" font-weight="800" font-size="36" fill="#f8fafc" class="splash-logo-text">Chada</text>
      <text x="140" y="76" font-family="'Outfit',sans-serif" font-weight="500" font-size="16" fill="rgba(148,163,184,0.8)" class="splash-logo-subtext">DIGITAL</text>
      <rect x="310" y="42" width="4" height="36" rx="2" fill="#3b82f6" class="splash-logo-accent"/>
    </svg>

19. resources/sass/_splash.scss — Full splash animations:
    - Ring stroke-dasharray/dashoffset → 0 (1.2s ease-out)
    - Dot scale(0)→scale(1) with opacity (0.5s, 1.0s delay)
    - Text/subtext fade-in (0.6s, 0.8s/0.9s delay)
    - Accent slide-in from -10px (0.5s, 1.1s delay)
    - Mark continuous pulse scale(1)→1.05 (2.5s, 1.5s delay, infinite)
    - .splash-overlay: fixed inset-0 z-50 flex flex-col items-center justify-center bg-[#0e1b2e] with radial gradients
    - .splash-progress-track: 280px × 4px, bg white/0.08, rounded-full
    - .splash-progress-fill: gradient bg, width transition 200ms, gradient-shift animation
    - Responsive: mobile max-width adjustments
    - @media (prefers-reduced-motion: reduce): ALL animations disabled, static display
    Import into app.scss with: @import './splash';

20. resources/js/demo-viewer.js — ES module:
    export function demoViewerConfig() { return { demo:{}, slug:'', subpage:'', showSplash:true, progress:0, loadingText:'Loading demo...', progressInterval:null, observer:null, rafId:null,
      get iframeSrc() { const base = `/demos/${this.slug}`; return this.subpage ? `${base}/${this.subpage}` : `${base}/index.html`; },
      init() { this.simulateProgress(); this.$watch('showSplash', (visible) => { if(!visible) return; this.$nextTick(() => { const iframe = this.$refs.iframe; if(!iframe) return; this.setupIframeDetection(iframe); }); }); },
      simulateProgress() { const startTime = performance.now(); const targetDuration = 3000; const tick = () => { const elapsed = performance.now() - startTime; const ratio = Math.min(elapsed / targetDuration, 1); const eased = 1 - Math.pow(1 - ratio, 2); this.progress = Math.min(Math.round(eased * 90), 90); if(this.progress < 90) this.rafId = requestAnimationFrame(tick); }; this.rafId = requestAnimationFrame(tick); },
      setupIframeDetection(iframe) { try { this.observer = new PerformanceObserver((list) => { for(const entry of list.getEntries()) { if(entry.name === this.iframeSrc && entry.responseEnd > 0) { this.loadingText = 'Rendering...'; this.progress = 95; } } }); this.observer.observe({ type: 'resource', buffered: true }); } catch(e) {} iframe.addEventListener('load', () => { if(this.rafId) cancelAnimationFrame(this.rafId); if(this.observer) this.observer.disconnect(); this.progress = 100; this.loadingText = 'Ready!'; setTimeout(() => { this.showSplash = false; }, 400); }, { once: true }); },
      close() { window.location.href = this.$root.dataset.returnUrl || '/showcase'; },
      destroy() { if(this.rafId) cancelAnimationFrame(this.rafId); if(this.observer) this.observer.disconnect(); }
    }; }

    Then update resources/js/app.js to add after Alpine.start():
    import { demoViewerConfig } from './modules/demo-viewer';
    document.addEventListener('alpine:init', () => { Alpine.data('demoViewer', () => demoViewerConfig()); });

    Also create resources/js/modules/ directory. Move demo-viewer.js there if not already.

✅ ACCEPTANCE: All partials render without errors when included in a test view
```

### Phase 3 — Routes, Controllers & Views

````text
Create all routes, controllers, services, and page views for the Chada Digital Laravel app.
Project: c:/laragon/www/chada_digital

STEP 1 — Replace routes/web.php:
```php
<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/showcase', [PageController::class, 'showcase'])->name('showcase');
Route::redirect('/showcase.html', '/showcase', 301);
Route::get('/demo/{slug}', [DemoController::class, 'show'])->name('demo.show');
Route::get('/demo/{slug}/{subpage}', [DemoController::class, 'subpage'])
    ->where('subpage', '.*')
    ->name('demo.subpage');
Route::post('/api/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');
````

STEP 2 — Create app/Services/DemoService.php:

- Method all(): returns array with 5 demos (apexflow, elysian, hirebase, noir, sterling-vale)
- Each demo: ['title' => '...', 'description' => '...', 'thumbnail' => '/assets/images/project-xxx.jpg', 'category' => '...']
- Methods: exists($slug), get($slug), collection()
- Register as singleton in AppServiceProvider:
  use App\Services\DemoService;
  public function register(): void { $this->app->singleton(DemoService::class); }

STEP 3 — Create app/Http/Controllers/PageController.php:

- home(): returns view('pages.home', ['meta' => [title, description, canonical, ogImage]])
- showcase(): returns view('pages.showcase', ['meta' => [...]])
- sitemap(): inject DemoService, build $urls array (home, showcase, all demos via demoService->all()), return response(view('sitemap', ['urls' => $urls])->render(), 200, ['Content-Type' => 'application/xml'])

STEP 4 — Create app/Http/Controllers/DemoController.php:

- Constructor: \_\_construct(protected DemoService $demoService) {}
- show($slug): get demo from service, check exists + File::exists(public_path("demos/{$slug}")), return view('pages.demo', ['demo', 'slug', 'meta'])
- subpage($slug, $subpage): similar, check File::exists for subpage path (try with/without index.html)

STEP 5 — Create app/Http/Controllers/ContactController.php:

- submit(Request): validate name/email/message, check honeypot $request->filled('bot-field'), return JSON 200

STEP 6 — Create resources/views/pages/home.blade.php:
@extends('layouts.app')
@section('content')
@include('partials.hero')
@include('partials.about')
@include('partials.services')
@include('partials.portfolio')
@include('partials.products')
@include('partials.contact')
@endsection

STEP 7 — Create resources/views/pages/showcase.blade.php:
@extends('layouts.app')
@section('content')

  <main class="min-h-screen bg-background" x-data="{ category: 'all' }">
    {{-- Header section with title --}}
    <section class="px-6 py-16 md:py-24">
      <div class="mx-auto max-w-4xl text-center">
        <span class="text-xs font-semibold uppercase tracking-[0.3em] text-primary">Our Work</span>
        <h1 class="mt-4 font-display text-4xl font-bold tracking-tight md:text-5xl">Featured <span class="text-primary">Projects</span></h1>
        <p class="mt-4 text-base text-muted-foreground">A selection of recent work across industries and use cases.</p>
      </div>
    </section>
    {{-- Filter buttons with Alpine --}}
    <section class="px-6 pb-8">
      <div class="mx-auto max-w-7xl">
        <div class="flex flex-wrap items-center justify-center gap-3">
          <button @click="category = 'all'" :class="category === 'all' ? 'border-blue-500 bg-blue-500/20 text-blue-500' : ''" class="filter-btn inline-flex items-center rounded-full border border-border bg-card/50 px-5 py-2.5 text-sm font-medium text-foreground transition-all duration-300 hover:bg-primary/10 hover:text-primary">All</button>
          <button @click="category = 'Construction'" :class="category === 'Construction' ? 'border-blue-500 bg-blue-500/20 text-blue-500' : ''" class="filter-btn ...">Construction</button>
          <button @click="category = 'SaaS'" :class="category === 'SaaS' ? 'border-blue-500 bg-blue-500/20 text-blue-500' : ''" class="filter-btn ...">SaaS</button>
          <button @click="category = 'Recruitment'" :class="category === 'Recruitment' ? 'border-blue-500 bg-blue-500/20 text-blue-500' : ''" class="filter-btn ...">Recruitment</button>
        </div>
      </div>
    </section>
    {{-- Project grid with all 5 demos as showcase-project-card partials --}}
    <section class="px-6 pb-20">
      <div class="mx-auto max-w-7xl">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          @include('partials.showcase-project-card', ['slug' => 'sterling-vale', 'category' => 'Construction', 'image' => 'project-sterling.jpg', 'title' => 'Sterling & Vale', 'description' => 'Construction Firm — Corporate Website'])
          @include('partials.showcase-project-card', ['slug' => 'apexflow', 'category' => 'SaaS', 'image' => 'project-apexflow.jpg', 'title' => 'ApexFlow', 'description' => 'SaaS Platform — AI Automation'])
          @include('partials.showcase-project-card', ['slug' => 'noir', 'category' => 'E-commerce', 'image' => 'project-noir.jpg', 'title' => 'NOIR', 'description' => 'E-Commerce — Fashion Store'])
          @include('partials.showcase-project-card', ['slug' => 'elysian', 'category' => 'Booking', 'image' => 'project-elysian.jpg', 'title' => 'ELYSIAN', 'description' => 'Booking — Hotel & Spa'])
          @include('partials.showcase-project-card', ['slug' => 'hirebase', 'category' => 'Recruitment', 'image' => 'project-hirebase.jpg', 'title' => 'HIREBASE', 'description' => 'Recruitment — Job Board Platform'])
        </div>
      </div>
    </section>
  </main>
@endsection

STEP 8 — Create resources/views/pages/demo.blade.php:
@extends('layouts.app')
@section('content')

<div class="min-h-screen bg-background"
     x-data="demoViewer('{{ $slug }}', '{{ $subpage ?? '' }}', {{ Js::from($demo) }})"
     data-return-url="{{ route('showcase') }}"
     @keydown.escape.window="close()">

    {{-- Splash --}}
    <div x-show="showSplash" x-trap="showSplash"
         class="splash-overlay" role="dialog" aria-modal="true" aria-label="Demo loading">
        <div class="mb-6 md:mb-8"><x-splash-logo :size="140" class="w-20 sm:w-[110px] lg:w-[140px] h-auto"/></div>
        <h1 class="font-display text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-2 text-center px-4" x-text="demo.title"></h1>
        <p class="text-sm sm:text-base lg:text-lg text-muted-foreground mb-2 text-center px-4" x-text="demo.description"></p>
        <span class="text-xs font-semibold uppercase tracking-widest text-primary mb-6" x-text="demo.category"></span>
        <img :src="'{{ asset('') }}' + demo.thumbnail" :alt="demo.title" class="splash-thumbnail mb-8" width="800" height="600" loading="eager">
        <div class="splash-progress-track mb-3" role="progressbar" aria-valuemin="0" aria-valuemax="100" :aria-valuenow="progress" aria-label="Demo loading progress">
          <div class="splash-progress-fill" :style="{ width: progress + '%' }"></div>
        </div>
        <p class="text-sm text-muted-foreground mb-8" x-text="loadingText"></p>
        <button @click="close()" class="inline-flex items-center gap-2 rounded-full border border-border px-6 py-3 text-sm text-muted-foreground hover:text-foreground hover:border-primary transition-colors focus:outline-none focus:ring-2 focus:ring-primary/50" aria-label="Close demo viewer">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
          Close Preview
        </button>
    </div>

    {{-- Iframe --}}
    <div class="fixed inset-0 z-10" x-show="!showSplash" x-transition:enter="transition-opacity duration-500 delay-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <iframe x-ref="iframe" :src="iframeSrc" class="w-full h-full border-0"
                sandbox="allow-scripts allow-same-origin allow-forms allow-pointer-lock"
                loading="lazy" title="Demo Preview"></iframe>
        <button @click="close()" class="fixed top-4 right-4 z-20 inline-flex size-10 items-center justify-center rounded-full bg-card/80 border border-border text-muted-foreground hover:text-primary hover:border-primary transition-colors backdrop-blur-sm" aria-label="Close demo preview">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
    </div>

</div>
@endsection
@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('demoViewer', (slug, subpage, demo) => ({
        demo, slug, subpage, showSplash: true, progress: 0,
        loadingText: 'Loading demo...', progressInterval: null, observer: null, rafId: null,
        get iframeSrc() { const base = `/demos/${this.slug}`; return this.subpage ? `${base}/${this.subpage}` : `${base}/index.html`; },
        init() { let startTime = performance.now(); const tick = () => { let elapsed = performance.now() - startTime; let ratio = Math.min(elapsed / 3000, 1); this.progress = Math.min(Math.round((1 - Math.pow(1 - ratio, 2)) * 90), 90); if(this.progress < 90) this.rafId = requestAnimationFrame(tick); }; this.rafId = requestAnimationFrame(tick); this.$watch('showSplash', v => { if(!v) return; this.$nextTick(() => { let iframe = this.$refs.iframe; if(!iframe) return; try { this.observer = new PerformanceObserver((list) => { for(let e of list.getEntries()) { if(e.name === this.iframeSrc && e.responseEnd > 0) { this.loadingText = 'Rendering...'; this.progress = 95; } } }); this.observer.observe({ type: 'resource', buffered: true }); } catch(e) {} iframe.addEventListener('load', () => { if(this.rafId) cancelAnimationFrame(this.rafId); if(this.observer) this.observer.disconnect(); this.progress = 100; this.loadingText = 'Ready!'; setTimeout(() => { this.showSplash = false; }, 400); }, { once: true }); }); }); },
        close() { window.location.href = this.$root.dataset.returnUrl || '/showcase'; },
        destroy() { if(this.rafId) cancelAnimationFrame(this.rafId); if(this.observer) this.observer.disconnect(); }
    }));
});
</script>
@endpush

STEP 9 — Create resources/views/errors/404.blade.php:
@extends('layouts.app')
@section('content')

<main class="flex min-h-screen items-center justify-center px-6">
  <div class="text-center">
    <span class="text-6xl font-extrabold text-primary">404</span>
    <h1 class="mt-4 font-display text-2xl font-bold tracking-tight md:text-4xl">Page Not Found</h1>
    <p class="mt-4 max-w-md mx-auto text-muted-foreground">The page you are looking for doesn't exist or has been moved.</p>
    <a href="{{ route('home') }}" class="mt-8 inline-flex items-center gap-2 rounded-full bg-primary px-7 py-3.5 text-xs font-semibold uppercase tracking-widest text-primary-foreground transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary/30">Go Back Home</a>
  </div>
</main>
@endsection

STEP 10 — Create resources/views/sitemap.blade.php (XML template):
{!! '<'.'?xml version="1.0" encoding="UTF-8"?'.'>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($urls as $url)
<url>
<loc>{{ $url['loc'] }}</loc>
<changefreq>{{ $url['changefreq'] ?? 'weekly' }}</changefreq>
<priority>{{ $url['priority'] ?? '0.5' }}</priority>
</url>
@endforeach
</urlset>

✅ ACCEPTANCE: All routes return 200, /demo/apexflow shows splash then iframe

````

### Phase 4 — SEO, Sitemap & Performance

```text
Implement SEO, sitemap, redirects, and performance optimizations.

Project: c:/laragon/www/chada_digital

STEPS:
1. In PageController::sitemap(), build $urls array:
   - home (priority 1.0, weekly), showcase (0.9, weekly)
   - For each demo from DemoService: demo.show (0.8, monthly)
   - Return response(view('sitemap', ['urls' => $urls])->render(), 200, ['Content-Type' => 'application/xml'])

2. Update public/robots.txt — verify Sitemap: line points to https://www.chadadigital.com/sitemap.xml

3. Add mix.version() to webpack.mix.js (append after the .webpackConfig block):
   mix.version();

4. In webpack.mix.js, add a second JS entry for demo-viewer:
   mix.js('resources/js/modules/demo-viewer.js', 'public/js')

5. Ensure all project/portfolio images have: loading="lazy", width="800", height="600", class="aspect-[4/3]"

6. Add fetchpriority="high" on the hero image in partials/hero.blade.php

7. Verify routes/web.php has: Route::redirect('/showcase.html', '/showcase', 301);

✅ ACCEPTANCE: /sitemap.xml returns valid XML, /showcase.html → 301 → /showcase
````

### Phase 5 — Testing & Deployment

````text
Create tests and deployment configuration.

Project: c:/laragon/www/chada_digital

STEP 1 — Create tests/Feature/PageRoutesTest.php with these test methods:
- test_home_page_loads: get(route('home'))→assertStatus(200)→assertSee('Chada Digital')
- test_showcase_page_loads: get(route('showcase'))→assertStatus(200)
- test_showcase_html_redirects: get('/showcase.html')→assertRedirect→assertStatus(301)
- test_demo_page_loads: get(route('demo.show', 'apexflow'))→assertStatus(200)
- test_invalid_demo_returns_404: get(route('demo.show', 'nonexistent'))→assertStatus(404)
- test_404_page_loads: get('/nonexistent-page')→assertStatus(404)
- test_contact_form_validation: postJson(route('contact.submit'), [])→assertStatus(422)→assertJsonValidationErrors(['name','email','message'])
- test_contact_form_submits_successfully: postJson with valid data→assertStatus(200)
- test_sitemap_loads: get(route('sitemap'))→assertStatus(200)→assertHeader('Content-Type', 'application/xml')

STEP 2 — Create tests/Feature/DemoRoutesTest.php:
- test_each_demo_slug_loads (apexflow, elysian, hirebase, noir, sterling-vale)
- test_demo_subpage_loads: get(route('demo.subpage', ['slug'=>'apexflow','subpage'=>'dashboard']))→assertStatus(200)
- test_invalid_demo_subpage_returns_404

STEP 3 — Create deploy.sh (make executable: chmod +x deploy.sh):
```bash
#!/bin/bash
set -e
echo "=== Chada Digital Deployment ==="

# System deps
sudo apt update
sudo apt install -y php8.2 php8.2-fpm php8.2-mysql php8.2-cli php8.2-common \
  php8.2-curl php8.2-mbstring php8.2-xml php8.2-zip php8.2-bcmath php8.2-gd \
  php8.2-opcache nginx git composer unzip

# Bun
curl -fsSL https://bun.sh/install | bash
source ~/.bashrc

# App
cd /var/www/chada_digital
git pull origin main
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist
bun install && bun run prod

# Permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# Cache
php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan event:cache

# Migrate
php artisan migrate --force

# Reload
sudo systemctl reload php8.2-fpm
sudo nginx -t && sudo systemctl reload nginx

echo "=== Deployment Complete ==="
````

STEP 4 — Create .github/workflows/deploy.yml:

```yaml
name: Deploy to Production
on:
    push:
        branches: [main]
jobs:
    tests:
        runs-on: ubuntu-latest
        services:
            mysql:
                image: mysql:8.0
                env:
                    MYSQL_ROOT_PASSWORD: root
                    MYSQL_DATABASE: chada_digital
                ports:
                    - 3306:3306
        steps:
            - uses: actions/checkout@v4
            - uses: oven-sh/setup-bun@v1
            - uses: shivammathur/setup-php@v2
              with:
                  php-version: "8.2"
            - run: composer install --no-interaction
            - run: bun install && bun run prod
            - run: php artisan test
    deploy:
        needs: tests
        runs-on: ubuntu-latest
        steps:
            - name: Deploy to EC2
              uses: appleboy/ssh-action@v1
              with:
                  host: ${{ secrets.EC2_HOST }}
                  username: ubuntu
                  key: ${{ secrets.SSH_PRIVATE_KEY }}
                  script: |
                      cd /var/www/chada_digital
                      git pull origin main
                      composer install --no-dev --optimize-autoloader --no-interaction
                      bun install && bun run prod
                      php artisan migrate --force
                      php artisan config:cache && php artisan route:cache && php artisan view:cache
                      sudo systemctl reload php8.2-fpm
```

STEP 5 — nginx config reference (for deploy.sh or manual setup at /etc/nginx/sites-available/chadadigital):

```nginx
server {
    listen 80;
    server_name chadadigital.com www.chadadigital.com;
    root /var/www/chada/public;
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;
    gzip on; gzip_vary on; gzip_min_length 1024;
    gzip_types text/plain text/css text/xml text/javascript application/javascript application/json image/svg+xml;
    location /css/ { expires 1y; add_header Cache-Control "public, immutable"; }
    location /js/ { expires 1y; add_header Cache-Control "public, immutable"; }
    location /assets/images/ { expires 30d; add_header Cache-Control "public"; }
    location /demos/ { add_header Content-Security-Policy "default-src 'self' 'unsafe-inline' 'unsafe-eval'; img-src 'self' data: https:; font-src 'self' https://fonts.gstatic.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com;" always; }
    location / { try_files $uri $uri/ /index.php?$query_string; }
    location ~ \.php$ { fastcgi_pass unix:/var/run/php/php8.2-fpm.sock; fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name; include fastcgi_params; fastcgi_buffers 16 16k; fastcgi_buffer_size 32k; }
    location ~ /\.(?!well-known).* { deny all; }
    access_log /var/log/nginx/chada-access.log;
    error_log /var/log/nginx/chada-error.log;
}
```

✅ ACCEPTANCE: php artisan test passes all tests, deploy.sh is executable

````

### Phase 3.6 — Playwright Browser Automation

```text
Set up the Playwright browser automation sidecar service.

Project: c:/laragon/www/chada_digital

Create the following files:

📁 services/browser-service/package.json:
{ "name": "chada-browser-service", "version": "1.0.0", "private": true, "type": "commonjs", "scripts": { "start": "node server.js", "dev": "node --watch server.js" }, "dependencies": { "express": "^4.18.0", "playwright": "^1.40.0", "pino": "^8.16.0" } }

📁 services/browser-service/config.js:
module.exports = {
  maxBrowsers: parseInt(process.env.BROWSER_POOL_SIZE || '3', 10),
  sessionTTL: 300000,
  commandTimeout: 30000,
  maxRetries: 3,
  healthCheckInterval: 10000,
  chromiumFlags: ['--no-sandbox', '--disable-gpu', '--disable-dev-shm-usage', '--single-process'],
};

📁 services/browser-service/BrowserPool.js:
- Class managing pool of Chromium instances
- Constructor: accepts config, initializes empty browsers Map and pending queue
- acquire(): returns available browser or queues request; auto-cleans crashed browsers via browser.isConnected()
- release(sessionId): returns browser to pool
- health(): returns { status, activeSessions, availableSlots, totalCommands, avgDuration_ms, uptime, memoryMB }

📁 services/browser-service/BrowserSession.js:
- Creates isolated browser context per session
- Methods: navigate(url, waitUntil), click(selector, timeout), type(selector, text, delay), select(selector, value), wait(selector, state, timeout), execute(script, args), screenshot(fullPage, clip), extract(mode, selector), close()
- Retry logic: 3 attempts with exponential backoff (100ms, 200ms, 400ms)

📁 services/browser-service/commands/ — 8 modules (navigate.js, click.js, type.js, select.js, wait.js, execute.js, screenshot.js, extract.js):
  Each exports a handler(req, res) that validates input, calls BrowserSession method, returns JSON { success, data?, error?, sessionId, duration_ms }

📁 services/browser-service/middleware/logger.js — pino request logger middleware

📁 services/browser-service/server.js — Express HTTP server:
- POST /session — create session
- POST /session/:id/navigate — navigate
- POST /session/:id/click — click element
- POST /session/:id/type — type text
- POST /session/:id/select — select dropdown
- POST /session/:id/wait — wait for selector
- POST /session/:id/execute — execute JS
- POST /session/:id/screenshot — capture screenshot (returns base64 PNG)
- POST /session/:id/extract — extract content
- DELETE /session/:id — close session
- GET /sessions — list active sessions
- GET /health — pool health check

📁 app/Services/BrowserService.php — PHP HTTP client wrapper:
- Properties: private string $baseUrl (from config)
- Methods: createSession($options), navigate($sessionId, $url, $waitUntil), click(...), type(...), select(...), wait(...), execute(...), screenshot(...), extract(...), closeSession(...), health(), listSessions()
- Uses Http::timeout(35)->post() with try/catch for ConnectionException
- Circuit breaker: after 5 consecutive failures, returns SERVICE_UNAVAILABLE without HTTP calls for 30s

📁 app/Http/Controllers/BrowserController.php:
- All 12 endpoint methods delegating to BrowserService
- create(), navigate($id), click($id), type($id), select($id), wait($id), execute($id), screenshot($id), extract($id), destroy($id), list(), health()

📁 routes/api.php — Add browser routes (create if needed):
use App\Http\Controllers\BrowserController;
Route::middleware('auth:sanctum')->prefix('browser')->group(function () {
    Route::post('/sessions', [BrowserController::class, 'create']);
    Route::post('/sessions/{id}/navigate', [BrowserController::class, 'navigate']);
    Route::post('/sessions/{id}/click', [BrowserController::class, 'click']);
    Route::post('/sessions/{id}/type', [BrowserController::class, 'type']);
    Route::post('/sessions/{id}/select', [BrowserController::class, 'select']);
    Route::post('/sessions/{id}/wait', [BrowserController::class, 'wait']);
    Route::post('/sessions/{id}/execute', [BrowserController::class, 'execute']);
    Route::post('/sessions/{id}/screenshot', [BrowserController::class, 'screenshot']);
    Route::post('/sessions/{id}/extract', [BrowserController::class, 'extract']);
    Route::delete('/sessions/{id}', [BrowserController::class, 'destroy']);
    Route::get('/sessions', [BrowserController::class, 'list']);
    Route::get('/health', [BrowserController::class, 'health']);
});

📁 config/browser.php:
return ['service_url' => env('BROWSER_SERVICE_URL', 'http://localhost:3099')];

📁 app/Console/Commands/BrowserStatus.php — artisan browser:status command:
- Calls BrowserService::health() and ::listSessions()
- Outputs table with pool status, active sessions, memory usage

Register BrowserService as singleton in AppServiceProvider.

Run: cd services/browser-service && bun install && bunx playwright install chromium

✅ ACCEPTANCE: bun run services/browser-service/server.js starts, GET /health returns {"status":"ok"}
````

---

## 3. Quick-Start Prompts

### Fix the Asset Pipeline

```text
At c:/laragon/www/chada_digital, remove @tailwindcss/vite from package.json (bun remove @tailwindcss/vite), verify webpack.mix.js is configured for Mix + Tailwind v3 PostCSS, run bun install && bun run dev. Confirm public/css/app.css and public/js/app.js are generated.
```

### Create Just the Demo Viewer Page

```text
At c:/laragon/www/chada_digital, create the full demo iframe viewer: DemoService (app/Services/DemoService.php), DemoController (show + subpage methods), pages/demo.blade.php with Alpine splash overlay + iframe, splash-logo.blade.php component, _splash.scss animations, demo-viewer.js module. Wire route /demo/{slug} and /demo/{slug}/{subpage}. Test with /demo/apexflow.
```

### Set Up the Playwright Service Only

```text
At c:/laragon/www/chada_digital, create services/browser-service/ with package.json (express + playwright + pino), config.js, BrowserPool.js, BrowserSession.js, all 8 command modules, server.js, PHP BrowserService wrapper, BrowserController, browser API routes, config/browser.php. Run bun install && bunx playwright install chromium in services/browser-service/. Verify GET /health returns {"status":"ok"}.
```

### Add SEO Meta Tags to All Pages

```text
At c:/laragon/www/chada_digital, create partials/meta.blade.php with full SEO (title, description, OG, Twitter Card, canonical, hreflang, favicon). Create partials/structured-data.blade.php with JSON-LD. Include both in layouts/app.blade.php head. Ensure each controller passes $meta array to views.
```

### Create the Deployment Script

```text
At c:/laragon/www/chada_digital, create deploy.sh (EC2 Ubuntu provisioning + git pull + composer install + bun run prod + cache + permissions + reload). Create .github/workflows/deploy.yml (GitHub Actions: test → deploy via SSH). Provide nginx server block config.
```

---

## 4. Environment Setup Commands

### Laragon (Windows)

```bash
cd c:\laragon\www\chada_digital
bun install
bun run dev
```

### Linux Dev

```bash
sudo apt update && sudo apt install -y php8.2 php8.2-fpm php8.2-mysql php8.2-mbstring php8.2-xml php8.2-curl php8.2-bcmath php8.2-zip nginx mysql-server composer git unzip
curl -fsSL https://bun.sh/install | bash
git clone <repo-url> /var/www/chada_digital
cd /var/www/chada_digital
composer install && bun install
cp .env.example .env && php artisan key:generate
bun run dev
```

### Docker

```bash
docker-compose up -d
```

(Requires docker-compose.yml with php:8.2-fpm, nginx:alpine, mysql:8.0)

### EC2/Ubuntu Production

```bash
ssh -i ~/.ssh/chada-key.pem ubuntu@<elastic-ip>
sudo add-apt-repository ppa:ondrej/php -y && sudo apt update
sudo apt install -y php8.2 php8.2-fpm php8.2-mysql php8.2-cli php8.2-common php8.2-curl php8.2-mbstring php8.2-xml php8.2-zip php8.2-bcmath php8.2-gd php8.2-opcache nginx git composer unzip
curl -fsSL https://bun.sh/install | bash && source ~/.bashrc
sudo dd if=/dev/zero of=/swapfile bs=1M count=2048 && sudo chmod 600 /swapfile && sudo mkswap /swapfile && sudo swapon /swapfile
cd /var/www && sudo git clone <repo-url> chada_digital
cd /var/www/chada_digital
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist
bun install && bun run prod
cp .env.example .env && php artisan key:generate
# Edit .env: APP_ENV=production, APP_DEBUG=false, DB_*=RDS values
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
php artisan config:cache && php artisan route:cache && php artisan view:cache
sudo cp nginx.conf /etc/nginx/sites-available/chadadigital && sudo ln -s /etc/nginx/sites-available/chadadigital /etc/nginx/sites-enabled/
sudo nginx -t && sudo systemctl reload nginx
sudo certbot --nginx -d chadadigital.com -d www.chadadigital.com
```

---

## 5. Verification Checklist

| Phase | Check                    | Command                                                         |
| ----- | ------------------------ | --------------------------------------------------------------- |
| 1     | `bun run dev` compiles   | `bun run dev` → `public/css/app.css` + `public/js/app.js` exist |
| 1     | No Vite dependency       | `bun pm ls \| grep @tailwindcss/vite` → no output               |
| 2     | Master layout renders    | Visit `/` → header + footer visible                             |
| 2     | All 13 partials exist    | `ls resources/views/partials/`                                  |
| 3     | All routes return 200    | `php artisan route:list`                                        |
| 3     | Demo viewer works        | Visit `/demo/apexflow` → splash → iframe loads                  |
| 3     | Invalid demo returns 404 | Visit `/demo/nonexistent` → 404 page                            |
| 4     | Sitemap valid XML        | Visit `/sitemap.xml` → valid XML with all URLs                  |
| 4     | 301 redirect works       | Visit `/showcase.html` → redirects to `/showcase`               |
| 5     | Tests pass               | `php artisan test`                                              |
| 5     | deploy.sh executable     | `test -x deploy.sh` → exit 0                                    |
| 3.6   | Browser service health   | `curl http://localhost:3099/health` → `{"status":"ok"}`         |

---

> Full migration plan: [`MIGRATION_PLAN.md`](MIGRATION_PLAN.md:1)
> Reference static site: [`chada-digital-static/`](chada-digital-static/index.html:1)
