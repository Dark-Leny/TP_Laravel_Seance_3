# 🎯 Évaluation des Compétences - Séance 2

**Valider vos acquis en base de données SQLite, Eloquent ORM et relations**

---

## 🎯 Objectifs de l'Évaluation

Cette évaluation permet de valider votre maîtrise de :
- ✅ **SQLite** et structure de base de données
- ✅ **Migrations Laravel** et gestion de schéma
- ✅ **Modèles Eloquent** et relations
- ✅ **Requêtes optimisées** et performance
- ✅ **Seeders** et gestion des données

**⏱️ Durée :** 45 minutes  
**💯 Notation :** 20 points au total

---

## 📋 Modalités

### **✅ Prérequis**
- Avoir terminé les modules 01 à 05 de la séance 2
- Base de données SQLite opérationnelle
- Modèles Category, Livre, Auteur fonctionnels

### **🔧 Setup de l'Évaluation**

```bash
# 1. Créer une branche d'évaluation
git checkout -b evaluation-seance-02

# 2. Vérifier l'état de la base
php artisan migrate:status
php artisan tinker --execute="echo 'Categories: ' . App\Models\Category::count() . ', Livres: ' . App\Models\Livre::count() . ', Auteurs: ' . App\Models\Auteur::count() . PHP_EOL;"

# 3. Préparer l'environnement
php artisan config:clear
php artisan cache:clear
```

---

## 💻 PARTIE 1 : Migrations et Structure (5 points)

### **📝 Exercice 1.1 : Créer une Table "Emprunts" (3 points)**

Créez une migration pour une table `emprunts` qui gère les emprunts de livres par des utilisateurs.

**Spécifications :**
- `id` : clé primaire
- `utilisateur_id` : clé étrangère vers la table `utilisateurs`
- `livre_id` : clé étrangère vers la table `livres`
- `date_emprunt` : date d'emprunt (obligatoire)
- `date_retour_prevue` : date de retour prévue (obligatoire)
- `date_retour_effective` : date de retour effective (nullable)
- `statut` : enum ('en_cours', 'rendu', 'en_retard') avec défaut 'en_cours'
- `commentaires` : texte optionnel
- `timestamps` automatiques

**Contraintes :**
- Suppression en cascade si l'utilisateur ou le livre est supprimé
- Index sur `statut` et `date_emprunt`

```bash
# Commandes à exécuter
php artisan make:migration create_emprunts_table
# Éditez le fichier puis :
php artisan migrate
```

**📊 Critères d'évaluation :**
- Structure correcte (1 pt)
- Types de colonnes appropriés (1 pt)  
- Contraintes et index (1 pt)

### **📝 Exercice 1.2 : Modifier une Table Existante (2 points)**

Ajoutez une colonne `isbn_13` à la table `livres` pour supporter les ISBN-13 en plus des ISBN-10.

**Spécifications :**
- Colonne `isbn_13` de type string(17)
- Nullable
- Unique
- Index pour les recherches rapides
- Placée après la colonne `isbn` existante

```bash
# Créez et exécutez la migration appropriée
```

**📊 Critères d'évaluation :**
- Migration correcte (1 pt)
- Contraintes appropriées (1 pt)

---

## 🎭 PARTIE 2 : Modèles Eloquent (5 points)

### **📝 Exercice 2.1 : Créer le Modèle Emprunt (3 points)**

Créez le modèle `Emprunt` avec toutes les relations et fonctionnalités nécessaires.

```bash
php artisan make:model Emprunt
```

**Spécifications requises :**
```php
class Emprunt extends Model
{
    // 1. Propriétés de base (fillable, casts, etc.)
    
    // 2. Relations :
    // - belongsTo vers Utilisateur
    // - belongsTo vers Livre
    
    // 3. Scopes :
    // - scopeEnCours() : emprunts en cours
    // - scopeEnRetard() : emprunts en retard
    // - scopeParUtilisateur($query, $userId)
    
    // 4. Accessors/Mutators :
    // - getEstEnRetardAttribute() : boolean
    // - getNombreJoursEmpruntAttribute() : int
    
    // 5. Méthodes personnalisées :
    // - marquerRendu() : marque l'emprunt comme rendu
}
```

**📊 Critères d'évaluation :**
- Structure de base (1 pt)
- Relations correctes (1 pt)
- Scopes et méthodes (1 pt)

### **📝 Exercice 2.2 : Mettre à Jour les Modèles Existants (2 points)**

Ajoutez les relations manquantes dans les modèles `Livre` et `Utilisateur`.

**Dans le modèle Livre :**
```php
// Relation : Un livre peut avoir plusieurs emprunts
public function emprunts()
{
    // À implémenter
}

// Scope : Livres actuellement empruntés
public function scopeEmprunte($query)
{
    // À implémenter
}
```

**Dans le modèle Utilisateur :**
```php
// Relation : Un utilisateur peut avoir plusieurs emprunts
public function emprunts()
{
    // À implémenter
}

// Scope : Utilisateurs ayant des emprunts en cours
public function scopeAvecEmprunts($query)
{
    // À implémenter
}
```

**📊 Critères d'évaluation :**
- Relations ajoutées (1 pt)
- Scopes fonctionnels (1 pt)

---

## 🔍 PARTIE 3 : Requêtes et Relations (5 points)

### **📝 Exercice 3.1 : Requêtes Complexes (3 points)**

Utilisez Tinker pour écrire et exécuter ces requêtes :

```bash
php artisan tinker
```

**Requêtes à implémenter :**

```php
// 1. Afficher tous les livres avec leurs auteurs et catégories (Eager Loading)
>>> // Votre code ici

// 2. Trouver les livres actuellement empruntés avec les informations d'emprunt
>>> // Votre code ici

// 3. Lister les utilisateurs ayant des emprunts en retard
>>> // Votre code ici

// 4. Compter le nombre d'emprunts par catégorie de livre
>>> // Votre code ici

// 5. Trouver les auteurs dont aucun livre n'est actuellement emprunté
>>> // Votre code ici
```

**📊 Critères d'évaluation :**
- Syntaxe Eloquent correcte (1 pt)
- Optimisation (Eager Loading) (1 pt)
- Logique des requêtes (1 pt)

### **📝 Exercice 3.2 : Analyse de Performance (2 points)**

Analysez et optimisez cette requête problématique :

```php
// Code problématique fourni :
$emprunts = Emprunt::all();
foreach ($emprunts as $emprunt) {
    echo $emprunt->utilisateur->nom . " a emprunté " . $emprunt->livre->titre . 
         " de " . $emprunt->livre->auteur->nom_complet . PHP_EOL;
}
```

**Questions :**
1. Identifiez le problème de performance
2. Proposez une version optimisée
3. Calculez le nombre de requêtes avant/après optimisation

**📊 Critères d'évaluation :**
- Identification du problème N+1 (1 pt)
- Solution optimisée (1 pt)

---

## 🌱 PARTIE 4 : Seeders et Données (3 points)

### **📝 Exercice 4.1 : Créer EmpruntSeeder (3 points)**

Créez un seeder qui génère des données d'emprunts cohérentes.

```bash
php artisan make:seeder EmpruntSeeder
```

**Spécifications :**
- Créer 15 emprunts fictifs
- 10 emprunts "en_cours" 
- 3 emprunts "rendu"
- 2 emprunts "en_retard"
- Dates cohérentes (emprunts récents)
- Utiliser des utilisateurs et livres existants

**Code attendu :**
```php
class EmpruntSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer des utilisateurs et livres existants
        // Créer des emprunts avec des statuts variés
        // Assurer la cohérence des dates
    }
}
```

**Mettre à jour DatabaseSeeder :**
```php
public function run(): void
{
    $this->call([
        CategorySeeder::class,
        AuteurSeeder::class,     // Si créé précédemment
        LivreSeeder::class,
        EmpruntSeeder::class,    // ← Ajouter ici
    ]);
}
```

**Test :**
```bash
php artisan db:seed --class=EmpruntSeeder
php artisan tinker --execute="echo 'Emprunts créés: ' . App\Models\Emprunt::count() . PHP_EOL;"
```

**📊 Critères d'évaluation :**
- Structure du seeder (1 pt)
- Données cohérentes (1 pt)
- Intégration complète (1 pt)

---

## ⚡ PARTIE 5 : Cas Pratique Final (2 points)

### **📝 Exercice 5.1 : Fonctionnalité Complète (2 points)**

Implémentez une méthode dans le modèle `Livre` qui retourne un rapport sur l'activité d'emprunt :

```php
// Dans le modèle Livre
public function getRapportEmprunts()
{
    return [
        'titre' => $this->titre,
        'auteur' => $this->auteur->nom_complet,
        'total_emprunts' => // Nombre total d'emprunts
        'emprunts_en_cours' => // Nombre d'emprunts en cours
        'derniere_emprunt' => // Date du dernier emprunt (format 'd/m/Y')
        'utilisateur_frequent' => // Nom de l'utilisateur qui a le plus emprunté ce livre
    ];
}
```

**Test de validation :**
```php
// Dans Tinker
>>> $livre = App\Models\Livre::first()
>>> $rapport = $livre->getRapportEmprunts()
>>> print_r($rapport)
```

**📊 Critères d'évaluation :**
- Logique correcte (1 pt)
- Optimisation et performance (1 pt)

---

## 📊 Grille d'Évaluation

| 📋 Partie | 💯 Points | ✅ Acquis | 📈 En cours | ❌ Non acquis |
|-----------|-----------|-----------|-------------|---------------|
| **Migrations** | 5 pts | 4-5 pts | 2-3 pts | 0-1 pts |
| **Modèles Eloquent** | 5 pts | 4-5 pts | 2-3 pts | 0-1 pts |
| **Requêtes/Relations** | 5 pts | 4-5 pts | 2-3 pts | 0-1 pts |
| **Seeders** | 3 pts | 3 pts | 1-2 pts | 0 pts |
| **Cas Pratique** | 2 pts | 2 pts | 1 pt | 0 pts |
| **TOTAL** | **20 pts** | **17-20** | **9-16** | **0-8** |

### **🎯 Seuils de Validation**

- **🏆 Excellent (17-20 pts)** : Maîtrise complète, prêt pour des projets complexes
- **✅ Acquis (12-16 pts)** : Bonnes bases, quelques approfondissements nécessaires
- **📈 En cours (8-11 pts)** : Bases fragiles, révision recommandée
- **❌ Non acquis (0-7 pts)** : Reprendre les modules de formation

---

## 🔄 Après l'Évaluation

### **✅ Si Réussite**

```bash
# Committer votre travail
git add .
git commit -m "✅ Évaluation Séance 2 réussie - Score: XX/20"
git checkout seance-02-database-sqlite
git merge evaluation-seance-02
```

**🚀 Prochaines étapes :**
1. **Séance 3** : CRUD et formulaires web
2. **Projet final** : Application complète
3. **Déploiement** : Mise en production

### **📈 Si À Améliorer**

**Plan de révision personnalisé :**

```bash
# Identifier les points faibles
# Score < 5 en Migrations → Revoir 04-TP-MIGRATIONS.md
# Score < 5 en Eloquent → Revoir 01-CONCEPTS-DATABASE.md + 02-GLOSSAIRE-ELOQUENT.md
# Score < 5 en Requêtes → Revoir 05-EXERCICES-PRATIQUES.md

# Refaire l'évaluation après révision
```

---

## 🎉 Validation Finale

Une fois l'évaluation terminée, validez vos acquis avec cette checklist :

### **🏆 Compétences Maîtrisées**

- [ ] **SQLite** : Je comprends les bases de données relationnelles
- [ ] **Migrations** : Je crée et modifie des structures de tables
- [ ] **Eloquent ORM** : Je manipule les données avec des objets
- [ ] **Relations** : Je gère les liens entre les données (1-N, N-1)
- [ ] **Requêtes** : J'écris des requêtes optimisées
- [ ] **Performance** : J'évite le problème N+1
- [ ] **Seeders** : Je peuple la base avec des données cohérentes

### **🚀 Prêt pour la Suite**

- [ ] Base de données bien structurée
- [ ] Relations fonctionnelles
- [ ] Code optimisé et documenté
- [ ] Bonnes pratiques appliquées

---

**🎊 Félicitations pour avoir terminé l'évaluation de la Séance 2 !**

> 💡 Cette évaluation valide vos compétences fondamentales en base de données Laravel. Vous êtes maintenant prêt(e) à construire des applications web robustes !