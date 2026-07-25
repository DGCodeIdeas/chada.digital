# Chada Digital

Laravel 12 application migrated from a static site. Serves the Chada Digital portfolio with an iframe-based demo embedding system.

## Stack

- **Backend:** Laravel 12, PHP 8.2
- **Frontend:** Blade templates, Tailwind CSS v3, Alpine.js, jQuery modules
- **Asset pipeline:** Laravel Mix (webpack) via Bun — use `bun run dev` / `bun run prod`
- **Database:** SQLite (local dev) → MySQL 8.0 on RDS (production)
- **Server (prod):** nginx + PHP 8.2-FPM on EC2 t3.small

## Key directories

| Path | Purpose |
|---|---|
| `chada-digital-static/` | Original static site — READ ONLY reference |
| `public/demos/` | Demo project files — READ ONLY, never modify |
| `resources/views/` | All Blade templates (layouts, pages, partials, components) |
| `app/Services/PreviewService.php` | Demo metadata (slugs, titles, descriptions) |
| `docs/deployment-guide.md` | Full EC2 + RDS + Namecheap deployment guide |

## Running locally

```bash
bun install
bun run dev          # compile assets (watch mode: bun run watch)
php artisan serve    # start Laravel dev server
```

## Deployment

Push to `main` → GitHub Actions builds assets and deploys to EC2 via rsync.
See `docs/deployment-guide.md` for the full setup walkthrough.

## Important rules

- Use `mix()` helper in Blade, never `@vite()`
- Use `bun` for all package commands, never `npm`
- Never write to `chada-digital-static/` or `public/demos/`

## User preferences

- Keep the existing jQuery module structure — do not migrate to Alpine.js unless asked
- Route/controller naming uses `Preview` prefix (PreviewController, PreviewService, `/preview/{slug}`) — matches current working code, not the original plan's `Demo` naming
