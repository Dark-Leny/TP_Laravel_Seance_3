# ⚡ Démarrage Ultra-Rapide BiblioTech

> **🎯 Objectif :** Avoir l'application fonctionnelle en moins de 5 minutes

---

## 🚀 3 Méthodes au Choix

### 🌟 **Méthode 1 : GitHub Codespace (30 secondes)**

**✨ Parfait pour : Débutants, formation, démonstration**

1. **Cliquer ici :** [![Open in Codespaces](https://github.com/codespaces/badge.svg)](https://codespaces.new/votre-org/bibliotech)
2. **Attendre 2-3 minutes** que VS Code se charge
3. **Chercher "✅ BiblioTech configuré !"** dans le terminal
4. **Cliquer sur "PORTS"** en bas de VS Code
5. **Cliquer sur 🌐** à côté du port 8000
6. **🎉 Terminé !** Votre application Laravel fonctionne

### 🏠 **Méthode 2 : Installation Locale Automatique (2 minutes)**

**✨ Parfait pour : Développeurs, travail hors ligne**

**Prérequis :** Docker Desktop installé

```bash
# Télécharger et installer en 1 commande
curl -sSL https://raw.githubusercontent.com/votre-org/bibliotech/main/scripts/install.sh | bash

# Puis accéder à : http://localhost:8000
```

### 🐳 **Méthode 3 : Docker Manuel (5 minutes)**

**✨ Parfait pour : Contrôle total, personnalisation**

```bash
# 1. Télécharger
git clone https://github.com/votre-org/bibliotech.git
cd bibliotech

# 2. Démarrer (tout en 1 commande)
make start

# 3. Accéder à : http://localhost:8000
```

---

## ✅ Vérification Rapide

### **Test en 30 secondes**

```bash
# Vérifier que tout fonctionne
make check
```

**Vous devriez voir :**
```
✅ Application Laravel (port 8000)
✅ MailHog (port 8025)
✅ PostgreSQL (port 5432)
✅ Laravel 11.x fonctionnel
✅ Routes configurées
```

### **Test Navigation**

1. **Page d'accueil** : Statistiques BiblioTech
2. **Catalogue** : 5 livres avec images
3. **Détail livre** : Cliquer sur "Voir détails"
4. **Recherche** : Taper "Clean" → Résultat

**✅ Si tout fonctionne → Vous êtes prêt !**

---

## 🌐 URLs Importantes

### **GitHub Codespace**
- **Application** : Onglet PORTS → 🌐 port 8000
- **MailHog** : Onglet PORTS → port 8025
- **Terminal** : Intégré VS Code

### **Installation Locale**
- **Application** : http://localhost:8000
- **MailHog** : http://localhost:8025
- **Adminer (BDD)** : http://localhost:8080

---

## 🛠 Commandes Essentielles

### **Gestion Application**
```bash
make start          # 🚀 Démarrer
make stop           # 🛑 Arrêter
make restart        # 🔄 Redémarrer
make check          # ✅ Vérifier
```

### **Développement**
```bash
make shell          # 🐚 Terminal Laravel
make logs           # 📋 Voir les logs
make install        # 📦 Réinstaller
```

### **Laravel Artisan**
```bash
php artisan route:list     # Voir toutes les routes
php artisan --version      # Version Laravel
php artisan tinker         # Console interactive
```

---

## 🚨 Problèmes Fréquents

### **GitHub Codespace**

**❌ Application ne charge pas :**
```bash
make check    # Diagnostic
make install  # Réinstaller si nécessaire
```

**❌ Port 8000 non visible :**
- Vérifier onglet "PORTS" en bas de VS Code
- Cliquer sur 🌐 à côté du port 8000
- Attendre le message "✅ BiblioTech configuré !"

### **Installation Locale**

**❌ `make start` ne fonctionne pas :**
```bash
# Vérifier Docker
docker --version
docker-compose --version

# Si problème, redémarrer Docker Desktop
make clean
make start
```

**❌ Port 8000 déjà utilisé :**
```bash
# Voir qui utilise le port
lsof -i :8000

# Arrêter et relancer
make stop
make start
```

---

## 📚 Étapes Suivantes

### **Immédiatement**
1. **✅ Vérifier** que l'application fonctionne
2. **🎮 Explorer** toutes les pages (accueil, catalogue, recherche)
3. **📖 Lire** [Guide Séance 1](seance-01/README.md)

### **Pour Apprendre**
1. **💪 Faire** les [exercices pratiques](seance-01/EXERCICES.md)
2. **🧠 Comprendre** les [concepts MVC](seance-01/CONCEPTS.md)
3. **📝 Tester** avec l'[auto-évaluation](seance-01/EVALUATION.md)

### **Si Problème**
1. **🔍 Diagnostiquer** avec `make check`
2. **📖 Consulter** [Guide Dépannage](TROUBLESHOOTING.md)
3. **💬 Demander** de l'aide sur [GitHub Discussions](../../discussions)

---

## 🚀 Installation & Démarrage universelle

Utilisez les scripts suivants pour installer et démarrer le projet, quel que soit l'environnement :

```bash
bash scripts/install.sh      # Installation automatique
bash scripts/start.sh        # Démarrage du serveur Laravel
bash scripts/check.sh        # Diagnostic (optionnel)
```
- L’URL d’accès est affichée à la fin du démarrage (onglet PORTS ou https://CODESPACE_NAME-8000.app.github.dev).

**Remarques :**
- Le script `install.sh` détecte automatiquement l’environnement (Codespace, Docker, local) et configure tout.
- Le script `start.sh` attend la base de données, lance le serveur Laravel et affiche l’URL d’accès.
- Pour vérifier l’installation, utilisez `bash scripts/check.sh`.

---

**🚀 Prêt ? Choisissez votre méthode et commencez l'aventure Laravel !**

> 💡 **Conseil débutant :** Commencez par GitHub Codespace, c'est le plus simple et ça élimine tous les problèmes d'installation.
