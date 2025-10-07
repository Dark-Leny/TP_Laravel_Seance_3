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
