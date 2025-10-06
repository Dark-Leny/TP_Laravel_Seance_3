<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LivreController extends Controller
{
    /**
     * Affichage liste avec données statiques
     * SÉANCE 1 : Comprendre les collections de données et leur passage aux vues
     */
    public function index()
    {
        $livres = [
            [
                'id' => 1,
                'titre' => 'Laravel pour Débutants',
                'auteur' => 'John Smith',
                'annee' => 2024,
                'pages' => 320,
                'description' => 'Guide complet pour apprendre Laravel étape par étape.',
                'couverture' => 'laravel'
            ],
            [
                'id' => 2,
                'titre' => 'Docker en Pratique',
                'auteur' => 'Marie Dubois',
                'annee' => 2023,
                'pages' => 280,
                'description' => 'Maîtriser la containerisation avec Docker.',
                'couverture' => 'docker'
            ],
            [
                'id' => 3,
                'titre' => 'MVC Expliqué Simplement',
                'auteur' => 'Pierre Martin',
                'annee' => 2024,
                'pages' => 195,
                'description' => 'Comprendre l\'architecture MVC avec des exemples concrets.',
                'couverture' => 'mvc'
            ]
        ];

        $statistiques = [
            'totalLivres' => count($livres),
            'livresDisponibles' => count(array_filter($livres, function($livre) {
                return !isset($livre['disponible']) || $livre['disponible'] === true;
            })),
            'totalCategories' => 3 // Pour la démo
        ];

        return view('livres.index', [
            'livres' => $livres,
            'stats' => $statistiques,
            'total' => count($livres)
        ]);
    }

    /**
     * Affichage détail avec paramètre d'URL
     * SÉANCE 1 : Comprendre les paramètres de route et la gestion d'erreurs
     */
    public function show($id)
    {
        // Conversion de l'ID en entier pour éviter les erreurs
        $id = (int) $id;

        $livres = [
            1 => [
                'id' => 1,
                'titre' => 'Laravel pour Débutants',
                'auteur' => 'John Smith',
                'annee' => 2024,
                'pages' => 320,
                'isbn' => '978-2-1234-5678-9',
                'description' => 'Guide complet pour apprendre Laravel étape par étape. Ce livre couvre tous les aspects fondamentaux du framework PHP le plus populaire.',
                'couverture' => 'laravel',
                'disponible' => true,
                'categorie' => 'Framework PHP'
            ],
            2 => [
                'id' => 2,
                'titre' => 'Docker en Pratique',
                'auteur' => 'Marie Dubois',
                'annee' => 2023,
                'pages' => 280,
                'isbn' => '978-2-1234-5679-6',
                'description' => 'Maîtriser la containerisation avec Docker. Apprenez à créer, déployer et gérer des applications containerisées.',
                'couverture' => 'docker',
                'disponible' => true,
                'categorie' => 'DevOps'
            ],
            3 => [
                'id' => 3,
                'titre' => 'MVC Expliqué Simplement',
                'auteur' => 'Pierre Martin',
                'annee' => 2024,
                'pages' => 195,
                'isbn' => '978-2-1234-5680-2',
                'description' => 'Comprendre l\'architecture MVC avec des exemples concrets. Pattern architectural incontournable du développement moderne.',
                'couverture' => 'mvc',
                'disponible' => false,
                'categorie' => 'Architecture'
            ]
        ];

        // Vérification de l'existence du livre
        if (!isset($livres[$id])) {
            abort(404, 'Livre non trouvé');
        }

        return view('livres.show', [
            'livre' => $livres[$id]
        ]);
    }

    /**
     * Recherche de livres
     * SÉANCE 1 : Comprendre la récupération de données de formulaire
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');

        $tousLesLivres = [
            [
                'id' => 1,
                'titre' => 'Laravel pour Débutants',
                'auteur' => 'John Smith',
                'annee' => 2024,
                'pages' => 320,
                'description' => 'Guide complet pour apprendre Laravel étape par étape.',
                'couverture' => 'laravel'
            ],
            [
                'id' => 2,
                'titre' => 'Docker en Pratique',
                'auteur' => 'Marie Dubois',
                'annee' => 2023,
                'pages' => 280,
                'description' => 'Maîtriser la containerisation avec Docker.',
                'couverture' => 'docker'
            ],
            [
                'id' => 3,
                'titre' => 'MVC Expliqué Simplement',
                'auteur' => 'Pierre Martin',
                'annee' => 2024,
                'pages' => 195,
                'description' => 'Comprendre l\'architecture MVC avec des exemples concrets.',
                'couverture' => 'mvc'
            ]
        ];

        // Filtrage des livres selon la requête de recherche
        $livresFiltres = [];
        if (!empty($query)) {
            foreach ($tousLesLivres as $livre) {
                if (
                    stripos($livre['titre'], $query) !== false ||
                    stripos($livre['auteur'], $query) !== false ||
                    stripos($livre['description'], $query) !== false
                ) {
                    $livresFiltres[] = $livre;
                }
            }
        } else {
            $livresFiltres = $tousLesLivres;
        }

        return view('livres.search', [
            'livres' => $livresFiltres,
            'query' => $query,
            'total' => count($livresFiltres)
        ]);
    }
}
