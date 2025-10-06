# 🛡️ PROTECTION DES BRANCHES - BiblioTech Laravel

## ⚠️ RÈGLES IMPORTANTES

### ❌ **INTERDICTIONS ABSOLUES**
- Ne JAMAIS fusionner `main` vers `seance-*`
- Ne JAMAIS fusionner `seance-*` vers `main` 
- Ne JAMAIS fusionner `seance-*` vers `seance-*`

### ✅ **WORKFLOW AUTORISÉ**
1. Travailler sur la branche de votre séance : `seance-XX-nom`
2. Push vers GitHub : `git push origin seance-XX-nom`
3. Chaque séance reste indépendante

## 📋 **BRANCHES ACTUELLES**
- `main` → Séance 1 (MVC, Routes, Vues)
- `seance-02-database-sqlite` → Séance 2 (SQLite, Eloquent, Relations)

## 🔒 **PROTECTION GITHUB** (RECOMMANDÉE)

### Configuration sur GitHub.com :
1. Aller sur : **Settings** → **Branches** → **Add rule**
2. **Branch name pattern** : `main`
3. Cocher :
   - ✅ Restrict pushes that create files larger than 100MB
   - ✅ Require pull request reviews before merging
   - ❌ Allow force pushes
   - ❌ Allow deletions

4. **Branch name pattern** : `seance-*`
5. Cocher les mêmes options

## ⚡ **COMMANDES SÉCURISÉES**

### Vérifier sa branche actuelle :
```bash
git branch
# * seance-02-database-sqlite  ← OK
# * main                       ← Attention !
```

### Push sécurisé :
```bash
# Si vous êtes sur seance-02-database-sqlite
git push origin seance-02-database-sqlite

# JAMAIS ça :
git push origin main  # ❌ DANGER !
```

### Changer de séance :
```bash
git checkout seance-02-database-sqlite  # Pour travailler sur séance 2
git checkout main                       # Pour revenir à séance 1
```


---

## 💡 **RAPPEL PÉDAGOGIQUE**

Chaque branche de séance est un **environnement d'apprentissage complet** :
- Documentation dédiée
- Exercices spécifiques  
- Niveau de progression différent
- Technologies adaptées

**La fusion détruirait cette cohérence pédagogique !**

---

## ✅ **CHECKLIST AVANT CHAQUE TRAVAIL**

- [ ] Je suis sur la bonne branche : `git branch`
- [ ] Je vais pousser vers la bonne branche : `git push origin <ma-branche>`
- [ ] Je n'ai pas l'intention de fusionner des séances
- [ ] J'ai lu cette documentation de protection