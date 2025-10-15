<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livre;
use App\Exports\LivresExport;
use Maatwebsite\Excel\Facades\Excel;

class LivreController extends Controller
{
    /** Liste des livres **/
    public function index()
    {
        $livres = Livre::paginate(12); // Use paginator instead of all()
        $categories = \App\Models\Categorie::all();
        $statistiques = [
            'totalLivres' => $livres->total(),
            'livresDisponibles' => $livres->where('disponible', true)->count(),
            'totalCategories' => $categories->count(),
        ];

        return view('livres.index', [
            'livres' => $livres,
            'categories' => $categories,
            'stats' => $statistiques,
            'total' => $livres->total()
        ]);
    }

    /** Détail d’un livre **/
    public function show($id)
    {
        $livre = Livre::findOrFail($id); // Gère l’erreur automatiquement
        return view('livres.show', compact('livre'));
    }

    /** Recherche **/
    public function search(Request $request)
    {
        $query = $request->input('q', '');
        $livres = Livre::query()
            ->where('titre', 'LIKE', "%$query%")
            ->orWhere('auteur', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->get();

        return view('livres.search', [
            'livres' => $livres,
            'query' => $query,
            'total' => $livres->count()
        ]);
    }

    /** Export des livres en Excel **/
    public function export()
    {
        return Excel::download(new LivresExport, 'livres.xlsx');
    }

    /** Affiche le formulaire de création d’un livre */
    public function create()
    {
        // À compléter selon besoin
        return view('livres.create');
    }

    /** Affiche le formulaire d'édition d’un livre */
    public function edit($id)
    {
        $livre = Livre::findOrFail($id);
        $categories = \App\Models\Categorie::all();
        return view('livres.edit', compact('livre', 'categories'));
    }

    /** Met à jour un livre */
    public function update(Request $request, $id)
    {
        // À compléter selon besoin
    }

    /** Supprime un livre */
    public function destroy($id)
    {
        // À compléter selon besoin
    }
}