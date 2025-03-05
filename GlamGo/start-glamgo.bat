@echo off
echo Starting GlamGo Application...
echo.

:: Check if XAMPP is running
echo Checking XAMPP services...
netstat -an | find "3306" > nul
if errorlevel 1 (
    echo MySQL is not running! Please start XAMPP MySQL service.
    pause
    exit
)

:: Navigate to project directory
cd /d "%~dp0"

:: Clear Laravel caches
echo Clearing Laravel caches...
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

:: Build frontend assets
echo Building frontend assets...
call npm run build

:: Start Laravel server
echo Starting Laravel server...
php artisan serve

pause 