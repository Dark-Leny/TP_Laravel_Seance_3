@extends('layouts.app')

@section('title', 'Catalogue des Livres')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>📚 Catalogue des Livres</h1>
                <a href="{{ route('livres.create') }}" class="btn btn-success">
                    ➕ Ajouter un livre
                </a>
            </div>
        </div>
    </div>

    {{-- Formulaire de recherche --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <form method="GET" action="{{ route('livres.index') }}">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" 
                               class="form-control" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Rechercher un livre ou un auteur...">
                    </div>
                    <div class="col-md-4">
                        <select name="categorie" class="form-select">
                            <option value="">Toutes les catégories</option>
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}" 
                                        {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">🔍 Rechercher</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Liste des livres --}}
    <div class="row">
        @forelse($livres as $livre)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $livre->titre }}</h5>
                        <p class="card-text">
                            <strong>👤 Auteur :</strong> {{ $livre->auteur }}<br>
                            <strong>📂 Catégorie :</strong> 
                            <span class="badge bg-info">{{ $livre->categorie->nom }}</span><br>
                            <strong>📄 Pages :</strong> {{ $livre->pages }}<br>
                            <strong>📅 Publication :</strong> {{ $livre->date_publication ? $livre->date_publication->format('Y') : 'N/A' }}
                        </p>
                        <div class="mt-auto">
                            @if($livre->disponible)
                                <span class="badge bg-success mb-2">✅ Disponible</span>
                            @else
                                <span class="badge bg-danger mb-2">❌ Indisponible</span>
                            @endif
                            <div class="btn-group w-100" role="group">
                                <a href="{{ route('livres.show', $livre) }}" 
                                   class="btn btn-primary btn-sm">👁️ Voir</a>
                                <a href="{{ route('livres.edit', $livre) }}" 
                                   class="btn btn-secondary btn-sm">✏️ Modifier</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <h4>📭 Aucun livre trouvé</h4>
                    <p>Il n'y a actuellement aucun livre dans le catalogue.</p>
                    <a href="{{ route('livres.create') }}" class="btn btn-success">
                        Ajouter le premier livre
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($livres->hasPages())
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {{ $livres->withQueryString()->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection