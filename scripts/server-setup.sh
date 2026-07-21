#!/usr/bin/env bash
# =============================================================================
# Chada Digital — EC2 t3.small Initial Server Setup
# Ubuntu 22.04 LTS
#
# Run ONCE after launching the EC2 instance:
#   chmod +x scripts/server-setup.sh && sudo bash scripts/server-setup.sh
#
# Credit-efficiency goals:
#   - PHP-FPM ondemand: workers only exist when needed (no idle CPU burn)
#   - OPcache: compiled PHP cached in memory → fewer CPU cycles per request
#   - nginx: static assets served directly, never touching PHP
#   - 2 GB swap: prevents OOM on t3.small (2 GB RAM) without extra cost
# =============================================================================

set -euo pipefail

APP_DIR="/var/www/chada-digital"
DOMAIN="${DOMAIN:-yourdomain.com}"       # override: DOMAIN=chadadigital.com sudo bash ...
PHP_VERSION="8.2"

echo "==> [1/9] System update"
apt-get update -qq
apt-get upgrade -y -qq

echo "==> [2/9] Install packages"
apt-get install -y -qq \
  nginx \
  php${PHP_VERSION}-fpm \
  php${PHP_VERSION}-cli \
  php${PHP_VERSION}-mysql \
  php${PHP_VERSION}-xml \
  php${PHP_VERSION}-mbstring \
  php${PHP_VERSION}-curl \
  php${PHP_VERSION}-bcmath \
  php${PHP_VERSION}-zip \
  php${PHP_VERSION}-intl \
  php${PHP_VERSION}-opcache \
  mysql-client \
  certbot \
  python3-certbot-nginx \
  unzip \
  git

echo "==> [3/9] Create 2 GB swap file (prevents OOM without extra cost)"
if [ ! -f /swapfile ]; then
  fallocate -l 2G /swapfile
  chmod 600 /swapfile
  mkswap /swapfile
  swapon /swapfile
  echo '/swapfile none swap sw 0 0' >> /etc/fstab
  # Reduce swappiness — only swap when truly necessary
  echo 'vm.swappiness=10' >> /etc/sysctl.conf
  sysctl -p
fi

echo "==> [4/9] PHP-FPM — ondemand pool (no idle workers burning credits)"
cat > /etc/php/${PHP_VERSION}/fpm/pool.d/chada.conf <<'PHPFPM'
[chada]
user = www-data
group = www-data
listen = /run/php/php8.2-fpm-chada.sock
listen.owner = www-data
listen.group = www-data
listen.mode = 0660

; ondemand: workers spawn on request, die when idle.
; Saves CPU credits vs dynamic/static which keep workers alive.
pm = ondemand
pm.max_children = 5          ; 5 × ~300 MB = 1.5 GB max — safe on 2 GB RAM
pm.process_idle_timeout = 10s
pm.max_requests = 500        ; recycle workers to prevent memory creep

; Logging — errors only, no access log spam
php_flag[display_errors] = off
php_admin_value[error_log] = /var/log/php${PHP_VERSION}-fpm-chada.log
php_admin_flag[log_errors] = on

; Env vars forwarded to PHP
env[APP_ENV] = production
PHPFPM

# Remove the default www pool — we don't need it
rm -f /etc/php/${PHP_VERSION}/fpm/pool.d/www.conf

echo "==> [5/9] OPcache — compile once, serve from memory"
cat > /etc/php/${PHP_VERSION}/mods-available/opcache.ini <<'OPCACHE'
zend_extension=opcache.so
opcache.enable=1
opcache.enable_cli=0
opcache.memory_consumption=64          ; 64 MB — sufficient for Laravel 12
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=4000
opcache.validate_timestamps=0          ; PROD: never re-stat files (saves CPU)
opcache.revalidate_freq=0
opcache.save_comments=1
opcache.fast_shutdown=1
OPCACHE

echo "==> [6/9] nginx — static assets bypass PHP entirely"
cat > /etc/nginx/sites-available/chada-digital <<NGINX
server {
    listen 80;
    server_name ${DOMAIN} www.${DOMAIN};
    root ${APP_DIR}/public;
    index index.php;

    # ── Gzip (reduces bandwidth & response time) ──────────────────
    gzip on;
    gzip_vary on;
    gzip_types text/plain text/css application/javascript application/json
               image/svg+xml font/woff2;
    gzip_min_length 1024;

    # ── Static assets: served directly, 1-year cache ──────────────
    # Never hits PHP. Saves CPU credits on every asset request.
    location ~* \.(css|js|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot|webp|map)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
        access_log off;        # skip logging for static files
        try_files \$uri =404;
    }

    # ── demo files — static only, no PHP execution ────────────────
    location ^~ /demos/ {
        expires 7d;
        add_header Cache-Control "public";
        add_header X-Content-Type-Options "nosniff";
        access_log off;
        try_files \$uri =404;
    }

    # ── Laravel app ───────────────────────────────────────────────
    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \.php$ {
        try_files \$uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/run/php/php8.2-fpm-chada.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;

        # Keep connections alive to FPM (reduces handshake overhead)
        fastcgi_keep_conn on;
        fastcgi_read_timeout 60;
    }

    # ── Security headers ──────────────────────────────────────────
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    add_header Referrer-Policy "strict-origin-when-cross-origin";

    # ── Block dot-files ───────────────────────────────────────────
    location ~ /\. {
        deny all;
    }

    # ── Block access to sensitive files ───────────────────────────
    location ~* \.(env|log|lock|json|md|yml|yaml|sh|sql)$ {
        deny all;
    }
}
NGINX

ln -sf /etc/nginx/sites-available/chada-digital /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default
nginx -t

echo "==> [7/9] App directory & permissions"
mkdir -p ${APP_DIR}
chown -R ubuntu:www-data ${APP_DIR}
chmod 750 ${APP_DIR}

echo "==> [8/9] Start & enable services"
systemctl enable nginx php${PHP_VERSION}-fpm
systemctl restart nginx php${PHP_VERSION}-fpm

echo "==> [9/9] Laravel scheduler cron (single entry — no queue worker needed)"
# Uses sync queue driver so no separate worker process consuming CPU.
(crontab -l -u ubuntu 2>/dev/null || true; echo "* * * * * cd ${APP_DIR} && php artisan schedule:run >> /dev/null 2>&1") \
  | crontab -u ubuntu -

echo ""
echo "======================================================"
echo "  Server setup complete."
echo ""
echo "  Next steps:"
echo "  1. Point your Namecheap domain A record → $(curl -s ifconfig.me)"
echo "  2. Deploy the app (push to main branch)"
echo "  3. Run: sudo certbot --nginx -d ${DOMAIN} -d www.${DOMAIN}"
echo "======================================================"
