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

# Maintenance bypass secret — allows the team to preview the site while
# visitors see the maintenance page. The bypass URL is the SHA-256 hash
# of this phrase, served at /{hash}. Visiting that URL sets a cookie that
# bypasses the 503 maintenance page for 12 hours.
#
# Current bypass URL: https://chadadigital.com/pass-entropy-white-done-carp
# (Laravel computes the hash automatically from the --secret value.)
MAINTENANCE_SECRET="pass-entropy-white-done-carp"

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

# Run artisan down with the bypass secret. The --secret flag creates a
# bypass route at /{sha256(secret)} that sets a cookie exempting the
# visitor from maintenance mode. This persists across deploys because
# the secret is hardcoded here — every deploy re-runs `artisan down`
# with the same secret, so the bypass URL stays stable.
sudo -u www-data php artisan down --retry=15 --refresh=15 --secret="${MAINTENANCE_SECRET}" || true
sudo -u www-data php artisan migrate --force
sudo -u www-data php artisan storage:link --force || true
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache
sudo -u www-data php artisan event:cache

if [ -f "$MAINTENANCE_LOCK" ]; then
  echo "→ ${MAINTENANCE_LOCK} present — leaving site in maintenance mode deliberately."
  echo "→ Bypass URL: https://chadadigital.com/${MAINTENANCE_SECRET}"
  echo "→ (Laravel serves this at /{sha256(secret)} and sets a 12-hour bypass cookie.)"
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
