<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Categorie;
use Illuminate\Http\Request;
use PDF;
use Excel;

class LivreController extends Controller
{
    /**
     * Export PDF du catalogue filtré
     */
    public function exportPdf(Request $request)
    {
        // Récupérer les livres filtrés (même logique que index)
        $query = Livre::with('categorie');
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(titre) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                    ->orWhereRaw('LOWER(auteur) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                    ->orWhereRaw('LOWER(resume) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
            });
        }
        if ($request->filled('categorie')) {
            $query->where('categorie_id', $request->categorie);
        }
        if ($request->has('disponible')) {
            $query->where('disponible', $request->disponible);
        }
        if ($request->filled('date_debut') && $request->filled('date_fin')) {
            $query->whereBetween('date_publication', [$request->date_debut, $request->date_fin]);
        }
        $sortField = $request->get('sort', 'titre');
        $sortDirection = $request->get('direction', 'asc');
        $livres = $query->orderBy($sortField, $sortDirection)->get();

        // Générer le PDF avec barryvdh/laravel-dompdf
        $pdf = PDF::loadView('livres.export_pdf', compact('livres'));
        return $pdf->download('catalogue_livres.pdf');
    }

    /**
     * Export Excel du catalogue filtré
     */
    public function exportExcel(Request $request)
    {
        // Récupérer les livres filtrés (même logique que index)
        $query = Livre::with('categorie');
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(titre) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                    ->orWhereRaw('LOWER(auteur) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                    ->orWhereRaw('LOWER(resume) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
            });
        }
        if ($request->filled('categorie')) {
            $query->where('categorie_id', $request->categorie);
        }
        if ($request->has('disponible')) {
            $query->where('disponible', $request->disponible);
        }
        if ($request->filled('date_debut') && $request->filled('date_fin')) {
            $query->whereBetween('date_publication', [$request->date_debut, $request->date_fin]);
        }
        $sortField = $request->get('sort', 'titre');
        $sortDirection = $request->get('direction', 'asc');
        $livres = $query->orderBy($sortField, $sortDirection)->get();

        // Utiliser Laravel Excel pour exporter
        return Excel::download(new \App\Exports\LivresExport($livres), 'catalogue_livres.xlsx');
    }
    /**
     * Afficher la liste des livres
     */
    public function index(Request $request)
    {
        // Eager loading intelligent : inclure 'categorie' seulement si affiché
        $withCategorie = true; // à adapter selon la vue ou les filtres
        $query = $withCategorie ? Livre::with('categorie') : Livre::query();

        // Recherche multi-critères (titre, auteur, résumé)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(titre) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                    ->orWhereRaw('LOWER(auteur) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                    ->orWhereRaw('LOWER(resume) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
            });
        }

        // Filtre par catégorie
        if ($request->filled('categorie')) {
            $query->where('categorie_id', $request->categorie);
        }

        // Filtre par disponibilité
        if ($request->has('disponible')) {
            $query->where('disponible', $request->disponible);
        }

        // Filtre par période de publication
        if ($request->filled('date_debut') && $request->filled('date_fin')) {
            $query->whereBetween('date_publication', [$request->date_debut, $request->date_fin]);
        }

        // Tri dynamique
        $allowedSorts = ['titre', 'auteur', 'date_publication', 'pages'];
        $sortField = in_array($request->get('sort'), $allowedSorts) ? $request->get('sort') : 'titre';
        $sortDirection = in_array($request->get('direction'), ['asc', 'desc']) ? $request->get('direction') : 'asc';

        // Sélectionner uniquement les colonnes nécessaires
        $query->select(['id', 'titre', 'auteur', 'isbn', 'categorie_id', 'resume', 'date_publication', 'pages', 'disponible', 'created_at', 'updated_at']);

        // Pagination et persistance des filtres
        $perPage = $request->get('perPage', 12);
        $livres = $query->orderBy($sortField, $sortDirection)->paginate($perPage)->withQueryString();

        // Cache des catégories (rarement modifiées)
        $categories = cache()->remember('categories_livres', 3600, function () {
            return Categorie::orderBy('nom')->get();
        });

        // Compteurs globaux optimisés et mis en cache
        $stats = cache()->remember('livres_stats', 600, function () {
            return [
                'totalLivres' => Livre::count(),
                'livresDisponibles' => Livre::where('disponible', true)->count(),
                'totalCategories' => Categorie::count()
            ];
        });

        // Index DB : à créer sur titre, auteur, categorie_id pour optimiser la recherche
        // (à faire via migration)

        return view('livres.index', compact('livres', 'categories', 'stats'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $categories = Categorie::orderBy('nom')->get();
        return view('livres.create', compact('categories'));
    }

    /**
     * Sauvegarder un nouveau livre
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255', // 📝 Note: En séance 4, nous transformerons ceci en relation vers un modèle Auteur
            'isbn' => 'required|string|unique:livres|size:13',
            'categorie_id' => 'required|exists:categories,id',
            'resume' => 'nullable|string|max:1000',
            'date_publication' => 'required|date|before_or_equal:today',
            'pages' => 'required|integer|min:1|max:9999',
            'disponible' => 'boolean'
        ]);

        $livre = Livre::create($validated);

        return redirect()
            ->route('livres.show', $livre)
            ->with('success', 'Livre créé avec succès !');
    }

    /**
     * Afficher un livre spécifique
     */
    public function show(Livre $livre)
    {
        return view('livres.show', compact('livre'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Livre $livre)
    {
        $categories = Categorie::orderBy('nom')->get();
        return view('livres.edit', compact('livre', 'categories'));
    }

    /**
     * Mettre à jour un livre
     */
    public function update(Request $request, Livre $livre)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255', // 📝 Note: En séance 4, nous transformerons ceci en relation vers un modèle Auteur
            'isbn' => 'required|string|size:13|unique:livres,isbn,' . $livre->id,
            'categorie_id' => 'required|exists:categories,id',
            'resume' => 'nullable|string|max:1000',
            'date_publication' => 'required|date|before_or_equal:today',
            'pages' => 'required|integer|min:1|max:9999',
            'disponible' => 'boolean'
        ]);

        $livre->update($validated);

        return redirect()
            ->route('livres.show', $livre)
            ->with('success', 'Livre mis à jour avec succès !');
    }

    /**
     * Supprimer un livre
     */
    public function destroy(Livre $livre)
    {
        $livre->delete();

        return redirect()
            ->route('livres.index')
            ->with('success', 'Livre supprimé avec succès !');
    }
}
