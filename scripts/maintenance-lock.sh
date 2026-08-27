#!/usr/bin/env bash
# scripts/maintenance-lock.sh — deliberately hold the site down across deploys,
# or release that hold. This is separate from Laravel's own `php artisan down`,
# which the deploy script also uses internally for its brief down/migrate/up
# bracket on every push. Use THIS script when you want the site to stay down
# through one or more future deploys until you say otherwise.
#
# Usage (run on the EC2 host, from the app directory):
#   scripts/maintenance-lock.sh on    # locks it down now, and keeps it down
#                                      # through future deploys until "off"
#   scripts/maintenance-lock.sh off   # releases the lock and brings it up now
#
set -euo pipefail

APP_DIR="/opt/dstack-panel/projects/chada.digital"
cd "${APP_DIR}"

LOCK_FILE="storage/app/maintenance-lock"

case "${1:-}" in
  on)
    sudo -u www-data touch "$LOCK_FILE"
    sudo -u www-data php artisan down --retry=15 --refresh=15 || true
    echo "→ Maintenance lock ON. Site is down and will stay down across future"
    echo "  deploys until you run: scripts/maintenance-lock.sh off"
    ;;
  off)
    sudo -u www-data rm -f "$LOCK_FILE"
    sudo -u www-data php artisan up
    echo "→ Maintenance lock OFF. Site is back up; future deploys will bring it"
    echo "  up automatically again as normal."
    ;;
  *)
    echo "Usage: scripts/maintenance-lock.sh on|off"
    exit 1
    ;;
esac
