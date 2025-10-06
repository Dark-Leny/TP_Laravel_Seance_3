@echo off
echo ========================================
echo Configuration Bootstrap pour BiblioTech
echo ========================================
echo.

cd /d "%~dp0\.."

echo Verification de Node.js...
where node >nul 2>&1
if errorlevel 1 (
    echo ERREUR: Node.js non trouve
    echo Installez Node.js depuis nodejs.org
    pause
    exit /b 1
)
echo ✅ Node.js disponible

echo.
echo Verification de npm...
where npm >nul 2>&1
if errorlevel 1 (
    echo ERREUR: npm non trouve
    pause
    exit /b 1
)
echo ✅ npm disponible

echo.
echo Installation de Bootstrap 5.3.3 et Popper.js...
npm install bootstrap@5.3.3 @popperjs/core@2.11.8

echo.
echo Verification de l'installation...
if exist "node_modules\bootstrap\package.json" (
    echo ✅ Bootstrap 5.3.3 installe avec succes
) else (
    echo ❌ ERREUR: Installation de Bootstrap echouee
    goto :error
)

if exist "node_modules\@popperjs\core\package.json" (
    echo ✅ Popper.js installe avec succes
) else (
    echo ❌ ERREUR: Installation de Popper.js echouee
    goto :error
)

echo.
echo Affichage des versions installees...
echo.
echo === VERSIONS BOOTSTRAP ===
node -e "console.log('Bootstrap version:', require('./node_modules/bootstrap/package.json').version)"
node -e "console.log('Popper.js version:', require('./node_modules/@popperjs/core/package.json').version)"

echo.
echo ========================================
echo Configuration Bootstrap terminee !
echo ========================================
echo.
echo Vous pouvez maintenant utiliser Bootstrap dans vos vues Laravel
echo Ajoutez ces lignes dans votre layout principal :
echo.
echo CSS: ^<link href="{{ asset('node_modules/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"^>
echo JS:  ^<script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}"^>^</script^>
echo.
pause
exit /b 0

:error
echo.
echo ========================================
echo  ERREURS DETECTEES!
echo ========================================
echo Verifiez votre connexion internet et reessayez
pause
exit /b 1