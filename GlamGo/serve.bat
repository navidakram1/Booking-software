@echo off
echo Starting GlamGo Development Environment...

REM Clear caches
echo Clearing caches...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

REM Run migrations if needed
echo Checking database...
php artisan migrate

REM Start the server
echo Starting Laravel Development Server...
php artisan serve 