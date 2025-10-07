<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue des Livres - PDF</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Catalogue des Livres</h2>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Catégorie</th>
                <th>ISBN</th>
                <th>Date de publication</th>
                <th>Pages</th>
                <th>Disponible</th>
            </tr>
        </thead>
        <tbody>
            @foreach($livres as $livre)
                <tr>
                    <td>{{ $livre->titre }}</td>
                    <td>{{ $livre->auteur }}</td>
                    <td>{{ $livre->categorie->nom ?? '-' }}</td>
                    <td>{{ $livre->isbn }}</td>
                    <td>{{ optional($livre->date_publication)->format('d/m/Y') }}</td>
                    <td>{{ $livre->pages }}</td>
                    <td>{{ $livre->disponible ? 'Oui' : 'Non' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
