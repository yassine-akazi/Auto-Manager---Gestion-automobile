@extends('layouts.app')

@section('title', 'Détails de la Facture')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-6">Détails de la Facture</h1>

    <div class="bg-white p-6 shadow rounded-lg max-w-3xl mx-auto">
        <p><strong>Client :</strong> {{ $invoice->client->nom }} {{ $invoice->client->prenom }}</p>
        <p><strong>Montant :</strong> {{ number_format($invoice->montant, 2, ',', ' ') }} DH</p>
        <p><strong>Description :</strong> {{ $invoice->description ?? '-' }}</p>
        <p><strong>Date :</strong> {{ $invoice->created_at->format('d/m/Y') }}</p>

        <div class="mt-6 flex gap-4">
            <a href="{{ route('invoices.index') }}"
               class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
               Retour
            </a>
        </div>
    </div>
</div>
@endsection