#!/usr/bin/env bash
# Chada Digital — Enable gzip on nginx (one-time setup)
#
# Run via SSH on the EC2 box:
#   ssh ubuntu@<EC2_HOST>
#   cd /opt/dstack-panel/projects/chada.digital
#   sudo bash scripts/enable-gzip-on-nginx.sh
#
# What this does:
#   1. Copies scripts/nginx-gzip.conf to /etc/nginx/conf.d/chada-gzip.conf
#   2. Pre-gzips CSS/JS files in public/css/ and public/js/ for gzip_static
#   3. Tests nginx config + reloads
#
# Idempotent — safe to run multiple times.

set -euo pipefail

APP_DIR="/opt/dstack-panel/projects/chada.digital"
SNIPPET_SRC="${APP_DIR}/scripts/nginx-gzip.conf"
SNIPPET_DEST="/etc/nginx/conf.d/chada-gzip.conf"

echo "→ 1/3 Installing nginx gzip config snippet"
cp "${SNIPPET_SRC}" "${SNIPPET_DEST}"
echo "  ✓ Snippet installed at ${SNIPPET_DEST}"

echo
echo "→ 2/3 Pre-gzipping CSS/JS files"
COUNT=0
for dir in "${APP_DIR}/public/css" "${APP_DIR}/public/js"; do
    if [ -d "${dir}" ]; then
        for f in "${dir}"/*.css "${dir}"/*.js; do
            [ -f "${f}" ] || continue
            gzip -k -9 -f "${f}"
            COUNT=$((COUNT + 1))
            echo "  ✓ gzipped $(basename "${f}")"
        done
    fi
done
echo "  ✓ ${COUNT} files pre-gzipped"

echo
echo "→ 3/3 Testing nginx config + reloading"
if nginx -t; then
    systemctl reload nginx
    echo "  ✓ nginx reloaded"
else
    echo "✗ ERROR: nginx config test failed"
    exit 1
fi

echo
echo "✅ gzip enabled on nginx"
echo "Expected impact: app.css 325KB→~45KB, app.js 164KB→~50KB"
