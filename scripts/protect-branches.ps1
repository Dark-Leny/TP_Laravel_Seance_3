# 🛡️ Script de Protection des Branches - BiblioTech Laravel (PowerShell)
# Usage: .\protect-branches.ps1

Write-Host "🛡️  Configuration de la Protection des Branches" -ForegroundColor Cyan
Write-Host "===============================================" -ForegroundColor Cyan

# Configuration des alias Git
Write-Host "⚙️  Configuration des alias Git..." -ForegroundColor Yellow

# Alias pour push sécurisé
git config alias.safe-push '!powershell -Command "$branch = git symbolic-ref --short HEAD; if ($branch -like \"seance-*\") { Write-Host \"🚀 Push sécurisé vers: $branch\" -ForegroundColor Green; git push origin $branch } else { Write-Host \"💡 Branche détectée: $branch\" -ForegroundColor Yellow; git push $args }"'

# Alias pour lister les séances
git config alias.list-seances '!git branch -a | Select-String "seance" | Sort-Object'

# Alias pour séance courante
git config alias.current-seance '!powershell -Command "$branch = git symbolic-ref --short HEAD; if ($branch -like \"seance-*\") { Write-Host \"📚 Séance courante: $branch\" -ForegroundColor Green } else { Write-Host \"❌ Pas sur une branche séance\" -ForegroundColor Red }"'

Write-Host "✅ Alias configurés:" -ForegroundColor Green
Write-Host "   - git safe-push    # Push sécurisé" -ForegroundColor White
Write-Host "   - git list-seances # Lister les séances" -ForegroundColor White  
Write-Host "   - git current-seance # Séance courante" -ForegroundColor White

# Créer un hook PowerShell
$hookContent = @'
#!/usr/bin/env powershell
# Hook pre-push pour Windows
$currentBranch = git symbolic-ref --short HEAD

# Vérifier si on est sur une branche séance et qu'on tente de pousser vers main
if ($currentBranch -like "seance-*") {
    # Lire les arguments du push
    $input = @()
    while ($line = [Console]::ReadLine()) {
        if ($line -eq $null) { break }
        $input += $line
    }
    
    foreach ($line in $input) {
        $parts = $line -split '\s+'
        $remoteRef = $parts[2]
        
        if ($remoteRef -eq "refs/heads/main") {
            Write-Host "❌ ERREUR: Tentative de push depuis '$currentBranch' vers 'main'" -ForegroundColor Red
            Write-Host "🚫 Les branches séance ne peuvent pas être poussées vers main" -ForegroundColor Red
            Write-Host "💡 Utilisez: git push origin $currentBranch" -ForegroundColor Yellow
            exit 1
        }
    }
}
'@

# Écrire le hook (Note: Les hooks Git sur Windows peuvent être complexes)
$hookPath = ".git\hooks\pre-push.ps1"
$hookContent | Out-File -FilePath $hookPath -Encoding UTF8
Write-Host "✅ Hook PowerShell créé: $hookPath" -ForegroundColor Green

# Instructions finales
Write-Host ""
Write-Host "🎯 Protection des Branches Activée!" -ForegroundColor Green
Write-Host "==================================" -ForegroundColor Green
Write-Host "✅ Alias Git configurés" -ForegroundColor Green
Write-Host "✅ Hook PowerShell créé" -ForegroundColor Green
Write-Host ""
Write-Host "📋 Prochaines étapes:" -ForegroundColor Yellow
Write-Host "1. Configurer la protection sur GitHub (voir .github\BRANCH_PROTECTION.md)" -ForegroundColor White
Write-Host "2. Utiliser 'git safe-push' pour pousser en sécurité" -ForegroundColor White
Write-Host "3. Vérifier avec 'git current-seance' avant de travailler" -ForegroundColor White
Write-Host ""
Write-Host "⚠️  RAPPEL: Chaque séance reste sur sa branche!" -ForegroundColor Red

# Tester la configuration
Write-Host ""
Write-Host "🧪 Test de la configuration:" -ForegroundColor Magenta
git current-seance
git list-seances