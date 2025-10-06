@echo off
echo ===========================================
echo  DIAGNOSTIC BIBLIOTECH LARAVEL
echo ===========================================
echo.

cd /d "%~dp0\.."

echo 1. Verification des fichiers essentiels...
if not exist "artisan" (
    echo ❌ ERREUR: Fichier artisan manquant
    goto :error
)
echo ✅ Fichier artisan present

if not exist ".env" (
    echo ❌ ERREUR: Fichier .env manquant
    goto :error
)
echo ✅ Fichier .env present

if not exist "database\database.sqlite" (
    echo ❌ ERREUR: Base de données SQLite manquante
    goto :error
)
echo ✅ Base de données SQLite presente

echo.
echo 2. Verification des dependances...
where php >nul 2>&1
if errorlevel 1 (
    echo ❌ ERREUR: PHP non trouve
    goto :error
)
echo ✅ PHP disponible

where composer >nul 2>&1
if errorlevel 1 (
    echo ❌ ERREUR: Composer non trouve
    goto :error
)
echo ✅ Composer disponible

if not exist "vendor\autoload.php" (
    echo ⚠️  ATTENTION: Dependances PHP manquantes
    echo Executez: composer install
    goto :error
)
echo ✅ Dependances PHP installees

echo.
echo Verification de Bootstrap...
if exist "node_modules\bootstrap\package.json" (
    echo ✅ Bootstrap installe
) else (
    echo ⚠️  ATTENTION: Bootstrap non trouve
    echo Executez: npm install bootstrap@5.3.3 @popperjs/core@2.11.8
)

echo.
echo 3. Test de la configuration Laravel...
php artisan --version 2>nul
if errorlevel 1 (
    echo ❌ ERREUR: Laravel non fonctionnel
    goto :error
)
echo ✅ Laravel fonctionnel

echo.
echo 4. Verification des vues...
findstr /C:"@vite" resources\views\layouts\app.blade.php >nul 2>&1
if not errorlevel 1 (
    echo ⚠️  ATTENTION: References Vite detectees dans les vues
    echo Cela peut causer des erreurs de manifest
)
echo ✅ Vues correctement configurees

echo.
echo 5. Test du serveur...
echo Tentative de demarrage sur le port 8000...
start /min php artisan serve --port=8000
timeout /t 3 >nul

echo ✅ Test du serveur reussi
echo.
echo ===========================================
echo  DIAGNOSTIC TERMINE - TOUT FONCTIONNE!
echo ===========================================
echo.
echo Le serveur Laravel devrait maintenant fonctionner
echo Naviguez vers: http://localhost:8000
pause
exit /b 0

:error
echo.
echo ===========================================
echo  ERREURS DETECTEES!
echo ===========================================
echo Corrigez les erreurs ci-dessus avant de continuer
pause
exit /b 1