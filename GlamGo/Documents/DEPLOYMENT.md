# Deployment Guide

## Overview

This document outlines the deployment process for the GlamGo salon management system. Follow these instructions to deploy the application in various environments.

## Prerequisites

- PHP 8.1 or higher
- MySQL 8.0 or higher
- Node.js 16.x or higher
- Composer 2.x
- Git
- Web server (Apache/Nginx)
- SSL certificate
- Redis (optional, for caching)

## Environment Setup

1. Clone the repository:
```bash
git clone https://github.com/yourusername/glamgo.git
cd glamgo
```

2. Install dependencies:
```bash
composer install --no-dev --optimize-autoloader
npm install
npm run build
```

3. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

4. Update `.env` file:
```env
APP_NAME=GlamGo
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password

MAIL_MAILER=smtp
MAIL_HOST=your-mail-host
MAIL_PORT=587
MAIL_USERNAME=your-mail-username
MAIL_PASSWORD=your-mail-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@your-domain.com
MAIL_FROM_NAME="${APP_NAME}"

QUEUE_CONNECTION=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

## Database Setup

1. Run migrations:
```bash
php artisan migrate --force
```

2. Seed database:
```bash
php artisan db:seed --class=ProductionSeeder
```

## Web Server Configuration

### Apache

1. Enable required modules:
```bash
sudo a2enmod rewrite
sudo a2enmod ssl
```

2. Configure virtual host:
```apache
<VirtualHost *:80>
    ServerName your-domain.com
    Redirect permanent / https://your-domain.com/
</VirtualHost>

<VirtualHost *:443>
    ServerName your-domain.com
    DocumentRoot /var/www/glamgo/public
    
    SSLEngine on
    SSLCertificateFile /path/to/certificate.crt
    SSLCertificateKeyFile /path/to/private.key
    SSLCertificateChainFile /path/to/chain.crt
    
    <Directory /var/www/glamgo/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/glamgo-error.log
    CustomLog ${APACHE_LOG_DIR}/glamgo-access.log combined
</VirtualHost>
```

### Nginx

```nginx
server {
    listen 80;
    server_name your-domain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl;
    server_name your-domain.com;
    root /var/www/glamgo/public;
    
    ssl_certificate /path/to/certificate.crt;
    ssl_certificate_key /path/to/private.key;
    
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    
    index index.php;
    charset utf-8;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }
    
    error_page 404 /index.php;
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## File Permissions

```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

## Queue Worker Setup

1. Create systemd service:
```bash
sudo nano /etc/systemd/system/glamgo-worker.service
```

2. Add configuration:
```ini
[Unit]
Description=GlamGo Queue Worker
After=network.target

[Service]
User=www-data
Group=www-data
Restart=always
ExecStart=/usr/bin/php /var/www/glamgo/artisan queue:work --sleep=3 --tries=3 --max-time=3600

[Install]
WantedBy=multi-user.target
```

3. Start service:
```bash
sudo systemctl enable glamgo-worker
sudo systemctl start glamgo-worker
```

## Scheduled Tasks

Add Laravel scheduler to crontab:
```bash
* * * * * cd /var/www/glamgo && php artisan schedule:run >> /dev/null 2>&1
```

## Cache Configuration

1. Clear all caches:
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

2. Cache for production:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## SSL Certificate

1. Install Certbot:
```bash
sudo apt install certbot
```

2. Generate certificate:
```bash
sudo certbot certonly --webroot -w /var/www/glamgo/public -d your-domain.com
```

## Monitoring Setup

1. Install monitoring tools:
```bash
composer require laravel/telescope --dev
php artisan telescope:install
```

2. Configure Telescope in production:
```php
// config/telescope.php
'enabled' => env('TELESCOPE_ENABLED', false),
```

## Backup Configuration

1. Install backup package:
```bash
composer require spatie/laravel-backup
```

2. Configure backup:
```bash
php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"
```

3. Schedule backup:
```php
// app/Console/Kernel.php
$schedule->command('backup:clean')->daily()->at('01:00');
$schedule->command('backup:run')->daily()->at('02:00');
```

## Post-Deployment Checklist

1. Verify application health:
```bash
php artisan about
```

2. Check security headers:
```bash
curl -I https://your-domain.com
```

3. Test all features:
- Admin dashboard access
- Booking system
- Payment processing
- Email notifications
- File uploads
- API endpoints

4. Monitor logs:
```bash
tail -f storage/logs/laravel.log
```

## Rollback Procedure

1. Switch to previous version:
```bash
git checkout previous-tag
```

2. Restore database:
```bash
php artisan migrate:rollback
```

3. Clear caches:
```bash
php artisan cache:clear
php artisan config:clear
```

## Troubleshooting

Common issues and solutions:

1. Permission errors:
```bash
sudo chown -R www-data:www-data /var/www/glamgo
find /var/www/glamgo -type f -exec chmod 644 {} \;
find /var/www/glamgo -type d -exec chmod 755 {} \;
```

2. Cache issues:
```bash
php artisan optimize:clear
```

3. Database connection errors:
```bash
php artisan config:clear
php artisan cache:clear
```

## Security Considerations

1. Enable HTTPS only
2. Set secure headers
3. Configure CORS
4. Rate limiting
5. Input validation
6. SQL injection prevention
7. XSS protection
8. CSRF protection

## Performance Optimization

1. Enable OPcache
2. Configure Redis caching
3. Use CDN for assets
4. Enable Gzip compression
5. Optimize images
6. Minify CSS/JS
7. Database indexing

## Maintenance Mode

Enable maintenance mode during updates:
```bash
php artisan down --secret="your-secret-token"
# Perform updates
php artisan up
```

# Database Backup System

## Automatic Backups
The system includes an automated database backup solution that:
- Creates daily backups at midnight
- Stores backups in `storage/app/backups/database`
- Maintains the last 7 backups, automatically removing older ones
- Logs all backup operations

### Manual Backup
To create a manual backup, run:
```bash
php artisan db:backup
```

Optional: Specify a custom filename:
```bash
php artisan db:backup --filename=custom_backup.sql
```

### Backup Location
- Default location: `storage/app/backups/database/`
- Backup naming format: `backup_YYYY-MM-DD_HH-mm-ss.sql`
- Log file: `storage/logs/db-backups.log`

### Monitoring
- Check `storage/logs/db-backups.log` for backup operation logs
- Monitor `storage/app/backups/database/` for backup files
- Failed backups are logged with error details

### Recovery
To restore from a backup:
```bash
mysql -u [username] -p [database_name] < storage/app/backups/database/[backup_file].sql
```

### Best Practices
1. Regularly verify backup integrity
2. Store backups offsite (recommended)
3. Test restore process periodically
4. Monitor available storage space
5. Review backup logs weekly

## Service Search Functionality Deployment

### Database Considerations
1. Index Optimization
   ```sql
   -- Add indexes for search fields
   ALTER TABLE services ADD INDEX idx_name (name);
   ALTER TABLE services ADD INDEX idx_category (category);
   ALTER TABLE services ADD INDEX idx_status (status);
   ALTER TABLE services ADD INDEX idx_price (price);
   ```

2. Query Optimization
   - Enable query caching
   - Configure database connection pooling
   - Set appropriate buffer pool size

### Cache Configuration
1. Redis Setup
   ```env
   CACHE_DRIVER=redis
   REDIS_HOST=127.0.0.1
   REDIS_PASSWORD=null
   REDIS_PORT=6379
   ```

2. Cache Keys
   ```php
   // Example cache key structure
   'services:search:' . md5($query . $category . $status . $priceRange)
   ```

### Performance Tuning
1. PHP Configuration
   ```ini
   memory_limit = 256M
   max_execution_time = 30
   opcache.enable = 1
   opcache.memory_consumption = 128
   ```

2. Nginx Configuration
   ```nginx
   location /admin/services/search {
       proxy_cache_use_stale error timeout http_500 http_502 http_503 http_504;
       proxy_cache_valid 200 60m;
       proxy_cache_bypass $http_cache_control;
       add_header X-Cache-Status $upstream_cache_status;
   }
   ```

### Monitoring Setup
1. Performance Metrics
   - Response time tracking
   - Query execution time
   - Cache hit/miss ratio
   - Memory usage

2. Error Tracking
   - Search query errors
   - Cache failures
   - Database connection issues

### Security Measures
1. Rate Limiting
   ```php
   // In routes/web.php
   Route::middleware(['throttle:60,1'])->group(function () {
       Route::get('/admin/services/search', [ServiceController::class, 'search']);
   });
   ```

2. Input Validation
   ```php
   // In ServiceController
   $validated = $request->validate([
       'query' => 'nullable|string|max:255',
       'category' => 'nullable|string|in:hair,nails,facial,massage',
       'status' => 'nullable|string|in:active,inactive',
       'price_range' => 'nullable|string|in:low,medium,high'
   ]);
   ```

### Backup Strategy
1. Database Backups
   ```bash
   # Daily backup script
   mysqldump -u user -p database > backup_$(date +%Y%m%d).sql
   ```

2. Cache Backups
   ```bash
   # Redis backup
   redis-cli SAVE
   ```

### Rollback Plan
1. Database Rollback
   ```bash
   # Restore from backup
   mysql -u user -p database < backup_20240315.sql
   ```

2. Code Rollback
   ```bash
   # Revert to previous version
   git checkout v1.0.0
   composer install
   php artisan migrate:rollback
   ```

### Health Checks
1. Service Monitoring
   ```php
   // Health check endpoint
   Route::get('/health', function () {
       return response()->json([
           'status' => 'healthy',
           'database' => DB::connection()->getPdo() ? 'connected' : 'disconnected',
           'cache' => Cache::get('test') ? 'working' : 'failed',
           'search' => Service::count() > 0 ? 'ready' : 'not ready'
       ]);
   });
   ```

### Deployment Checklist
- [ ] Run database migrations
- [ ] Clear application cache
- [ ] Optimize autoloader
- [ ] Set up monitoring
- [ ] Configure rate limiting
- [ ] Enable query caching
- [ ] Set up error tracking
- [ ] Configure backup system
- [ ] Test search functionality
- [ ] Verify security measures
- [ ] Check performance metrics
- [ ] Monitor error logs
- [ ] Test rollback procedures
