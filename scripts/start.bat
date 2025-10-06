@echo off
chcp 65001 >nul
setlocal enabledelayedexpansion

REM ===============================================
REM Script de Démarrage BiblioTech - Windows
REM ===============================================

set "GREEN=[32m"
set "RED=[31m"
set "YELLOW=[33m"
set "BLUE=[34m"
set "NC=[0m"
set "SUCCESS=✅"
set "ERROR=❌"
set "INFO=ℹ️"
set "ROCKET=🚀"

echo.
echo %BLUE%╔══════════════════════════════════════════════════════════════╗%NC%
echo %BLUE%║  %ROCKET% Démarrage de BiblioTech Laravel                       ║%NC%
echo %BLUE%╚══════════════════════════════════════════════════════════════╝%NC%
echo.

REM Vérifier si PHP est installé
where php >nul 2>&1
if errorlevel 1 (
    echo %ERROR% PHP n'est pas installé ou pas dans le PATH
    echo %INFO% Veuillez installer XAMPP, WAMP ou PHP
    pause
    exit /b 1
)

REM Vérifier si on est dans un projet Laravel
if not exist "artisan" (
    echo %ERROR% Console Artisan non trouvée
    echo %INFO% Assurez-vous d'être dans le répertoire du projet Laravel
    pause
    exit /b 1
)

REM Vérifier si .env existe
if not exist ".env" (
    echo %YELLOW% Fichier .env manquant, création depuis .env.example...%NC%
    if exist ".env.example" (
        copy ".env.example" ".env" >nul
        echo %SUCCESS% Fichier .env créé
    ) else (
        echo %ERROR% Fichier .env.example manquant
        pause
        exit /b 1
    )
)

REM Vérifier si APP_KEY est configurée
findstr /C:"APP_KEY=base64:" .env >nul 2>&1
if errorlevel 1 (
    echo %YELLOW% Génération de la clé d'application...%NC%
    php artisan key:generate
    if errorlevel 1 (
        echo %ERROR% Erreur lors de la génération de la clé
        pause
        exit /b 1
    )
    echo %SUCCESS% Clé d'application générée
)

REM Vérifier les dépendances Composer
if not exist "vendor" (
    echo %YELLOW% Installation des dépendances PHP...%NC%
    where composer >nul 2>&1
    if errorlevel 1 (
        echo %ERROR% Composer n'est pas installé
        echo %INFO% Téléchargez Composer depuis getcomposer.org
        pause
        exit /b 1
    )
    
    composer install --no-dev --optimize-autoloader
    if errorlevel 1 (
        echo %ERROR% Erreur lors de l'installation des dépendances
        pause
        exit /b 1
    )
    echo %SUCCESS% Dépendances PHP installées
)

REM Nettoyer le cache Laravel
echo %INFO% Nettoyage du cache Laravel...
php artisan config:clear >nul 2>&1
php artisan cache:clear >nul 2>&1
php artisan view:clear >nul 2>&1

REM Vérifier la base de données
echo %INFO% Vérification de la base de données...
php artisan migrate:status >nul 2>&1
if errorlevel 1 (
    echo %YELLOW% Base de données non configurée ou inaccessible%NC%
    echo %INFO% Vous devrez configurer la base de données dans .env
) else (
    echo %SUCCESS% Base de données accessible
)

REM Créer le lien symbolique pour le storage
if not exist "public\storage" (
    echo %INFO% Création du lien symbolique storage...
    php artisan storage:link >nul 2>&1
    if not errorlevel 1 (
        echo %SUCCESS% Lien storage créé
    )
)

REM Vérifier si le port 8000 est libre
netstat -an | findstr ":8000" >nul 2>&1
if not errorlevel 1 (
    echo %YELLOW% Le port 8000 est déjà utilisé%NC%
    echo %INFO% L'application sera démarrée sur un autre port
    set PORT_OPTION=
) else (
    set PORT_OPTION=--port=8000
)

echo.
echo %GREEN%🚀 Démarrage du serveur Laravel...%NC%
echo %INFO% L'application sera accessible dans votre navigateur
echo %INFO% Appuyez sur Ctrl+C pour arrêter le serveur
echo.

REM Démarrer le serveur de développement
php artisan serve %PORT_OPTION%

REM Si on arrive ici, le serveur s'est arrêté
echo.
echo %INFO% Serveur arrêté
pause