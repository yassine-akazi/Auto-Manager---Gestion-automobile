@extends('layouts.app')

@section('title', "Détails de l'achat")

@section('content')
<div class="min-h-screen main-bg py-6 sm:py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-6xl mx-auto">

        {{-- Header Premium --}}
        <div class="mb-8 sm:mb-12">
            <a href="{{ route('purchases.index') }}" 
               class="inline-flex items-center text-secondary hover:text-red-600 transition-all group mb-6">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                <span class="font-medium">Retour aux achats</span>
            </a>

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <div class="flex items-center gap-4 mb-2">
                        <h1 class="text-3xl sm:text-4xl font-light text-primary">Achat #{{ $purchase->id }}</h1>
                        @if($purchase->reste <= 0)
                            <span class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-gray-800 to-black text-white font-semibold text-sm shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Soldé
                            </span>
                        @else
                            <span class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold text-sm shadow-lg animate-pulse">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                En attente
                            </span>
                        @endif
                    </div>
                    <p class="text-secondary">Transaction du {{ \Carbon\Carbon::parse($purchase->date_achat)->locale('fr')->isoFormat('D MMMM YYYY') }}</p>
                </div>

                {{-- Quick Actions --}}
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('purchases.edit', $purchase->id) }}" 
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-medium px-5 py-2.5 rounded-xl transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Modifier
                    </a>

                    
                </div>
            </div>
        </div>

        {{-- Layout 2 colonnes --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Colonne Gauche (2/3) --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Card Véhicule Premium --}}
                <div class="bg-card shadow-2xl border-2 border-gray-900 dark:border-gray-800 rounded-2xl overflow-hidden">
                    @php $car = $purchase->car; @endphp

                    {{-- Image Hero avec overlay noir/rouge --}}
                    @if($car->image)
                        <div class="relative">
                            <img src="{{ asset('uploads/cars/' . $car->image) }}" 
                                 class="w-full h-72 sm:h-96 object-cover"
                                 alt="{{ $car->marque }} {{ $car->modele }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
                            <div class="absolute top-6 right-6">
                                <span class="inline-flex items-center px-4 py-2 rounded-full bg-red-600 text-white font-bold text-sm shadow-xl">
                                    {{ $car->statut }}
                                </span>
                            </div>
                            <div class="absolute bottom-6 left-6 right-6">
                                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-3">{{ $car->marque }} {{ $car->modele }}</h2>
                                <div class="flex items-center gap-4 text-white/90">
                                    <span class="inline-flex items-center bg-black/30 backdrop-blur-sm px-3 py-1.5 rounded-lg">
                                        <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $car->annee }}
                                    </span>
                                    <span class="inline-flex items-center bg-black/30 backdrop-blur-sm px-3 py-1.5 rounded-lg">
                                        <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                        </svg>
                                        {{ number_format($car->kilometrage) }} km
                                    </span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="h-72 bg-gradient-to-br from-gray-900 to-black flex items-center justify-center">
                            <div class="text-center text-white">
                                <svg class="w-20 h-20 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-xl font-semibold">{{ $car->marque }} {{ $car->modele }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- Specs Grid Noir/Rouge --}}
                    <div class="p-6 bg-gradient-to-br from-gray-50 to-white dark:from-gray-900 dark:to-black">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <div class="bg-white dark:bg-gray-900 rounded-xl p-4 border-2 border-gray-900 dark:border-gray-800 shadow-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wide">Année</span>
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $car->annee }}</p>
                            </div>

                            <div class="bg-white dark:bg-gray-900 rounded-xl p-4 border-2 border-gray-900 dark:border-gray-800 shadow-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wide">Km</span>
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                    </svg>
                                </div>
                                <p class="text-xl font-bold text-gray-900 dark:text-white">{{ number_format($car->kilometrage) }}</p>
                            </div>

                            <div class="bg-white dark:bg-gray-900 rounded-xl p-4 border-2 border-gray-900 dark:border-gray-800 shadow-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wide">Matricule</span>
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <p class="text-lg font-bold text-gray-900 dark:text-white font-mono">
                                    {{ $car->matricule_part1 }}-{{ $car->matricule_part2 }}-{{ $car->matricule_part3 }}
                                </p>
                            </div>

                            <div class="bg-gradient-to-br from-red-600 to-red-700 rounded-xl p-4 shadow-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold text-white uppercase tracking-wide">Statut</span>
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <p class="text-lg font-bold text-white">{{ $car->statut }}</p>
                            </div>
                        </div>

                        {{-- Prix de vente Noir/Rouge --}}
                        <div class="mt-6 bg-gradient-to-r from-gray-900 via-red-900 to-black rounded-2xl p-6 text-white border-2 border-red-600 shadow-2xl">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium opacity-90 mb-1">Prix de vente</p>
                                    <p class="text-4xl font-bold">{{ number_format($car->prix_vente, 0, ',', ' ') }} <span class="text-2xl">DH</span></p>
                                </div>
                                <svg class="w-16 h-16 opacity-20" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-.05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91s4.18 1.39 4.18 3.91c-.01 1.83-1.38 2.83-3.12 3.16z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card Client Noir/Rouge --}}
                <div class="bg-card shadow-2xl border-2 border-gray-900 dark:border-gray-800 rounded-2xl overflow-hidden">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 p-6 text-white">
                        <div class="flex items-center">
                            <div class="w-16 h-16 rounded-full bg-black/30 backdrop-blur-sm flex items-center justify-center text-white font-bold text-2xl mr-4 border-2 border-white/50 shadow-xl">
                                {{ substr($purchase->client->nom, 0, 1) }}{{ substr($purchase->client->prenom, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-medium opacity-90">Client</p>
                                <h3 class="text-2xl font-bold">{{ $purchase->client->nom }} {{ $purchase->client->prenom }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-gradient-to-br from-gray-50 to-white dark:from-gray-900 dark:to-black">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex items-center space-x-3 bg-white dark:bg-gray-900 rounded-xl p-4 border-2 border-gray-900 dark:border-gray-800 shadow-lg">
                                <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-secondary font-medium">Téléphone</p>
                                    <p class="font-bold text-primary">{{ $purchase->client->telephone }}</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3 bg-white dark:bg-gray-900 rounded-xl p-4 border-2 border-gray-900 dark:border-gray-800 shadow-lg">
                                <div class="w-10 h-10 rounded-full bg-black dark:bg-red-600 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-secondary font-medium">CNI</p>
                                    <p class="font-bold text-primary font-mono">{{ $purchase->client->cni }}</p>
                                </div>
                            </div>

                            @if($purchase->client->email)
                            <div class="flex items-center space-x-3 bg-white dark:bg-gray-900 rounded-xl p-4 border-2 border-gray-900 dark:border-gray-800 shadow-lg sm:col-span-2">
                                <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-secondary font-medium">Email</p>
                                    <p class="font-bold text-primary">{{ $purchase->client->email }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            {{-- Colonne Droite (1/3) - Financial Summary Noir/Rouge --}}
            <div class="lg:col-span-1 space-y-6">

                {{-- Card Financière --}}
                <div class="bg-card shadow-2xl border-2 border-gray-900 dark:border-gray-800 rounded-2xl overflow-hidden sticky top-6">
                    <div class="bg-gradient-to-br from-gray-900 via-red-900 to-black p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold">Résumé Financier</h3>
                            <svg class="w-8 h-8 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <p class="text-sm opacity-80 mb-1">Prix Total</p>
                                <p class="text-3xl font-bold">{{ number_format($purchase->prix_total, 0, ',', ' ') }} DH</p>
                            </div>

                            <div class="h-3 bg-black/30 rounded-full overflow-hidden border border-white/20">
                                <div class="h-full bg-gradient-to-r from-red-500 to-red-600 rounded-full transition-all duration-500 shadow-lg" 
                                     style="width: {{ $purchase->prix_total > 0 ? ($purchase->avance / $purchase->prix_total * 100) : 0 }}%"></div>
                            </div>

                            <div class="flex justify-between text-sm">
                                <span class="opacity-80">Progression</span>
                                <span class="font-bold">{{ $purchase->prix_total > 0 ? number_format($purchase->avance / $purchase->prix_total * 100, 1) : 0 }}%</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-4 bg-gradient-to-br from-gray-50 to-white dark:from-gray-900 dark:to-black">
                        <div class="bg-gradient-to-br from-gray-900 to-black dark:from-gray-800 dark:to-black rounded-xl p-4 border-2 border-gray-900 dark:border-gray-700 shadow-lg">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-bold text-white uppercase tracking-wide">Avance Versée</span>
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-white">
                                {{ number_format($purchase->avance, 0, ',', ' ') }} DH
                            </p>
                        </div>

                        <div class="bg-gradient-to-br from-red-600 to-red-700 rounded-xl p-4 shadow-lg {{ $purchase->reste > 0 ? 'animate-pulse' : 'opacity-50' }}">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-bold text-white uppercase tracking-wide">Reste à Payer</span>
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-white">
                                {{ number_format($purchase->reste, 0, ',', ' ') }} DH
                            </p>
                        </div>

                        <div class="border-t-2 border-gray-900 dark:border-gray-800 pt-4 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-secondary font-medium">Méthode</span>
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-black dark:bg-red-600 text-white">
                                    {{ ucfirst($purchase->payment_method) }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-sm text-secondary font-medium">Date</span>
                                <span class="text-sm font-bold text-primary">
                                    {{ \Carbon\Carbon::parse($purchase->date_achat)->format('d/m/Y') }}
                                </span>
                            </div>

                            @if($purchase->payment_method === 'cheque' && $purchase->cheque_scan)
                            <a href="{{ asset('storage/'.$purchase->cheque_scan) }}" 
                               target="_blank"
                               class="flex items-center justify-center gap-2 w-full bg-red-600 hover:bg-red-700 text-white font-bold px-4 py-2.5 rounded-xl transition-all shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Voir le chèque
                            </a>
                            @endif
                        </div>
                    </div>

                    <div class="bg-gray-100 dark:bg-black px-6 py-4 border-t-2 border-gray-900 dark:border-gray-800">
                        <div class="flex items-center text-xs text-secondary">
                            <svg class="w-4 h-4 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>Par <span class="font-bold text-primary">{{ $purchase->user->name }}</span></span>
                        </div>
                    </div>
                </div>

                {{-- Actions Rapides Noir/Rouge --}}
                <div class="bg-card shadow-2xl border-2 border-gray-900 dark:border-gray-800 rounded-2xl p-6 space-y-3">
                    <h4 class="text-sm font-bold text-secondary uppercase tracking-wide mb-4">Actions Rapides</h4>
                    
                    <a href="{{ route('purchases.edit', $purchase->id) }}" 
                        class="flex items-center gap-3 w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold px-4 py-3 rounded-xl transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Modifier
                    </a>

                   

                    <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" 
                          onsubmit="return confirm('⚠️ Supprimer définitivement ?')">
                        @csrf
                        @method('DELETE')
                        <button class="flex items-center gap-3 w-full bg-black hover:bg-gray-900 text-white font-bold px-4 py-3 rounded-xl transition-all border-2 border-red-600 shadow-lg hover:shadow-red-600/50">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Supprimer
                        </button>
                    </form>
                </div>

            </div>

        </div>

    </div>
</div>

<style>
@media print {
    .no-print, nav, footer, button, a[href*="edit"], form[method="POST"] {
        display: none !important;
    }
}
</style>
@endsection