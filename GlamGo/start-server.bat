@echo off
echo Starting GlamGo Server...

REM Change to the script's directory
cd /d "%~dp0"

REM Check if artisan file exists
if not exist "artisan" (
    echo Error: artisan file not found!
    echo Make sure you're running this script from the GlamGo directory.
    pause
    exit /b 1
)

REM Start the server
echo Starting Laravel development server...
php artisan serve

pause 