@extends('layouts.app')

@section('title', $livre->titre . ' - Détail')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>📖 {{ $livre->titre }}</h2>
                        <div class="btn-group">
                            <a href="{{ route('livres.edit', $livre) }}" class="btn btn-warning">
                                ✏️ Modifier
                            </a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                🗑️ Supprimer
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>👤 Auteur :</strong> {{ $livre->auteur }}</p>
                            <p><strong>📂 Catégorie :</strong> 
                               <span class="badge bg-info">{{ $livre->categorie->nom }}</span></p>
                            <p><strong>📄 Pages :</strong> {{ $livre->pages }}</p>
                            <p><strong>📅 Date de publication :</strong> 
                               {{ $livre->date_publication ? $livre->date_publication->format('d/m/Y') : 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>📚 ISBN :</strong> {{ $livre->isbn }}</p>
                            <p><strong>📊 Statut :</strong> 
                                @if($livre->disponible)
                                    <span class="badge bg-success">✅ Disponible</span>
                                @else
                                    <span class="badge bg-danger">❌ Indisponible</span>
                                @endif
                            </p>
                            <p><strong>🕒 Ajouté le :</strong> 
                               {{ $livre->created_at->format('d/m/Y à H:i') }}</p>
                            <p><strong>🔄 Modifié le :</strong> 
                               {{ $livre->updated_at->format('d/m/Y à H:i') }}</p>
                        </div>
                    </div>
                    
                    @if($livre->resume)
                        <hr>
                        <h5>📝 Résumé</h5>
                        <p class="text-muted">{{ $livre->resume }}</p>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('livres.index') }}" class="btn btn-secondary">
                        ⬅️ Retour au catalogue
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal de confirmation de suppression --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">⚠️ Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer le livre <strong>"{{ $livre->titre }}"</strong> ?</p>
                <p class="text-danger">Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ route('livres.destroy', $livre) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">🗑️ Supprimer définitivement</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
