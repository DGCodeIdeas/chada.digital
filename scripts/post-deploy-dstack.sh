#!/usr/bin/env bash
# =============================================================================
# Chada Digital — Post-Deploy Tasks (DStack / Docker variant)
#
# Called by GitHub Actions after files are synced to the DStack projects dir.
# Runs artisan commands inside the devstack-php container and reloads nginx
# via docker exec instead of systemctl.
#
# Prerequisites on EC2:
#   - DStack running: ~/devstack-manager/docker-compose up -d
#   - Virtual host created for chadadigital.com (framework: laravel)
#   - .env file present at ~/devstack-manager/projects/chadadigital.com/.env
# =============================================================================

set -euo pipefail

CONTAINER="devstack-php"
APP_PATH="/var/www/projects/chadadigital.com"
HOST_APP_DIR="${HOME}/devstack-manager/projects/chadadigital.com"

echo "→ Setting storage permissions"
chown -R ubuntu:www-data \
    "${HOST_APP_DIR}/storage" \
    "${HOST_APP_DIR}/bootstrap/cache"
chmod -R 775 \
    "${HOST_APP_DIR}/storage" \
    "${HOST_APP_DIR}/bootstrap/cache"

echo "→ Running artisan tasks inside PHP container"
docker exec "${CONTAINER}" sh -c "
    set -e
    cd ${APP_PATH}

    echo '  · Maintenance mode on'
    php artisan down --retry=15 --refresh=15 || true

    echo '  · Running database migrations'
    php artisan migrate --force

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

echo "→ Reloading nginx config"
docker exec devstack-nginx nginx -s reload

echo "✓ DStack deploy complete"
