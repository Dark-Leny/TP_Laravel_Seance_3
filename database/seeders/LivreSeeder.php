<?php

namespace Database\Seeders;

use App\Models\Livre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LivreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $livres = [
            [
                'titre' => 'Laravel pour Débutants',
                'auteur' => 'John Smith',
                'annee' => 2024,
                'nb_pages' => 320,
                'isbn' => '978-2-1234-5678-9',
                'resume' => 'Guide complet pour apprendre Laravel étape par étape. Ce livre couvre tous les aspects fondamentaux du framework PHP le plus populaire.',
                'couverture' => 'laravel.jpg',
                'disponible' => true,
                'categorie' => 'Framework PHP'
            ],
            [
                'titre' => 'Docker en Pratique',
                'auteur' => 'Marie Dubois',
                'annee' => 2023,
                'nb_pages' => 280,
                'isbn' => '978-2-1234-5679-6',
                'resume' => 'Maîtriser la containerisation avec Docker. Apprenez à créer, déployer et gérer des applications containerisées.',
                'couverture' => 'docker.jpg',
                'disponible' => true,
                'categorie' => 'DevOps'
            ],
            [
                'titre' => 'MVC Expliqué Simplement',
                'auteur' => 'Pierre Martin',
                'annee' => 2024,
                'nb_pages' => 195,
                'isbn' => '978-2-1234-5680-2',
                'resume' => 'Comprendre l\'architecture MVC avec des exemples concrets. Pattern architectural incontournable du développement moderne.',
                'couverture' => 'mvc.jpg',
                'disponible' => false,
                'categorie' => 'Architecture'
            ],
            [
                'titre' => 'Clean Code',
                'auteur' => 'Robert C. Martin',
                'annee' => 2008,
                'nb_pages' => 464,
                'isbn' => '978-0-13-235088-4',
                'resume' => 'Manuel du développeur agile. Apprenez à écrire du code propre et maintenable.',
                'couverture' => 'clean-code.jpg',
                'disponible' => true,
                'categorie' => 'Méthodologie'
            ],
            [
                'titre' => 'Base de Données Relationnelles',
                'auteur' => 'Sophie Moreau',
                'annee' => 2023,
                'nb_pages' => 350,
                'isbn' => '978-2-1234-5681-9',
                'resume' => 'Conception et optimisation de bases de données. SQL, NoSQL et bonnes pratiques.',
                'couverture' => 'database.jpg',
                'disponible' => true,
                'categorie' => 'Base de Données'
            ]
        ];

        foreach ($livres as $livre) {
            Livre::create($livre);
        }
    }
}
