@echo off
echo Checking admin user in database...
echo.

:: Navigate to project directory
cd /d "%~dp0"

:: Run artisan command to check admin user
php artisan tinker --execute="App\Models\User::where('email', 'admin@glamgo.com')->first();"

echo.
pause 