@echo off
echo ===========================================
echo  BIBLIOTECH LARAVEL - DEMARRAGE SIMPLE
echo ===========================================
echo.

cd /d "%~dp0\.."

echo Verification de l'environnement...
if not exist ".env" (
    echo ERREUR: Fichier .env manquant
    echo Copiez .env.example vers .env et configurez-le
    pause
    exit /b 1
)

echo Nettoyage des caches...
php artisan config:clear >nul 2>&1
php artisan cache:clear >nul 2>&1
php artisan view:clear >nul 2>&1
php artisan route:clear >nul 2>&1

echo.
echo Demarrage du serveur Laravel sur http://localhost:8000
echo Appuyez sur Ctrl+C pour arreter
echo.
php artisan serve --port=8000

pause
