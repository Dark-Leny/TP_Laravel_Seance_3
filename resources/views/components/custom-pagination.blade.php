@props(['paginator'])

<div class="pagination-wrapper mt-4">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <span class="text-muted">
                Affichage de <strong>{{ $paginator->firstItem() }}</strong> à <strong>{{ $paginator->lastItem() }}</strong> sur <strong>{{ $paginator->total() }}</strong> livres
            </span>
        </div>
        <form method="GET" action="" class="d-inline-flex align-items-center">
            <label for="perPage" class="me-2">Éléments par page :</label>
            <select name="perPage" id="perPage" class="form-select form-select-sm" onchange="this.form.submit()">
                @foreach([6,12,24,48] as $size)
                    <option value="{{ $size }}" {{ request('perPage', 12) == $size ? 'selected' : '' }}>{{ $size }}</option>
                @endforeach
            </select>
            @foreach(request()->except('perPage','page') as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
        </form>
    </div>
    <nav>
        <ul class="pagination justify-content-center">
            {{-- Première page --}}
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url(1) }}">« Première</a>
            </li>
            {{-- Précédent --}}
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}">‹</a>
            </li>
            {{-- Pages --}}
            @foreach ($paginator->getUrlRange(max(1, $paginator->currentPage()-2), min($paginator->lastPage(), $paginator->currentPage()+2)) as $page => $url)
                <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach
            {{-- Suivant --}}
            <li class="page-item {{ $paginator->currentPage() == $paginator->lastPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">›</a>
            </li>
            {{-- Dernière page --}}
            <li class="page-item {{ $paginator->currentPage() == $paginator->lastPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">Dernière »</a>
            </li>
        </ul>
    </nav>
</div>
