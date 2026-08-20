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

# Was the site already in manually-set maintenance mode BEFORE this deploy?
# (e.g. David ran `php artisan down` deliberately before pushing.) If so, this
# deploy should leave it down afterward instead of forcing it back up — the
# rsync step now excludes storage/framework/down, so this file reliably
# reflects the pre-deploy state at this point in the script.
WAS_DOWN=false
if [ -f storage/framework/down ]; then
  WAS_DOWN=true
  echo "→ Site was already in maintenance mode before this deploy — will stay down after."
fi

sudo -u www-data php artisan down --retry=15 --refresh=15 || true
sudo -u www-data php artisan migrate --force
sudo -u www-data php artisan storage:link --force || true
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache
sudo -u www-data php artisan event:cache

if [ "$WAS_DOWN" = false ]; then
  sudo -u www-data php artisan up
else
  echo "→ Leaving site in maintenance mode (was down pre-deploy). Run 'php artisan up' manually when ready."
fi

echo "→ Fixing ownership (PHP-FPM reads as www-data)"
chown -R www-data:www-data \
     "${APP_DIR}/storage" \
     "${APP_DIR}/bootstrap/cache" \
     "${APP_DIR}/public"

echo "→ Reloading host nginx"
nginx -t && systemctl reload nginx

echo "✅ chada.digital deploy complete"
