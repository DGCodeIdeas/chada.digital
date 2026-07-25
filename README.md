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
| CSS | Tailwind CSS v3 + custom SCSS via PostCSS |
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
│       └── app.scss                 # Tailwind directives + custom utility classes
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
│   └── deployment-guide.md          # full AWS + Namecheap deployment walkthrough
│
├── webpack.mix.js                   # asset pipeline config
└── tailwind.config.js               # design tokens + Tailwind theme
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

For the complete step-by-step guide including RDS provisioning, Namecheap DNS setup, and SSL configuration, see **[docs/deployment-guide.md](docs/deployment-guide.md)**.

---

## Contact Form

The contact form posts to `POST /api/contact`. It includes:

- Server-side validation (name, email, message)
- Honeypot field (`bot-field`) for spam filtering
- JSON response (`{ message: "..." }`)

> **Note:** Email delivery (`Mail::to()->send()`) is intentionally deferred. The endpoint currently returns a success response without sending an email. See `app/Mail/ContactFormSubmission.php` and `MIGRATION_PLAN.md` Phase 5 for implementation notes.

---

## SEO

- Dynamic `<title>`, `<meta description>`, Open Graph, and Twitter Card tags via `resources/views/partials/meta.blade.php`
- JSON-LD structured data (Organization + WebSite schema) via `resources/views/partials/structured-data.blade.php`
- Dynamic XML sitemap at `/sitemap.xml` (auto-includes all preview slugs from `PreviewService`)
- 301 redirect from `/showcase.html` → `/showcase`
- Lazy-loaded images throughout

---

## Further Reading

| Document | Description |
|---|---|
| [`MIGRATION_PLAN.md`](MIGRATION_PLAN.md) | Full technical migration plan (Phases 1–5) |
| [`IMPLEMENTATION_PROMPT.md`](IMPLEMENTATION_PROMPT.md) | Phase-by-phase AI agent implementation prompts |
| [`docs/deployment-guide.md`](docs/deployment-guide.md) | AWS EC2 + RDS + Namecheap deployment walkthrough |
