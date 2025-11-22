@extends('layouts.app')

@section('title','Liste des voitures')

@section('content')
<div class="min-h-screen main-bg py-4 sm:py-8 px-3 sm:px-4 lg:px-8">

    <div class="max-w-7xl mx-auto">
        
        {{-- Header Section --}}
        <div class="mb-6 sm:mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-primary mb-2 flex items-center gap-3">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                        Catalogue de Véhicules
                    </h1>
                    <p class="text-secondary text-sm sm:text-base">Gérez votre inventaire de voitures en toute simplicité</p>
                </div>
                
                <a href="{{ route('cars.create') }}" 
                   class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-red-600 to-red-800 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-semibold hover:from-red-700 hover:to-red-900 transform hover:scale-105 transition-all duration-200 shadow-lg shadow-red-900/50 hover:shadow-red-600/50 group text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Ajouter une voiture</span>
                </a>
            </div>
        </div>

        {{-- Filter Section --}}
        <div class="bg-card rounded-xl sm:rounded-2xl shadow-2xl p-4 sm:p-6 mb-6 sm:mb-8 border-2 border-card">
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                <h2 class="text-base sm:text-lg font-semibold text-primary">Filtres de recherche</h2>
            </div>
            
            <form action="{{ route('cars.filter') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                
                {{-- Search Input --}}
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" 
                           name="search" 
                           placeholder="Marque, modèle..." 
                           value="{{ request('search') }}" 
                           class="pl-9 sm:pl-10 w-full bg-card border-2 border-card text-primary rounded-lg sm:rounded-xl px-3 sm:px-4 py-2 sm:py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 placeholder-gray-500 text-sm sm:text-base">
                </div>

                {{-- Year Input --}}
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <input type="number" 
                           name="annee_exacte" 
                           placeholder="Année exacte" 
                           value="{{ request('annee_exacte') }}" 
                           class="pl-9 sm:pl-10 w-full bg-card border-2 border-card text-primary rounded-lg sm:rounded-xl px-3 sm:px-4 py-2 sm:py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 placeholder-gray-500 text-sm sm:text-base">
                </div>

                {{-- Status Select --}}
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <select name="statut" 
                            class="pl-9 sm:pl-10 w-full bg-card border-2 border-card text-primary rounded-lg sm:rounded-xl px-3 sm:px-4 py-2 sm:py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 appearance-none text-sm sm:text-base custom-select">
                        <option value="">Tous les statuts</option>
                        <option value="Disponible" {{ request('statut')=='Disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="Réservée" {{ request('statut')=='Réservée' ? 'selected' : '' }}>Réservée</option>
                        <option value="En réparation" {{ request('statut')=='En réparation' ? 'selected' : '' }}>En réparation</option>
                        <option value="En inspection" {{ request('statut')=='En inspection' ? 'selected' : '' }}>En inspection</option>
                        <option value="En négociation" {{ request('statut')=='En négociation' ? 'selected' : '' }}>En négociation</option>
                        <option value="Vendue" {{ request('statut')=='Vendue' ? 'selected' : '' }}>Vendue</option>
                        <option value="Hors stock" {{ request('statut')=='Hors stock' ? 'selected' : '' }}>Hors stock</option>
                    </select>
                </div>

                {{-- Submit Button --}}
                <button type="submit" 
                        class="bg-gradient-to-r from-red-600 to-red-800 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg sm:rounded-xl font-semibold hover:from-red-700 hover:to-red-900 transform hover:scale-105 transition-all duration-200 shadow-lg shadow-red-900/50 hover:shadow-red-600/50 flex items-center justify-center gap-2 text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filtrer
                </button>
            </form>
        </div>

        {{-- Stats Bar --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 mb-6 sm:mb-8">
            <div class="bg-card rounded-lg sm:rounded-xl p-4 border-2 border-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs sm:text-sm text-secondary font-medium">Total Voitures</p>
                        <p class="text-2xl sm:text-3xl font-bold text-primary">{{ $cars->total() }}</p>
                    </div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-red-600 to-red-800 rounded-lg sm:rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-card rounded-lg sm:rounded-xl p-4 border-2 border-green-900/50">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs sm:text-sm text-secondary font-medium">Disponibles</p>
                        <p class="text-2xl sm:text-3xl font-bold text-primary">{{ $cars->where('statut', 'Disponible')->count() }}</p>
                    </div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-green-600 to-green-800 rounded-lg sm:rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-card rounded-lg sm:rounded-xl p-4 border-2 border-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs sm:text-sm text-secondary font-medium">Vendues</p>
                        <p class="text-2xl sm:text-3xl font-bold text-primary">{{ $cars->where('statut', 'Vendue')->count() }}</p>
                    </div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-red-600 to-red-800 rounded-lg sm:rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cars Grid --}}
        @if($cars->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
                @foreach($cars as $car)
                <div class="bg-card rounded-xl sm:rounded-2xl shadow-2xl overflow-hidden hover:shadow-red-900/50 transform hover:-translate-y-2 transition-all duration-300 border-2 border-card group">

                    {{-- Image avec overlay --}}
                    <div class="relative overflow-hidden">
                        <img src="{{ $car->image ? asset('uploads/cars/'.$car->image) : asset('uploads/cars/default.png') }}" 
                             alt="{{ $car->marque }}" 
                             class="w-full h-40 sm:h-48 object-cover transform group-hover:scale-110 transition-transform duration-500">
                        
                        {{-- Status Badge --}}
                        <div class="absolute top-2 sm:top-3 right-2 sm:right-3">
                            <span class="px-2 sm:px-3 py-1 sm:py-1.5 rounded-full text-white text-xs font-semibold shadow-lg backdrop-blur-sm
                                {{ $car->statut == 'Disponible' ? 'bg-green-500/90' : ($car->statut == 'Vendue' ? 'bg-red-500/90' : 'bg-yellow-500/90') }}">
                                {{ $car->statut }}
                            </span>
                        </div>

                        {{-- Quick View Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-red-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3 sm:p-4">
                            <a href="{{ route('cars.show',$car) }}" 
                               class="w-full bg-white/90 backdrop-blur-sm text-gray-900 px-3 sm:px-4 py-2 rounded-lg font-semibold text-center hover:bg-white transition-colors flex items-center justify-center gap-2 text-xs sm:text-sm">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Voir les détails
                            </a>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-4 sm:p-5">
                        <h2 class="text-lg sm:text-xl font-bold text-primary mb-2 truncate">
                            {{ $car->marque }} {{ $car->modele }}
                        </h2>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-secondary">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-xs sm:text-sm">{{ $car->annee }}</span>
                            </div>
                            
                            <div class="flex items-center">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-base sm:text-lg font-bold text-primary">
                                    {{ $car->prix_vente ? number_format($car->prix_vente, 0, ',', ' ') . ' DH' : 'N/A' }}
                                </span>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex gap-2 pt-3 sm:pt-4 border-t border-card">
                            <a href="{{ route('cars.edit',$car) }}" 
                               class="flex-1 bg-gradient-to-r from-red-600 to-red-800 text-white px-2 sm:px-3 py-2 rounded-lg hover:from-red-700 hover:to-red-900 transition-all duration-200 text-center text-xs sm:text-sm font-semibold shadow-md shadow-red-900/50 hover:shadow-red-600/50 transform hover:scale-105 flex items-center justify-center gap-1">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                <span class="hidden sm:inline">Modifier</span>
                            </a>
                            
                            <form action="{{ route('cars.destroy',$car) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('⚠️ Êtes-vous sûr de vouloir supprimer {{ $car->marque }} {{ $car->modele }} ?')" 
                                  class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-gray-700 to-gray-900 text-white px-2 sm:px-3 py-2 rounded-lg hover:from-gray-800 hover:to-black transition-all duration-200 text-xs sm:text-sm font-semibold shadow-md shadow-gray-900/50 hover:shadow-black/50 transform hover:scale-105 border border-gray-700 flex items-center justify-center gap-1">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    <span class="hidden sm:inline">Supprimer</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            {{-- Empty State --}}
            <div class="bg-card rounded-xl sm:rounded-2xl shadow-2xl p-8 sm:p-12 text-center border-2 border-card">
                <div class="w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-red-900/30 to-red-800/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-primary mb-2">Aucune voiture trouvée</h3>
                <p class="text-secondary mb-6 text-sm sm:text-base">Ajoutez votre première voiture pour commencer</p>
                <a href="{{ route('cars.create') }}" 
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-red-600 to-red-800 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-semibold hover:from-red-700 hover:to-red-900 transform hover:scale-105 transition-all duration-200 shadow-lg shadow-red-900/50 text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Ajouter une voiture
                </a>
            </div>
        @endif

        {{-- Pagination --}}
        @if($cars->hasPages())
            <div class="bg-card rounded-xl sm:rounded-2xl shadow-2xl p-4 sm:p-6 border-2 border-card">
                <div class="flex justify-center">
                    {{ $cars->links() }}
                </div>
            </div>
        @endif

    </div>
</div>

<style>
    .custom-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23dc2626' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }
</style>
@endsection