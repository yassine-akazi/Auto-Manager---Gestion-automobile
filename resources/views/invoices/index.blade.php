@extends('layouts.app')

@section('title', 'Liste des factures')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Liste des factures</h1>

    @if($invoices->count() == 0)
        <p>Aucune facture trouvée.</p>
    @else
        <table class="w-full bg-white shadow-md rounded">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3">ID</th>
                    <th class="p-3">Client</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($invoices as $invoice)
                <tr class="border-b">
                    <td class="p-3">{{ $invoice->id }}</td>
                    <td class="p-3">{{ $invoice->client_name }}</td>
                    <td class="p-3">{{ $invoice->created_at->format('d/m/Y') }}</td>
                    <td class="p-3">
                        <a class="text-blue-600" href="{{ route('invoices.show', $invoice->id) }}">Voir</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection