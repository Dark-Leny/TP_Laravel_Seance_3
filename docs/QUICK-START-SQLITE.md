# 🚀 Guide de Démarrage Rapide - BiblioTech Laravel SQLite

## Installation Express (2 minutes)

### 1️⃣ Installation automatique
```bash
# Double-cliquez sur ce fichier
scripts\install.bat
```

### 2️⃣ Démarrage automatique  
```bash
# Double-cliquez sur ce fichier
scripts\start-simple.bat
```

### 3️⃣ Tester l'application
Naviguez vers **http://localhost:8000** et testez :
- ✅ `/` : Page d'accueil avec statistiques
- ✅ `/livres` : Liste des livres français
- ✅ `/livre/1` : Détail du premier livre
- ✅ `/test` : Test de fonctionnement simple

## Configuration Base de Données SQLite

Le projet utilise **SQLite** pour la simplicité :
- **Fichier** : `database/database.sqlite` (créé automatiquement)
- **Configuration** : Dans `.env` → `DB_CONNECTION=sqlite`
- **Avantages** : Aucune installation de serveur MySQL/PostgreSQL requise

### Environnement .env
```env
APP_NAME=BiblioTech
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
CACHE_DRIVER=file
SESSION_DRIVER=file
```

## Routes Françaises

| URL | Description | Contrôleur |
|-----|-------------|------------|
| http://localhost:8000/ | Accueil avec statistiques | AccueilController |
| http://localhost:8000/livres | Liste des livres | LivreController@index |
| http://localhost:8000/livre/1 | Détail livre ID 1 | LivreController@show |
| http://localhost:8000/recherche | Recherche de livres | LivreController@search |

## Troubleshooting SQLite

### ❌ Erreur "database locked"
```bash
# Arrêtez le serveur (Ctrl+C) et relancez
php artisan serve
```

### ❌ Base de données corrompue
```bash
# Recréez la base SQLite
del database\database.sqlite
type nul > database\database.sqlite
php artisan migrate
```

### ❌ Erreur de permissions
```bash
# Vérifiez les permissions du dossier database/
icacls database /grant Everyone:F /T
```

## Commandes SQLite Utiles

```bash
# Voir le statut des migrations
php artisan migrate:status

# Remettre à zéro et migrer
php artisan migrate:fresh

# Voir la base de données (si sqlite3 installé)
sqlite3 database\database.sqlite
.tables
.schema
.quit
```

---
*✅ Projet BiblioTech Laravel avec SQLite fonctionnel !*