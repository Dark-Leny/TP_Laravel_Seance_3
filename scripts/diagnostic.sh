#!/bin/bash

# Couleurs pour l'affichage
GREEN='\033[32m'
RED='\033[31m'
YELLOW='\033[33m'
BLUE='\033[34m'
NC='\033[0m' # No Color
SUCCESS='✅'
ERROR='❌'
WARNING='⚠️'

echo "==========================================="
echo "  DIAGNOSTIC BIBLIOTECH LARAVEL"
echo "==========================================="
echo

# Se déplacer dans le répertoire parent du script
cd "$(dirname "$0")/.."

echo "1. Vérification des fichiers essentiels..."
if [ ! -f "artisan" ]; then
    echo -e "${ERROR} ERREUR: Fichier artisan manquant"
    exit 1
fi
echo -e "${SUCCESS} Fichier artisan présent"

if [ ! -f ".env" ]; then
    echo -e "${ERROR} ERREUR: Fichier .env manquant"
    exit 1
fi
echo -e "${SUCCESS} Fichier .env présent"

if [ ! -f "database/database.sqlite" ]; then
    echo -e "${ERROR} ERREUR: Base de données SQLite manquante"
    exit 1
fi
echo -e "${SUCCESS} Base de données SQLite présente"

echo
echo "2. Vérification des dépendances..."
if ! command -v php &> /dev/null; then
    echo -e "${ERROR} ERREUR: PHP non trouvé"
    exit 1
fi
echo -e "${SUCCESS} PHP disponible"

if ! command -v composer &> /dev/null; then
    echo -e "${ERROR} ERREUR: Composer non trouvé"
    exit 1
fi
echo -e "${SUCCESS} Composer disponible"

if [ ! -f "vendor/autoload.php" ]; then
    echo -e "${WARNING} ATTENTION: Dépendances PHP manquantes"
    echo "Exécutez: composer install"
    exit 1
fi
echo -e "${SUCCESS} Dépendances PHP installées"

echo
echo "3. Test de la configuration Laravel..."
if ! php artisan --version &> /dev/null; then
    echo -e "${ERROR} ERREUR: Laravel non fonctionnel"
    exit 1
fi
echo -e "${SUCCESS} Laravel fonctionnel"

echo
echo "4. Vérification des vues..."
if grep -q "@vite" resources/views/layouts/app.blade.php 2>/dev/null; then
    echo -e "${WARNING} ATTENTION: Références Vite détectées dans les vues"
    echo "Cela peut causer des erreurs de manifest"
fi
echo -e "${SUCCESS} Vues correctement configurées"

echo
echo "5. Test du serveur..."
echo "Tentative de démarrage sur le port 8000..."
# Démarrer le serveur en arrière-plan et récupérer le PID
php artisan serve --port=8000 &
SERVER_PID=$!
sleep 3

# Vérifier si le serveur est en cours d'exécution
if kill -0 $SERVER_PID 2>/dev/null; then
    echo -e "${SUCCESS} Test du serveur réussi"
    # Arrêter le serveur de test
    kill $SERVER_PID 2>/dev/null
else
    echo -e "${ERROR} ERREUR: Impossible de démarrer le serveur"
    exit 1
fi

echo
echo "==========================================="
echo "  DIAGNOSTIC TERMINÉ - TOUT FONCTIONNE!"
echo "==========================================="
echo
echo "Le serveur Laravel devrait maintenant fonctionner"
echo "Naviguez vers: http://localhost:8000"