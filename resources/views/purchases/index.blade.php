@extends('layouts.app')

@section('title','Liste des achats')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Liste des achats</h1>

        <a href="{{ route('purchases.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            ➕ Nouvel achat
        </a>
    </div>

    {{-- FILTRE --}}
    <form method="GET" class="flex flex-wrap gap-4 mb-4">
        <input type="text" name="search" placeholder="Chercher client, voiture, vendeur..."
               value="{{ request('search') }}"
               class="border px-3 py-2 rounded w-full md:w-1/3">

        <select name="year" class="border px-3 py-2 rounded w-full md:w-1/6">
            <option value="">Toutes les années</option>
            @foreach(range(date('Y'), 2000) as $y)
                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                    {{ $y }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Filtrer
        </button>

        <a href="{{ route('purchases.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Réinitialiser
        </a>
    </form>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-3">Client</th>
                    <th class="px-4 py-3">Voiture</th>
                    <th class="px-4 py-3">Vendeur</th>
                    <th class="px-4 py-3">Prix Vente</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach($purchases as $purchase)
                <tr class="border-t hover:bg-gray-50">

                    <td class="px-4 py-3">
                        {{ $purchase->client->nom }} {{ $purchase->client->prenom }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $purchase->car->marque }} {{ $purchase->car->modele }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $purchase->user->name }}
                    </td>

                    <td class="px-4 py-3 font-semibold text-green-700">
                        {{ number_format($purchase->prix_vente, 2, ',', ' ') }} DH
                    </td>

                    <td class="px-4 py-3">
                        {{ $purchase->created_at->format('d/m/Y') }}
                    </td>

                    <td class="px-4 py-3 text-center">

                        <div class="flex items-center justify-center gap-2">

                            {{-- Voir --}}
                            <a href="{{ route('purchases.show', $purchase->id) }}"
                               class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                                Voir
                            </a>

                            {{-- Modifier --}}
                            <a href="{{ route('purchases.edit', $purchase->id) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                                Modifier
                            </a>

                            {{-- Supprimer --}}
                            <form action="{{ route('purchases.destroy', $purchase->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Voulez-vous vraiment supprimer cet achat ?');">
                                @csrf
                                @method('DELETE')

                                <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                    Supprimer
                                </button>
                            </form>

                        </div>

                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $purchases->links() }}
    </div>
</div>
@endsection