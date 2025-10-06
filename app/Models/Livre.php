<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    use HasFactory;


    protected $fillable = [
        'titre',
        'auteur',
        'isbn',
        'categorie_id',
        'resume',
        'date_publication',
        'pages',
        'disponible'
    ];

    protected $casts = [
        'date_publication' => 'date',
        'disponible' => 'boolean'
    ];

    /**
     * Scope pour les livres disponibles
     */
    public function scopeDisponible($query)
    {
        return $query->where('disponible', true);
    }

    /**
     * Scope pour rechercher par titre ou auteur
     */
    public function scopeRecherche($query, $terme)
    {
        return $query->where('titre', 'like', '%' . $terme . '%')
            ->orWhere('auteur', 'like', '%' . $terme . '%');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    /**
     * Scope pour filtrer par catégorie
     */
    public function scopeParCategorie($query, $categorieNom)
    {
        return $query->where('categorie', $categorieNom);
    }

    /**
     * Scope pour filtrer par catégorie via relation
     */
    public function scopeParCategorieSlug($query, $categorieSlug)
    {
        return $query->whereHas('categorie', function ($q) use ($categorieSlug) {
            $q->where('slug', $categorieSlug);
        });
    }

    /**
     * Accesseur pour l'URL du livre
     */
    public function getUrlAttribute()
    {
        return route('livre.show', $this->id);
    }
}
