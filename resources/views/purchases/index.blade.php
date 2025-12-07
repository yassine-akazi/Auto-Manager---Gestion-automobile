@extends('layouts.app')

@section('title', 'Liste des Achats')

@section('content')
<div class="min-h-screen main-bg py-6 sm:py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-7xl mx-auto">
        
        {{-- Header Minimaliste --}}
        <div class="mb-8 sm:mb-12">
            <h1 class="text-3xl sm:text-4xl font-light text-primary mb-2">Liste des Achats</h1>
            <p class="text-secondary">Gérez toutes vos transactions de véhicules</p>
        </div>

        {{-- FILTRES Minimalistes --}}
        <form method="GET" class="mb-8">
            <div class="bg-card rounded-2xl shadow-lg border border-card p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    {{-- Recherche --}}
                    <div>
                        <label class="block text-xs font-medium text-secondary mb-2">Rechercher</label>
                        <input type="text" 
                               name="search" 
                               placeholder="Client, voiture..."
                               value="{{ request('search') }}"
                               class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 transition text-sm">
                    </div>

                    {{-- Filtre année --}}
                    <div>
                        <label class="block text-xs font-medium text-secondary mb-2">Année</label>
                        <select name="year" 
                                class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 transition text-sm custom-select">
                            <option value="">Toutes les années</option>
                            @foreach(range(date('Y'), 2020) as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filtre état paiement --}}
                    <div>
                        <label class="block text-xs font-medium text-secondary mb-2">État Paiement</label>
                        <select name="status" 
                                class="w-full bg-card border border-card text-primary rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 transition text-sm custom-select">
                            <option value="">Tous les états</option>
                            <option value="paye" {{ request('status')=='paye'?'selected':'' }}>Payé</option>
                            <option value="reste" {{ request('status')=='reste'?'selected':'' }}>Restant</option>
                        </select>
                    </div>

                    {{-- Bouton filtrer --}}
                    <div class="flex items-end">
                        <button class="w-full bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg px-6 py-3 transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            Filtrer
                        </button>
                    </div>
                </div>
            </div>
        </form>

        {{-- TABLEAU Minimaliste --}}
        <div class="bg-card rounded-2xl shadow-lg border border-card overflow-hidden">
            
            {{-- Version Desktop --}}
            <div class="hidden lg:block overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50 dark:bg-gray-800/50 border-b border-card">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-secondary uppercase tracking-wider">Client</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-secondary uppercase tracking-wider">Voiture</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-secondary uppercase tracking-wider">Total</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-secondary uppercase tracking-wider">Avance</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-secondary uppercase tracking-wider">Reste</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-secondary uppercase tracking-wider">Méthode</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-secondary uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-secondary uppercase tracking-wider">État</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-secondary uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-card">
                        @forelse($purchases as $purchase)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">

                                {{-- Client --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center text-white font-semibold text-sm">
                                            {{ substr($purchase->client->nom, 0, 1) }}{{ substr($purchase->client->prenom, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-primary">
                                                {{ $purchase->client->nom }} {{ $purchase->client->prenom }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Voiture --}}
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium text-primary">{{ $purchase->car->marque }}</p>
                                    <p class="text-xs text-secondary">{{ $purchase->car->modele }}</p>
                                </td>

                                {{-- Total --}}
                                <td class="px-6 py-4">
                                    <span class="text-sm font-semibold text-green-600 dark:text-green-400">
                                        {{ number_format($purchase->prix_total, 2) }} DH
                                    </span>
                                </td>

                                {{-- Avance --}}
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-blue-600 dark:text-blue-400">
                                        {{ number_format($purchase->avance, 2) }} DH
                                    </span>
                                </td>

                                {{-- Reste --}}
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium {{ $purchase->reste > 0 ? 'text-orange-600 dark:text-orange-400' : 'text-gray-400' }}">
                                        {{ number_format($purchase->reste, 2) }} DH
                                    </span>
                                </td>

                                {{-- Méthode --}}
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400">
                                        {{ ucfirst($purchase->payment_method) }}
                                    </span>
                                </td>

                                {{-- Date --}}
                                <td class="px-6 py-4 text-sm text-secondary">
                                    {{ \Carbon\Carbon::parse($purchase->date_achat)->format('d/m/Y') }}
                                </td>

                                {{-- État --}}
                                <td class="px-6 py-4">
                                    @if($purchase->reste <= 0)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                            Payé
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                            Restant
                                        </span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('purchases.show', $purchase->id) }}"
                                           class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium transition-colors">
                                            Voir
                                        </a>

                                        <a href="{{ route('purchases.edit', $purchase->id) }}"
                                           class="text-yellow-600 hover:text-yellow-800 dark:text-yellow-400 dark:hover:text-yellow-300 text-sm font-medium transition-colors">
                                            Modifier
                                        </a>

                                        <form action="{{ route('purchases.destroy', $purchase->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet achat ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium transition-colors">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-secondary">
                                        <svg class="w-16 h-16 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="text-lg font-medium mb-1">Aucun achat trouvé</p>
                                        <p class="text-sm">Commencez par créer votre premier achat</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Version Mobile (Cartes) --}}
            <div class="lg:hidden p-4 space-y-4">
                @forelse($purchases as $purchase)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-card p-5 {{ $purchase->reste <= 0 ? 'border-l-4 border-l-green-500' : 'border-l-4 border-l-orange-500' }}">
                        
                        {{-- Header --}}
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center text-white font-semibold text-sm">
                                    {{ substr($purchase->client->nom, 0, 1) }}{{ substr($purchase->client->prenom, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-primary">
                                        {{ $purchase->client->nom }} {{ $purchase->client->prenom }}
                                    </p>
                                    <p class="text-xs text-secondary">
                                        {{ $purchase->car->marque }} - {{ $purchase->car->modele }}
                                    </p>
                                </div>
                            </div>
                            
                            @if($purchase->reste <= 0)
                                <span class="bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 px-2.5 py-1 rounded-md text-xs font-semibold">
                                    Payé
                                </span>
                            @else
                                <span class="bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 px-2.5 py-1 rounded-md text-xs font-semibold">
                                    Restant
                                </span>
                            @endif
                        </div>

                        {{-- Details Grid --}}
                        <div class="grid grid-cols-2 gap-3 mb-4 text-sm">
                            <div>
                                <p class="text-xs text-secondary mb-1">Total</p>
                                <p class="font-semibold text-green-600 dark:text-green-400">{{ number_format($purchase->prix_total, 2) }} DH</p>
                            </div>
                            <div>
                                <p class="text-xs text-secondary mb-1">Avance</p>
                                <p class="font-semibold text-blue-600 dark:text-blue-400">{{ number_format($purchase->avance, 2) }} DH</p>
                            </div>
                            <div>
                                <p class="text-xs text-secondary mb-1">Reste</p>
                                <p class="font-semibold text-orange-600 dark:text-orange-400">{{ number_format($purchase->reste, 2) }} DH</p>
                            </div>
                            <div>
                                <p class="text-xs text-secondary mb-1">Date</p>
                                <p class="font-medium text-primary">{{ \Carbon\Carbon::parse($purchase->date_achat)->format('d/m/Y') }}</p>
                            </div>
                        </div>

                        {{-- Footer --}}
                        <div class="flex justify-between items-center pt-3 border-t border-card">
                            <span class="text-xs bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400 px-2 py-1 rounded-md font-medium">
                                {{ ucfirst($purchase->payment_method) }}
                            </span>
                            
                            <div class="flex space-x-3">
                                <a href="{{ route('purchases.show', $purchase->id) }}" 
                                   class="text-blue-600 dark:text-blue-400 text-sm font-medium">Voir</a>
                                <a href="{{ route('purchases.edit', $purchase->id) }}" 
                                   class="text-yellow-600 dark:text-yellow-400 text-sm font-medium">Modifier</a>
                                <form action="{{ route('purchases.destroy', $purchase->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Supprimer cet achat ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 dark:text-red-400 text-sm font-medium">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 text-secondary">
                        <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-lg font-medium">Aucun achat trouvé</p>
                    </div>
                @endforelse
            </div>

        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $purchases->links() }}
        </div>

    </div>
</div>

<style>
.custom-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 1.25em 1.25em;
    padding-right: 2.5rem;
    appearance: none;
}

.dark .custom-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%239ca3af' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
}
</style>
@endsection