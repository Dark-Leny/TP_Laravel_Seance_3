
@props([
    'livre',
    'showActions' => true,
    'showCategory' => true,
    'compact' => false
])

<div class="card h-100 {{ $compact ? 'card-compact' : '' }} shadow-sm">
    <div class="card-body d-flex flex-column">
        <h5 class="card-title">
            <i class="fas fa-book"></i> {{ $livre->titre }}
        </h5>
        <p class="card-text mb-1">
            <i class="fas fa-user"></i> <strong>Auteur :</strong> {{ $livre->auteur }}<br>
            @if($showCategory)
                <i class="fas fa-folder"></i> <strong>Catégorie :</strong> <span class="badge bg-info">{{ $livre->categorie->nom ?? '-' }}</span><br>
            @endif
            <i class="fas fa-file-alt"></i> <strong>Pages :</strong> {{ $livre->pages ?? '-' }}<br>
            <i class="fas fa-calendar"></i> <strong>Publication :</strong> {{ optional($livre->date_publication)->format('Y') ?? '-' }}
        </p>
        <div class="mt-auto">
            @if($livre->disponible)
                <span class="badge bg-success mb-2"><i class="fas fa-check"></i> Disponible</span>
            @else
                <span class="badge bg-danger mb-2"><i class="fas fa-times"></i> Indisponible</span>
            @endif
            @if($showActions)
                <div class="btn-group w-100" role="group">
                    <a href="{{ route('livres.show', $livre) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Voir</a>
                    <a href="{{ route('livres.edit', $livre) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> Modifier</a>
                    <form action="{{ route('livres.destroy', $livre) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .card-compact {
        padding: 0.5rem;
        font-size: 0.95em;
    }
    .card:hover {
        box-shadow: 0 0 10px #0d6efd33;
        transform: translateY(-3px) scale(1.02);
        transition: all 0.2s;
    }
</style>
@endpush
