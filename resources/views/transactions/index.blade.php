<table class="table-auto w-full border">
    <thead>
        <tr>
            <th>Voiture</th>
            <th>Client</th>
            <th>Vendeur</th>
            <th>Prix</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $t)
        <tr>
            <td>{{ $t->car->marque }} {{ $t->car->modele }}</td>
            <td>{{ $t->client->nom }} {{ $t->client->prenom }}</td>
            <td>{{ $t->user->name }}</td>
            <td>{{ number_format($t->prix_vente, 2, ',', ' ') }} DH</td>
            <td>{{ $t->date_achat }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $transactions->links() }}