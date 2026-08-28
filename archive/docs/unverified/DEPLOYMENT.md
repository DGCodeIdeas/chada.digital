# Chada Digital — Deployment Guide

This document describes how the `chada.digital` Laravel 12 application is deployed
to an EC2 instance running [DStack](https://github.com/DGCodeIdeas/DStack),
a Docker-based PHP development stack manager.

---

## Architecture

```
git push origin main
  → GitHub Actions (deploy.yml)
      → bun install + bun run build        (Vite/React assets)
      → composer install --no-dev
      → rsync → EC2 ~/devstack-manager/projects/chadadigital.com/
      → SSH: scripts/post-deploy-dstack.sh
            → docker exec devstack-php
                artisan migrate --force
                artisan storage:link --force
                artisan config:cache / route:cache / view:cache / event:cache
                artisan up
            → docker exec devstack-nginx  nginx -s reload
  → Live at chadadigital.com
```

---

## Required GitHub Secrets

Add these at **GitHub → Settings → Secrets and variables → Actions → New repository secret**:

| Secret | Description |
|--------|-------------|
| `EC2_HOST` | EC2 public IP address or DNS hostname |
| `SSH_PRIVATE_KEY` | Full contents of the `.pem` private key file (including `-----BEGIN` / `-----END` lines) |

---

## One-Time EC2 Setup

Perform these steps once after DStack is installed and all containers are healthy:

1. **Place the Laravel `.env` on the server** — it is never committed to git:
   ```bash
   # From your LOCAL machine:
   scp .env ubuntu@YOUR_EC2_IP:~/devstack-manager/projects/chadadigital.com/.env
   ```

2. **Run the server-setup script** (creates the vhost, directories, and cron):
   ```bash
   bash scripts/server-setup-dstack.sh
   ```

3. **Trigger the first deploy** by pushing to `main`:
   ```bash
   git push origin main
   ```

---

## Minimum `.env` Values

The `.env` file lives **only on the server** — it is never synced by CI.

```ini
APP_NAME="Chada Digital"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://chadadigital.com

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=chadadigital
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
REDIS_HOST=redis
REDIS_PORT=6379

APP_KEY=base64:...   # php artisan key:generate --show
```

> **Important:** `DB_HOST=mysql` and `REDIS_HOST=redis` are Docker Compose service names.
> Do **not** use `localhost` or `127.0.0.1` — they resolve to the container itself.

---

## What `deploy.yml` Does

1. Checkout repository code on the GitHub Actions runner
2. Install Node dependencies with `bun install`
3. Build frontend assets with `bun run build`
4. Install PHP dependencies with `composer install --no-dev --optimize-autoloader`
5. `rsync` all files to `EC2:~/devstack-manager/projects/chadadigital.com/`
   (excludes `.env`, `storage/`, and `bootstrap/cache/` to preserve server-side state)
6. SSH into EC2 and run `scripts/post-deploy-dstack.sh`
7. `post-deploy-dstack.sh` runs artisan tasks inside the PHP container and reloads nginx

---

## Rollback

If a deploy introduces a regression:

1. Go to **GitHub → Actions → deploy workflow**
2. Find the last known-good run
3. Click **Re-run jobs → Re-run all jobs**

This re-deploys the exact artifact from that commit, including running `artisan migrate --force` for that revision.

> ⚠️ Database rollbacks (`artisan migrate:rollback`) must be run manually via SSH
> if a migration introduced a breaking schema change.

---

## Notes

- `.env` is **never** committed to git or synced by CI — it lives only on the server.
- The Laravel scheduler cron (`* * * * * docker exec devstack-php ... artisan schedule:run`) is installed by `server-setup-dstack.sh` and survives container restarts.
- `COMPOSE_PROJECT_NAME` defaults to `devstack`. If your DStack instance uses a different value, `export COMPOSE_PROJECT_NAME=yourvalue` before running any deploy scripts.
