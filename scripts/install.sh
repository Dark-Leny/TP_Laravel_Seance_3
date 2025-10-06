#!/bin/bash

echo "========================================"
echo "Installation BiblioTech Laravel - SQLite"
echo "========================================"
echo

# Se déplacer dans le répertoire parent du script
cd "$(dirname "$0")/.."

echo "Vérification de Composer..."
if ! command -v composer &> /dev/null; then
    echo "ERREUR: Composer non trouvé"
    echo "Installez Composer depuis getcomposer.org"
    exit 1
fi

echo "Configuration .env..."
if [ ! -f .env ]; then
    cp .env.example .env
    php artisan key:generate
    echo "Fichier .env créé et clé générée"
else
    echo "Fichier .env existe déjà"
fi

echo
echo "Installation des dépendances PHP..."
composer install --no-interaction --optimize-autoloader

echo
echo "Création de la base de données SQLite..."
if [ ! -f "database/database.sqlite" ]; then
    touch "database/database.sqlite"
    echo "Base de données SQLite créée"
fi

echo
echo "Migration de la base de données..."
php artisan migrate --force

echo
echo "Nettoyage des caches..."
php artisan config:clear >/dev/null 2>&1
php artisan cache:clear >/dev/null 2>&1
php artisan view:clear >/dev/null 2>&1

# Vérifier si Node.js est disponible pour les assets
if command -v npm &> /dev/null; then
    echo
    echo "Nettoyage des dépendances Node.js..."
    if [ -d "node_modules" ]; then
        rm -rf node_modules
    fi
    if [ -f "package-lock.json" ]; then
        rm package-lock.json
    fi
    
    echo "Installation des dépendances Node.js..."
    npm install

    echo
    echo "Configuration Laravel..."
    php artisan key:generate --no-interaction
    php artisan storage:link --no-interaction 2>/dev/null || true
    php artisan config:cache
    php artisan route:cache

    echo
    echo "Compilation des assets..."
    npm run build
fi

echo
echo "========================================"
echo "Installation terminée !"
echo
echo "Pour démarrer l'application :"
echo "php artisan serve"
echo
echo "Puis accédez à : http://localhost:8000"
echo "========================================"