@extends('layouts.app', [
    'title' => 'À propos',
    'breadcrumbs' => [
        ['label' => 'À propos', 'url' => null]
    ]
])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h1><i class="fas fa-info-circle"></i> À propos de BiblioTech</h1>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h3><i class="fas fa-graduation-cap"></i> Formation BTS SIO SLAM</h3>
                            <p>
                                BiblioTech est un projet pédagogique développé dans le cadre de la formation 
                                <strong>BTS SIO option SLAM</strong> (Solutions Logicielles et Applications Métiers).
                            </p>
                            <ul>
                                <li>Architecture MVC avec Laravel</li>
                                <li>Base de données SQLite portable</li>
                                <li>Interface responsive Bootstrap 5</li>
                                <li>Moteur de templates Blade</li>
                                <li>Routes paramétrées et nommées</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h3><i class="fas fa-cloud"></i> Environnements Disponibles</h3>
                            <ul class="list-group">
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="fab fa-github text-success me-2"></i>
                                    <strong>GitHub Codespace</strong>
                                    <small class="text-muted ms-auto">Cloud prêt à l'emploi</small>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="fas fa-laptop text-primary me-2"></i>
                                    <strong>Installation Locale</strong>
                                    <small class="text-muted ms-auto">PHP + Composer</small>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="fab fa-docker text-info me-2"></i>
                                    <strong>Docker</strong>
                                    <small class="text-muted ms-auto">Optionnel</small>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h3><i class="fas fa-cogs"></i> Technologies Utilisées</h3>
                            <div class="mb-3">
                                <span class="badge bg-danger me-1 mb-1">Laravel {{ app()->version() }}</span>
                                <span class="badge bg-primary me-1 mb-1">PHP {{ phpversion() }}</span>
                                <span class="badge bg-info me-1 mb-1">Bootstrap 5</span>
                                <span class="badge bg-warning text-dark me-1 mb-1">SQLite</span>
                                <span class="badge bg-success me-1 mb-1">Blade Templates</span>
                                <span class="badge bg-secondary me-1 mb-1">GitHub Codespace</span>
                                <span class="badge bg-dark me-1 mb-1">Artisan CLI</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3><i class="fas fa-rocket"></i> Démarrage Rapide</h3>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fab fa-github text-success me-2"></i>
                                    <span class="badge bg-success">Codespace : Prêt en 30s</span>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-laptop text-primary me-2"></i>
                                    <span class="badge bg-primary">Local : scripts/start.bat</span>
                                </li>
                                <li class="mb-2">
                                    <i class="fab fa-docker text-info me-2"></i>
                                    <span class="badge bg-info">Docker : make start</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <h3><i class="fas fa-road"></i> Progression des Séances</h3>
                            <div class="timeline">
                                <div class="alert alert-success">
                                    <strong>✅ Séance 1 :</strong> Fondations Laravel<br>
                                    <small>MVC, Routes, Contrôleurs, Blade Templates, SQLite</small>
                                </div>
                                <div class="alert alert-secondary">
                                    <strong>🔒 Séance 2 :</strong> Base de Données SQLite<br>
                                    <small>Migrations, Eloquent ORM, Relations, Seeders</small>
                                </div>
                                <div class="alert alert-secondary">
                                    <strong>🔒 Séance 3 :</strong> CRUD + Formulaires<br>
                                    <small>Create, Read, Update, Delete, Validation</small>
                                </div>
                                <div class="alert alert-secondary">
                                    <strong>🔒 Séances 4-8 :</strong> Fonctionnalités Avancées<br>
                                    <small>Auth, API, Recherche, IA, Production</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h3><i class="fas fa-target"></i> Objectifs Pédagogiques</h3>
                            <ul>
                                <li>Maîtriser le pattern MVC avec Laravel</li>
                                <li>Créer et gérer des routes efficacement</li>
                                <li>Développer avec le moteur Blade</li>
                                <li>Comprendre l'architecture web moderne</li>
                                <li>Utiliser SQLite pour le développement</li>
                                <li>Déboguer avec les outils Laravel</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h3><i class="fas fa-chart-line"></i> Compétences Acquises</h3>
                            <div class="progress mb-2">
                                <div class="progress-bar bg-success" style="width: 100%">
                                    Architecture MVC - 100%
                                </div>
                            </div>
                            <div class="progress mb-2">
                                <div class="progress-bar bg-success" style="width: 100%">
                                    Routes Laravel - 100%
                                </div>
                            </div>
                            <div class="progress mb-2">
                                <div class="progress-bar bg-success" style="width: 100%">
                                    Templates Blade - 100%
                                </div>
                            </div>
                            <div class="progress mb-2">
                                <div class="progress-bar bg-success" style="width: 100%">
                                    Contrôleurs - 100%
                                </div>
                            </div>
                            <div class="progress mb-2">
                                <div class="progress-bar bg-secondary" style="width: 0%">
                                    Base de données - 0%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <p class="mb-0">
                        <i class="fas fa-code"></i>
                        Séance 1 - Développé pour l'apprentissage Laravel et SQLite
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection