# Protection des Branches - BiblioTech Laravel (PowerShell)
# Usage: .\protect-branches.ps1

Write-Host "Protection des Branches - Configuration" -ForegroundColor Cyan
Write-Host "======================================" -ForegroundColor Cyan

# Configuration des alias Git
Write-Host "Configuration des alias Git..." -ForegroundColor Yellow

# Alias pour push securise
git config alias.safe-push '!f() { branch=$(git symbolic-ref --short HEAD); if [[ $branch == seance-* ]]; then echo "Push securise vers: $branch"; git push origin $branch; else echo "Branche detectee: $branch"; git push "$@"; fi }; f'

# Alias pour lister les seances
git config alias.list-seances '!git branch -a | grep seance | sort'

# Alias pour seance courante  
git config alias.current-seance '!branch=$(git symbolic-ref --short HEAD); if [[ $branch == seance-* ]]; then echo "Seance courante: $branch"; else echo "Pas sur une branche seance"; fi'

Write-Host "Alias configures:" -ForegroundColor Green
Write-Host "   - git safe-push    # Push securise" -ForegroundColor White
Write-Host "   - git list-seances # Lister les seances" -ForegroundColor White  
Write-Host "   - git current-seance # Seance courante" -ForegroundColor White

Write-Host ""
Write-Host "Protection des Branches Activee!" -ForegroundColor Green
Write-Host "================================" -ForegroundColor Green
Write-Host "Alias Git configures" -ForegroundColor Green
Write-Host ""
Write-Host "Prochaines etapes:" -ForegroundColor Yellow
Write-Host "1. Configurer la protection sur GitHub" -ForegroundColor White
Write-Host "2. Utiliser 'git safe-push' pour pousser en securite" -ForegroundColor White
Write-Host "3. Verifier avec 'git current-seance' avant de travailler" -ForegroundColor White
Write-Host ""
Write-Host "RAPPEL: Chaque seance reste sur sa branche!" -ForegroundColor Red

# Test de la configuration
Write-Host ""
Write-Host "Test de la configuration:" -ForegroundColor Magenta
git current-seance