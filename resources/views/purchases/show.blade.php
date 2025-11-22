@extends('layouts.app')

@section('title', "Détails de l'achat")

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">

    <h1 class="text-3xl font-bold mb-6">Détails de l'achat</h1>

    <div class="bg-white p-6 shadow rounded-lg max-w-3xl mx-auto">

        {{-- Informations Client --}}
        <h2 class="text-xl font-semibold mb-3">Informations du client</h2>
        <div class="space-y-1 mb-6">
            <p><strong>Nom :</strong> {{ $purchase->client->nom }} {{ $purchase->client->prenom }}</p>
            <p><strong>Téléphone :</strong> {{ $purchase->client->telephone }}</p>
            <p><strong>CNI :</strong> {{ $purchase->client->cni }}</p>
        </div>

        <hr class="my-6">

        {{-- Informations Voiture --}}
        <h2 class="text-xl font-semibold mb-3">Informations sur la voiture</h2>

        @php $car = $purchase->car; @endphp

        <div class="space-y-2 mb-6">

            @if($car->image)
            <img src="{{ asset('uploads/cars/' . $car->image) }}" 
                 alt="{{ $car->marque }}" 
                 class="w-full h-48 object-cover rounded mb-3">
            @endif

            <p><strong>Marque :</strong> {{ $car->marque }}</p>
            <p><strong>Modèle :</strong> {{ $car->modele }}</p>
            <p><strong>Année :</strong> {{ $car->annee }}</p>
            <p><strong>Kilométrage :</strong> {{ $car->kilometrage }} km</p>
            <p><strong>Matricule :</strong> 
                {{ $car->matricule_part1 }}-{{ $car->matricule_part2 }}-{{ $car->matricule_part3 }}
            </p>
        </div>

        <hr class="my-6">

        {{-- Infos Vente --}}
        <h2 class="text-xl font-semibold mb-3">Informations de la vente</h2>
        <div class="space-y-1 mb-6">
            <p><strong>Prix de vente :</strong> 
                {{ number_format($purchase->prix_vente, 2, ',', ' ') }} DH
            </p>
            <p><strong>Vendu par :</strong> {{ $purchase->user->name }}</p>
            <p><strong>Date :</strong> {{ $purchase->created_at->format('d/m/Y') }}</p>
        </div>

        <hr class="my-6">

        {{-- Actions --}}
        <div class="flex gap-4 mt-6">
            <a href="{{ route('purchases.index') }}" 
               class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                Retour
            </a>

            <a href="{{ route('purchases.edit', $purchase->id) }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Modifier
            </a>

            <form action="{{ route('purchases.destroy', $purchase->id) }}" 
                  method="POST"
                  onsubmit="return confirm('Voulez-vous vraiment supprimer cet achat ?')">
                @csrf
                @method('DELETE')
                <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    Supprimer
                </button>
            </form>
        </div>

    </div>

</div>
@endsection