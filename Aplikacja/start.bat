@echo off

%systemDrive%\xampp\mysql\bin\mysql -uroot -e "CREATE DATABASE IF NOT EXISTS portal;"

if %errorlevel% neq 0 (
    msg %username% "Nie udało się utworzyć bazy danych."
    exit /b %errorlevel%
)

if exist storage\app\public\photos (
    rmdir /s /q storage\app\public\photos
    mkdir storage\app\public\photos
)

xcopy /s /i /y "storage\app\public\photos-example\*" "storage\app\public\photos\"

php -r "copy('.env.example', '.env');"

call composer install

call php artisan migrate:fresh --seed

call php artisan key:generate

call php artisan storage:link

call php artisan serve

start http://127.0.0.1:8000

code .
