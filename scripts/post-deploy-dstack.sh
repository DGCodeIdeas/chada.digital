#!/usr/bin/env bash
# =============================================================================
# Chada Digital — Post-Deploy Tasks (DStack / Docker variant)
#
# Called by GitHub Actions after files are rsync'd to the DStack projects dir.
# Runs artisan commands inside the PHP container via docker exec.
#
# Prerequisites (one-time, run server-setup-dstack.sh):
#   1. DStack running at ~/devstack-manager
#   2. Vhost created for chadadigital.com (framework: laravel)
#   3. .env at ~/devstack-manager/projects/chadadigital.com/.env
# =============================================================================

set -euo pipefail

# Fix #2: derive container names from COMPOSE_PROJECT_NAME (default: devstack)
PROJECT="${COMPOSE_PROJECT_NAME:-devstack}"
PHP_CONTAINER="${PROJECT}-php"
NGINX_CONTAINER="${PROJECT}-nginx"

APP_PATH="/var/www/projects/chadadigital.com"
HOST_APP_DIR="${HOME}/devstack-manager/projects/chadadigital.com"

# Fix #3: ensure required directories exist — rsync excludes storage/ and bootstrap/cache/
# to preserve runtime state, but they won't exist on a fresh EC2 deploy
echo "→ Ensuring storage directories exist"
mkdir -p \
    "${HOST_APP_DIR}/storage/logs" \
    "${HOST_APP_DIR}/storage/framework/cache" \
    "${HOST_APP_DIR}/storage/framework/sessions" \
    "${HOST_APP_DIR}/storage/framework/views" \
    "${HOST_APP_DIR}/bootstrap/cache"

# Fix #1: chmod only — chown requires root and fails in the GitHub Actions SSH context
echo "→ Setting storage permissions"
chmod -R 777 \
    "${HOST_APP_DIR}/storage" \
    "${HOST_APP_DIR}/bootstrap/cache"

echo "→ Running artisan tasks inside ${PHP_CONTAINER}"
docker exec "${PHP_CONTAINER}" sh -c "
    set -e
    cd ${APP_PATH}

    echo '  · Maintenance mode on'
    php artisan down --retry=15 --refresh=15 || true

    echo '  · Migrations'
    php artisan migrate --force

    echo '  · Storage symlink (Fix #4 — idempotent)'
    php artisan storage:link --force || true

    echo '  · Clearing stale caches'
    php artisan cache:clear
    php artisan view:clear

    echo '  · Warming caches'
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache

    echo '  · Maintenance mode off'
    php artisan up
"

echo "→ Reloading nginx"
docker exec "${NGINX_CONTAINER}" nginx -s reload

echo "✅ DStack deploy complete"
