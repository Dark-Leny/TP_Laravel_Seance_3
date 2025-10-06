#!/bin/bash
echo "========================================"
echo "Démarrage simple BiblioTech Laravel"
echo "========================================"
echo

cd "$(dirname "$0")/.."

echo "Vérification de PHP..."
if ! command -v php &> /dev/null; then
    echo "ERREUR: PHP non trouvé"
    exit 1
fi

echo "Vérification de la configuration..."
if [ ! -f ".env" ]; then
    echo "ERREUR: Fichier .env manquant"
    echo "Exécutez d'abord: ./scripts/install.sh"
    exit 1
fi

if [ ! -f "database/database.sqlite" ]; then
    echo "ERREUR: Base de données manquante"
    echo "Exécutez d'abord: ./scripts/install.sh"
    exit 1
fi

echo "Nettoyage des caches..."
php artisan config:clear >/dev/null 2>&1
php artisan cache:clear >/dev/null 2>&1
php artisan view:clear >/dev/null 2>&1

echo
echo "========================================"
echo "Démarrage du serveur Laravel..."
echo "========================================"
echo
echo "Application accessible sur: http://localhost:8000"
echo "Appuyez sur Ctrl+C pour arrêter le serveur"
echo

php artisan serve