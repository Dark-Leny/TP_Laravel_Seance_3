{{-- Composant carte livre réutilisable --}}
@props(['livre', 'showDetails' => false])

<div class="card h-100 shadow-sm">
    <img src="{{ $livre['couverture'] ?? '/images/livres/default.jpg' }}" 
        class="card-img-top" alt="{{ $livre['titre'] }}" 
        style="height: 200px; object-fit: cover;">
    
    <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{ $livre['titre'] }}</h5>
        <p class="card-text text-muted">
            <i class="fas fa-user"></i> {{ $livre['auteur'] }}
        </p>
        
    @if(isset($livre['categorie']))
    <span class="badge bg-secondary mb-2">{{ $livre['categorie'] }}</span>
    @endif
        
    @if($showDetails && isset($livre['description']))
    <p class="card-text">{{ Str::limit($livre['description'], 100) }}</p>
    @endif
        
        <div class="mt-auto">
            @if(isset($livre['disponible']))
                @if($livre['disponible'])
                    <span class="badge bg-success mb-2">
                        <i class="fas fa-check"></i> Disponible
                    </span>
                @else
                    <span class="badge bg-warning mb-2">
                        <i class="fas fa-clock"></i> Emprunté
                    </span>
                @endif
            @endif
            
            <div class="d-grid">
                <a href="{{ route('livres.show', $livre['id']) }}" class="btn btn-outline-primary">
                    <i class="fas fa-eye"></i> Voir détails
                </a>
            </div>
        </div>
    </div>
</div>