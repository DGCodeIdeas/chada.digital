#!/usr/bin/env bash
# =============================================================================
# Chada Digital — EC2 DStack Server Setup
# Run ONCE on the EC2 instance after DStack is installed and containers are up.
# =============================================================================

set -euo pipefail

DSTACK_DIR="${HOME}/devstack-manager"
DOMAIN="${DOMAIN:-chadadigital.com}"
PROJECT_DIR="${DSTACK_DIR}/projects/chadadigital.com"
PROJECT="${COMPOSE_PROJECT_NAME:-devstack}"
PHP_CONTAINER="${PROJECT}-php"

# ---------------------------------------------------------------------------
echo "==> [1/6] Verify DStack containers are running"
# ---------------------------------------------------------------------------
docker ps --format '{{.Names}}' | grep -q "${PROJECT}-nginx" \
    || { echo "ERROR: DStack containers not running. Start them first."; exit 1; }
echo "    ✅ Containers healthy"

# ---------------------------------------------------------------------------
echo "==> [2/6] Create vhost for ${DOMAIN}"
# ---------------------------------------------------------------------------
VHOST_RESP=$(curl -s -X POST http://localhost:5000/api/vhosts \
    -H "Content-Type: application/json" \
    -d "{\"domain\": \"${DOMAIN}\", \"framework\": \"laravel\"}")
if echo "${VHOST_RESP}" | grep -q '"success":true'; then
    echo "    ✅ Vhost created"
elif echo "${VHOST_RESP}" | grep -q 'already exists'; then
    echo "    ✅ Vhost already exists — skipping"
else
    echo "    ⚠️  Unexpected response: ${VHOST_RESP}"
fi

# ---------------------------------------------------------------------------
echo "==> [3/6] Create required Laravel directories and set permissions"
# ---------------------------------------------------------------------------
mkdir -p \
    "${PROJECT_DIR}/storage/logs" \
    "${PROJECT_DIR}/storage/framework/cache" \
    "${PROJECT_DIR}/storage/framework/sessions" \
    "${PROJECT_DIR}/storage/framework/views" \
    "${PROJECT_DIR}/bootstrap/cache"
chmod -R 777 \
    "${PROJECT_DIR}/storage" \
    "${PROJECT_DIR}/bootstrap/cache"
echo "    ✅ Directories ready"

# ---------------------------------------------------------------------------
echo "==> [4/6] Verify .env exists"
# ---------------------------------------------------------------------------
if [[ ! -f "${PROJECT_DIR}/.env" ]]; then
    echo "    ERROR: .env not found at ${PROJECT_DIR}/.env"
    echo "    Create it before deploying. Required keys:"
    echo "      APP_KEY, DB_HOST=mysql, DB_DATABASE, DB_USERNAME, DB_PASSWORD"
    exit 1
fi
echo "    ✅ .env found"

# ---------------------------------------------------------------------------
echo "==> [5/6] Install Laravel scheduler cron"
# ---------------------------------------------------------------------------
CRON_JOB="* * * * * docker exec ${PHP_CONTAINER} php /var/www/projects/${DOMAIN}/artisan schedule:run >> /dev/null 2>&1"
(crontab -l 2>/dev/null | grep -v 'artisan schedule:run' || true; echo "${CRON_JOB}") | crontab -
echo "    ✅ Scheduler cron installed"

# ---------------------------------------------------------------------------
echo "==> [6/6] Done"
# ---------------------------------------------------------------------------
echo ""
echo "============================================================"
echo "  Setup complete for ${DOMAIN}"
echo ""
echo "  Next steps:"
echo "  1. Push to main to trigger the first deploy:"
echo "       git push origin main"
echo ""
echo "  2. Enable HTTPS (after DNS is pointed at this server):"
echo "       curl -s -X POST http://localhost:5000/api/ssl/local \\"
echo "         -H 'Content-Type: application/json' \\"
echo "         -d '{\"domain\": \"${DOMAIN}\"}'  "
echo ""
echo "  3. DNS A record → $(curl -s ifconfig.me 2>/dev/null || echo 'YOUR_EC2_IP')"
echo "============================================================"
