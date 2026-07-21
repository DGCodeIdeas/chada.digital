#!/usr/bin/env bash
# =============================================================================
# Chada Digital — Post-Deploy Tasks (runs on EC2 after each rsync)
#
# Called by GitHub Actions after files are synced.
# These are all fast in-memory operations — minimal CPU credit usage.
# =============================================================================

set -euo pipefail

APP_DIR="/var/www/chada-digital"
PHP="php8.2"

cd ${APP_DIR}

echo "→ Setting storage permissions"
chown -R ubuntu:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

echo "→ Putting app in maintenance mode"
${PHP} artisan down --retry=15 --refresh=15 || true

echo "→ Running database migrations"
${PHP} artisan migrate --force

echo "→ Clearing stale caches"
${PHP} artisan cache:clear
${PHP} artisan view:clear

echo "→ Warming all caches (fast — writes to disk/memory, no compilation needed)"
# OPcache already handles PHP compilation.
# These just write serialised arrays — very cheap.
${PHP} artisan config:cache    # merges all config files into one file
${PHP} artisan route:cache     # serialises route list
${PHP} artisan view:cache      # pre-compiles all Blade templates
${PHP} artisan event:cache

echo "→ Reloading PHP-FPM (graceful — no dropped requests)"
sudo systemctl reload php8.2-fpm

echo "→ Bringing app back online"
${PHP} artisan up

echo "✓ Deploy complete"
