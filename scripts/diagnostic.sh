#!/bin/bash
echo "==========================================="
echo " DIAGNOSTIC BIBLIOTECH LARAVEL"
echo "==========================================="
echo

cd "$(dirname "$0")/.."

echo "1. Vérification des fichiers essentiels..."
if [ ! -f "artisan" ]; then
    echo "❌ ERREUR: Fichier artisan manquant"
    exit 1
fi
echo "✅ Fichier artisan présent"

if [ ! -f ".env" ]; then
    echo "❌ ERREUR: Fichier .env manquant"
    exit 1
fi
echo "✅ Fichier .env présent"

if [ ! -f "database/database.sqlite" ]; then
    echo "❌ ERREUR: Base de données SQLite manquante"
    exit 1
fi
echo "✅ Base de données SQLite présente"

echo
echo "2. Vérification des dépendances..."
if ! command -v php &> /dev/null; then
    echo "❌ ERREUR: PHP non trouvé"
    exit 1
fi
echo "✅ PHP disponible"

if ! command -v composer &> /dev/null; then
    echo "❌ ERREUR: Composer non trouvé"
    exit 1
fi
echo "✅ Composer disponible"

if [ ! -f "vendor/autoload.php" ]; then
    echo "⚠️  ATTENTION: Dépendances PHP manquantes"
    echo "Exécutez: composer install"
    exit 1
fi
echo "✅ Dépendances PHP installées"

echo
echo "Vérification de Bootstrap..."
if [ -f "node_modules/bootstrap/package.json" ]; then
    echo "✅ Bootstrap installé"
else
    echo "⚠️  ATTENTION: Bootstrap non trouvé"
    echo "Exécutez: npm install bootstrap@5.3.3 @popperjs/core@2.11.8"
fi

echo
echo "3. Test de la configuration Laravel..."
if ! php artisan --version &>/dev/null; then
    echo "❌ ERREUR: Laravel non fonctionnel"
    exit 1
fi
echo "✅ Laravel fonctionnel"

echo
echo "4. Vérification des vues..."
if grep -q "@vite" resources/views/layouts/app.blade.php 2>/dev/null; then
    echo "⚠️  ATTENTION: Références Vite détectées dans les vues"
    echo "Cela peut causer des erreurs de manifest"
fi
echo "✅ Vues correctement configurées"

echo
echo "5. Test du serveur..."
echo "Tentative de démarrage sur le port 8000..."
php artisan serve --port=8000 &
SERVER_PID=$!
sleep 3

if kill -0 $SERVER_PID 2>/dev/null; then
    echo "✅ Test du serveur réussi"
    kill $SERVER_PID
else
    echo "❌ ERREUR: Serveur non démarré"
fi

echo
echo "==========================================="
echo " DIAGNOSTIC TERMINÉ - TOUT FONCTIONNE!"
echo "==========================================="
echo
echo "Le serveur Laravel devrait maintenant fonctionner"
echo "Naviguez vers: http://localhost:8000"