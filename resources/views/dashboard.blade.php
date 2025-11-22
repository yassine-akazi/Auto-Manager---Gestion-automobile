@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="min-h-screen main-bg py-4 sm:py-8 px-3 sm:px-4 lg:px-8">
    
    <div class="max-w-7xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-6 sm:mb-8">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-primary mb-2 flex items-center gap-3">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Dashboard
                    </h1>
                    <p class="text-secondary text-sm sm:text-base">Bienvenue, <span class="text-red-500 font-semibold">{{ auth()->user()->name }}</span></p>
                </div>
                <div class="text-right">
                    <p class="text-xs sm:text-sm text-muted">Dernière connexion</p>
                    <p class="text-primary font-semibold text-sm sm:text-base">{{ now()->format('d/m/Y à H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Main Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
            
            {{-- Total Cars --}}
            <div class="bg-card rounded-xl sm:rounded-2xl shadow-2xl p-4 sm:p-6 border-2 border-card hover:border-red-600/50 transition-all duration-300 transform hover:scale-105 group">
                <div class="flex items-center justify-between mb-3 sm:mb-4">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-red-600 to-red-900 rounded-xl flex items-center justify-center shadow-lg shadow-red-900/50 group-hover:rotate-12 transition-transform">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-xs sm:text-sm font-semibold text-secondary uppercase tracking-wide">Total</p>
                    </div>
                </div>
                <div class="mt-3 sm:mt-4">
                    <p class="text-4xl sm:text-5xl font-bold text-primary mb-2">{{ $totalCars }}</p>
                    <p class="text-xs sm:text-sm text-secondary">
                        <span class="inline-flex items-center">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                            Voitures au total
                        </span>
                    </p>
                </div>
            </div>

            {{-- Sold Cars --}}
            <div class="bg-card rounded-xl sm:rounded-2xl shadow-2xl p-4 sm:p-6 border-2 border-green-900/50 hover:border-green-600/50 transition-all duration-300 transform hover:scale-105 group">
                <div class="flex items-center justify-between mb-3 sm:mb-4">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-green-600 to-green-900 rounded-xl flex items-center justify-center shadow-lg shadow-green-900/50 group-hover:rotate-12 transition-transform">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-xs sm:text-sm font-semibold text-secondary uppercase tracking-wide">Vendues</p>
                    </div>
                </div>
                <div class="mt-3 sm:mt-4">
                    <p class="text-4xl sm:text-5xl font-bold text-primary mb-2">{{ $soldCars }}</p>
                    <p class="text-xs sm:text-sm text-green-400">
                        <span class="inline-flex items-center">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $totalCars > 0 ? round(($soldCars / $totalCars) * 100, 1) : 0 }}% du total
                        </span>
                    </p>
                </div>
            </div>

            {{-- Available Cars --}}
            <div class="bg-card rounded-xl sm:rounded-2xl shadow-2xl p-4 sm:p-6 border-2 border-blue-900/50 hover:border-blue-600/50 transition-all duration-300 transform hover:scale-105 group">
                <div class="flex items-center justify-between mb-3 sm:mb-4">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-blue-600 to-blue-900 rounded-xl flex items-center justify-center shadow-lg shadow-blue-900/50 group-hover:rotate-12 transition-transform">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-xs sm:text-sm font-semibold text-secondary uppercase tracking-wide">Disponibles</p>
                    </div>
                </div>
                <div class="mt-3 sm:mt-4">
                    <p class="text-4xl sm:text-5xl font-bold text-primary mb-2">{{ $availableCars }}</p>
                    <p class="text-xs sm:text-sm text-blue-400">
                        <span class="inline-flex items-center">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $totalCars > 0 ? round(($availableCars / $totalCars) * 100, 1) : 0 }}% du total
                        </span>
                    </p>
                </div>
            </div>

        </div>

        {{-- Progress Bar --}}
        <div class="bg-card rounded-xl sm:rounded-2xl shadow-2xl p-4 sm:p-6 mb-6 sm:mb-8 border-2 border-card">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4 gap-3">
                <h3 class="text-lg sm:text-xl font-bold text-primary">Répartition des Véhicules</h3>
                <div class="flex flex-wrap items-center gap-3 sm:gap-4 text-xs sm:text-sm">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <span class="text-secondary">Vendues</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span class="text-secondary">Disponibles</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-gray-600 rounded-full"></div>
                        <span class="text-secondary">Autres</span>
                    </div>
                </div>
            </div>
            
            <div class="relative w-full h-6 sm:h-8 bg-gray-800 rounded-full overflow-hidden">
                @php
                    $soldPercent = $totalCars > 0 ? ($soldCars / $totalCars) * 100 : 0;
                    $availablePercent = $totalCars > 0 ? ($availableCars / $totalCars) * 100 : 0;
                    $otherPercent = 100 - $soldPercent - $availablePercent;
                @endphp
                
                <div class="absolute top-0 left-0 h-full bg-gradient-to-r from-green-600 to-green-500 transition-all duration-500" 
                     style="width: {{ $soldPercent }}%"></div>
                <div class="absolute top-0 h-full bg-gradient-to-r from-blue-600 to-blue-500 transition-all duration-500" 
                     style="left: {{ $soldPercent }}%; width: {{ $availablePercent }}%"></div>
                <div class="absolute top-0 h-full bg-gradient-to-r from-gray-600 to-gray-700 transition-all duration-500" 
                     style="left: {{ $soldPercent + $availablePercent }}%; width: {{ $otherPercent }}%"></div>
            </div>
            
            <div class="flex justify-between mt-3 sm:mt-4 text-xs sm:text-sm">
                <div class="text-center">
                    <p class="text-secondary">Vendues</p>
                    <p class="text-primary font-bold">{{ round($soldPercent, 1) }}%</p>
                </div>
                <div class="text-center">
                    <p class="text-secondary">Disponibles</p>
                    <p class="text-primary font-bold">{{ round($availablePercent, 1) }}%</p>
                </div>
                <div class="text-center">
                    <p class="text-secondary">Autres</p>
                    <p class="text-primary font-bold">{{ round($otherPercent, 1) }}%</p>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="mb-6 sm:mb-8">
            <h2 class="text-xl sm:text-2xl font-bold text-primary mb-4 sm:mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                Actions Rapides
            </h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                
                <a href="{{ route('cars.index') }}" 
                   class="bg-card rounded-lg sm:rounded-xl p-4 sm:p-6 border-2 border-card hover:border-red-600/50 transition-all duration-300 transform hover:scale-105 group">
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-red-600 to-red-900 rounded-xl flex items-center justify-center shadow-lg shadow-red-900/50 group-hover:rotate-12 transition-transform">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-primary font-semibold text-sm sm:text-base">Gérer Voitures</p>
                            <p class="text-secondary text-xs sm:text-sm">Liste complète</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('cars.create') }}" 
                   class="bg-card rounded-lg sm:rounded-xl p-4 sm:p-6 border-2 border-green-900/50 hover:border-green-600/50 transition-all duration-300 transform hover:scale-105 group">
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-green-600 to-green-900 rounded-xl flex items-center justify-center shadow-lg shadow-green-900/50 group-hover:rotate-12 transition-transform">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-primary font-semibold text-sm sm:text-base">Ajouter Voiture</p>
                            <p class="text-secondary text-xs sm:text-sm">Nouveau véhicule</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('clients.show') }}" 
                   class="bg-card rounded-lg sm:rounded-xl p-4 sm:p-6 border-2 border-blue-900/50 hover:border-blue-600/50 transition-all duration-300 transform hover:scale-105 group">
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-600 to-blue-900 rounded-xl flex items-center justify-center shadow-lg shadow-blue-900/50 group-hover:rotate-12 transition-transform">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-primary font-semibold text-sm sm:text-base">Gérer Clients</p>
                            <p class="text-secondary text-xs sm:text-sm">Base clients</p>
                        </div>
                    </div>
                </a>

                @if(auth()->user()->role === 'admin')
                <a href="{{ route('users.index') }}" 
                   class="bg-card rounded-lg sm:rounded-xl p-4 sm:p-6 border-2 border-purple-900/50 hover:border-purple-600/50 transition-all duration-300 transform hover:scale-105 group">
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-purple-600 to-purple-900 rounded-xl flex items-center justify-center shadow-lg shadow-purple-900/50 group-hover:rotate-12 transition-transform">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-primary font-semibold text-sm sm:text-base">Gérer Utilisateurs</p>
                            <p class="text-secondary text-xs sm:text-sm">Admin seulement</p>
                        </div>
                    </div>
                </a>
                @endif

            </div>
        </div>

        {{-- Additional Stats Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-6 sm:mb-8">
            
            {{-- Status Breakdown --}}
            <div class="bg-card rounded-xl sm:rounded-2xl shadow-2xl p-4 sm:p-6 border-2 border-card">
                <h3 class="text-lg sm:text-xl font-bold text-primary mb-4 sm:mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Statistiques par Statut
                </h3>
                
                <div class="space-y-3 sm:space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gray-800/30 rounded-lg border border-gray-700/30">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-secondary text-sm sm:text-base">Disponibles</span>
                        </div>
                        <span class="text-primary font-bold text-base sm:text-lg">{{ $availableCars }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-800/30 rounded-lg border border-gray-700/30">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-red-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            <span class="text-secondary text-sm sm:text-base">Vendues</span>
                        </div>
                        <span class="text-primary font-bold text-base sm:text-lg">{{ $soldCars }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-800/30 rounded-lg border border-gray-700/30">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-secondary text-sm sm:text-base">Réservées</span>
                        </div>
                        <span class="text-primary font-bold text-base sm:text-lg">{{ $totalCars - $availableCars - $soldCars }}</span>
                    </div>
                </div>
            </div>

            {{-- System Info --}}
            <div class="bg-card rounded-xl sm:rounded-2xl shadow-2xl p-4 sm:p-6 border-2 border-card">
                <h3 class="text-lg sm:text-xl font-bold text-primary mb-4 sm:mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Informations Système
                </h3>
                
                <div class="space-y-3 sm:space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gray-800/30 rounded-lg border border-gray-700/30">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="text-secondary text-sm sm:text-base">Utilisateur</span>
                        </div>
                        <span class="text-primary font-semibold text-sm sm:text-base truncate ml-2">{{ auth()->user()->name }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-800/30 rounded-lg border border-gray-700/30">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <span class="text-secondary text-sm sm:text-base">Rôle</span>
                        </div>
                        <span class="text-red-400 font-semibold capitalize text-sm sm:text-base">{{ auth()->user()->role }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-800/30 rounded-lg border border-gray-700/30">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-secondary text-sm sm:text-base">Date du jour</span>
                        </div>
                        <span class="text-primary font-semibold text-sm sm:text-base">{{ now()->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- Footer Info --}}
        <div class="bg-gradient-to-r from-red-900/20 to-red-800/10 rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-red-900/30 backdrop-blur-sm">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-red-600 to-red-900 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-red-400 mb-1 flex items-center gap-2 text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Astuce du jour
                    </h4>
                    <p class="text-secondary text-xs sm:text-sm">Utilisez les filtres de recherche pour trouver rapidement une voiture spécifique dans votre inventaire.</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection