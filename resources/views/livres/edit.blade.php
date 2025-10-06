@extends('layouts.app')

@section('title', 'Modifier - ' . $livre->titre)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2>✏️ Modifier "{{ $livre->titre }}"</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('livres.update', $livre) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        {{-- Titre --}}
                        <div class="mb-3">
                            <label for="titre" class="form-label">📖 Titre *</label>
                            <input type="text" 
                                   class="form-control @error('titre') is-invalid @enderror" 
                                   id="titre" 
                                   name="titre" 
                                   value="{{ old('titre', $livre->titre) }}">
                            @error('titre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Auteur --}}
                        <div class="mb-3">
                            <label for="auteur" class="form-label">👤 Auteur *</label>
                            <input type="text" 
                                   class="form-control @error('auteur') is-invalid @enderror" 
                                   id="auteur" 
                                   name="auteur" 
                                   value="{{ old('auteur', $livre->auteur) }}">
                            @error('auteur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ISBN --}}
                        <div class="mb-3">
                            <label for="isbn" class="form-label">📚 ISBN (13 chiffres) *</label>
                            <input type="text" 
                                   class="form-control @error('isbn') is-invalid @enderror" 
                                   id="isbn" 
                                   name="isbn" 
                                   value="{{ old('isbn', $livre->isbn) }}"
                                   maxlength="13">
                            @error('isbn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Catégorie --}}
                        <div class="mb-3">
                            <label for="categorie_id" class="form-label">📂 Catégorie *</label>
                            <select class="form-select @error('categorie_id') is-invalid @enderror" 
                                    name="categorie_id" id="categorie_id">
                                <option value="">Choisir une catégorie</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}" 
                                            {{ old('categorie_id', $livre->categorie_id) == $categorie->id ? 'selected' : '' }}>
                                        {{ $categorie->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categorie_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            {{-- Pages --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pages" class="form-label">📄 Nombre de pages *</label>
                                    <input type="number" 
                                           class="form-control @error('pages') is-invalid @enderror" 
                                           id="pages" 
                                           name="pages" 
                                           value="{{ old('pages', $livre->pages) }}"
                                           min="1" max="9999">
                                    @error('pages')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Date de publication --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_publication" class="form-label">📅 Date de publication *</label>
                                    <input type="date" 
                                           class="form-control @error('date_publication') is-invalid @enderror" 
                                           id="date_publication" 
                                           name="date_publication" 
                                           value="{{ old('date_publication', $livre->date_publication->format('Y-m-d')) }}"
                                           max="{{ date('Y-m-d') }}">
                                    @error('date_publication')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Disponibilité --}}
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="disponible" 
                                       name="disponible" 
                                       value="1"
                                       {{ old('disponible', $livre->disponible) ? 'checked' : '' }}>
                                <label class="form-check-label" for="disponible">
                                    ✅ Livre disponible
                                </label>
                            </div>
                        </div>

                        {{-- Résumé --}}
                        <div class="mb-3">
                            <label for="resume" class="form-label">📝 Résumé (optionnel)</label>
                            <textarea class="form-control @error('resume') is-invalid @enderror" 
                                      id="resume" 
                                      name="resume" 
                                      rows="4">{{ old('resume', $livre->resume) }}</textarea>
                            @error('resume')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('livres.show', $livre) }}" class="btn btn-secondary">
                                ⬅️ Annuler
                            </a>
                            <button type="submit" class="btn btn-warning">
                                ✏️ Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
