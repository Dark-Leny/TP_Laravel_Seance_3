# 💪 EXERCICES PRATIQUES - SÉANCE 1

## 🎯 **Objectif des Exercices**

Ces exercices vous permettront de **pratiquer concrètement** les concepts vus en séance 1 :
- Architecture MVC de Laravel
- Système de routes et paramètres
- Contrôleurs et passage de données
- Vues Blade et héritage de templates

**⏱️ Durée estimée :** 1h30-2h selon votre niveau

---

## 🚀 **Exercice 1 : Personnaliser la Page d'Accueil (15 min)**

### **🎯 Objectif**
Modifier la page d'accueil pour la personnaliser avec vos informations.

### **📋 Instructions**
1. **Ouvrir** le fichier `resources/views/welcome.blade.php`
2. **Modifier** la section hero pour afficher votre nom d'équipe/classe
3. **Ajouter** votre établissement dans le sous-titre
4. **Personnaliser** les couleurs ou les icônes selon vos préférences

### **💡 Exemple de modification**
```blade
{{-- Dans la section hero --}}
<h1><i class="fas fa-book-open me-3"></i>{{ $appName }} - Lycée Jean Moulin</h1>
<p class="lead">Votre bibliothèque numérique développée par la classe BTS SIO2</p>
<p>Formation Laravel - Équipe de développement : Alice, Bob, Charlie</p>
```

### **✅ Validation**
- [ ] La page d'accueil affiche vos informations personnalisées
- [ ] Le design reste cohérent et professionnel
- [ ] Aucune erreur dans la console du navigateur

---

## 🛣️ **Exercice 2 : Créer une Nouvelle Route (20 min)**

### **🎯 Objectif**
Créer une page "Contact" accessible via une route personnalisée.

### **📋 Instructions**

#### **Étape 1 : Définir la route**
Dans `routes/web.php`, ajouter :
```php
Route::get('/contact', function () {
    return view('contact', [
        'etablissement' => 'Votre Lycée',
        'formation' => 'BTS SIO SLAM',
        'email' => 'contact@votre-lycee.fr',
        'telephone' => '01 23 45 67 89',
        'adresse' => '123 Rue de l\'École, 75000 Paris'
    ]);
})->name('contact');
```

#### **Étape 2 : Créer la vue**
Créer le fichier `resources/views/contact.blade.php` :
```blade
@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-envelope me-2"></i>Contactez-nous</h3>
                </div>
                <div class="card-body">
                    <h5>{{ $etablissement }}</h5>
                    <p class="text-muted">{{ $formation }}</p>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-envelope me-2"></i>Email</h6>
                            <p>{{ $email }}</p>
                            
                            <h6><i class="fas fa-phone me-2"></i>Téléphone</h6>
                            <p>{{ $telephone }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-map-marker-alt me-2"></i>Adresse</h6>
                            <p>{{ $adresse }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```

#### **Étape 3 : Ajouter le lien dans la navigation**
Dans `resources/views/layouts/app.blade.php`, ajouter dans le menu :
```blade
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
        <i class="fas fa-envelope me-1"></i>Contact
    </a>
</li>
```

### **✅ Validation**
- [ ] La page `/contact` s'affiche correctement
- [ ] Le lien "Contact" apparaît dans la navigation
- [ ] Le lien est actif quand on est sur la page contact
- [ ] Toutes vos données personnalisées s'affichent

---

## 📚 **Exercice 3 : Ajouter des Livres au Catalogue (25 min)**

### **🎯 Objectif**
Enrichir le catalogue avec 3 nouveaux livres de votre choix.

### **📋 Instructions**

#### **Étape 1 : Modifier le contrôleur**
Dans `app/Http/Controllers/BookController.php`, ajouter vos livres dans la méthode `index()` :

```php
// Ajouter après le livre ID 5
[
    'id' => 6,
    'titre' => 'Votre Titre de Livre',
    'auteur' => 'Votre Auteur Préféré',
    'isbn' => '978-2-1234-5683-3',
    'annee_publication' => 2024,
    'pages' => 300,
    'disponible' => true, // ou false
    'description' => 'Description détaillée de votre livre...',
    'couverture' => 'https://via.placeholder.com/200x300/[COULEUR]/FFFFFF?text=TITRE',
    'categorie' => 'Votre Catégorie',
    'language' => 'Français',
    'publisher' => 'Votre Éditeur'
],
// Répéter pour les livres 7 et 8
```

#### **Étape 2 : Mettre à jour les statistiques**
Ajuster les statistiques dans la route d'accueil (`routes/web.php`) :
```php
Route::get('/', function () {
    return view('welcome', [
        'appName' => config('app.name'),
        'totalBooks' => 8, // Mis à jour
        'availableBooks' => 6 // À ajuster selon vos livres
    ]);
})->name('home');
```

#### **Étape 3 : Ajouter dans la méthode show()**
N'oublier pas d'ajouter vos nouveaux livres dans le tableau de la méthode `show()` également.

### **💡 Idées de livres techniques**
- "JavaScript Moderne" par Emma Développeuse
- "Git & GitHub pour les Nuls" par Pierre Versioning  
- "CSS Grid & Flexbox" par Marie Design
- "Sécurité Web" par Alex Hacker
- "API RESTful" par Sophie Backend

### **✅ Validation**
- [ ] Le catalogue affiche maintenant 8 livres
- [ ] Les nouveaux livres ont des informations complètes
- [ ] Les statistiques sur la page d'accueil sont correctes
- [ ] On peut accéder aux détails des nouveaux livres

---

## 🔧 **Exercice 4 : Route avec Paramètres Multiples (30 min)**

### **🎯 Objectif**
Créer une route démonstrant l'utilisation de plusieurs paramètres.

### **📋 Instructions**

#### **Étape 1 : Créer la route**
Dans `routes/web.php`, ajouter :
```php
Route::get('/livre/{id}/chapitre/{chapter}', function($id, $chapter) {
    // Simuler des chapitres pour nos livres
    $chaptersData = [
        1 => [ // Laravel pour les Débutants
            1 => 'Introduction à Laravel',
            2 => 'Installation et Configuration', 
            3 => 'Vos Premières Routes',
            4 => 'Les Contrôleurs MVC'
        ],
        2 => [ // Docker en Action
            1 => 'Qu\'est-ce que Docker ?',
            2 => 'Installation Docker',
            3 => 'Premiers Containers',
            4 => 'Docker Compose'
        ],
        3 => [ // Architecture MVC Expliquée
            1 => 'Les Patterns Architecturaux',
            2 => 'Le Pattern MVC',
            3 => 'Implémentation Pratique',
            4 => 'Avantages et Inconvénients'
        ]
    ];
    
    // Vérifier que le livre existe
    if (!isset($chaptersData[$id])) {
        abort(404, 'Livre non trouvé');
    }
    
    // Vérifier que le chapitre existe
    if (!isset($chaptersData[$id][$chapter])) {
        abort(404, 'Chapitre non trouvé');
    }
    
    $chapterTitle = $chaptersData[$id][$chapter];
    $totalChapters = count($chaptersData[$id]);
    
    return view('demo.chapter', [
        'bookId' => $id,
        'chapterNumber' => $chapter,
        'chapterTitle' => $chapterTitle,
        'totalChapters' => $totalChapters,
        'allChapters' => $chaptersData[$id]
    ]);
})->where(['id' => '[0-9]+', 'chapter' => '[0-9]+'])
  ->name('demo.chapter');
```

#### **Étape 2 : Créer la vue**
Créer le dossier et fichier `resources/views/demo/chapter.blade.php` :
```blade
@extends('layouts.app')

@section('title', "Chapitre $chapterNumber - $chapterTitle")

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('books.index') }}">Catalogue</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('books.show', $bookId) }}">Livre {{ $bookId }}</a>
    </li>
    <li class="breadcrumb-item active">Chapitre {{ $chapterNumber }}</li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- En-tête du chapitre -->
            <div class="card border-primary mb-4">
                <div class="card-header bg-primary text-white">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">
                                <i class="fas fa-bookmark me-2"></i>
                                Chapitre {{ $chapterNumber }}
                            </h3>
                            <p class="mb-0 opacity-75">{{ $chapterTitle }}</p>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-light text-primary fs-6">
                                {{ $chapterNumber }} / {{ $totalChapters }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenu du chapitre -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4>{{ $chapterTitle }}</h4>
                    <p class="text-muted">
                        Contenu du chapitre {{ $chapterNumber }} du livre {{ $bookId }}.
                    </p>
                    
                    <!-- Contenu simulé -->
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Démonstration :</strong> Cette page montre l'utilisation de <strong>plusieurs paramètres</strong> 
                        dans une route Laravel : <code>/livre/{id}/chapitre/{chapter}</code>
                    </div>
                    
                    <p>
                        Ce chapitre fait partie du livre n°{{ $bookId }} et correspond au chapitre {{ $chapterNumber }} 
                        sur un total de {{ $totalChapters }} chapitres.
                    </p>
                </div>
            </div>

            <!-- Navigation entre chapitres -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5><i class="fas fa-list me-2"></i>Navigation dans le livre</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($chapterNumber > 1)
                                <a href="{{ route('demo.chapter', [$bookId, $chapterNumber - 1]) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-chevron-left me-2"></i>Chapitre précédent
                                </a>
                            @else
                                <button class="btn btn-outline-secondary" disabled>
                                    <i class="fas fa-chevron-left me-2"></i>Premier chapitre
                                </button>
                            @endif
                        </div>
                        <div class="col-md-4 text-center">
                            <a href="{{ route('books.show', $bookId) }}" class="btn btn-primary">
                                <i class="fas fa-book me-2"></i>Retour au livre
                            </a>
                        </div>
                        <div class="col-md-4 text-end">
                            @if($chapterNumber < $totalChapters)
                                <a href="{{ route('demo.chapter', [$bookId, $chapterNumber + 1]) }}" class="btn btn-outline-primary">
                                    Chapitre suivant<i class="fas fa-chevron-right ms-2"></i>
                                </a>
                            @else
                                <button class="btn btn-outline-secondary" disabled>
                                    Dernier chapitre<i class="fas fa-chevron-right ms-2"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table des matières -->
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-list-ol me-2"></i>Tous les chapitres</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach($allChapters as $num => $title)
                            <div class="list-group-item {{ $num == $chapterNumber ? 'active' : '' }}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Chapitre {{ $num }}</strong> - {{ $title }}
                                    </div>
                                    <div>
                                        @if($num == $chapterNumber)
                                            <span class="badge bg-primary">Actuel</span>
                                        @else
                                            <a href="{{ route('demo.chapter', [$bookId, $num]) }}" class="btn btn-sm btn-outline-primary">
                                                Lire
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```

### **✅ Validation**
- [ ] L'URL `/livre/1/chapitre/1` fonctionne
- [ ] La navigation entre chapitres est opérationnelle  
- [ ] Les contraintes de paramètres fonctionnent (erreur 404 si paramètres invalides)
- [ ] Le breadcrumb affiche le bon chemin

---

## 🎨 **Exercice 5 : Personnaliser le Design (20 min)**

### **🎯 Objectif**
Personnaliser l'apparence de BiblioTech avec vos propres couleurs.

### **📋 Instructions**

#### **Étape 1 : Créer un fichier CSS personnalisé**
Dans `resources/css/app.css`, ajouter :
```css
/* Couleurs personnalisées */
:root {
    --primary-color: #your-color-here; /* Remplacer par votre couleur */
    --secondary-color: #your-secondary-color;
    --accent-color: #your-accent-color;
}

/* Navbar personnalisée */
.navbar-primary {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
}

/* Cartes de livres avec effet personnalisé */
.book-card-custom {
    border-left: 4px solid var(--accent-color);
    transition: all 0.3s ease;
}

.book-card-custom:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

/* Hero section avec dégradé personnalisé */
.hero-custom {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
}
```

#### **Étape 2 : Appliquer les classes dans les vues**
Modifier `resources/views/welcome.blade.php` :
```blade
{{-- Remplacer la classe hero-section par hero-custom --}}
<div class="hero-custom rounded p-5">
```

Modifier `resources/views/layouts/app.blade.php` :
```blade
{{-- Remplacer bg-primary par navbar-primary --}}
<nav class="navbar navbar-expand-lg navbar-dark navbar-primary">
```

#### **Étape 3 : Compiler les assets**
```bash
npm run build
```

### **💡 Suggestions de couleurs**
- **Bleu moderne :** `#2563eb`, `#3b82f6`, `#60a5fa`
- **Vert tech :** `#059669`, `#10b981`, `#34d399`  
- **Violet créatif :** `#7c3aed`, `#8b5cf6`, `#a78bfa`
- **Orange énergique :** `#ea580c`, `#f97316`, `#fb923c`

### **✅ Validation**
- [ ] Les nouvelles couleurs s'appliquent correctement
- [ ] L'interface reste lisible et professionnelle
- [ ] Les animations fonctionnent
- [ ] Le design est cohérent sur toutes les pages

---

## 🔍 **Exercice Bonus : Route de Recherche Avancée (25 min)**

### **🎯 Objectif**
Améliorer la fonctionnalité de recherche avec des paramètres multiples.

### **📋 Instructions**

#### **Étape 1 : Nouvelle route de recherche**
```php
Route::get('/recherche-avancee/{category?}/{year?}', function($category = null, $year = null) {
    // Récupérer tous les livres (même données que BookController)
    $allBooks = [
        // ... copier le tableau des livres du BookController
    ];
    
    $filteredBooks = collect($allBooks);
    
    // Filtrer par catégorie si spécifiée
    if ($category) {
        $filteredBooks = $filteredBooks->filter(function($book) use ($category) {
            return strtolower($book['category']) === strtolower($category);
        });
    }
    
    // Filtrer par année si spécifiée
    if ($year) {
        $filteredBooks = $filteredBooks->filter(function($book) use ($year) {
            return $book['publication_year'] == $year;
        });
    }
    
    return view('books.advanced-search', [
        'books' => $filteredBooks->values()->all(),
        'category' => $category,
        'year' => $year,
        'totalFound' => $filteredBooks->count()
    ]);
})->where(['year' => '[0-9]{4}'])->name('books.advanced-search');
```

#### **Étape 2 : Créer la vue**
Créer `resources/views/books/advanced-search.blade.php` :
```blade
@extends('layouts.app')

@section('title', 'Recherche Avancée')

@section('content')
<div class="container">
    <h1><i class="fas fa-filter me-3"></i>Recherche Avancée</h1>
    
    <div class="alert alert-info">
        <strong>{{ $totalFound }}</strong> livre(s) trouvé(s)
        @if($category) dans la catégorie "<strong>{{ $category }}</strong>" @endif
        @if($year) pour l'année <strong>{{ $year }}</strong> @endif
    </div>
    
    <!-- Liens de filtrage rapide -->
    <div class="mb-4">
        <h6>Filtrer par catégorie :</h6>
        <a href="{{ route('books.advanced-search', ['Développement Web']) }}" class="btn btn-sm btn-outline-primary me-2">Développement Web</a>
        <a href="{{ route('books.advanced-search', ['DevOps']) }}" class="btn btn-sm btn-outline-success me-2">DevOps</a>
        <a href="{{ route('books.advanced-search', ['Architecture']) }}" class="btn btn-sm btn-outline-info">Architecture</a>
    </div>
    
    <!-- Affichage des résultats -->
    <div class="row">
        @forelse($books as $book)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5>{{ $book['title'] }}</h5>
                        <p class="text-muted">{{ $book['author'] }}</p>
                        <p><span class="badge bg-secondary">{{ $book['category'] }}</span></p>
                        <p><small>{{ $book['publication_year'] }}</small></p>
                        <a href="{{ route('books.show', $book['id']) }}" class="btn btn-primary">Détails</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>Aucun livre ne correspond à ces critères.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
```

### **✅ Validation**
- [ ] `/recherche-avancee/DevOps` filtre par catégorie
- [ ] `/recherche-avancee/DevOps/2024` filtre par catégorie ET année
- [ ] Les liens de filtrage rapide fonctionnent
- [ ] Le compteur de résultats est correct

---

## 📊 **Auto-évaluation**

### **✅ Checklist de Réussite**

**Niveau Débutant :** 
- [ ] Exercice 1 terminé : Page d'accueil personnalisée
- [ ] Exercice 2 terminé : Route contact créée
- [ ] Navigation mise à jour avec nouveaux liens

**Niveau Intermédiaire :**
- [ ] Exercice 3 terminé : 3 nouveaux livres ajoutés
- [ ] Exercice 4 terminé : Route multi-paramètres fonctionnelle
- [ ] Statistiques cohérentes dans toute l'application

**Niveau Avancé :**
- [ ] Exercice 5 terminé : Design personnalisé
- [ ] Exercice bonus terminé : Recherche avancée
- [ ] Code propre et bien commenté

### **🎯 Compétences Validées**

Après ces exercices, vous maîtrisez :
- ✅ **Routes Laravel** : simples, paramétrées, optionnelles
- ✅ **Contrôleurs** : passage de données aux vues
- ✅ **Vues Blade** : héritage, sections, variables
- ✅ **Navigation** : liens actifs, routes nommées
- ✅ **CSS** : personnalisation et compilation

## 🎉 **Félicitations !**

Vous avez terminé tous les exercices de la **Séance 1** ! 

Vous êtes maintenant prêt(e) pour la **Séance 2** où nous aborderons :
- 🗄️ Base de données et migrations
- 🔗 Modèles Eloquent et relations
- 🔄 CI/CD avec GitHub Actions

**Prochaine étape :** Consulter [EVALUATION.md](EVALUATION.md) pour valider vos acquis.