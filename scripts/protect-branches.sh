#!/bin/bash
# 🛡️ Script de Protection des Branches - BiblioTech Laravel
# Usage: ./protect-branches.sh

echo "🛡️  Configuration de la Protection des Branches"
echo "=============================================="

# Configuration Git locale
echo "📝 Configuration des hooks Git..."

# Hook pre-push pour empêcher les push vers main depuis les branches seance-*
cat > .git/hooks/pre-push << 'EOF'
#!/bin/sh
protected_branches="^main$"
current_branch=$(git symbolic-ref HEAD | sed -e 's,.*/\(.*\),\1,')

# Vérifier si on pousse vers une branche protégée depuis une branche séance
if echo "$current_branch" | grep -q "^seance-"; then
    remote="$1"
    url="$2"
    
    while read local_ref local_sha remote_ref remote_sha; do
        if echo "$remote_ref" | grep -qE "$protected_branches"; then
            echo "❌ ERREUR: Tentative de push depuis '$current_branch' vers '$(echo $remote_ref | sed 's/refs\/heads\///')'"
            echo "🚫 Les branches séance ne peuvent pas être poussées vers main"
            echo "💡 Utilisez: git push origin $current_branch"
            exit 1
        fi
    done
fi

# Empêcher le push direct vers main si on n'est pas sur main
if [ "$current_branch" != "main" ]; then
    while read local_ref local_sha remote_ref remote_sha; do
        if echo "$remote_ref" | grep -qE "$protected_branches"; then
            echo "❌ ERREUR: Push vers 'main' autorisé uniquement depuis la branche 'main'"
            echo "💡 Basculez d'abord: git checkout main"
            exit 1
        fi
    done
fi
EOF

# Rendre le hook exécutable
chmod +x .git/hooks/pre-push

echo "✅ Hook pre-push installé"

# Alias Git utiles
echo "⚙️  Configuration des alias Git..."
git config alias.safe-push '!f() { 
    current_branch=$(git symbolic-ref --short HEAD)
    if [[ $current_branch == seance-* ]]; then
        echo "🚀 Push sécurisé vers: $current_branch"
        git push origin $current_branch
    else
        echo "💡 Branche détectée: $current_branch"
        git push "$@"
    fi
}; f'

git config alias.list-seances '!git branch -a | grep seance | sort'
git config alias.current-seance '!git symbolic-ref --short HEAD | grep seance || echo "❌ Pas sur une branche séance"'

echo "✅ Alias configurés:"
echo "   - git safe-push    # Push sécurisé"
echo "   - git list-seances # Lister les séances"
echo "   - git current-seance # Séance courante"

# Instructions finales
echo ""
echo "🎯 Protection des Branches Activée!"
echo "=================================="
echo "✅ Hook pre-push installé"
echo "✅ Alias Git configurés"
echo ""
echo "📋 Prochaines étapes:"
echo "1. Configurer la protection sur GitHub (voir BRANCH_PROTECTION.md)"
echo "2. Utiliser 'git safe-push' pour pousser en sécurité"
echo "3. Vérifier avec 'git current-seance' avant de travailler"
echo ""
echo "⚠️  RAPPEL: Chaque séance reste sur sa branche!"