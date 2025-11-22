@extends('layouts.app')

@section('title', 'Modifier achat')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">

    <h1 class="text-2xl font-bold mb-6">Modifier l'achat</h1>

    <div class="bg-white p-6 shadow rounded-lg max-w-3xl">

        <form action="{{ route('purchases.update', $purchase->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Sélection Client --}}
            <label class="block font-semibold mb-1">Client :</label>
            <select name="client_id" class="w-full border px-3 py-2 mb-4 rounded">
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" 
                        {{ $purchase->client_id == $client->id ? 'selected' : '' }}>
                        {{ $client->nom }} {{ $client->prenom }}
                    </option>
                @endforeach
            </select>

            {{-- Sélection Voiture --}}
            <label class="block font-semibold mb-1">Voiture :</label>
            <select name="car_id" class="w-full border px-3 py-2 mb-4 rounded">
                @foreach($cars as $car)
                    <option value="{{ $car->id }}"
                        {{ $purchase->car_id == $car->id ? 'selected' : '' }}>
                        {{ $car->marque }} - {{ $car->modele }} - {{ $car->matricule }}
                    </option>
                @endforeach
            </select>

            {{-- Prix Vente --}}
            <label class="block font-semibold mb-1">Prix de vente :</label>
            <input type="number" step="0.01" name="prix_vente" 
                   value="{{ $purchase->prix_vente }}"
                   class="w-full border px-3 py-2 mb-4 rounded">

            {{-- Sélection du vendeur --}}
            <label class="block font-semibold mb-1">Vendu par :</label>
            <select name="user_id" class="w-full border px-3 py-2 mb-4 rounded">
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                        {{ $purchase->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            {{-- Actions --}}
            <div class="flex gap-4 mt-6">

                <a href="{{ route('purchases.index') }}" 
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Annuler
                </a>

                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Enregistrer
                </button>

            </div>
        </form>
    </div>

</div>
@endsection