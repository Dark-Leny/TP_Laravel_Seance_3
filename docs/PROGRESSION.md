# 📋 PROGRESSION - Formation Laravel BiblioTech

> **Plan de cours simple** pour 8 séances de 3h

---

## 🎯 **VUE D'ENSEMBLE**

### **📊 Résumé Formation**
- **Durée** : 24h (8 séances × 3h)
- **Public** : BTS SIO SLAM
- **Projet** : Application BiblioTech (gestion bibliothèque)
- **Base de données** : SQLite (simple et portable)
- **Environnement** : PHP local ou GitHub Codespace

### **🏆 Objectif Final**
À la fin, chaque étudiant a une application Laravel complète avec SQLite qu'il peut présenter en entretien d'embauche.

---

## 📅 **PROGRAMME DÉTAILLÉ**

### **🎯 SÉANCE 1 : Fondations (3h)**
**Objectif** : Comprendre Laravel et créer ses premières pages

#### **Contenu**
- **Installation** : PHP + Laravel avec SQLite
- **MVC** : Model-View-Controller expliqué simplement
- **Routes** : Créer URLs pour accéder aux pages
- **Blade** : Templates pour afficher les pages
- **SQLite** : Base de données simple et portable

#### **Exercices**
- Installer avec `php artisan serve`
- Créer route `/contact`
- Afficher liste des livres
- Personnaliser page d'accueil
- Navigation entre pages

#### **Validation**
- Application fonctionne avec SQLite
- 3 routes créées et fonctionnelles
- Compréhension flux : URL → Contrôleur → Vue

---

### **🗄️ SÉANCE 2 : Base de Données SQLite (3h)**
**Objectif** : Remplacer les données en dur par une base SQLite

#### **Contenu**
- **SQLite** : Avantages pour développement et formation
- **Migrations** : Créer tables dans le fichier SQLite
- **Modèles Eloquent** : Interagir avec SQLite en PHP
- **Relations** : Liens entre tables (livre → catégorie)
- **Seeders** : Remplir SQLite avec des données de test

#### **Exercices**
 - Créer table `livres` et `categories` dans SQLite
 - Modèles `Livre` et `Catégorie` avec relations
- Afficher livres depuis la base SQLite
- Ajouter données via seeders

#### **Validation**
- Base SQLite fonctionnelle
- Données affichées depuis SQLite
- Relations entre livres et catégories
- Fichier `database/database.sqlite` présent

---

### **✏️ SÉANCE 3 : CRUD + Formulaires (3h)**
**Objectif** : Permettre d'ajouter, modifier, supprimer des livres

#### **Contenu**
- **CRUD** : Create, Read, Update, Delete
- **Formulaires HTML** : Saisie de données
- **Validation** : Vérifier les données saisies
- **Messages flash** : Retours utilisateur
- **Transactions SQLite** : Intégrité des données

#### **Exercices**
- Formulaire d'ajout de livre
- Page modification livre existant
- Suppression avec confirmation
- Validation des champs obligatoires

#### **Validation**
- Toutes opérations CRUD fonctionnelles
- Validation côté serveur active
- Messages d'erreur/succès affichés
- Données persistées dans SQLite

---

### **🔐 SÉANCE 4 : Authentification (3h)**
**Objectif** : Système de connexion utilisateurs avec SQLite

#### **Contenu**
- **Register/Login** : Inscription et connexion
- **Sessions** : Maintenir utilisateur connecté (fichier)
- **Middleware** : Protéger certaines pages
- **Rôles** : Admin vs utilisateur normal
- **Tables utilisateurs** : Stockage dans SQLite

#### **Exercices**
- Pages inscription/connexion
- Protection page admin
- Affichage conditionnel selon rôle
- Déconnexion

#### **Validation**
- Système auth complet
- Pages protégées fonctionnelles
- Différenciation admin/utilisateur

---

### **🔗 SÉANCE 5 : Relations Avancées + API (3h)**
**Objectif** : Données complexes et API pour mobile avec SQLite

#### **Contenu**
- **Relations avancées** : Many-to-many (auteurs ↔ livres)
- **API REST** : Endpoints JSON avec SQLite
- **Postman** : Tester l'API
- **Sanctum** : Authentification API

#### **Exercices**
 - Table pivot `auteur_livre` dans SQLite
 - Points d'API `/api/livres` utilisant SQLite
- Tests API avec Postman
- Protection API par tokens

#### **Validation**
- Relations complexes dans SQLite fonctionnelles
- API REST avec données SQLite opérationnelle
- Tests API passent

---

### **🔍 SÉANCE 6 : Recherche + Performance SQLite (3h)**
**Objectif** : Optimiser l'application SQLite

#### **Contenu**
- **Recherche fulltext SQLite** : Chercher dans titre/auteur/contenu
- **Index SQLite** : Améliorer performances
- **Pagination** : Diviser résultats par pages
- **Cache** : Accélérer l'application
- **Optimisation requêtes SQLite** : N+1 queries

#### **Exercices**
- Barre de recherche avec FTS SQLite
- Index SQLite pour performances
- Pagination des résultats
- Mise en cache des catégories
- Optimisation requêtes SQLite

#### **Validation**
- Recherche fulltext SQLite fonctionnelle
- Navigation pagination fluide
- Performance améliorée mesurable
- Index créés correctement

---

### **🚀 SÉANCE 7 : Technologies Avancées (3h)**
**Objectif** : Fonctionnalités innovantes avec SQLite

#### **Contenu**
- **QR Codes** : Génération pour chaque livre
- **API IA** : Recommandations via OpenAI
- **WebSockets** : Notifications temps réel
- **PWA** : Application mobile-like
- **Comparaison SQLite/PostgreSQL** : Migration optionnelle

#### **Exercices**
- QR code sur page livre
- Recommandations IA basées sur historique SQLite
- Notifications emprunts temps réel
- Installation app sur mobile
- Option : Migration vers PostgreSQL

#### **Validation**
- Au moins 2 features avancées implémentées
- QR codes fonctionnels
- Intégration IA basique
- Compréhension différences BDD

---

### **🌐 SÉANCE 8 : Production + Migration BDD (3h)**
**Objectif** : Déployer l'application et comprendre les options BDD

#### **Contenu**
- **Tests automatisés** : Vérifier que tout marche
- **SQLite → PostgreSQL** : Migration pour production
- **Hébergement** : Mettre en ligne avec base adaptée
- **Monitoring** : Surveillance erreurs

#### **Exercices**
- Tests unitaires et fonctionnels
- Optionnel : Migration vers PostgreSQL
- Déploiement avec base adaptée (SQLite ou PostgreSQL)
- Configuration SSL + domaine

#### **Validation**
- Application en ligne et accessible
- Tests automatiques passent  
- Compréhension choix SQLite vs PostgreSQL
- Pipeline déploiement fonctionne

---

## 📊 **PRÉREQUIS PAR SÉANCE**

| Séance | Prérequis Étudiant | Prérequis Formateur |
|--------|-------------------|-------------------|
| **1** | Bases HTML/CSS, PHP installé | Connaître Laravel + SQLite |
| **2** | S1 validée + SQLite | Tester migrations SQLite |
| **3** | S2 validée | Exemples validation |
| **4** | S3 validée | Démo auth Laravel |
| **5** | S4 validée | API Postman préparée |
| **6** | S5 validée | FTS SQLite + benchmarks |
| **7** | S6 validée | Comptes APIs (OpenAI) |
| **8** | S7 validée | Hébergement configuré |

---

## 💾 **PROGRESSSION BASE DE DONNÉES**

### **🎯 Approche Pédagogique**
1. **Séances 1-4** : SQLite pur (apprentissage bases)
2. **Séances 5-6** : SQLite optimisé (FTS, index, performance)
3. **Séances 7-8** : Options PostgreSQL (production, comparaison)

### **Avantages SQLite Formation**
- ✅ **Installation zéro** - Pas de serveur séparé
- ✅ **Portable** - Fichier unique transportable
- ✅ **Débogage facile** - Outils visuels simples
- ✅ **Performance** - Idéal pour développement
- ✅ **BTS SIO** - Suffisant pour toutes compétences

### **Quand introduire PostgreSQL**
- **Séance 7** : Optionnel, pour comparer
- **Séance 8** : Si déploiement nécessite
- **Jamais obligatoire** : SQLite couvre 100% programme BTS

---

## 🎯 **VALIDATION DE PASSAGE**

### **Critères pour passer à la séance suivante**
- **Note ≥ 12/20** à l'évaluation séance
- **Exercices principaux** terminés et fonctionnels
- **Compréhension concepts** vérifiée (questions/réponses)

---


## 🔄 **ADAPTATION POSSIBLE**

### **Si groupe avancé**
- Exercices bonus chaque séance
- Séance 7 peut inclure plus de technologies
- Projet personnel libre en parallèle

### **Si groupe en difficulté**
- Réduire contenu séances 7-8
- Plus d'exercices guidés
- Sessions rattrapage intermédiaires

---



🎯 **Cette progression garantit une montée en compétences régulière et maîtrisée, du débutant à un niveau professionnel junior en Laravel !**