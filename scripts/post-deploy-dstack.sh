#!/usr/bin/env bash
# Chada Digital — Post-Deploy (host PHP-FPM variant)
# Runs on EC2 after rsync, invoked via `sudo bash`. App served by HOST PHP-FPM 8.5.
set -euo pipefail

APP_DIR="/opt/dstack-panel/projects/chada.digital"
cd "${APP_DIR}"

echo "→ Normalizing ownership after rsync (files land root-owned via sudo rsync)"
chown -R www-data:www-data "${APP_DIR}"

echo "→ Ensuring storage directories exist"
sudo -u www-data mkdir -p storage/logs \
         storage/framework/cache \
         storage/framework/sessions \
         storage/framework/views \
         bootstrap/cache

echo "→ Artisan tasks (host, as www-data)"

# Deliberate, LONG-TERM maintenance lock — separate from Laravel's own
# storage/framework/down file, which this script also uses internally below
# for the brief down/migrate/up bracket on every deploy. Reusing that same
# file for "stay down across a push" used to cause a one-way lock: once it
# existed for ANY reason, every future deploy would see it and skip `up`
# forever, since nothing ever cleared it. This lock file is separate and only
# ever touched deliberately (see scripts/maintenance-lock.sh), so the normal
# down->migrate->up bracket below always completes normally unless someone
# has explicitly locked the site down.
MAINTENANCE_LOCK="storage/app/maintenance-lock"

sudo -u www-data php artisan down --retry=15 --refresh=15 || true
sudo -u www-data php artisan migrate --force
sudo -u www-data php artisan storage:link --force || true
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache
sudo -u www-data php artisan event:cache

if [ -f "$MAINTENANCE_LOCK" ]; then
  echo "→ ${MAINTENANCE_LOCK} present — leaving site in maintenance mode deliberately."
  echo "→ Run scripts/maintenance-lock.sh off (then this script will bring it up next deploy,"
  echo "  or run 'php artisan up' directly for an immediate change)."
else
  sudo -u www-data php artisan up
fi

echo "→ Fixing ownership (PHP-FPM reads as www-data)"
chown -R www-data:www-data \
     "${APP_DIR}/storage" \
     "${APP_DIR}/bootstrap/cache" \
     "${APP_DIR}/public"

echo "→ Reloading host nginx"
nginx -t && systemctl reload nginx

echo "✅ chada.digital deploy complete"
