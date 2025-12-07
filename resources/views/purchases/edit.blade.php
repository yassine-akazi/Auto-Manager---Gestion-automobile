@extends('layouts.app')

@section('title', 'Modifier Achat')

@section('content')
<div class="min-h-screen main-bg py-6 sm:py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-3xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-8 sm:mb-12">
            <a href="{{ route('purchases.index') }}" class="inline-flex items-center text-secondary hover:text-primary transition-colors group mb-6">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                <span>Retour</span>
            </a>
            
            <h1 class="text-3xl sm:text-4xl font-light text-primary mb-2">Modifier Achat</h1>
            <p class="text-secondary">Mettre à jour les informations de l’achat</p>
        </div>

        {{-- Form --}}
        <div class="bg-card rounded-2xl shadow-lg border border-card p-6 sm:p-8">

            <form action="{{ route('purchases.update', $purchase->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                {{-- SECTION 1 --}}
                <div class="space-y-6">
                    <h2 class="text-xl font-medium text-primary pb-3 border-b border-card">1. Client & Véhicule</h2>

                    {{-- Client --}}
                    <div>
                        <label class="block text-sm font-medium text-primary mb-2">
                            Client <span class="text-red-500">*</span>
                        </label>
                        <select name="client_id" required
                            class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3 custom-select">
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" 
                                    {{ $purchase->client_id == $client->id ? 'selected' : '' }}>
                                    {{ $client->nom }} {{ $client->prenom }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <p class="text-red-400 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Voiture --}}
                    <div>
                        <label class="block text-sm font-medium text-primary mb-2">
                            Voiture <span class="text-red-500">*</span>
                        </label>
                        <select name="car_id" required
                            class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3 custom-select">
                            @foreach($cars as $car)
                                <option value="{{ $car->id }}" 
                                    {{ $purchase->car_id == $car->id ? 'selected' : '' }}>
                                    {{ $car->marque }} {{ $car->modele }} ({{ $car->statut }})
                                </option>
                            @endforeach
                        </select>
                        @error('car_id')
                            <p class="text-red-400 text-xs">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- SECTION 2 --}}
                <div class="space-y-6">
                    <h2 class="text-xl font-medium text-primary pb-3 border-b border-card">2. Informations Financières</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        {{-- Prix total --}}
                        <div>
                            <label class="block text-sm font-medium text-primary mb-2">Prix Total</label>
                            <input type="number" name="prix_total" id="prix_total" step="0.01"
                                value="{{ $purchase->prix_total }}"
                                class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3">
                        </div>

                        {{-- Avance --}}
                        <div>
                            <label class="block text-sm font-medium text-primary mb-2">Avance</label>
                            <input type="number" name="avance" id="avance" step="0.01"
                                value="{{ $purchase->avance }}"
                                class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3">
                        </div>

                        {{-- Reste --}}
                        <div>
                            <label class="block text-sm font-medium text-green-600 mb-2">Reste</label>
                            <input type="number" name="reste" id="reste" step="0.01" readonly
                                value="{{ $purchase->reste }}"
                                class="w-full bg-green-50 dark:bg-green-900/20 border border-green-300 rounded-lg px-4 py-3 font-semibold text-sm cursor-not-allowed">
                        </div>
                    </div>

                    {{-- Prix de vente --}}
                    <div>
                        <label class="block text-sm font-medium text-primary mb-2">Prix de vente</label>
                        <input type="number" name="prix_vente" step="0.01"
                            value="{{ $purchase->car->prix_vente }}"
                            class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3">
                    </div>
                </div>

                {{-- SECTION 3 --}}
                <div class="space-y-6">
                    <h2 class="text-xl font-medium text-primary pb-3 border-b border-card">3. Paiement</h2>

                    {{-- Méthode --}}
                    <div>
                        <label class="block text-sm font-medium text-primary mb-2">Méthode de paiement</label>
                        <select name="payment_method" id="payment_method"
                            class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3 custom-select">
                            <option value="cash" {{ $purchase->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="cheque" {{ $purchase->payment_method == 'cheque' ? 'selected' : '' }}>Chèque</option>
                            <option value="virement" {{ $purchase->payment_method == 'virement' ? 'selected' : '' }}>Virement</option>
                        </select>
                    </div>

                    {{-- Scan du chèque --}}
                    <div id="cheque_upload_container" class="{{ $purchase->payment_method == 'cheque' ? '' : 'hidden' }}">
                        <label class="block text-sm font-medium text-primary mb-2">Scan du chèque</label>

                        @if($purchase->cheque_scan)
                            <p class="text-xs mb-2">Fichier actuel :
                                <a href="{{ asset('storage/'.$purchase->cheque_scan) }}" target="_blank" class="text-blue-500 underline">Voir</a>
                            </p>
                        @endif

                        <input type="file" name="cheque_scan" accept="image/*,application/pdf"
                               class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3 file:mr-4 file:px-4 file:bg-red-50 file:text-red-700">
                    </div>

                    {{-- Date achat --}}
                    <div>
                        <label class="block text-sm font-medium text-primary mb-2">Date d’achat</label>
                        <input type="date" name="date_achat"
                            value="{{ $purchase->date_achat }}"
                            class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3">
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-6">
                    <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-3 rounded-lg flex items-center justify-center gap-2">
                        Mettre à jour
                    </button>

                    <a href="{{ route('purchases.index') }}" 
                        class="flex-1 bg-card hover:bg-gray-100 dark:hover:bg-gray-800 text-primary font-medium px-6 py-3 rounded-lg border border-card flex items-center justify-center gap-2">
                        Annuler
                    </a>
                </div>

            </form>
        </div>

    </div>
</div>

<script>
    // Calcul automatique du reste
    const prixTotal = document.getElementById('prix_total');
    const avance = document.getElementById('avance');
    const reste = document.getElementById('reste');

    function calculateReste() {
        const total = parseFloat(prixTotal.value) || 0;
        const payed = parseFloat(avance.value) || 0;
        reste.value = (total - payed).toFixed(2);
    }

    prixTotal.addEventListener('input', calculateReste);
    avance.addEventListener('input', calculateReste);

    // Affichage du scan chèque
    const paymentMethod = document.getElementById('payment_method');
    const chequeContainer = document.getElementById('cheque_upload_container');

    paymentMethod.addEventListener('change', function () {
        this.value === 'cheque'
            ? chequeContainer.classList.remove('hidden')
            : chequeContainer.classList.add('hidden');
    });
</script>

@endsection