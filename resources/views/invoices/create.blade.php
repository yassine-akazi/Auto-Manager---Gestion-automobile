@extends('layouts.app')

@section('title','Créer une facture')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Créer une nouvelle facture</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('invoices.store') }}" method="POST" class="bg-white p-6 shadow rounded-lg max-w-lg">
        @csrf

        {{-- Sélection Client --}}
        <div class="mb-4">
            <label for="client_id" class="block font-semibold mb-1">Client</label>
            <select name="client_id" id="client_id" class="w-full border px-3 py-2 rounded">
                <option value="">-- Choisir un client --</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->nom }} {{ $client->prenom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Numéro --}}
        <div class="mb-4">
            <label for="numero" class="block font-semibold mb-1">Numéro de facture</label>
            <input type="text" name="numero" id="numero" value="{{ old('numero') }}" class="w-full border px-3 py-2 rounded">
        </div>

        {{-- Date d'émission --}}
        <div class="mb-4">
            <label for="date_emission" class="block font-semibold mb-1">Date d'émission</label>
            <input type="date" name="date_emission" id="date_emission" value="{{ old('date_emission') }}" class="w-full border px-3 py-2 rounded">
        </div>

        {{-- Montant --}}
        <div class="mb-4">
            <label for="montant" class="block font-semibold mb-1">Montant (DH)</label>
            <input type="number" name="montant" id="montant" value="{{ old('montant') }}" step="0.01" class="w-full border px-3 py-2 rounded">
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Description (optionnel)</label>
            <textarea name="description" id="description" rows="3" class="w-full border px-3 py-2 rounded">{{ old('description') }}</textarea>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Créer la facture
            </button>

            <a href="{{ route('invoices.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection