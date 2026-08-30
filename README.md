# Chada Digital

> **Stack:** Laravel 12 + Blade + Bootstrap 5 + Material Design 3 + Laravel Mix + jQuery  
> **Asset Pipeline:** Bun → Laravel Mix (webpack) → `mix()` in Blade  
> **CSS:** Bootstrap 5 → MD3 tokens → MD3/Bootstrap bridge → Custom SCSS  
> **JS:** Bootstrap JS + Material Web Components + jQuery modules  
> **Build:** `bun run dev` / `bun run prod`  
> **Deploy:** GitHub Actions → rsync → EC2 (nginx + PHP-FPM)

## Key Conventions

- **Never modify `public/demos/`** — six independent demo sites, read-only
- Use `mix()` in Blade, never `@vite()` — Mix is the configured pipeline
- Use `bun`, never `npm`, for any package command
- Preserve existing route names and URL structure
- Keep the contact form's honeypot spam field

## Migration

See `MIGRATION.md` for the complete Tailwind → Bootstrap + MD3 migration spec.

## Related Docs

| Document | Purpose |
|----------|---------|
| `MIGRATION.md` | **Active spec** — Bootstrap + MD3 migration |
| `Open_Decision.md` | Decision log |
| `TODO-Placeholders.md` | Content checklist |
| `docs/Redesign(1).md` through `docs/Redesign(9).md` | Iteration history |

---
*Tailwind CSS has been removed per founder directive. See `MIGRATION.md` §1 for rationale.*
