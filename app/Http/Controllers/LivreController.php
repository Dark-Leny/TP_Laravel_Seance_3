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
        $livres = Livre::all();
        $statistiques = [
            'totalLivres' => $livres->count(),
            'livresDisponibles' => $livres->where('disponible', true)->count(),
            'totalCategories' => $livres->groupBy('categorie')->count(),
        ];

        return view('livres.index', [
            'livres' => $livres,
            'stats' => $statistiques,
            'total' => $livres->count()
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
}