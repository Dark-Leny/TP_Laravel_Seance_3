<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLivreRequest extends FormRequest
{
    public function authorize()
    {
        // Autoriser toutes les requêtes (à adapter si besoin)
        return true;
    }

    public function rules()
    {
        return [
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'isbn' => ['required', 'string', 'size:13', 'unique:livres', new \App\Rules\ValidIsbn],
            'categorie_id' => 'required|exists:categories,id',
            'resume' => 'nullable|string|max:1000',
            'date_publication' => 'required|date|before_or_equal:today',
            'pages' => 'required|integer|min:1|max:9999',
            'disponible' => 'boolean',

            // Validation conditionnelle : résumé obligatoire si catégorie "Roman"
            // Tome obligatoire si pages > 1000 (à ajouter si champ "tome" existe)
        ];
    }
    public function messages()
    {
        return [
            'titre.required' => 'Le titre est obligatoire.',
            'auteur.required' => "L'auteur est obligatoire.",
            'isbn.required' => "L'ISBN est obligatoire.",
            'isbn.size' => "L'ISBN doit comporter exactement 13 chiffres.",
            'isbn.unique' => "Cet ISBN existe déjà dans la base.",
            'isbn.string' => "L'ISBN doit être une chaîne de caractères.",
            'categorie_id.required' => "La catégorie est obligatoire.",
            'categorie_id.exists' => "La catégorie sélectionnée n'existe pas.",
            'date_publication.required' => "La date de publication est obligatoire.",
            'date_publication.date' => "La date de publication doit être une date valide.",
            'date_publication.before_or_equal' => "La date de publication ne peut pas être dans le futur.",
            'pages.required' => "Le nombre de pages est obligatoire.",
            'pages.integer' => "Le nombre de pages doit être un nombre entier.",
            'pages.min' => "Le nombre de pages doit être supérieur à 0.",
            'pages.max' => "Le nombre de pages doit être inférieur à 10 000.",
        ];
    }

    public function attributes()
    {
        return [
            'titre' => 'titre',
            'auteur' => 'auteur',
            'isbn' => 'ISBN',
            'categorie_id' => 'catégorie',
            'resume' => 'résumé',
            'date_publication' => 'date de publication',
            'pages' => 'nombre de pages',
            'disponible' => 'disponibilité',
        ];
    }
}
