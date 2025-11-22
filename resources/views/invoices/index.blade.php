@extends('layouts.app')

@section('title','Factures')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Liste des factures</h1>

    <a href="{{ route('invoices.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
        ➕ Ajouter une facture
    </a>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4">Numéro</th>
                <th class="py-2 px-4">Client</th>
                <th class="py-2 px-4">Date</th>
                <th class="py-2 px-4">Montant</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($invoices as $invoice)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-4">{{ $invoice->numero }}</td>
                    <td class="py-2 px-4">{{ $invoice->client->nom }} {{ $invoice->client->prenom }}</td>
                    <td class="py-2 px-4">{{ \Carbon\Carbon::parse($invoice->date_emission)->format('d/m/Y') }}</td>                    <td class="py-2 px-4">{{ number_format($invoice->montant, 2, ',', ' ') }} DH</td>
                    <td class="py-2 px-4 space-x-2">
                        <a href="{{ route('invoices.show', $invoice) }}" class="text-blue-600 hover:underline">Voir</a>
                        <a href="{{ route('invoices.edit', $invoice) }}" class="text-yellow-600 hover:underline">Modifier</a>
                        <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer cette facture ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-2 px-4 text-center">Aucune facture trouvée</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $invoices->links() }}
</div>
@endsection