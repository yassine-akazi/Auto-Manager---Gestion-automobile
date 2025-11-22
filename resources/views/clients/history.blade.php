@extends('layouts.app')

@section('title', 'Historique Client')

@section('content')
<div class="min-h-screen main-bg py-4 sm:py-8 px-3 sm:px-4 md:px-6 lg:px-8">
    
    <div class="max-w-7xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-6 sm:mb-8">
            <a href="{{ route('clients.show') }}" class="inline-flex items-center text-secondary hover:text-red-500 transition-colors group mb-4">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                <span class="text-sm sm:text-base">Retour à la liste des clients</span>
            </a>
            
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-red-600 to-red-900 rounded-xl sm:rounded-2xl flex items-center justify-center shadow-lg shadow-red-900/50">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-primary mb-1">Historique d'Achats</h1>
                    <p class="text-xs sm:text-sm text-secondary">
                        <span class="text-red-500 font-semibold">{{ $client->nom }} {{ $client->prenom }}</span> 
                        • {{ $purchases->count() }} achat(s)
                    </p>
                </div>
            </div>
        </div>

        {{-- Client Info Card --}}
        <div class="bg-card rounded-xl sm:rounded-2xl shadow-2xl border-2 border-card p-4 sm:p-6 mb-6 sm:mb-8">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-red-500 to-red-700 rounded-full flex items-center justify-center text-white font-bold text-lg sm:text-2xl shadow-lg">
                    {{ strtoupper(substr($client->nom, 0, 1) . substr($client->prenom, 0, 1)) }}
                </div>
                <div class="flex-1 grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 w-full">
                    <div>
                        <p class="text-xs text-muted uppercase tracking-wide mb-1">Client</p>
                        <p class="text-primary font-semibold text-sm sm:text-base">{{ $client->nom }} {{ $client->prenom }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-muted uppercase tracking-wide mb-1">CNI</p>
                        <p class="text-primary font-semibold text-sm sm:text-base">{{ $client->cni }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-muted uppercase tracking-wide mb-1">Téléphone</p>
                        <p class="text-primary font-semibold text-sm sm:text-base">{{ $client->telephone }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- No History --}}
        @if($purchases->isEmpty())
            <div class="bg-card rounded-xl sm:rounded-2xl shadow-2xl border-2 border-yellow-900/50 p-6 sm:p-8 text-center">
                <svg class="w-16 h-16 sm:w-20 sm:h-20 text-yellow-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-xl sm:text-2xl font-bold text-yellow-400 mb-2">Aucun historique trouvé</h3>
                <p class="text-secondary text-sm sm:text-base">Ce client n'a effectué aucun achat pour le moment.</p>
            </div>
        @else

            {{-- Purchases Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                @foreach($purchases as $purchase)
                    <div class="bg-card rounded-xl sm:rounded-2xl shadow-2xl border-2 border-card overflow-hidden transform hover:scale-105 transition-all duration-300 animate-slide-in">
                        
                        {{-- Car Image --}}
                        @if($purchase->car->image)
                            <div class="relative h-48 sm:h-56 overflow-hidden bg-card">
                                <img src="{{ asset('uploads/cars/' . $purchase->car->image) }}" 
                                     alt="{{ $purchase->car->marque }} {{ $purchase->car->modele }}" 
                                     class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                                <div class="absolute top-3 right-3 bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                    {{ $purchase->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                        @else
                            <div class="relative h-48 sm:h-56 bg-gradient-to-br from-card to-card flex items-center justify-center">
                                <svg class="w-20 h-20 sm:w-24 sm:h-24 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                </svg>
                                <div class="absolute top-3 right-3 bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                    {{ $purchase->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                        @endif

                        {{-- Car Info --}}
                        <div class="p-4 sm:p-6">
                            <h3 class="text-lg sm:text-xl font-bold text-primary mb-3 sm:mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                </svg>
                                {{ $purchase->car->marque }} {{ $purchase->car->modele }}
                            </h3>

                            <div class="space-y-2 sm:space-y-3 mb-4">
                                {{-- Année --}}
                                <div class="flex items-center justify-between py-2 border-b border-card">
                                    <span class="text-secondary text-xs sm:text-sm flex items-center gap-2">
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Année
                                    </span>
                                    <span class="text-primary font-semibold text-sm sm:text-base">{{ $purchase->car->annee }}</span>
                                </div>

                                {{-- Prix --}}
                                <div class="flex items-center justify-between py-2 border-b border-card">
                                    <span class="text-secondary text-xs sm:text-sm flex items-center gap-2">
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Prix de vente
                                    </span>
                                    <span class="text-green-400 font-bold text-sm sm:text-base">
                                        {{ $purchase->prix_vente ? number_format($purchase->prix_vente, 2, ',', ' ') : '-' }} DH
                                    </span>
                                </div>

                                {{-- Matricule --}}
                                <div class="flex items-center justify-between py-2 border-b border-card">
                                    <span class="text-secondary text-xs sm:text-sm flex items-center gap-2">
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Matricule
                                    </span>
                                    <span class="text-primary font-mono font-semibold text-sm sm:text-base">
                                        {{ $purchase->car->matricule_part1 }}-{{ $purchase->car->matricule_part2 }}-{{ $purchase->car->matricule_part3 }}
                                    </span>
                                </div>

                                {{-- Statut --}}
                                <div class="flex items-center justify-between py-2">
                                    <span class="text-secondary text-xs sm:text-sm flex items-center gap-2">
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Statut
                                    </span>
                                    <span class="px-3 py-1 rounded-full text-xs font-bold
                                        {{ $purchase->car->statut === 'Vendue' ? 'bg-green-900/30 text-green-400 border border-green-500/50' : 
                                           ($purchase->car->statut === 'Disponible' ? 'bg-blue-900/30 text-blue-400 border border-blue-500/50' : 
                                           'bg-yellow-900/30 text-yellow-400 border border-yellow-500/50') }}">
                                        {{ $purchase->car->statut }}
                                    </span>
                                </div>
                            </div>

                            {{-- View Car Button --}}
                            <a href="{{ route('cars.show', $purchase->car->id) }}" 
                               class="w-full bg-gradient-to-r from-red-600 to-red-900 hover:from-red-700 hover:to-black text-white font-bold px-4 py-2.5 sm:py-3 rounded-lg sm:rounded-xl shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center justify-center gap-2 text-sm sm:text-base">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Voir les détails
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Summary Stats --}}
            <div class="mt-6 sm:mt-8 bg-card rounded-xl sm:rounded-2xl shadow-2xl border-2 border-card p-4 sm:p-6">
                <h3 class="text-lg sm:text-xl font-bold text-primary mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Statistiques
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-card border border-card rounded-lg p-4 text-center">
                        <p class="text-secondary text-xs sm:text-sm mb-1">Total Achats</p>
                        <p class="text-2xl sm:text-3xl font-bold text-primary">{{ $purchases->count() }}</p>
                    </div>
                    <div class="bg-card border border-card rounded-lg p-4 text-center">
                        <p class="text-secondary text-xs sm:text-sm mb-1">Montant Total</p>
                        <p class="text-2xl sm:text-3xl font-bold text-green-400">{{ number_format($purchases->sum('prix_vente'), 2, ',', ' ') }} DH</p>
                    </div>
                    <div class="bg-card border border-card rounded-lg p-4 text-center">
                        <p class="text-secondary text-xs sm:text-sm mb-1">Premier Achat</p>
                        <p class="text-xl sm:text-2xl font-bold text-primary">{{ $purchases->min('created_at')->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

        @endif

    </div>
</div>

<style>
@keyframes slide-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-slide-in {
    animation: slide-in 0.5s ease forwards;
}
</style>
@endsection