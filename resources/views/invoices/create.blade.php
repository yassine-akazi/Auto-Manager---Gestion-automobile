@extends('layouts.app')

@section('title', 'Créer Facture')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 shadow-xl rounded">

    <h1 class="text-3xl font-bold mb-6 text-blue-700">Créer une Facture</h1>

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf

        {{-- CLIENT --}}
        <h2 class="text-xl font-bold mb-2 text-gray-700">Client</h2>

        <select name="client_id" class="w-full border p-2 rounded mb-6">
            @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->nom }}</option>
            @endforeach
        </select>

        {{-- TVA --}}
        <h2 class="text-xl font-bold mb-2 text-gray-700">TVA (%)</h2>

        <input type="number" name="tva_rate" id="tva_rate"
               class="w-full border p-2 rounded mb-6"
               placeholder="Ex: 20"
               min="0" max="100"
               value="20">

        {{-- PRODUITS --}}
        <h2 class="text-xl font-bold mb-3 text-gray-700">Produits / Services</h2>

        <div id="products-list">
            <div class="product flex gap-4 mb-3">
                <input type="text" name="products[0][nom]" class="flex-1 border p-2 rounded" placeholder="Nom du produit" required>
                <input type="number" name="products[0][qty]" class="w-20 border p-2 rounded qty" placeholder="Qté" min="1" required>
                <input type="number" name="products[0][prix]" class="w-24 border p-2 rounded prix" placeholder="Prix" min="0" step="0.01" required>
            </div>
        </div>

        <button type="button"
                onclick="addProduct()"
                class="bg-blue-600 text-white px-4 py-2 rounded mb-6">
            + Ajouter produit
        </button>

        {{-- TOTALS --}}
        <div class="border-t pt-4 mt-4">
            <label class="font-bold">Total HT (DH)</label>
            <input type="number" id="total_ht" class="w-full border p-2 rounded bg-gray-100 mb-3" readonly>

            <label class="font-bold">Montant TVA (DH)</label>
            <input type="number" id="tva_amount" class="w-full border p-2 rounded bg-gray-100 mb-3" readonly>

            <label class="font-bold text-green-700">Total TTC (DH)</label>
            <input type="number" name="total" id="total_ttc" class="w-full border p-2 rounded bg-green-100 font-bold text-lg" readonly>
        </div>

        <button class="bg-green-600 text-white px-6 py-2 mt-6 rounded text-lg">
            Générer Facture PDF
        </button>

    </form>
</div>

<script>
let index = 1;

// Ajouter un produit
function addProduct() {
    const div = document.createElement('div');
    div.classList.add('product', 'flex', 'gap-4', 'mb-3');

    div.innerHTML = `
        <input type="text" name="products[${index}][nom]" class="flex-1 border p-2 rounded" placeholder="Nom du produit" required>
        <input type="number" name="products[${index}][qty]" class="w-20 border p-2 rounded qty" placeholder="Qté" min="1" required>
        <input type="number" name="products[${index}][prix]" class="w-24 border p-2 rounded prix" placeholder="Prix" min="0" step="0.01" required>
    `;

    document.getElementById('products-list').appendChild(div);
    index++;
}

// Calcul automatique HT + TVA + TTC
document.addEventListener('input', calculateTotals);

function calculateTotals() {
    let totalHT = 0;

    document.querySelectorAll('.product').forEach(row => {
        const qty = parseFloat(row.querySelector('.qty')?.value || 0);
        const prix = parseFloat(row.querySelector('.prix')?.value || 0);
        totalHT += qty * prix;
    });

    const tvaRate = parseFloat(document.getElementById('tva_rate').value || 0) / 100;
    const tvaAmount = totalHT * tvaRate;
    const totalTTC = totalHT + tvaAmount;

    document.getElementById('total_ht').value = totalHT.toFixed(2);
    document.getElementById('tva_amount').value = tvaAmount.toFixed(2);
    document.getElementById('total_ttc').value = totalTTC.toFixed(2);
}
</script>

@endsection