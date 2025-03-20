@echo off
echo Setting up GlamGo Development Environment...

REM Install dependencies
echo Installing dependencies...
composer install

REM Create .env file if it doesn't exist
if not exist .env (
    echo Creating .env file...
    copy .env.example .env
)

REM Generate application key
echo Generating application key...
php artisan key:generate

REM Run migrations and seeders
echo Setting up database...
php artisan migrate:fresh --seed

REM Clear all caches
echo Clearing caches...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

REM Create storage link
echo Creating storage link...
php artisan storage:link

echo Setup complete! Run serve.bat to start the development server. 