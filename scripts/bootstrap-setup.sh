#!/bin/bash
echo "========================================"
echo "Configuration Bootstrap pour BiblioTech"
echo "========================================"
echo

cd "$(dirname "$0")/.."

echo "Vérification de Node.js..."
if ! command -v node &> /dev/null; then
    echo "ERREUR: Node.js non trouvé"
    echo "Installez Node.js depuis nodejs.org"
    exit 1
fi
echo "✅ Node.js disponible"

echo
echo "Vérification de npm..."
if ! command -v npm &> /dev/null; then
    echo "ERREUR: npm non trouvé"
    exit 1
fi
echo "✅ npm disponible"

echo
echo "Installation de Bootstrap 5.3.3 et Popper.js..."
npm install bootstrap@5.3.3 @popperjs/core@2.11.8

echo
echo "Vérification de l'installation..."
if [ -f "node_modules/bootstrap/package.json" ]; then
    echo "✅ Bootstrap 5.3.3 installé avec succès"
else
    echo "❌ ERREUR: Installation de Bootstrap échouée"
    exit 1
fi

if [ -f "node_modules/@popperjs/core/package.json" ]; then
    echo "✅ Popper.js installé avec succès"
else
    echo "❌ ERREUR: Installation de Popper.js échouée"
    exit 1
fi

echo
echo "Affichage des versions installées..."
echo
echo "=== VERSIONS BOOTSTRAP ==="
node -e "console.log('Bootstrap version:', require('./node_modules/bootstrap/package.json').version)"
node -e "console.log('Popper.js version:', require('./node_modules/@popperjs/core/package.json').version)"

echo
echo "========================================"
echo "Configuration Bootstrap terminée !"
echo "========================================"
echo
echo "Vous pouvez maintenant utiliser Bootstrap dans vos vues Laravel"
echo "Ajoutez ces lignes dans votre layout principal :"
echo
echo "CSS: <link href=\"{{ asset('node_modules/bootstrap/dist/css/bootstrap.min.css') }}\" rel=\"stylesheet\">"
echo "JS:  <script src=\"{{ asset('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}\"></script>"
echo