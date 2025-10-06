@props(['categories'])

<div class="card mb-4">
    <div class="card-header">
        <h5>🔍 Recherche Avancée</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('livres.index') }}">
            <div class="row g-2 align-items-end">
                {{-- Champ de recherche texte --}}
                <div class="col-md-3">
                    <label for="search" class="form-label">Mot-clé</label>
                    <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="Titre, auteur, résumé...">
                </div>
                {{-- Select catégorie --}}
                <div class="col-md-2">
                    <label for="categorie" class="form-label">Catégorie</label>
                    <select name="categorie" id="categorie" class="form-select">
                        <option value="">Toutes</option>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}" {{ request('categorie') == $categorie->id ? 'selected' : '' }}>{{ $categorie->nom }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Checkbox disponibilité --}}
                <div class="col-md-2">
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" name="disponible" id="disponible" value="1" {{ request('disponible') ? 'checked' : '' }}>
                        <label class="form-check-label" for="disponible">Disponible</label>
                    </div>
                </div>
                {{-- Dates de publication --}}
                <div class="col-md-2">
                    <label for="date_debut" class="form-label">Date début</label>
                    <input type="date" name="date_debut" id="date_debut" class="form-control" value="{{ request('date_debut') }}">
                </div>
                <div class="col-md-2">
                    <label for="date_fin" class="form-label">Date fin</label>
                    <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ request('date_fin') }}">
                </div>
                {{-- Tri --}}
                <div class="col-md-2">
                    <label for="sort" class="form-label">Trier par</label>
                    <select name="sort" id="sort" class="form-select">
                        <option value="titre" {{ request('sort','titre')=='titre' ? 'selected' : '' }}>Titre</option>
                        <option value="auteur" {{ request('sort')=='auteur' ? 'selected' : '' }}>Auteur</option>
                        <option value="date_publication" {{ request('sort')=='date_publication' ? 'selected' : '' }}>Date</option>
                        <option value="pages" {{ request('sort')=='pages' ? 'selected' : '' }}>Pages</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="direction" class="form-label">Ordre</label>
                    <select name="direction" id="direction" class="form-select">
                        <option value="asc" {{ request('direction','asc')=='asc' ? 'selected' : '' }}>Ascendant</option>
                        <option value="desc" {{ request('direction')=='desc' ? 'selected' : '' }}>Descendant</option>
                    </select>
                </div>
                {{-- Boutons --}}
                <div class="col-md-2 mt-4">
                    <button type="submit" class="btn btn-primary w-100 mb-1">Rechercher</button>
                    <a href="{{ route('livres.index') }}" class="btn btn-outline-secondary w-100">Réinitialiser</a>
                </div>
            </div>
        </form>
    </div>
</div>
