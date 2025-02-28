# GlamGo Deployment Guide

## Deployment Overview

This guide covers the deployment process for the GlamGo salon booking system.

## Prerequisites

- PHP 8.2+
- MySQL 8.0+
- Node.js 18+
- Composer 2+
- Web server (Apache/Nginx)
- SSL certificate
- Git

## Server Requirements

### Minimum Specifications
- CPU: 2 cores
- RAM: 4GB
- Storage: 20GB SSD
- Bandwidth: 100GB/month

### Recommended Specifications
- CPU: 4 cores
- RAM: 8GB
- Storage: 40GB SSD
- Bandwidth: 500GB/month

## Deployment Steps

### 1. Server Setup

```bash
# Update system
sudo apt update
sudo apt upgrade -y

# Install required packages
sudo apt install -y nginx mysql-server php8.2-fpm php8.2-mysql php8.2-mbstring php8.2-xml php8.2-curl
```

### 2. Database Setup

```bash
# Secure MySQL installation
sudo mysql_secure_installation

# Create database and user
mysql -u root -p
CREATE DATABASE glamgo;
CREATE USER 'glamgo_user'@'localhost' IDENTIFIED BY 'your_password';
GRANT ALL PRIVILEGES ON glamgo.* TO 'glamgo_user'@'localhost';
FLUSH PRIVILEGES;
```

### 3. Application Deployment

```bash
# Clone repository
git clone https://github.com/yourusername/glamgo.git
cd glamgo

# Install dependencies
composer install --no-dev --optimize-autoloader
npm install
npm run build

# Set permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### 4. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure .env file
APP_NAME=GlamGo
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=glamgo
DB_USERNAME=glamgo_user
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@your-domain.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 5. Web Server Configuration

#### Nginx Configuration

```nginx
server {
    listen 80;
    server_name your-domain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl;
    server_name your-domain.com;

    ssl_certificate /etc/letsencrypt/live/your-domain.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/your-domain.com/privkey.pem;

    root /var/www/glamgo/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
    }

    location ~ /\.ht {
        deny all;
    }

    location ~ /.well-known {
        allow all;
    }
}
```

### 6. SSL Certificate

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx

# Obtain SSL certificate
sudo certbot --nginx -d your-domain.com
```

### 7. Final Setup

```bash
# Clear cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Create storage link
php artisan storage:link
```

## Deployment Checklist

- [ ] Environment variables configured
- [ ] Database migrations run
- [ ] Storage links created
- [ ] SSL certificate installed
- [ ] File permissions set
- [ ] Caches cleared and rebuilt
- [ ] Error logging configured
- [ ] Backup system setup
- [ ] Monitoring tools installed

## Monitoring Setup

### 1. Laravel Telescope (Development)

```bash
composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate
```

### 2. Production Monitoring

```bash
# Install monitoring tools
composer require laravel/horizon
php artisan horizon:install
```

## Backup Configuration

```bash
# Install backup package
composer require spatie/laravel-backup

# Configure backup
php artisan backup:run
```

## Maintenance Mode

```bash
# Enable maintenance mode
php artisan down --message="Updating system" --retry=60

# Disable maintenance mode
php artisan up
```

## Rollback Procedure

```bash
# Revert to previous version
git checkout previous_tag

# Restore database
mysql -u user -p database < backup.sql

# Clear cache
php artisan config:clear
php artisan cache:clear
```

## Performance Optimization

1. Enable OPcache
2. Configure Redis caching
3. Set up CDN for assets
4. Enable Gzip compression
5. Configure browser caching

## Security Measures

1. Enable HTTPS only
2. Set secure headers
3. Configure firewall
4. Enable rate limiting
5. Regular security updates

## Troubleshooting

Common issues and solutions:
1. Permission errors
2. Database connection issues
3. Cache problems
4. SSL certificate errors

## Deployment Schedule

1. Pre-deployment testing
2. Backup current version
3. Deploy new version
4. Run migrations
5. Clear caches
6. Verify functionality
7. Monitor for issues

## Resources

- Laravel Deployment Documentation
- Nginx Documentation
- MySQL Documentation
- Server Hardening Guide
