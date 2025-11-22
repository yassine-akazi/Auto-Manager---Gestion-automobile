@extends('layouts.app')

@section('title', 'Nouvel Achat')

@section('content')
<div class="min-h-screen main-bg py-6 sm:py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-3xl mx-auto">
        
        {{-- Header Minimaliste --}}
        <div class="mb-8 sm:mb-12">
            <a href="{{ route('purchases.index') }}" class="inline-flex items-center text-secondary hover:text-primary transition-colors group mb-6">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                <span>Retour</span>
            </a>
            
            <h1 class="text-3xl sm:text-4xl font-light text-primary mb-2">Nouvel Achat</h1>
            <p class="text-secondary">Enregistrer une nouvelle transaction</p>
        </div>

        {{-- Form Minimaliste --}}
        <div class="bg-card rounded-2xl shadow-lg border border-card p-6 sm:p-8">
            
            <form action="{{ route('purchases.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                {{-- Section 1: Client & Véhicule --}}
                <div class="space-y-6">
                    <h2 class="text-xl font-medium text-primary pb-3 border-b border-card">1. Client & Véhicule</h2>

                    {{-- Client --}}
                    <div>
                        <label class="block text-sm font-medium text-primary mb-2">
                            Client <span class="text-red-500">*</span>
                        </label>
                        <select name="client_id" required
                                class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 transition text-sm custom-select">
                            <option value="">Choisir un client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->nom }} {{ $client->prenom }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Voiture --}}
                    <div>
                        <label class="block text-sm font-medium text-primary mb-2">
                            Voiture <span class="text-red-500">*</span>
                        </label>
                        <select name="car_id" required
                                class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 transition text-sm custom-select">
                            <option value="">Choisir une voiture</option>
                            @foreach($cars as $car)
                                <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                    {{ $car->marque }} {{ $car->modele }} ({{ $car->statut }})
                                </option>
                            @endforeach
                        </select>
                        @error('car_id')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Section 2: Financières --}}
                <div class="space-y-6">
                    <h2 class="text-xl font-medium text-primary pb-3 border-b border-card">2. Informations Financières</h2>

                    {{-- Prix Total, Avance, Reste --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-primary mb-2">
                                Prix Total <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="prix_total" id="prix_total" step="0.01" value="{{ old('prix_total') }}" required placeholder="180000"
                                   class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 transition text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary mb-2">
                                Avance <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="avance" id="avance" step="0.01" value="{{ old('avance') }}" required placeholder="50000"
                                   class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 transition text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-green-600 mb-2">
                                Reste
                            </label>
                            <input type="number" name="reste" id="reste" step="0.01" readonly placeholder="0.00"
                                   class="w-full bg-green-50 dark:bg-green-900/20 border border-green-300 dark:border-green-700 text-green-600 dark:text-green-400 rounded-lg px-4 py-3 font-semibold text-sm cursor-not-allowed">
                        </div>
                    </div>

                    {{-- Prix de vente --}}
                    <div>
                        <label class="block text-sm font-medium text-primary mb-2">
                            Prix de vente <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="prix_vente" step="0.01" value="{{ old('prix_vente') }}" required placeholder="Entrer le prix"
                               class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 transition text-sm">
                    </div>
                </div>

                {{-- Section 3: Paiement --}}
                <div class="space-y-6">
                    <h2 class="text-xl font-medium text-primary pb-3 border-b border-card">3. Paiement</h2>

                    {{-- Méthode --}}
                    <div>
                        <label class="block text-sm font-medium text-primary mb-2">
                            Méthode de Paiement <span class="text-red-500">*</span>
                        </label>
                        <select name="payment_method" id="payment_method" required
                                class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 transition text-sm custom-select">
                            <option value="">Choisir une méthode</option>
                            <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="cheque" {{ old('payment_method') == 'cheque' ? 'selected' : '' }}>Chèque</option>
                            <option value="virement" {{ old('payment_method') == 'virement' ? 'selected' : '' }}>Virement</option>
                        </select>
                    </div>

                    {{-- Upload Cheque --}}
                    <div class="hidden" id="cheque_upload_container">
                        <label class="block text-sm font-medium text-primary mb-2">
                            Scan du Chèque
                        </label>
                        <input type="file" name="cheque_scan" accept="image/*,application/pdf"
                               class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 transition text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-red-50 file:text-red-700 hover:file:bg-red-100 dark:file:bg-red-900/30 dark:file:text-red-400">
                        <p class="text-xs text-secondary mt-1">PNG, JPG ou PDF</p>
                    </div>

                    {{-- Date --}}
                    <div>
                        <label class="block text-sm font-medium text-primary mb-2">
                            Date d'achat <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="date_achat" value="{{ old('date_achat', date('Y-m-d')) }}" required
                               class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 transition text-sm">
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-6">
                    <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-3 rounded-lg transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Valider l'achat
                    </button>
                    <a href="{{ route('purchases.index') }}" class="flex-1 bg-card hover:bg-gray-100 dark:hover:bg-gray-800 text-primary font-medium px-6 py-3 rounded-lg transition-colors border border-card flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
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

    // Affichage cheque
    const paymentMethod = document.getElementById('payment_method');
    const chequeContainer = document.getElementById('cheque_upload_container');

    paymentMethod.addEventListener('change', function() {
        if(this.value === 'cheque') {
            chequeContainer.classList.remove('hidden');
        } else {
            chequeContainer.classList.add('hidden');
        }
    });

    if(paymentMethod.value === 'cheque') {
        chequeContainer.classList.remove('hidden');
    }
</script>

<style>
.custom-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 1.25em 1.25em;
    padding-right: 2.5rem;
    appearance: none;
}

input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(0.5);
    cursor: pointer;
}

.dark input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
}
</style>
@endsection