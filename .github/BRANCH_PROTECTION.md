# 🛡️ Protection des Branches - BiblioTech Laravel

## 🎯 **Stratégie de Branches**

### **🏛️ Architecture des Branches**
```
Repository: bibliotech-laravel-bts-sio
├── main                        # ✅ Séance 1 - MVC & Routes
├── seance-02-database-sqlite    # ✅ Séance 2 - SQLite & Eloquent  
├── seance-03-crud-forms        # 🔄 Séance 3 - CRUD & Formulaires
├── seance-04-auth-middleware   # 🔄 Séance 4 - Auth & Middleware
└── seance-05-api-testing       # 🔄 Séance 5 - API & Tests
```

## 🚫 **INTERDICTION DE FUSION**

### **❌ Branches à NE JAMAIS fusionner :**
- `main` → `seance-*` 
- `seance-*` → `main`
- `seance-*` → `seance-*`

### **✅ Workflow Autorisé :**
1. **Développement** : Travailler sur `seance-XX-nom`
2. **Push** : `git push origin seance-XX-nom`
3. **Documentation** : Mettre à jour README et docs
4. **Tag** : `git tag v2.0-seanceXX`

## 🛡️ **Protection GitHub Recommandée**

### **Règles de Protection** (Settings → Branches)

#### **Branch: `main`**
```yaml
Branch name pattern: main
✅ Restrict pushes that create files larger than 100MB
✅ Require status checks to pass before merging
✅ Require branches to be up to date before merging
✅ Require conversation resolution before merging
❌ Allow force pushes: Everyone (INTERDIT)
❌ Allow deletions (INTERDIT)
```

#### **Branch Pattern: `seance-*`**
```yaml
Branch name pattern: seance-*
✅ Restrict pushes that create files larger than 100MB  
✅ Require pull request reviews before merging
✅ Dismiss stale PR reviews when new commits are pushed
✅ Require review from code owners
❌ Allow force pushes: Everyone (INTERDIT)
❌ Allow deletions (INTERDIT)
```

## 🔒 **Git Hooks Local (Optionnel)**

### **Pre-push Hook** (`.git/hooks/pre-push`)
```bash
#!/bin/sh
# Vérifier qu'on ne pousse pas vers des branches protégées
protected_branches="main"
current_branch=$(git symbolic-ref HEAD | sed -e 's,.*/\(.*\),\1,')

for branch in $protected_branches; do
    if [ "$current_branch" = "$branch" ]; then
        echo "❌ ERREUR: Push vers '$branch' interdit!"
        echo "💡 Utilisez une branche seance-XX-nom"
        exit 1
    fi
done
```

## 📋 **Checklist Formation**

### **✅ Avant Chaque Séance**
- [ ] Vérifier qu'on est sur la bonne branche
- [ ] Documenter les objectifs pédagogiques
- [ ] Tester l'installation complète
- [ ] Préparer les exercices et évaluation

### **✅ Après Chaque Séance**  
- [ ] Commit des modifications
- [ ] Push vers GitHub
- [ ] Tag de version (`v2.0-seance2`)
- [ ] Mise à jour documentation

## 🚨 **En Cas d'Erreur**

### **Si Fusion Accidentelle**
```bash
# 1. Identifier le commit de fusion
git log --oneline --graph

# 2. Revenir au commit précédent
git reset --hard <commit-avant-fusion>

# 3. Force push (ATTENTION: Dangereux)
git push --force-with-lease origin <branche>
```

---

## 🎓 **Bonnes Pratiques Pédagogiques**

### **👨‍🏫 Pour les Formateurs**
- Chaque séance = branche indépendante
- Documentation complète par séance
- Tests d'installation avant formation
- Backup régulier sur GitHub

### **👩‍💻 Pour les Étudiants**
- Fork le repository
- Travailler sur des branches personnelles
- Pull requests pour les exercices
- Respect de la structure établie

---

**⚠️ RAPPEL IMPORTANT : Les branches de séances sont des environnements pédagogiques séparés. Leur fusion détruirait la cohérence pédagogique du projet.**