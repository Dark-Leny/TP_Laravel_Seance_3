#!/bin/bash
echo "========================================"
echo "Installation BiblioTech Laravel - SQLite"
echo "========================================"
echo

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

echo
echo "========================================"
echo "Installation terminée!"
echo "Utilisez ./scripts/start-simple.sh pour démarrer"
echo "========================================"

# Nettoyage des anciens modules Node.js
if [ -d node_modules ]; then
    rm -rf node_modules
fi
if [ -f package-lock.json ]; then
    rm package-lock.json
fi

echo
echo "Installation des dépendances Node.js et Bootstrap..."
npm install
npm install bootstrap@5.3.3 @popperjs/core@2.11.8

echo
echo "Configuration Laravel..."
php artisan key:generate --no-interaction
php artisan storage:link --no-interaction
php artisan config:cache
php artisan route:cache

echo
echo "Compilation des assets..."
npm run build

echo
echo "========================================"
echo "Installation terminée !"
echo
echo "Pour démarrer l'application :"
echo "php artisan serve"
echo
echo "Puis accédez à : http://localhost:8000"
echo "========================================"