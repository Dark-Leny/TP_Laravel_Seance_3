#!/bin/bash

echo "🔧 CORRECTION AUTOMATIQUE - Option A"
echo "===================================="
echo "Mise à jour du code pour correspondre aux exercices"
echo

# Couleurs
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Fonction de confirmation
confirm() {
    read -p "$(echo -e ${YELLOW}$1${NC}) [y/N] " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        return 0
    else
        return 1
    fi
}

echo -e "${YELLOW}⚠️  Cette opération va modifier le code source${NC}"
echo "Les changements incluent:"
echo "  • Renommer Categorie → Category"
echo "  • Ajouter colonnes icone et active"
echo "  • Mettre à jour toutes les relations"
echo "  • Corriger les seeders"
echo

if ! confirm "Voulez-vous continuer ?"; then
    echo -e "${RED}❌ Opération annulée${NC}"
    exit 1
fi

echo
echo -e "${GREEN}🚀 Début des corrections...${NC}"
echo

# ÉTAPE 1: Renommer le modèle Categorie → Category
echo "📝 ÉTAPE 1/6: Renommer le modèle Categorie → Category"
if [ -f "app/Models/Categorie.php" ]; then
    mv app/Models/Categorie.php app/Models/Category.php
    echo -e "${GREEN}✅ Fichier renommé${NC}"
else
    echo -e "${YELLOW}⚠️  Fichier Categorie.php déjà renommé ou introuvable${NC}"
fi

# ÉTAPE 2: Mettre à jour le contenu du modèle Category
echo
echo "📝 ÉTAPE 2/6: Mise à jour du modèle Category"

cat > app/Models/Category.php << 'EOF'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'categories';
    
    protected $fillable = [
        'nom',
        'description',
        'slug',
        'couleur',
        'icone',
        'active'
    ];
    
    protected $casts = [
        'active' => 'boolean'
    ];
    
    /**
     * Une catégorie peut avoir plusieurs livres
     */
    public function livres()
    {
        return $this->hasMany(Livre::class, 'category_id');
    }
    
    /**
     * Scope pour les catégories actives
     */
    public function scopeActives($query)
    {
        return $query->where('active', true);
    }
    
    /**
     * Scope pour rechercher par nom
     */
    public function scopeRecherche($query, $terme)
    {
        return $query->where('nom', 'like', '%' . $terme . '%')
                    ->orWhere('description', 'like', '%' . $terme . '%');
    }
    
    /**
     * Scope pour trouver par slug
     */
    public function scopeParSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
    
    /**
     * Accesseur pour l'URL de la catégorie
     */
    public function getUrlAttribute()
    {
        return route('categorie.show', $this->slug);
    }
}
EOF

echo -e "${GREEN}✅ Modèle Category mis à jour avec colonnes icone et active${NC}"

# ÉTAPE 3: Mettre à jour le modèle Livre
echo
echo "📝 ÉTAPE 3/6: Mise à jour du modèle Livre"

cat > app/Models/Livre.php << 'EOF'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    use HasFactory;
    
    protected $table = 'livres';
    
    protected $fillable = [
        'titre',
        'auteur',
        'annee',
        'nb_pages',
        'isbn',
        'resume',
        'couverture',
        'disponible',
        'category_id'
    ];
    
    protected $casts = [
        'disponible' => 'boolean',
        'annee' => 'integer',
        'nb_pages' => 'integer'
    ];
    
    /**
     * Scope pour les livres disponibles
     */
    public function scopeDisponible($query)
    {
        return $query->where('disponible', true);
    }
    
    /**
     * Scope pour rechercher par titre ou auteur
     */
    public function scopeRecherche($query, $terme)
    {
        return $query->where('titre', 'like', '%' . $terme . '%')
                    ->orWhere('auteur', 'like', '%' . $terme . '%');
    }

    /**
     * Un livre appartient à une catégorie
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Alias pour compatibilité
     */
    public function categorie()
    {
        return $this->category();
    }

    /**
     * Scope pour filtrer par catégorie via relation
     */
    public function scopeParCategorie($query, $categorieSlug)
    {
        return $query->whereHas('category', function ($q) use ($categorieSlug) {
            $q->where('slug', $categorieSlug);
        });
    }

    /**
     * Accesseur pour l'URL du livre
     */
    public function getUrlAttribute()
    {
        return route('livre.show', $this->id);
    }
}
EOF

echo -e "${GREEN}✅ Modèle Livre mis à jour (category + alias categorie)${NC}"

# ÉTAPE 4: Créer migration pour ajouter colonnes manquantes
echo
echo "📝 ÉTAPE 4/6: Création migration pour colonnes icone et active"

TIMESTAMP=$(date +%Y_%m_%d_%H%M%S)
MIGRATION_FILE="database/migrations/${TIMESTAMP}_add_icone_active_to_categories.php"

cat > "$MIGRATION_FILE" << 'EOF'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('icone')->default('fas fa-book')->after('couleur');
            $table->boolean('active')->default(true)->after('icone');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['icone', 'active']);
        });
    }
};
EOF

echo -e "${GREEN}✅ Migration créée: $MIGRATION_FILE${NC}"

# ÉTAPE 5: Renommer et mettre à jour CategorySeeder
echo
echo "📝 ÉTAPE 5/6: Mise à jour des seeders"

if [ -f "database/seeders/CategorieSeeder.php" ]; then
    mv database/seeders/CategorieSeeder.php database/seeders/CategorySeeder.php
    echo -e "${GREEN}✅ Seeder renommé${NC}"
fi

cat > database/seeders/CategorySeeder.php << 'EOF'
<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'nom' => 'Laravel',
                'description' => 'Framework PHP moderne et élégant',
                'slug' => 'laravel',
                'couleur' => '#FF2D20',
                'icone' => 'fab fa-laravel',
                'active' => true
            ],
            [
                'nom' => 'PHP',
                'description' => 'Langage de programmation côté serveur',
                'slug' => 'php',
                'couleur' => '#777BB4',
                'icone' => 'fab fa-php',
                'active' => true
            ],
            [
                'nom' => 'Base de Données',
                'description' => 'Gestion et manipulation de données',
                'slug' => 'database',
                'couleur' => '#4DB33D',
                'icone' => 'fas fa-database',
                'active' => true
            ],
            [
                'nom' => 'Frontend',
                'description' => 'Développement d\'interfaces utilisateur',
                'slug' => 'frontend',
                'couleur' => '#61DAFB',
                'icone' => 'fas fa-palette',
                'active' => true
            ],
            [
                'nom' => 'DevOps',
                'description' => 'Déploiement et infrastructure',
                'slug' => 'devops',
                'couleur' => '#2496ED',
                'icone' => 'fas fa-server',
                'active' => true
            ],
            [
                'nom' => 'Architecture',
                'description' => 'Patterns et bonnes pratiques',
                'slug' => 'architecture',
                'couleur' => '#F7DF1E',
                'icone' => 'fas fa-sitemap',
                'active' => true
            ]
        ];

        foreach ($categories as $categorieData) {
            Category::create($categorieData);
        }
    }
}
EOF

echo -e "${GREEN}✅ CategorySeeder créé avec colonnes icone et active${NC}"

# Mettre à jour LivreSeeder
cat > database/seeders/LivreSeeder.php << 'EOF'
<?php

namespace Database\Seeders;

use App\Models\Livre;
use App\Models\Category;
use Illuminate\Database\Seeder;

class LivreSeeder extends Seeder
{
    public function run(): void
    {
        $laravel = Category::where('slug', 'laravel')->first();
        $php = Category::where('slug', 'php')->first();
        $database = Category::where('slug', 'database')->first();
        $frontend = Category::where('slug', 'frontend')->first();
        $devops = Category::where('slug', 'devops')->first();
        $architecture = Category::where('slug', 'architecture')->first();

        $livres = [
            [
                'titre' => 'Laravel pour Débutants',
                'auteur' => 'John Smith',
                'annee' => 2024,
                'nb_pages' => 320,
                'isbn' => '978-2-1234-5678-9',
                'resume' => 'Guide complet pour apprendre Laravel étape par étape.',
                'couverture' => 'laravel.jpg',
                'disponible' => true,
                'category_id' => $laravel?->id,
            ],
            [
                'titre' => 'Docker en Pratique',
                'auteur' => 'Marie Dubois',
                'annee' => 2023,
                'nb_pages' => 280,
                'isbn' => '978-2-1234-5679-6',
                'resume' => 'Maîtriser la containerisation avec Docker.',
                'couverture' => 'docker.jpg',
                'disponible' => true,
                'category_id' => $devops?->id,
            ],
            [
                'titre' => 'MVC Expliqué Simplement',
                'auteur' => 'Pierre Martin',
                'annee' => 2024,
                'nb_pages' => 195,
                'isbn' => '978-2-1234-5680-2',
                'resume' => 'Comprendre l\'architecture MVC avec des exemples concrets.',
                'couverture' => 'mvc.jpg',
                'disponible' => false,
                'category_id' => $architecture?->id,
            ],
            [
                'titre' => 'PHP 8 - Les Nouveautés',
                'auteur' => 'Lucas Bernard',
                'annee' => 2024,
                'nb_pages' => 245,
                'isbn' => '978-2-1234-5682-6',
                'resume' => 'Découvrez toutes les nouveautés de PHP 8.',
                'couverture' => 'php8.jpg',
                'disponible' => true,
                'category_id' => $php?->id,
            ],
            [
                'titre' => 'SQLite pour les Applications Modernes',
                'auteur' => 'Sophie Moreau',
                'annee' => 2023,
                'nb_pages' => 350,
                'isbn' => '978-2-1234-5681-9',
                'resume' => 'Guide complet de SQLite pour le développement.',
                'couverture' => 'sqlite.jpg',
                'disponible' => true,
                'category_id' => $database?->id,
            ],
            [
                'titre' => 'Bootstrap 5 et CSS Moderne',
                'auteur' => 'Emma Wilson',
                'annee' => 2024,
                'nb_pages' => 290,
                'isbn' => '978-2-1234-5683-3',
                'resume' => 'Créer des interfaces modernes avec Bootstrap 5.',
                'couverture' => 'bootstrap5.jpg',
                'disponible' => true,
                'category_id' => $frontend?->id,
            ]
        ];

        foreach ($livres as $livre) {
            Livre::create($livre);
        }
    }
}
EOF

echo -e "${GREEN}✅ LivreSeeder mis à jour pour utiliser Category${NC}"

# ÉTAPE 6: Mettre à jour DatabaseSeeder
echo
echo "📝 ÉTAPE 6/6: Mise à jour DatabaseSeeder"

cat > database/seeders/DatabaseSeeder.php << 'EOF'
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            LivreSeeder::class,
        ]);
    }
}
EOF

echo -e "${GREEN}✅ DatabaseSeeder mis à jour${NC}"

# Résumé final
echo
echo -e "${GREEN}✅ CORRECTIONS TERMINÉES !${NC}"
echo
echo "📋 Résumé des modifications:"
echo "  ✅ Modèle Categorie → Category"
echo "  ✅ Ajout colonnes: icone, active"
echo "  ✅ Ajout scope: actives()"
echo "  ✅ Relations mises à jour (category + alias categorie)"
echo "  ✅ Seeders corrigés et renommés"
echo "  ✅ Migration créée pour nouvelles colonnes"
echo
echo "🚀 PROCHAINES ÉTAPES:"
echo "  1. php artisan migrate (pour ajouter icone et active)"
echo "  2. php artisan migrate:fresh --seed (pour tout recréer)"
echo "  3. Tester les exercices dans Tinker"
echo
echo "📝 Test rapide suggéré:"
echo "  php artisan tinker"
echo "  >>> App\Models\Category::count()"
echo "  >>> App\Models\Category::actives()->get()"
echo "  >>> App\Models\Livre::with('category')->first()"
echo
