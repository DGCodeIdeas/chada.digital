# Chada Digital — Deployment Guide

> **Target:** AWS EC2 t3.small + RDS db.t3.micro (free tier, 6 months)
> **OS:** Ubuntu 22.04 LTS
> **Stack:** nginx + PHP 8.2-FPM + MySQL 8.0 (RDS)

---

## Table of Contents

1. [AWS Free Tier — Credit Budget](#1-aws-free-tier--credit-budget)
2. [Launch EC2 + RDS](#2-launch-ec2--rds)
3. [Initial Server Setup](#3-initial-server-setup)
4. [GitHub Actions Secrets](#4-github-actions-secrets)
5. [Production .env](#5-production-env)
6. [First Deploy](#6-first-deploy)
7. [Custom Domain from Namecheap](#7-custom-domain-from-namecheap)
8. [SSL Certificate](#8-ssl-certificate)
9. [Post-Launch Checklist](#9-post-launch-checklist)
10. [Monitoring Credits](#10-monitoring-credits)

---

## 1. AWS Free Tier — Credit Budget

The t3.small earns **864 CPU credits/day** (1 credit = 1 vCPU running at 100% for 60 seconds).
At idle, a properly configured server burns **~1–3 credits/hour**. A page request costs ~0.01–0.05 credits.

**What keeps the bill at zero:**

| Optimisation | Where it's configured |
|---|---|
| Assets built in GitHub Actions (free), not on EC2 | `.github/workflows/deploy.yml` |
| PHP-FPM `ondemand` — no idle worker processes | `scripts/server-setup.sh` step 4 |
| OPcache — PHP compiled once, served from RAM | `scripts/server-setup.sh` step 5 |
| nginx serves static files directly — never hits PHP | nginx `location ~* \.(css|js|...)` block |
| `sync` queue driver — no background worker process | `.env` `QUEUE_CONNECTION=sync` |
| File-based cache & sessions — reduces RDS queries | `.env` `CACHE_STORE=file`, `SESSION_DRIVER=file` |
| 2 GB swap — prevents OOM restarts (which spike CPU) | `scripts/server-setup.sh` step 3 |

**RDS free tier:** db.t3.micro — 750 hours/month, 20 GB storage, automated backups.

---

## 2. Launch EC2 + RDS

### 2.1 EC2 Instance

1. Go to **EC2 → Launch Instance**
2. **AMI:** Ubuntu Server 22.04 LTS (64-bit x86)
3. **Instance type:** `t3.small` *(free tier)*
4. **Key pair:** Create new → download `.pem` file → keep it safe
5. **Security group:** Create new with these rules:

   | Type | Port | Source | Purpose |
   |---|---|---|---|
   | SSH | 22 | My IP | Admin access only |
   | HTTP | 80 | 0.0.0.0/0 | Web traffic |
   | HTTPS | 443 | 0.0.0.0/0 | Web traffic |

6. **Storage:** 8 GB gp3 (free tier: up to 30 GB)
7. Launch → note the **Instance ID**

### 2.2 Elastic IP (prevents your IP changing on restart)

1. EC2 → **Elastic IPs → Allocate**
2. **Associate** it with your new instance
3. Note the Elastic IP — you'll need it for DNS

### 2.3 RDS Instance

1. Go to **RDS → Create database**
2. **Engine:** MySQL 8.0
3. **Template:** Free tier
4. **DB instance class:** `db.t3.micro`
5. **Storage:** 20 GB gp2 (do not enable autoscaling — it exits free tier)
6. **DB name:** `chada_digital`
7. **Username:** `chada_admin` (or your choice)
8. **Password:** generate a strong password, save it
9. **VPC security group:** Create new — allow **inbound TCP 3306** from the EC2 security group ID only (never `0.0.0.0/0`)
10. **Public access:** No
11. Note the **Endpoint** (e.g. `chada.xxxx.eu-west-1.rds.amazonaws.com`)

---

## 3. Initial Server Setup

SSH into the EC2 instance and run the setup script **once**:

```bash
# From your local machine
ssh -i /path/to/your-key.pem ubuntu@YOUR_ELASTIC_IP

# On the server — replace yourdomain.com with your actual domain
DOMAIN=chadadigital.com sudo bash scripts/server-setup.sh
```

This installs nginx, PHP 8.2-FPM, OPcache, Certbot, creates a 2 GB swap file, and configures the PHP-FPM pool for minimal credit usage. Takes ~3 minutes.

---

## 4. GitHub Actions Secrets

In your GitHub repo → **Settings → Secrets and variables → Actions → New repository secret**:

| Secret name | Value |
|---|---|
| `EC2_HOST` | Your Elastic IP address |
| `SSH_PRIVATE_KEY` | Full contents of your `.pem` key file |

The deploy workflow uses these to rsync files and run post-deploy commands over SSH.

### Allow ubuntu to reload PHP-FPM without a password

Run this once on the server (required for `post-deploy.sh`):

```bash
echo "ubuntu ALL=(ALL) NOPASSWD: /bin/systemctl reload php8.2-fpm" \
  | sudo tee /etc/sudoers.d/php-fpm-reload
sudo chmod 440 /etc/sudoers.d/php-fpm-reload
```

---

## 5. Production .env

SSH into the server and create the `.env` file. It is **never** committed to git.

```bash
ssh -i /path/to/your-key.pem ubuntu@YOUR_ELASTIC_IP
sudo nano /var/www/chada-digital/.env
```

Paste and fill in the values:

```dotenv
APP_NAME="Chada Digital"
APP_ENV=production
APP_KEY=                          # generated on first deploy — see step 6
APP_DEBUG=false
APP_URL=https://chadadigital.com  # your actual domain with https

APP_LOCALE=en
APP_FALLBACK_LOCALE=en

LOG_CHANNEL=single
LOG_LEVEL=error                   # errors only — reduces I/O on free tier

DB_CONNECTION=mysql
DB_HOST=chada.xxxx.eu-west-1.rds.amazonaws.com   # your RDS endpoint
DB_PORT=3306
DB_DATABASE=chada_digital
DB_USERNAME=chada_admin
DB_PASSWORD=your_rds_password

# File drivers — reduces RDS query load vs database drivers
SESSION_DRIVER=file
SESSION_LIFETIME=120
CACHE_STORE=file

# Sync queue — no background worker process needed
QUEUE_CONNECTION=sync

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
MAIL_MAILER=log                   # change when email is implemented
MAIL_FROM_ADDRESS="hello@chadadigital.com"
MAIL_FROM_NAME="Chada Digital"
```

---

## 6. First Deploy

Push to `main` to trigger GitHub Actions, **or** run manually:

```bash
# In GitHub → Actions → Deploy to EC2 → Run workflow
```

After rsync completes, the post-deploy script will run migrations. Then:

```bash
# On the server — generate app key (first time only)
ssh -i /path/to/your-key.pem ubuntu@YOUR_ELASTIC_IP
cd /var/www/chada-digital
php8.2 artisan key:generate
```

Copy the generated key into your `.env` `APP_KEY=` line.

---

## 7. Custom Domain from Namecheap

### 7.1 Point DNS to EC2

1. Log into **Namecheap → Domain List → Manage** your domain
2. Go to **Advanced DNS** tab
3. Delete any existing A records for `@` and `www`
4. Add these records:

   | Type | Host | Value | TTL |
   |---|---|---|---|
   | A Record | `@` | `YOUR_ELASTIC_IP` | Automatic |
   | A Record | `www` | `YOUR_ELASTIC_IP` | Automatic |

   > **Tip:** Set TTL to `5 min` while setting up, then increase to `1 hour` once confirmed working. Lower TTL = faster propagation when you make changes.

5. Click the green checkmark to save each record

### 7.2 Verify propagation

DNS can take a few minutes to a few hours. Check progress:

```bash
# From your local machine
dig +short chadadigital.com A
# Should return your Elastic IP once propagated

# Or check online:
# https://dnschecker.org — paste your domain and select A record
```

### 7.3 Update nginx server_name

The setup script already configured `server_name` with your domain. Verify:

```bash
ssh -i /path/to/your-key.pem ubuntu@YOUR_ELASTIC_IP
grep server_name /etc/nginx/sites-available/chada-digital
```

If the domain doesn't match, update it:

```bash
sudo nano /etc/nginx/sites-available/chada-digital
# Edit: server_name chadadigital.com www.chadadigital.com;
sudo nginx -t && sudo systemctl reload nginx
```

---

## 8. SSL Certificate

Once DNS has propagated (verify with `dig` first):

```bash
ssh -i /path/to/your-key.pem ubuntu@YOUR_ELASTIC_IP
sudo certbot --nginx -d chadadigital.com -d www.chadadigital.com
```

Certbot will:
- Verify domain ownership via HTTP
- Install the certificate
- Add an HTTPS server block to nginx automatically
- Add a redirect from HTTP → HTTPS

**Auto-renewal** is already set up by Certbot. Verify:

```bash
sudo systemctl status certbot.timer
# Should show: active (waiting)
```

After SSL is live, update `APP_URL` in `.env` to `https://chadadigital.com` and redeploy.

---

## 9. Post-Launch Checklist

```
[ ] EC2 t3.small launched (Ubuntu 22.04)
[ ] Elastic IP associated with instance
[ ] RDS db.t3.micro provisioned, security group restricts port 3306 to EC2 only
[ ] server-setup.sh run on EC2
[ ] GitHub Actions secrets set (EC2_HOST, SSH_PRIVATE_KEY)
[ ] sudoers entry added for php-fpm reload
[ ] .env created on server with production values
[ ] First deploy triggered (push to main or manual)
[ ] APP_KEY generated (php8.2 artisan key:generate)
[ ] Namecheap A records pointing to Elastic IP
[ ] DNS propagated (confirmed via dig or dnschecker.org)
[ ] SSL installed via Certbot
[ ] APP_URL updated to https:// in .env
[ ] APP_DEBUG=false confirmed in .env
[ ] Visit /sitemap.xml — verify it loads
[ ] Submit to Google Search Console
```

---

## 10. Monitoring Credits

Watch your CPU credit balance in **CloudWatch → EC2 → CPUCreditBalance**.

- If it trends toward 0: check for runaway processes (`top` on server)
- Normal idle: 800–864 credits (full bucket)
- A sudden drop usually means a PHP-FPM worker got stuck — `sudo systemctl restart php8.2-fpm`

**Stay in free tier checklist:**
- RDS storage stays under 20 GB (`SELECT table_schema, ROUND(SUM(data_length+index_length)/1024/1024,1) AS 'MB' FROM information_schema.tables GROUP BY table_schema;`)
- EC2 data transfer out stays under 100 GB/month (CloudWatch → EC2 → NetworkOut)
- No Elastic IP charges: only free while associated with a running instance
