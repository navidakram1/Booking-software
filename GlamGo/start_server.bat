@echo off
echo Starting MySQL server...
net start MySQL

echo Setting up database...
mysql -u root -p < database/glamgo_database.sql

echo Starting Laravel development server...
php artisan serve

pause 