@echo off
echo Setting up GlamGo Application...
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

:: Install dependencies
echo Installing PHP dependencies...
call composer install

echo Installing NPM dependencies...
call npm install

:: Create .env file if it doesn't exist
if not exist .env (
    echo Creating .env file...
    copy .env.example .env
    php artisan key:generate
)

:: Clear all caches
echo Clearing all caches...
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

:: Run migrations and seeders
echo Setting up database...
php artisan migrate:fresh --seed

:: Build frontend assets
echo Building frontend assets...
call npm run build

echo.
echo Setup completed successfully!
echo Default admin credentials:
echo Email: admin@glamgo.com
echo Password: Admin@123
echo.
echo You can now use start-glamgo.bat to start the application.
echo.
pause 