# Chada Digital

> **Digital solutions that scale businesses.** Portfolio and showcase site for Chada Digital — a web design and development studio serving ambitious teams across Nigeria and beyond.

Live site: [chadadigital.com](https://chadadigital.com) &nbsp;|&nbsp; Built with Laravel 12

---

## Overview

This is the production Laravel 12 application behind the Chada Digital website. It was migrated from a hand-crafted static site (`chada-digital-static/`) into a full Blade-templated application with dynamic routing, SEO management, and an iframe-based demo embedding system.

**Pages:**
- **Home** (`/`) — hero, services, about, portfolio highlights, contact form
- **Showcase** (`/showcase`) — filterable grid of all client projects
- **Preview** (`/preview/{slug}`) — full-screen iframe viewer for each demo project
- **404** — custom error page
- **Sitemap** (`/sitemap.xml`) — dynamically generated XML sitemap

**Demo projects embedded via preview viewer:**

| Slug | Project | Category |
|---|---|---|
| `apexflow` | ApexFlow | SaaS / AI Automation |
| `elysian` | ELYSIAN | Booking / Hotel & Spa |
| `hirebase` | HIREBASE | Recruitment / Job Board |
| `noir` | NOIR | E-Commerce / Fashion |
| `sterling-vale` | Sterling & Vale | Construction / Corporate |

---

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 12, PHP 8.2 |
| Templating | Blade (layouts, partials, anonymous components) |
| CSS | **Bootstrap 5.3 + Material Web Components (@material/web) + Material Symbols + custom SCSS** — *V5 pivot, see `docs/Redesign(10).md`* |
| JavaScript | jQuery ES6 modules + Alpine.js (available) |
| Asset pipeline | Laravel Mix (webpack) — run via **Bun** |
| Database (dev) | SQLite |
| Database (prod) | MySQL 8.0 on AWS RDS |
| Server (prod) | nginx + PHP 8.2-FPM on AWS EC2 t3.small |
| CI/CD | GitHub Actions → rsync to EC2 |

### Design tokens

| Token | Value |
|---|---|
| Background | `#0e1b2e` (dark navy) |
| Primary | `#3b82f6` (blue-500) |
| Card | `#0b1526` |
| Muted | `#1e293b` / `#94a3b8` |
| Font — Display | Outfit |
| Font — Body | Inter |
| Font — Accent | Playfair Display |

---

## Project Structure

```
chada-digital/
├── app/
│   ├── Http/Controllers/
│   │   ├── PageController.php       # home(), showcase(), sitemap()
│   │   ├── PreviewController.php    # show(), subpage() — iframe viewer
│   │   └── ContactController.php   # contact form with honeypot
│   └── Services/
│       └── PreviewService.php       # demo metadata (slug, title, thumbnail)
│
├── resources/
│   ├── views/
│   │   ├── layouts/app.blade.php    # master layout
│   │   ├── pages/                   # home, showcase, preview
│   │   ├── partials/                # header, footer, hero, about, services,
│   │   │                            # portfolio, contact, meta, structured-data
│   │   └── components/              # x-button-primary, x-button-outline,
│   │                                # x-section-heading, x-section-badge, x-splash-logo
│   ├── js/
│   │   ├── app.js                   # entry point — initialises all modules
│   │   └── modules/
│   │       ├── toast.js             # toast notification system
│   │       ├── mobile-nav.js        # hamburger nav toggle
│   │       ├── contact-form.js      # AJAX contact form + validation
│   │       └── projects-modal.js    # "View All Projects" modal
│   └── sass/
│       ├── app.scss                 # layered: Bootstrap → M3 → tokens → utilities → components
│       ├── _tokens.scss             # M3 design tokens (Chada primary + M3 surfaces)
│       ├── _bootstrap-overrides.scss # Bootstrap Sass variable overrides
│       ├── _utilities.scss          # custom utilities (.eyebrow, .u-section-fused)
│       └── _components.scss         # Chada-specific component classes
│
├── routes/web.php                   # all application routes
├── public/
│   ├── assets/images/               # project thumbnails, hero, logos
│   ├── demos/                       # ⚠️ READ ONLY — standalone demo HTML sites
│   ├── css/app.css                  # compiled (git-ignored, built by Mix)
│   └── js/app.js                    # compiled (git-ignored, built by Mix)
│
├── chada-digital-static/            # ⚠️ READ ONLY — original static site reference
│
├── .github/workflows/deploy.yml     # GitHub Actions CI/CD pipeline
├── scripts/
│   ├── server-setup.sh              # one-time EC2 provisioning script
│   └── post-deploy.sh               # runs on EC2 after each deploy
│
├── docs/
│   ├── Redesign(1-9).md             # V4 redesign build documents (agent-ready series)
│   └── unverified/
│       └── deployment-guide.md      # full AWS + Namecheap deployment walkthrough
│
├── archive/                         # superseded V1/V2-era specs (read-only history)
│
├── REDESIGN_IMPLEMENTATION.md       # V4 redesign master spec (see Further Reading)
├── Implementation_redesign.md       # agent session orientation for the V4 build
├── TODO-Placeholders.md             # content gates to fill before launch
├── Open_Decision.md                 # open product/content decisions (Q0–Q9)
│
├── webpack.mix.js                   # asset pipeline config
└── docs/Redesign(10).md             # V5 visual migration spec (Tailwind → Bootstrap+M3)
```

---

## Local Development

### Prerequisites

- PHP 8.2+
- [Bun](https://bun.sh) (used instead of npm)
- Composer

### Setup

```bash
# 1. Install PHP dependencies
composer install

# 2. Install JS dependencies
bun install

# 3. Copy environment file and generate app key
cp .env.example .env
php artisan key:generate

# 4. Run database migrations (creates SQLite file automatically)
php artisan migrate

# 5. Compile assets
bun run dev          # one-time build
bun run watch        # watch mode — rebuilds on file changes
```

### Start the dev server

```bash
php artisan serve
# → http://127.0.0.1:8000
```

### Available asset commands

| Command | Description |
|---|---|
| `bun run dev` | Development build with source maps |
| `bun run watch` | Watch mode — rebuilds on file changes |
| `bun run prod` | Production build — minified, versioned, console stripped |

> **Note:** Always use `bun`, never `npm`. Always use `mix()` in Blade templates, never `@vite()`.

---

## Routes

| Method | URI | Name | Description |
|---|---|---|---|
| GET | `/` | `home` | Homepage |
| GET | `/showcase` | `showcase` | Project showcase grid |
| GET | `/showcase.html` | — | 301 redirect → `/showcase` |
| GET | `/preview/{slug}` | `preview.show` | Demo iframe viewer |
| GET | `/preview/{slug}/{subpage}` | `preview.subpage` | Demo sub-page viewer |
| POST | `/api/contact` | `contact.submit` | Contact form endpoint |
| GET | `/sitemap.xml` | `sitemap` | XML sitemap |

---

## Key Conventions

- **Never modify** `chada-digital-static/` or `public/demos/` — both are read-only
- Use `mix()` helper in Blade, never `@vite()`
- Use `bun` for all package commands, never `npm`
- Controller and route naming uses the `Preview` prefix (`PreviewController`, `/preview/{slug}`) — this is intentional and differs from the original migration plan which used `Demo`
- The JS layer uses jQuery ES6 modules (not Alpine.js) — this is working and intentional

---

## Deployment

Deployment targets **AWS EC2 t3.small + RDS db.t3.micro** (free tier, credit-based model).

### How it works

1. Push to `main`
2. GitHub Actions builds production assets (JS/CSS) on its own runners — EC2 never compiles assets
3. Files are rsynced to `/var/www/chada-digital/` on EC2
4. `scripts/post-deploy.sh` runs on EC2: migrations, cache rebuild, PHP-FPM reload

### Required GitHub secrets

| Secret | Value |
|---|---|
| `EC2_HOST` | Your EC2 Elastic IP |
| `SSH_PRIVATE_KEY` | Contents of your `.pem` key file |

### First-time server setup

```bash
# SSH into your EC2 instance, then:
DOMAIN=chadadigital.com sudo bash scripts/server-setup.sh
```

This installs and configures nginx, PHP 8.2-FPM (ondemand mode), OPcache, Certbot, and a 2 GB swap file — all tuned to minimise CPU credit consumption.

For the complete step-by-step guide including RDS provisioning, Namecheap DNS setup, and SSL configuration, see **[docs/unverified/deployment-guide.md](docs/unverified/deployment-guide.md)**.

---

## Contact Form

The contact form posts to `POST /api/contact`. It includes:

- Server-side validation (name, email, message)
- Honeypot field (`bot-field`) for spam filtering
- JSON response (`{ message: "..." }`)

> **Note:** Email delivery (`Mail::to()->send()`) is intentionally deferred. The endpoint currently returns a success response without sending an email. See `app/Mail/ContactFormSubmission.php` and `archive/MIGRATION_PLAN_ARCHIVED.md` Phase 5 for implementation notes.

---

## SEO

- Dynamic `<title>`, `<meta description>`, Open Graph, and Twitter Card tags via `resources/views/partials/meta.blade.php`
- JSON-LD structured data (Organization + WebSite schema) via `resources/views/partials/structured-data.blade.php`
- Dynamic XML sitemap at `/sitemap.xml` (auto-includes all preview slugs from `PreviewService`)
- 301 redirect from `/showcase.html` → `/showcase`
- Lazy-loaded images throughout

---

## Further Reading

**Active — V4 redesign (pattern replication, original expression):**

| Document | Description |
|---|---|
| [`REDESIGN_IMPLEMENTATION.md`](REDESIGN_IMPLEMENTATION.md) | V4 redesign master spec (v3, Clarified) — decision history, 18-pattern architecture, acceptance criteria, sign-off tables |
| [`Implementation_redesign.md`](Implementation_redesign.md) | Agent session orientation for the V4 build — constraints, content model, phase map, Phase 1 task block |
| [`docs/Redesign(1).md`](docs/Redesign(1).md) … [`docs/Redesign(9).md`](docs/Redesign(9).md) | The nine V4 agent-ready build documents (data layer → homepage sections → signature systems → QA/launch gates) |
| [`docs/Redesign(10).md`](docs/Redesign(10).md) | **V5 visual pivot** — Phase 10 migration spec: Tailwind → Bootstrap 5.3 + Material Web Components + Material Symbols, no-borders fusion, Design Partner band |
| [`TODO-Placeholders.md`](TODO-Placeholders.md) | Content gates that must be filled by the Founder/Tech Lead before launch |
| [`Open_Decision.md`](Open_Decision.md) | Open product/content decisions (Q0–Q9) with their current statuses |
| [`docs/unverified/deployment-guide.md`](docs/unverified/deployment-guide.md) | AWS EC2 + RDS + Namecheap deployment walkthrough |

**Archived (V1-era, superseded):**

| Document | Description |
|---|---|
| [`archive/MIGRATION_PLAN_ARCHIVED.md`](archive/MIGRATION_PLAN_ARCHIVED.md) | Full technical migration plan (Phases 1–5) |
| [`archive/IMPLEMENTATION_PROMPT_ARCHIVED.md`](archive/IMPLEMENTATION_PROMPT_ARCHIVED.md) | Phase-by-phase AI agent implementation prompts |
| [`archive/Redesign_ARCHIVED.md`](archive/Redesign_ARCHIVED.md) | V2 redesign spec (WAB Digital replicate) |
| [`archive/Redesign_V1_LIGHT_THEME_ARCHIVED.md`](archive/Redesign_V1_LIGHT_THEME_ARCHIVED.md) | V1 redesign spec (light theme + case studies) |
