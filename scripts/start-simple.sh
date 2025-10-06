#!/bin/bash

echo "==========================================="
echo "  BIBLIOTECH LARAVEL - DÉMARRAGE SIMPLE"
echo "==========================================="
echo

# Se déplacer dans le répertoire parent du script
cd "$(dirname "$0")/.."

echo "Vérification de l'environnement..."
if [ ! -f ".env" ]; then
    echo "ERREUR: Fichier .env manquant"
    echo "Copiez .env.example vers .env et configurez-le"
    exit 1
fi

echo "Nettoyage des caches..."
php artisan config:clear >/dev/null 2>&1
php artisan cache:clear >/dev/null 2>&1
php artisan view:clear >/dev/null 2>&1
php artisan route:clear >/dev/null 2>&1

echo
echo "Démarrage du serveur Laravel sur http://localhost:8000"
echo "Appuyez sur Ctrl+C pour arrêter"
echo
php artisan serve --port=8000