@echo off
echo ========================================
echo Installation BiblioTech Laravel - SQLite
echo ========================================
echo.

cd /d "%~dp0\.."

echo Verification de Composer...
where composer >nul 2>&1
if errorlevel 1 (
    echo ERREUR: Composer non trouve
    echo Installez Composer depuis getcomposer.org
    pause
    exit /b 1
)

echo Configuration .env...
if not exist .env (
    copy .env.example .env
    php artisan key:generate
    echo Fichier .env cree et cle generee
) else (
    echo Fichier .env existe deja
)

echo.
echo Installation des dependances PHP...
composer install --no-interaction --optimize-autoloader

echo.
echo Creation de la base de données SQLite...
if not exist "database\database.sqlite" (
    type nul > "database\database.sqlite"
    echo Base de donnees SQLite creee
)

echo.
echo Migration de la base de données...
php artisan migrate --force

echo.
echo Nettoyage des caches...
php artisan config:clear >nul 2>&1
php artisan cache:clear >nul 2>&1
php artisan view:clear >nul 2>&1

echo.
echo ========================================
echo Installation terminee!
echo Utilisez scripts\start-simple.bat pour demarrer
echo ========================================
pause
if exist node_modules rmdir /s /q node_modules
if exist package-lock.json del package-lock.json

echo.
echo Installation des dependances Node.js et Bootstrap...
npm install
npm install bootstrap@5.3.3 @popperjs/core@2.11.8

echo.
echo Configuration Laravel...
php artisan key:generate --no-interaction
php artisan storage:link --no-interaction
php artisan config:cache
php artisan route:cache

echo.
echo Compilation des assets...
npm run build

echo.
echo ========================================
echo Installation terminee !
echo.
echo Pour demarrer l'application :
echo php artisan serve
echo.
echo Puis accedez a : http://localhost:8000
echo ========================================
pause