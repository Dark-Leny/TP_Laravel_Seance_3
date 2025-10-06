# 🏠 Guide Installation Locale - BiblioTech

> **🎯 Installer BiblioTech sur votre machine personnelle - 2 méthodes**

---

## 🎯 Pourquoi Installation Locale ?

**Avantages :**
- ✅ **Performance native** - Pas de latence réseau
- ✅ **Travail hors ligne** - Pas besoin d'internet constant
- ✅ **Contrôle total** - Configuration avancée
- ✅ **Apprentissage complet** - PHP + Laravel + optionnel Docker
- ✅ **Pas de limites** GitHub Codespace

## 📋 2 Méthodes d'Installation

### 🌟 **Méthode 1 : Simple PHP + SQLite (Recommandée)**

**✅ Parfait pour :** Débutants, performance, BTS SIO séances 1-4

**Prérequis :**
- PHP 8.3+ et Composer
- Node.js 18+ (optionnel pour compilation assets)

**Installation :**
```bash
# Clone du projet
git clone https://github.com/votre-org/bibliotech.git
cd bibliotech

# Installation automatique
./scripts/install.sh    # Linux/Mac/WSL
# OU
scripts\install.bat     # Windows

# Démarrage
php artisan serve
```

**Résultat :** Application SQLite fonctionnelle à http://localhost:8000

### 🐳 **Méthode 2 : Docker + PostgreSQL (Avancée)**

**✅ Parfait pour :** Tests avancés, BTS SIO séances 5-8, apprentissage Docker

**Prérequis :**
- Docker Desktop installé

**Installation :**
```bash
# Clone du projet  
git clone https://github.com/votre-org/bibliotech.git
cd bibliotech

# Option A : MailHog seulement (SQLite dans app)
docker-compose up mailhog
php artisan serve

# Option B : Environnement complet PostgreSQL
docker-compose --profile database up
```

**Résultat :** Application PostgreSQL + MailHog à http://localhost:8000
## 📋 Prérequis Système

### **Méthode 1 : Simple PHP + SQLite**
- **PHP 8.3+** avec extensions : pdo, pdo_sqlite, openssl, mbstring
- **Composer** (gestionnaire de paquets PHP)  
- **Node.js 18+** (optionnel, pour compilation assets)
- **Git** pour cloner le projet

### **Méthode 2 : Docker + PostgreSQL**
- **Docker Desktop** installé
- **Git** pour cloner le projet
- **VS Code** (recommandé)

### **Systèmes Supportés**
- **Windows 10/11** (avec ou sans WSL2)
- **macOS** Intel ou Apple Silicon
- **Linux** (Ubuntu, Debian, CentOS, etc.)

---

## 🚀 Installation Rapide

### **Option 1 : Script d'Installation (Recommandé)**

```bash
# Télécharger et installer automatiquement
curl -sSL https://raw.githubusercontent.com/votre-org/bibliotech/main/scripts/install.sh | bash

# OU clone manuel puis script
git clone https://github.com/votre-org/bibliotech.git
cd bibliotech
./scripts/install.sh
```

**Le script détecte automatiquement :**
- ✅ Environnement (local, Codespace, Docker)
- ✅ Configuration optimal (SQLite ou PostgreSQL)
- ✅ Dépendances manquantes
- ✅ Installation et démarrage

### **Option 2 : Installation Manuelle**

```bash
# 1. Clone du projet
git clone https://github.com/votre-org/bibliotech.git
cd bibliotech

# 2. Configuration
cp .env.example .env

# 3. Dépendances PHP
composer install

# 4. Configuration Laravel
php artisan key:generate
touch database/database.sqlite  # Base SQLite
php artisan migrate --seed

# 5. Assets (optionnel)
npm install && npm run build

# 6. Démarrage
php artisan serve
```

**Accès :** http://localhost:8000

---

## � Option Docker (Avancée)

### **Installation Docker**

#### **Windows**
```powershell
# Télécharger Docker Desktop : https://www.docker.com/products/docker-desktop
# Installer et activer WSL2

# Vérifier installation
docker --version
docker-compose --version
```

#### **macOS**
```bash
# Avec Homebrew
brew install --cask docker

# OU télécharger : https://www.docker.com/products/docker-desktop

# Vérifier installation
docker --version
docker-compose --version
```

#### **Linux (Ubuntu/Debian)**
```bash
# Installation Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh
sudo usermod -aG docker $USER

# Docker Compose
sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose

# Redémarrer session
newgrp docker
```

### **Utilisation Docker**

```bash
# Clone du projet
git clone https://github.com/votre-org/bibliotech.git
cd bibliotech

# Option A : MailHog seulement (recommandé)
docker-compose up mailhog -d
php artisan serve  # Application en SQLite

# Option B : Environnement complet PostgreSQL
docker-compose --profile database up -d

# Option C : Avec outils admin
docker-compose --profile database --profile tools up -d
```

### **Services Docker Disponibles**
- **mailhog** : Simulation emails (toujours disponible)
- **database** : PostgreSQL (profile "database")  
- **adminer** : Interface BDD web (profile "tools")
---

## 🌐 Accès aux Services

### **Méthode Simple (SQLite)**
- **Application** : http://localhost:8000
- **Base de données** : database/database.sqlite (fichier local)

### **Méthode Docker**
- **Application** : http://localhost:8000
- **MailHog (emails)** : http://localhost:8025
- **Adminer (BDD)** : http://localhost:8080 (si profile tools)
- **PostgreSQL** : localhost:5432 (si profile database)

### **Vérification des Services**
```bash
# PHP simple
php artisan serve  # Affiche l'URL d'accès

# Docker
docker-compose ps  # Liste les services actifs
```
```bash
# Voir quels ports sont utilisés
netstat -tulpn | grep :8000
netstat -tulpn | grep :5432

# Ou sur macOS
lsof -i :8000
lsof -i :5432
```

---

## 🛠 Commandes de Gestion

### **Services Docker**
```bash
# Démarrer tous les services
make start
# ou
docker-compose -f docker/docker-compose.yml up -d

# Arrêter tous les services
make stop
# ou
docker-compose -f docker/docker-compose.yml down

# Voir les logs
make logs
# ou
docker-compose -f docker/docker-compose.yml logs -f

# Reconstruire les images
docker-compose -f docker/docker-compose.yml build --no-cache
```

### **Développement**
```bash
# Terminal dans le container Laravel
make shell
# ou
docker-compose -f docker/docker-compose.yml exec app bash

# Commandes Laravel Artisan
make artisan cmd="route:list"
# ou
docker-compose -f docker/docker-compose.yml exec app php artisan route:list

# Compilation assets en mode watch
docker-compose -f docker/docker-compose.yml exec app npm run dev
```

---

## 🔄 Workflow de Développement

### **Session de Travail Typique**

1. **Démarrer l'environnement**
   ```bash
   cd bibliotech
   make start
   ```

2. **Ouvrir VS Code**
   ```bash
   code .
   ```

3. **Développer**
   - Modifier les fichiers dans VS Code
   - Tester dans le navigateur (http://localhost:8000)
   - Utiliser les commandes Artisan si nécessaire

4. **Arrêter en fin de session**
   ```bash
   make stop
   ```

### **Modifications Courantes**

**Routes :** `routes/web.php`
```php
Route::get('/nouvelle-route', [Controller::class, 'method'])->name('route.name');
```

**Contrôleurs :** `app/Http/Controllers/`
```bash

---

## 🛠️ Commandes essentielles pour le premier lancement (hors Docker)

Dans le terminal, exécutez :

```bash
composer install           # Installe les dépendances PHP
npm install                # Installe les dépendances JS
cp .env.example .env       # Copie le fichier d'environnement
php artisan key:generate   # Génère la clé d'application
php artisan migrate        # (optionnel) Crée les tables en base
php artisan serve          # Démarre le serveur Laravel
```

Ensuite, ouvrez l’application sur http://localhost:8000.

---

## 🚀 Installation & Démarrage universelle

Utilisez les scripts suivants pour installer et démarrer le projet, quel que soit l'environnement :

```bash
bash scripts/install.sh      # Installation automatique
bash scripts/start.sh        # Démarrage du serveur Laravel
bash scripts/check.sh        # Diagnostic (optionnel)
```
- Accès via http://localhost:8000

**Remarques :**
- Le script `install.sh` détecte automatiquement l’environnement (Codespace, Docker, local) et configure tout.
- Le script `start.sh` attend la base de données, lance le serveur Laravel et affiche l’URL d’accès.
- Pour vérifier l’installation, utilisez `bash scripts/check.sh`.
