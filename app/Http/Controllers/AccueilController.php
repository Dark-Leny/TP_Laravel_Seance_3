<?php

namespace App\Http\Controllers;



class AccueilController extends Controller
{
    /**
     * Affichage de la page d'accueil
     * SÉANCE 1 : Comprendre le passage de données à une vue
     */
    public function index()
    {
        $stats = [
            'totalLivres' => 5,
            'livresDisponibles' => 4,
            'totalEmprunts' => 12,
            'totalUtilisateurs' => 25
        ];

        // Livres mis en avant (top 3)
        $livresEnVedette = [
            [
                'id' => 1,
                'titre' => 'Maîtriser Laravel',
                'auteur' => 'Expert PHP',
                'couverture' => 'laravel'
            ],
            [
                'id' => 2,
                'titre' => 'Docker pour Débutants',
                'auteur' => 'DevOps Master',
                'couverture' => 'docker'
            ],
            [
                'id' => 3,
                'titre' => 'PHP 8 Moderne',
                'auteur' => 'Développeur Pro',
                'couverture' => 'php'
            ]
        ];

        return view('welcome', [
            'stats' => $stats,
            'livresEnVedette' => $livresEnVedette
        ]);
    }
}