#!/usr/bin/env bash
# Chada Digital — Post-Deploy (host PHP-FPM variant)
# Runs on EC2 after rsync. No Docker — app is served by HOST PHP-FPM 8.5.
set -euo pipefail

APP_DIR="/opt/dstack-panel/projects/chada.digital"
cd "${APP_DIR}"

echo "→ Ensuring storage directories exist"
mkdir -p storage/logs \
         storage/framework/cache \
         storage/framework/sessions \
         storage/framework/views \
         bootstrap/cache

echo "→ Artisan tasks (host, as www-data)"
sudo -u www-data php artisan down --retry=15 --refresh=15 || true
sudo -u www-data php artisan migrate --force
sudo -u www-data php artisan storage:link --force || true
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache
sudo -u www-data php artisan event:cache
sudo -u www-data php artisan up

echo "→ Fixing ownership (PHP-FPM reads as www-data)"
sudo chown -R www-data:www-data \
     "${APP_DIR}/storage" \
     "${APP_DIR}/bootstrap/cache" \
     "${APP_DIR}/public"

echo "→ Reloading host nginx"
sudo nginx -t && sudo systemctl reload nginx

echo "✅ chada.digital deploy complete"
