# DStack Migration — Pull Request Guide

## Overview

Two PRs are needed to migrate `chada.digital` from bare-metal PHP to DStack (Docker Compose). **Merge PR 1 first** (DStack image patch), then **PR 2** (deployment wiring). The existing bare-metal setup is left untouched — rollback is a one-liner revert.

---

## Required GitHub Secrets

| Secret | Used for | Status |
|--------|----------|--------|
| `EC2_HOST` | EC2 IP / hostname for rsync + SSH | ✅ Already configured |
| `SSH_PRIVATE_KEY` | SSH auth for both rsync and post-deploy | ✅ Already configured |

> **No new secrets are needed.** Both PRs reuse the existing secret pair.

---

# PR 1 — DGCodeIdeas/DStack

| Field | Value |
|-------|-------|
| **Repo** | `DGCodeIdeas/DStack` |
| **Branch** | `fix/php-laravel-extensions` |
| **Target** | `master` |
| **PR title** | `fix(php): add xml, mbstring, curl extensions for Laravel compatibility` |

**Why:** `chada.digital` (Laravel 12) requires the `xml`, `mbstring`, and `curl` PHP extensions. These are not currently installed in DStack's PHP image. The Alpine base image also needs `libxml2-dev` and `curl-dev` as build-time system dependencies.

---

## File: `docker/Dockerfile.php`

### What changes

| Block | Before | After |
|-------|--------|-------|
| `apk add` | ends with `oniguruma-dev`, `$PHPIZE_DEPS` | adds `libxml2-dev` and `curl-dev` before `$PHPIZE_DEPS` |
| `docker-php-ext-install` | ends with `opcache` | adds `xml`, `mbstring`, `curl` after `opcache` |

### Diff

```diff
 # DevStack PHP-FPM service
 FROM php:${PHP_VERSION:-8.2}-fpm-alpine
 
 # Install system build dependencies and runtime libraries required by PHP extensions
 RUN apk add --no-cache \
         bash \
         git \
         unzip \
         curl \
+        libxml2-dev \
+        curl-dev \
         libzip-dev \
         zlib-dev \
         libpng-dev \
         libjpeg-turbo-dev \
         freetype-dev \
         imagemagick-dev \
         icu-dev \
         oniguruma-dev \
         $PHPIZE_DEPS
 
 # Configure and install PHP extensions
 RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
     && docker-php-ext-install -j"$(nproc)" \
         pdo \
         pdo_mysql \
         mysqli \
         gd \
         zip \
         intl \
         bcmath \
-        opcache
+        opcache \
+        xml \
+        mbstring \
+        curl
 
 # Install PECL extensions (redis, imagick) and enable them
 RUN pecl install redis imagick \
     && docker-php-ext-enable redis imagick
 
 # Install Composer (latest)
 COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
 
 # Working directory for application code
 WORKDIR /var/www
 
 # Apply custom PHP configuration
 COPY docker/php.ini /usr/local/etc/php/conf.d/devstack.ini
 
 # Run as the default www-data user
 USER www-data
 
 CMD ["php-fpm"]
```

### Full updated file (copy-paste ready)

```dockerfile
# DevStack PHP-FPM service
FROM php:${PHP_VERSION:-8.2}-fpm-alpine

# Install system build dependencies and runtime libraries required by PHP extensions
RUN apk add --no-cache \
        bash \
        git \
        unzip \
        curl \
        libxml2-dev \
        curl-dev \
        libzip-dev \
        zlib-dev \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        imagemagick-dev \
        icu-dev \
        oniguruma-dev \
        $PHPIZE_DEPS

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        pdo \
        pdo_mysql \
        mysqli \
        gd \
        zip \
        intl \
        bcmath \
        opcache \
        xml \
        mbstring \
        curl

# Install PECL extensions (redis, imagick) and enable them
RUN pecl install redis imagick \
    && docker-php-ext-enable redis imagick

# Install Composer (latest)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Working directory for application code
WORKDIR /var/www

# Apply custom PHP configuration
COPY docker/php.ini /usr/local/etc/php/conf.d/devstack.ini

# Run as the default www-data user
USER www-data

CMD ["php-fpm"]
```

> **Note on `curl` vs `curl-dev`:** The `curl` entry in the `apk add` block installs the curl _binary_. `curl-dev` is a separate Alpine package that provides the C headers and `.so` files needed to compile the PHP `curl` extension. Both are required and they do not conflict.

### After merging

Rebuild the PHP image on EC2:

```bash
cd ~/devstack-manager
docker compose -f docker/docker-compose.yml build php
docker compose -f docker/docker-compose.yml up -d php
```

Verify extensions loaded:

```bash
docker exec devstack-php php -m | grep -E '^(xml|mbstring|curl)$'
# Expected output:
# curl
# mbstring
# xml
```

---

# PR 2 — DGCodeIdeas/chada.digital

| Field | Value |
|-------|-------|
| **Repo** | `DGCodeIdeas/chada.digital` |
| **Branch** | `feat/dstack-deployment` |
| **Target** | `main` |
| **PR title** | `feat(deploy): add DStack deployment support` |

**Why:** `chada.digital` currently deploys to bare-metal nginx + PHP-FPM at `/var/www/chada-digital/`. This PR adds a DStack-compatible deployment path using Docker containers, without removing or breaking the existing bare-metal scripts.

**Files changed:**
- 🆕 `scripts/post-deploy-dstack.sh` — new DStack-aware post-deploy script
- ✏️ `.github/workflows/deploy.yml` — updated rsync destination and post-deploy SSH command

---

## New File: `scripts/post-deploy-dstack.sh`

> Make it executable before committing:
> ```bash
> git update-index --chmod=+x scripts/post-deploy-dstack.sh
> ```

```bash
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
```

### Key differences vs. `scripts/post-deploy.sh` (bare-metal)

| Concern | Old `post-deploy.sh` | New `post-deploy-dstack.sh` |
|---------|----------------------|-----------------------------|
| PHP binary | `php8.2 artisan …` | `docker exec devstack-php php artisan …` |
| App path | `/var/www/chada-digital` | `/var/www/projects/chadadigital.com` (inside container) |
| Host app path | `/var/www/chada-digital` | `~/devstack-manager/projects/chadadigital.com` |
| FPM / web reload | `sudo systemctl reload php8.2-fpm` | `docker exec devstack-nginx nginx -s reload` |
| Permissions owner | `ubuntu:www-data` | `ubuntu:www-data` (host), container uses `www-data` internally |
| artisan invocation | One command per line | Batched inside a single `docker exec … sh -c` for efficiency |

---

## Updated File: `.github/workflows/deploy.yml`

### Changed step 1 of 2 — Sync files to EC2

**Before:**
```yaml
      - name: Sync files to EC2
        run: |
          rsync -az --delete \
            --exclude='.git' \
            --exclude='.github' \
            --exclude='node_modules' \
            --exclude='chada-digital-static' \
            --exclude='.env' \
            --exclude='storage/logs/*' \
            --exclude='storage/framework/cache/*' \
            --exclude='storage/framework/sessions/*' \
            --exclude='storage/framework/views/*' \
            --exclude='bootstrap/cache/*' \
            --exclude='database/database.sqlite' \
            -e "ssh -i ~/.ssh/deploy_key -o StrictHostKeyChecking=no" \
            ./ ubuntu@${{ secrets.EC2_HOST }}:/var/www/chada-digital/
```

**After:**
```yaml
      - name: Sync files to EC2
        run: |
          rsync -az --delete \
            --exclude='.git' \
            --exclude='.github' \
            --exclude='node_modules' \
            --exclude='chada-digital-static' \
            --exclude='.env' \
            --exclude='storage/logs/*' \
            --exclude='storage/framework/cache/*' \
            --exclude='storage/framework/sessions/*' \
            --exclude='storage/framework/views/*' \
            --exclude='bootstrap/cache/*' \
            --exclude='database/database.sqlite' \
            -e "ssh -i ~/.ssh/deploy_key -o StrictHostKeyChecking=no" \
            ./ ubuntu@${{ secrets.EC2_HOST }}:~/devstack-manager/projects/chadadigital.com/
```

### Changed step 2 of 2 — Run post-deploy tasks on EC2

**Before:**
```yaml
      - name: Run post-deploy tasks on EC2
        run: |
          ssh -i ~/.ssh/deploy_key -o StrictHostKeyChecking=no \
            ubuntu@${{ secrets.EC2_HOST }} \
            'cd /var/www/chada-digital && bash scripts/post-deploy.sh'
```

**After:**
```yaml
      - name: Run post-deploy tasks on EC2
        run: |
          ssh -i ~/.ssh/deploy_key -o StrictHostKeyChecking=no \
            ubuntu@${{ secrets.EC2_HOST }} \
            'bash ~/devstack-manager/projects/chadadigital.com/scripts/post-deploy-dstack.sh'
```

> **Why `bash ~/devstack-manager/…` instead of `cd … && bash scripts/…`?**  
> The script sets `HOME`-relative paths internally, so launching it directly from its absolute path is cleaner and avoids working-directory assumptions.

---

### Full updated file (copy-paste ready)

```yaml
name: Deploy to EC2
on:
  push:
    branches: [main]
  workflow_dispatch:
jobs:
  build-and-deploy:
    runs-on: ubuntu-latest
    steps:
      - name: Checkout code
        uses: actions/checkout@v4

      - name: Set up Bun
        uses: oven-sh/setup-bun@v2
        with:
          bun-version: latest

      - name: Cache node_modules
        uses: actions/cache@v4
        with:
          path: node_modules
          key: ${{ runner.os }}-bun-${{ hashFiles('bun.lock') }}
          restore-keys: |
            ${{ runner.os }}-bun-

      - name: Install JS dependencies
        run: bun install --frozen-lockfile

      - name: Build production assets
        run: bun run prod

      - name: Cache Composer packages
        uses: actions/cache@v4
        with:
          path: vendor
          key: ${{ runner.os }}-composer-${{ hashFiles('composer.lock') }}
          restore-keys: |
            ${{ runner.os }}-composer-

      - name: Install Composer dependencies
        uses: php-actions/composer@v6
        with:
          php_version: "8.2"
          args: --no-dev --optimize-autoloader --no-interaction

      - name: Write SSH key
        run: |
          mkdir -p ~/.ssh
          echo "${{ secrets.SSH_PRIVATE_KEY }}" > ~/.ssh/deploy_key
          chmod 600 ~/.ssh/deploy_key
          ssh-keyscan -H ${{ secrets.EC2_HOST }} >> ~/.ssh/known_hosts

      - name: Sync files to EC2
        run: |
          rsync -az --delete \
            --exclude='.git' \
            --exclude='.github' \
            --exclude='node_modules' \
            --exclude='chada-digital-static' \
            --exclude='.env' \
            --exclude='storage/logs/*' \
            --exclude='storage/framework/cache/*' \
            --exclude='storage/framework/sessions/*' \
            --exclude='storage/framework/views/*' \
            --exclude='bootstrap/cache/*' \
            --exclude='database/database.sqlite' \
            -e "ssh -i ~/.ssh/deploy_key -o StrictHostKeyChecking=no" \
            ./ ubuntu@${{ secrets.EC2_HOST }}:~/devstack-manager/projects/chadadigital.com/

      - name: Run post-deploy tasks on EC2
        run: |
          ssh -i ~/.ssh/deploy_key -o StrictHostKeyChecking=no \
            ubuntu@${{ secrets.EC2_HOST }} \
            'bash ~/devstack-manager/projects/chadadigital.com/scripts/post-deploy-dstack.sh'
```

---

## Merge Order & Checklist

Complete these steps in order. Steps 1–4 are EC2 prerequisites that must be in place before either PR is merged.

### EC2 Prerequisites (before any merge)

- [ ] **1.** Install Docker and Docker Compose on EC2
- [ ] **2.** Install Python 3.10+ and git on EC2
- [ ] **3.** Clone DStack and run the installer:
  ```bash
  git clone https://github.com/DGCodeIdeas/DStack.git ~/devstack-manager
  cd ~/devstack-manager
  bash install-local.sh
  ```
- [ ] **4.** Create the `chadadigital.com` virtual host via DStack API/CLI (framework: `laravel`)
- [ ] **5.** Create the `.env` file at `~/devstack-manager/projects/chadadigital.com/.env`

### Merge PR 1 — DStack Dockerfile patch

- [ ] **6.** Create branch `fix/php-laravel-extensions` off `master` in `DGCodeIdeas/DStack`
- [ ] **7.** Apply the `docker/Dockerfile.php` changes (diff above)
- [ ] **8.** Open PR → review → merge to `master`
- [ ] **9.** On EC2, rebuild and restart the PHP container:
  ```bash
  cd ~/devstack-manager
  docker compose -f docker/docker-compose.yml build php
  docker compose -f docker/docker-compose.yml up -d php
  ```
- [ ] **10.** Verify all three extensions are loaded:
  ```bash
  docker exec devstack-php php -m | grep -E '^(xml|mbstring|curl)$'
  ```

### Merge PR 2 — chada.digital DStack support

- [ ] **11.** Create branch `feat/dstack-deployment` off `main` in `DGCodeIdeas/chada.digital`
- [ ] **12.** Add `scripts/post-deploy-dstack.sh` (full content above) and set executable bit:
  ```bash
  git update-index --chmod=+x scripts/post-deploy-dstack.sh
  ```
- [ ] **13.** Update `.github/workflows/deploy.yml` (two-line change, diffs above)
- [ ] **14.** Open PR → review → merge to `main`
- [ ] **15.** The GitHub Actions workflow triggers automatically — monitor the run
- [ ] **16.** Verify both steps succeed in the Actions log:
  - ✅ `Sync files to EC2` → syncs to `~/devstack-manager/projects/chadadigital.com/`
  - ✅ `Run post-deploy tasks on EC2` → runs `post-deploy-dstack.sh`
- [ ] **17.** Verify the site loads correctly at `https://chadadigital.com`
- [ ] **18.** *(Optional)* Disable bare-metal nginx vhost and `php8.2-fpm` if fully migrated

---

## Rollback

The bare-metal setup is **completely untouched** by both PRs. If anything goes wrong after merging PR 2:

1. Revert the two changed lines in `deploy.yml`:
   - rsync destination: back to `/var/www/chada-digital/`
   - SSH command: back to `'cd /var/www/chada-digital && bash scripts/post-deploy.sh'`
2. Push the revert to `main` — GitHub Actions will automatically re-deploy to the bare-metal path using the original `post-deploy.sh`.

No data is lost. No secrets change. The rollback takes under 2 minutes.