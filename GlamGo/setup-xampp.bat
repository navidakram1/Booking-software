@echo off
echo Setting up GlamGo in XAMPP...
echo.

:: Check if running as administrator
net session >nul 2>&1
if %errorLevel% == 0 (
    echo Running with administrator privileges...
) else (
    echo Please run this script as administrator!
    echo Right-click the batch file and select "Run as administrator"
    pause
    exit
)

:: Set paths
set XAMPP_PATH=C:\xampp\htdocs\glamgo
set CURRENT_PATH=%~dp0

:: Create glamgo directory in htdocs if it doesn't exist
if not exist "%XAMPP_PATH%" (
    echo Creating directory in XAMPP htdocs...
    mkdir "%XAMPP_PATH%"
)

:: Copy project files to XAMPP
echo Copying project files to XAMPP htdocs...
xcopy /E /Y /I "%CURRENT_PATH%*" "%XAMPP_PATH%"

:: Create storage link
echo Creating storage link...
cd /d "%XAMPP_PATH%"
php artisan storage:link

:: Set permissions
echo Setting permissions...
icacls "%XAMPP_PATH%\storage" /grant "Everyone":(OI)(CI)F /T
icacls "%XAMPP_PATH%\bootstrap\cache" /grant "Everyone":(OI)(CI)F /T

:: Clear all caches
echo Clearing all caches...
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

:: Run migrations and seeders
echo Setting up database...
php artisan migrate:fresh --seed

echo.
echo Setup completed successfully!
echo You can now access GlamGo at: http://localhost/glamgo
echo Admin login: http://localhost/glamgo/admin/login
echo Email: admin@glamgo.com
echo Password: Admin@123
echo.
pause 