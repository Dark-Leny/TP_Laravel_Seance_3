# 💪 TP Pratique : Exercices Avancés Autonomes

**5 modules d'exercices progressifs pour maîtriser les contrôleurs et vues**

---

## 🎯 Objectifs Généraux

À la fin de ces exercices, vous serez capable de :
- ✅ **Développer des interfaces** utilisateur sophistiquées
- ✅ **Optimiser les performances** des contrôleurs et requêtes
- ✅ **Créer des composants** Blade réutilisables
- ✅ **Implémenter des fonctionnalités** avancées (recherche, filtres, export)
- ✅ **Maîtriser la validation** complexe et personnalisée

**⏱️ Durée totale :** 75 minutes (15 min par module)
**🎓 Niveau :** Autonome (solutions disponibles séparément)
**📝 Recommandation :** Choisir 3-4 modules selon le niveau de la classe

---

## 📋 Vue d'Ensemble des Modules

```
🚀 EXERCICES PROGRESSIFS
│
├── 📊 Module 1: Recherche et Filtres Avancés (15 min)
│   ├── Recherche multi-critères
│   ├── Filtres par date et statut
│   └── URL avec paramètres persistants
│
├── 🎨 Module 2: Composants Blade Avancés (15 min)
│   ├── Composant livre-card personnalisable
│   ├── Composant pagination custom
│   └── Composant formulaire réutilisable
│
├── ✅ Module 3: Validation Personnalisée (15 min)
│   ├── Règles de validation custom
│   ├── Form Request classes
│   └── Messages d'erreur personnalisés
│
├── 📱 Module 4: Interface Mobile & UX (15 min)
│   ├── Menu mobile optimisé
│   ├── Modales et notifications
│   └── Loading states et feedback
│
└── ⚡ Module 5: Performance & Export (15 min)
    ├── Optimisation des requêtes
    ├── Export PDF/Excel
    └── Cache et mémorisation
```

---

## 📊 Module 1 : Recherche et Filtres Avancés (12 min)

### **🎯 Objectif :** Implémenter un système de recherche multi-critères avec filtres avancés

### **🏗️ Exercice 1.1 : Recherche Multi-Critères**

**📝 Améliorer la méthode `index` du `LivreController` :**

```php
public function index(Request $request)
{
    $query = Livre::with('categorie');
    
    // TODO: Implémenter la recherche dans titre ET auteur
    if ($request->filled('search')) {
        $searchTerm = $request->search;
        // Recherche dans titre, auteur ET résumé
        // Utiliser whereRaw pour une recherche insensible à la casse
    }
    
    // TODO: Filtre par catégorie
    if ($request->filled('categorie')) {
        // Filtrer par categorie_id
    }
    
    // TODO: Filtre par disponibilité
    if ($request->has('disponible')) {
        // Filtrer selon le statut disponible/indisponible
    }
    
    // TODO: Filtre par période de publication
    if ($request->filled('date_debut') && $request->filled('date_fin')) {
        // Filtrer entre deux dates
    }
    
    // TODO: Tri dynamique
    $sortField = $request->get('sort', 'titre');
    $sortDirection = $request->get('direction', 'asc');
    // Valider les champs de tri autorisés
    
    $livres = $query->orderBy($sortField, $sortDirection)->paginate(12);
    $categories = Categorie::orderBy('nom')->get();
    
    return view('livres.index', compact('livres', 'categories'));
}
```

### **🏗️ Exercice 1.2 : Formulaire de Recherche Avancée**

**📝 Créer un composant `resources/views/components/search-form.blade.php` :**

```blade
{{-- TODO: Créer un formulaire de recherche avec : --}}
{{-- 1. Champ de recherche texte --}}
{{-- 2. Select pour les catégories --}}
{{-- 3. Checkbox pour la disponibilité --}}
{{-- 4. Champs de date (début/fin) --}}
{{-- 5. Select pour le tri (titre, auteur, date) --}}
{{-- 6. Boutons Rechercher et Réinitialiser --}}

@props(['categories'])

<div class="card mb-4">
    <div class="card-header">
        <h5>🔍 Recherche Avancée</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('livres.index') }}">
            {{-- À COMPLÉTER --}}
        </form>
    </div>
</div>
```

### **🏗️ Exercice 1.3 : URL et État Persistants**

**📝 Objectifs :**
- Les paramètres de recherche doivent persister dans l'URL
- Les liens de pagination doivent conserver les filtres
- Bouton "Réinitialiser" pour vider tous les filtres

---

## 🎨 Module 2 : Composants Blade Avancés (12 min)

### **🎯 Objectif :** Créer des composants réutilisables pour améliorer la maintenabilité

### **🏗️ Exercice 2.1 : Composant Livre Card Avancé**

**📝 Créer `resources/views/components/livre-card.blade.php` :**

```blade
@props([
    'livre',
    'showActions' => true,
    'showCategory' => true,
    'compact' => false
])

{{-- TODO: Créer une carte livre avec : --}}
{{-- 1. Mode compact/normal selon le prop --}}
{{-- 2. Actions conditionnelles (voir/modifier/supprimer) --}}
{{-- 3. Badge de disponibilité --}}
{{-- 4. Icônes pour chaque information --}}
{{-- 5. Hover effects CSS --}}

<div class="card h-100 {{ $compact ? 'card-compact' : '' }}">
    {{-- À COMPLÉTER --}}
</div>

@push('styles')
<style>
    .card-compact {
        /* TODO: Styles pour le mode compact */
    }
    .card:hover {
        /* TODO: Effet hover */
    }
</style>
@endpush
```

### **🏗️ Exercice 2.2 : Composant Pagination Personnalisée**

**📝 Créer `resources/views/components/custom-pagination.blade.php` :**

```blade
@props(['paginator'])

{{-- TODO: Créer une pagination avec : --}}
{{-- 1. Informations sur le nombre total --}}
{{-- 2. Sélecteur de nombre d'éléments par page --}}
{{-- 3. Navigation première/dernière page --}}
{{-- 4. Design Bootstrap personnalisé --}}

<div class="pagination-wrapper">
    {{-- À COMPLÉTER --}}
</div>
```

### **🏗️ Exercice 2.3 : Composant Formulaire Réutilisable**

**📝 Créer `resources/views/components/form-field.blade.php` :**

```blade
@props([
    'name',
    'label',
    'type' => 'text',
    'value' => '',
    'options' => [],
    'required' => false,
    'help' => null
])

{{-- TODO: Composant générique pour : --}}
{{-- 1. Input text, number, date, email --}}
{{-- 2. Textarea --}}
{{-- 3. Select avec options --}}
{{-- 4. Checkbox --}}
{{-- 5. Gestion automatique des erreurs --}}
{{-- 6. Texte d'aide optionnel --}}
```

---

## ✅ Module 3 : Validation Personnalisée (12 min)

### **🎯 Objectif :** Créer des règles de validation avancées et des Form Requests

### **🏗️ Exercice 3.1 : Form Request Classes**

**📝 Créer les Form Requests :**

```bash
# TODO: Générer les Form Requests
php artisan make:request StoreLivreRequest
php artisan make:request UpdateLivreRequest
```

**📝 Implémenter `app/Http/Requests/StoreLivreRequest.php` :**

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLivreRequest extends FormRequest
{
    public function authorize()
    {
        // TODO: Logique d'autorisation
        return true;
    }

    public function rules()
    {
        return [
            // TODO: Règles de validation pour création
            // 1. ISBN unique et format valide
            // 2. Date de publication cohérente
            // 3. Validation conditionnelle selon la catégorie
        ];
    }

    public function messages()
    {
        return [
            // TODO: Messages personnalisés en français
        ];
    }

    public function attributes()
    {
        return [
            // TODO: Noms d'attributs en français
        ];
    }
}
```

### **🏗️ Exercice 3.2 : Règles de Validation Personnalisées**

**📝 Créer une règle custom pour l'ISBN :**

```bash
# TODO: Générer une règle personnalisée
php artisan make:rule ValidIsbn
```

**📝 Implémenter la validation ISBN-13 avec checksum :**

```php
<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidIsbn implements Rule
{
    public function passes($attribute, $value)
    {
        // TODO: Implémenter la validation ISBN-13
        // 1. Vérifier la longueur (13 chiffres)
        // 2. Calculer et vérifier le checksum
        // 3. Valider le format (978 ou 979)
    }

    public function message()
    {
        return 'Le :attribute doit être un ISBN-13 valide.';
    }
}
```

### **🏗️ Exercice 3.3 : Validation Conditionnelle**

**📝 Objectifs à implémenter :**
- Si catégorie = "Roman", le résumé devient obligatoire
- Si pages > 1000, ajouter un champ "tome" obligatoire
- Validation de cohérence date de publication vs création

---

## 📱 Module 4 : Interface Mobile & UX (12 min)

### **🎯 Objectif :** Optimiser l'interface pour mobile et améliorer l'expérience utilisateur

### **🏗️ Exercice 4.1 : Navigation Mobile Optimisée**

**📝 Améliorer le layout `resources/views/layouts/app.blade.php` :**

```blade
{{-- TODO: Implémenter : --}}
{{-- 1. Menu hamburger avec animation --}}
{{-- 2. Recherche rapide dans la navbar mobile --}}
{{-- 3. Breadcrumb responsive --}}
{{-- 4. Bottom navigation pour mobile --}}

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    {{-- À COMPLÉTER --}}
</nav>

{{-- TODO: Ajouter bottom navigation pour mobile --}}
<div class="bottom-nav d-lg-none">
    {{-- À COMPLÉTER --}}
</div>

@push('styles')
<style>
    /* TODO: CSS pour mobile */
    @media (max-width: 768px) {
        /* Styles mobile spécifiques */
    }
</style>
@endpush
```

### **🏗️ Exercice 4.2 : Modales et Notifications**

**📝 Créer un système de notifications toast :**

```blade
{{-- TODO: Component notification-toast.blade.php --}}
@props(['type' => 'info', 'message', 'timeout' => 5000])

<div class="toast" data-timeout="{{ $timeout }}">
    {{-- À COMPLÉTER --}}
</div>

@push('scripts')
<script>
// TODO: JavaScript pour auto-hide des toasts
</script>
@endpush
```

### **🏗️ Exercice 4.3 : Loading States et Feedback**

**📝 Objectifs :**
- Spinner de chargement lors des soumissions de formulaire
- Skeleton loading pour la liste des livres
- Feedback visuel pour les actions (boutons disabled, etc.)
- Confirmation inline pour les suppressions

---

## ⚡ Module 5 : Performance & Export (12 min)

### **🎯 Objectif :** Optimiser les performances et ajouter des fonctionnalités d'export

### **🏗️ Exercice 5.1 : Optimisation des Requêtes**

**📝 Améliorer les performances du contrôleur :**

```php
public function index(Request $request)
{
    // TODO: Optimisations à implémenter :
    // 1. Eager loading intelligent selon les besoins
    // 2. Cache des catégories (rarement modifiées)
    // 3. Requête optimisée pour le comptage
    // 4. Index de base de données pour la recherche
    
    $query = Livre::query();
    
    // TODO: N'inclure 'categorie' que si nécessaire
    // TODO: Utiliser select() pour limiter les colonnes
    // TODO: Cache pour les compteurs globaux
    
    return view('livres.index', compact('livres', 'categories'));
}
```

### **🏗️ Exercice 5.2 : Export PDF et Excel**

**📝 Installer les dépendances :**

```bash
# TODO: Installer les packages nécessaires
composer require barryvdh/laravel-dompdf
composer require maatwebsite/excel
```

**📝 Créer les méthodes d'export :**

```php
// Dans LivreController
public function exportPdf(Request $request)
{
    // TODO: Générer un PDF avec la liste filtrée
    // 1. Récupérer les livres selon les filtres actuels
    // 2. Créer une vue spéciale pour PDF
    // 3. Générer et télécharger le PDF
}

public function exportExcel(Request $request)
{
    // TODO: Générer un Excel avec la liste filtrée
    // 1. Utiliser Laravel Excel
    // 2. Formater les données correctement
    // 3. Inclure des totaux et statistiques
}
```

### **🏗️ Exercice 5.3 : Cache et Mémorisation**

**📝 Objectifs :**
- Cache Redis/File pour les catégories
- Mémorisation des recherches fréquentes
- Cache des statistiques (nombre total de livres, etc.)
- Invalidation intelligente du cache

---

## 🎯 Challenges Bonus (Optionnels)

### **🚀 Challenge 1 : API REST**
Créer une API REST complète pour les livres avec :
- Endpoints CRUD complets
- Authentification par token
- Documentation Swagger
- Tests automatisés

### **🚀 Challenge 2 : Interface Administrative**
Développer un panneau d'administration avec :
- Dashboard avec statistiques
- Gestion en lot (bulk actions)
- Import CSV de livres
- Logs d'activité

### **🚀 Challenge 3 : Fonctionnalités Avancées**
Implémenter des fonctionnalités avancées :
- Système de tags/étiquettes
- Favoris utilisateur
- Recommandations intelligentes
- Historique de consultation

---

## ✅ Critères d'Évaluation

### **📊 Barème de Notation (sur 20 points)**

| Critère | Points | Description |
|---------|---------|-------------|
| **Module 1** | 4 pts | Recherche et filtres fonctionnels |
| **Module 2** | 4 pts | Composants réutilisables et bien structurés |
| **Module 3** | 4 pts | Validation robuste et messages clairs |
| **Module 4** | 4 pts | Interface responsive et UX soignée |
| **Module 5** | 4 pts | Optimisations et fonctionnalités avancées |

### **🎯 Niveaux de Compétence**

- **16-20 pts :** Expert - Maîtrise complète des concepts avancés
- **12-15 pts :** Avancé - Bonnes pratiques respectées
- **8-11 pts :** Intermédiaire - Fonctionnalités de base implémentées
- **4-7 pts :** Débutant - Travail à approfondir
- **0-3 pts :** Insuffisant - Revoir les concepts de base

---

## 🆘 Aide et Ressources

### **📚 Documentation Utile**
- [Laravel Validation](https://laravel.com/docs/validation)
- [Blade Components](https://laravel.com/docs/blade#components)
- [Eloquent Performance](https://laravel.com/docs/eloquent#eager-loading)
- [Laravel Excel Documentation](https://docs.laravel-excel.com)

### **💡 Conseils Généraux**
1. **Testez chaque module** avant de passer au suivant
2. **Utilisez Git** pour sauvegarder vos progrès
3. **Commentez votre code** pour expliquer vos choix
4. **Pensez mobile** dès le début
5. **Optimisez progressivement** (d'abord fonctionnel, puis performant)

### **🔧 Outils de Développement**
- **Laravel Debugbar** pour analyser les performances
- **Browser DevTools** pour tester le responsive
- **PHPStorm/VS Code** avec extensions Laravel
- **Postman** pour tester les APIs

---

## 🏁 Validation Finale

### **📋 Checklist de Livraison**

**Module 1 - Recherche :**
- [ ] Recherche multi-critères fonctionnelle
- [ ] Filtres par catégorie et disponibilité
- [ ] Tri dynamique par colonnes
- [ ] URL avec paramètres persistants

**Module 2 - Composants :**
- [ ] Composant livre-card réutilisable
- [ ] Pagination personnalisée
- [ ] Composants de formulaire génériques
- [ ] Styles CSS cohérents

**Module 3 - Validation :**
- [ ] Form Request classes implémentées
- [ ] Règles de validation personnalisées
- [ ] Messages d'erreur en français
- [ ] Validation conditionnelle

**Module 4 - Mobile :**
- [ ] Navigation mobile optimisée
- [ ] Interface responsive
- [ ] Notifications toast
- [ ] Loading states

**Module 5 - Performance :**
- [ ] Requêtes optimisées
- [ ] Export PDF/Excel
- [ ] Cache implémenté
- [ ] Performance mesurée

🎉 **Bravo !** Vous maîtrisez maintenant les aspects avancés des contrôleurs et vues Laravel !