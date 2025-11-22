@extends('layouts.app')

@section('title','Ajouter Voiture')

@section('content')
<div class="min-h-screen main-bg py-4 sm:py-8 px-3 sm:px-4 md:px-6 lg:px-8">
    
    <div class="max-w-5xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-6 sm:mb-8">
            <a href="{{ route('cars.index') }}" class="inline-flex items-center text-secondary hover:text-red-500 transition-colors group mb-4">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                <span class="text-sm sm:text-base">Retour à la liste</span>
            </a>
            
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-red-600 to-red-900 rounded-xl sm:rounded-2xl flex items-center justify-center shadow-lg shadow-red-900/50">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-primary mb-1">Ajouter une Voiture</h1>
                    <p class="text-xs sm:text-sm text-secondary">Remplissez les informations du véhicule</p>
                </div>
            </div>
        </div>

        {{-- Error Messages --}}
        @if($errors->any())
            <div class="bg-red-900/20 border-l-4 border-red-500 text-red-400 p-3 sm:p-4 mb-4 sm:mb-6 rounded-lg shadow-md animate-slide-in backdrop-blur-sm">
                <div class="flex items-start">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2 sm:mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="flex-1">
                        <h3 class="font-semibold mb-2 text-sm sm:text-base">Erreurs de validation :</h3>
                        <ul class="list-disc list-inside space-y-1 text-xs sm:text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Form Container --}}
        <div class="bg-card rounded-2xl sm:rounded-3xl shadow-2xl overflow-hidden border-2 border-card">
            
            <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6 md:p-8 space-y-6 sm:space-y-8">
                @csrf

                {{-- Section 1: Informations de Base --}}
                <div class="space-y-4 sm:space-y-6">
                    <div class="flex items-center gap-2 sm:gap-3 pb-3 sm:pb-4 border-b-2 border-card">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-red-600 to-red-900 rounded-lg sm:rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-red-900/50 text-sm sm:text-base">1</div>
                        <h2 class="text-xl sm:text-2xl font-bold text-primary">Informations de Base</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        {{-- Marque --}}
                        <div class="relative">
                            <label class="block mb-2 font-semibold text-primary text-xs sm:text-sm uppercase tracking-wide">
                                <span class="flex items-center gap-2">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    Marque <span class="text-red-500">*</span>
                                </span>
                            </label>
                            
                            <div class="custom-select-container">
                                <div id="marque-display" class="w-full bg-card border-2 border-card text-primary rounded-lg sm:rounded-xl px-3 sm:px-4 py-2 sm:py-3 cursor-pointer hover:border-red-800 transition-all flex items-center justify-between text-sm sm:text-base" onclick="toggleMarqueDropdown()">
                                    <span id="marque-selected-text" class="text-secondary truncate">-- Choisir une Marque --</span>
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500 transition-transform flex-shrink-0" id="marque-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                                
                                <div id="marque-dropdown" class="hidden absolute z-50 w-full mt-2 bg-card border-2 border-card rounded-lg sm:rounded-xl shadow-2xl overflow-hidden">
                                    <div class="p-2 sm:p-3 border-b border-card">
                                        <div class="relative">
                                            <svg class="absolute left-2 sm:left-3 top-2 sm:top-3 w-4 h-4 sm:w-5 sm:h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                            </svg>
                                            <input type="text" id="marque-search" placeholder="Rechercher..." class="w-full pl-8 sm:pl-10 pr-3 sm:pr-4 py-1.5 sm:py-2 bg-card border border-card text-primary rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 placeholder-gray-500 text-sm sm:text-base" autocomplete="off">
                                        </div>
                                    </div>
                                    <div id="marque-options" class="max-h-48 sm:max-h-64 overflow-y-auto custom-scrollbar"></div>
                                </div>
                                
                                <input type="hidden" id="marque" name="marque" required>
                            </div>
                        </div>

                        {{-- Modèle --}}
                        <div class="relative">
                            <label class="block mb-2 font-semibold text-primary text-xs sm:text-sm uppercase tracking-wide">
                                <span class="flex items-center gap-2">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Modèle <span class="text-red-500">*</span>
                                </span>
                            </label>
                            
                            <div class="custom-select-container">
                                <div id="modele-display" class="w-full bg-card border-2 border-card text-primary rounded-lg sm:rounded-xl px-3 sm:px-4 py-2 sm:py-3 cursor-not-allowed opacity-50 flex items-center justify-between text-sm sm:text-base">
                                    <span id="modele-selected-text" class="text-secondary truncate">-- Choisir d'abord une Marque --</span>
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-secondary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                                
                                <div id="modele-dropdown" class="hidden absolute z-50 w-full mt-2 bg-card border-2 border-card rounded-lg sm:rounded-xl shadow-2xl overflow-hidden">
                                    <div class="p-2 sm:p-3 border-b border-card">
                                        <div class="relative">
                                            <svg class="absolute left-2 sm:left-3 top-2 sm:top-3 w-4 h-4 sm:w-5 sm:h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                            </svg>
                                            <input type="text" id="modele-search" placeholder="Rechercher..." class="w-full pl-8 sm:pl-10 pr-3 sm:pr-4 py-1.5 sm:py-2 bg-card border border-card text-primary rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 placeholder-gray-500 text-sm sm:text-base" autocomplete="off">
                                        </div>
                                    </div>
                                    <div id="modele-options" class="max-h-48 sm:max-h-64 overflow-y-auto custom-scrollbar"></div>
                                </div>
                                
                                <input type="hidden" id="modele" name="modele" required>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <div class="relative">
                            <label class="block mb-2 font-semibold text-primary text-xs sm:text-sm uppercase tracking-wide">
                                <span class="flex items-center gap-2">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Année <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <input type="number" name="annee" value="{{ old('annee') }}" placeholder="Ex: 2023" min="1900" max="2026" class="w-full bg-card border-2 border-card text-primary rounded-lg sm:rounded-xl px-3 sm:px-4 py-2 sm:py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 placeholder-gray-500 text-sm sm:text-base" required>
                        </div>

                        <div class="relative">
                            <label class="block mb-2 font-semibold text-primary text-xs sm:text-sm uppercase tracking-wide">
                                <span class="flex items-center gap-2">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                    Kilométrage (km) <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <input type="number" name="kilometrage" value="{{ old('kilometrage') }}" placeholder="Ex: 45000" min="0" class="w-full bg-card border-2 border-card text-primary rounded-lg sm:rounded-xl px-3 sm:px-4 py-2 sm:py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 placeholder-gray-500 text-sm sm:text-base" required>
                        </div>
                    </div>
                </div>

                {{-- Section 2: Informations Financières --}}
                <div class="space-y-4 sm:space-y-6">
                    <div class="flex items-center gap-2 sm:gap-3 pb-3 sm:pb-4 border-b-2 border-card">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-red-600 to-red-900 rounded-lg sm:rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-red-900/50 text-sm sm:text-base">2</div>
                        <h2 class="text-xl sm:text-2xl font-bold text-primary">Informations Financières</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <div class="relative">
                            <label class="block mb-2 font-semibold text-primary text-xs sm:text-sm uppercase tracking-wide">
                                <span class="flex items-center gap-2">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                    </svg>
                                    Prix d'achat (DH) <span class="text-red-500">*</span>
                                </span>
                            </label>
                            <div class="relative">
                                <input type="number" name="prix_achat" step="0.01" value="{{ old('prix_achat') }}" placeholder="Ex: 150000" class="w-full bg-card border-2 border-card text-primary rounded-lg sm:rounded-xl pl-10 sm:pl-12 pr-3 sm:pr-4 py-2 sm:py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 placeholder-gray-500 text-sm sm:text-base" required>
                                <div class="absolute left-3 sm:left-4 top-2.5 sm:top-3.5 text-red-400 font-semibold text-xs sm:text-base">DH</div>
                            </div>
                        </div>

                        <div class="relative">
                            <label class="block mb-2 font-semibold text-primary text-xs sm:text-sm uppercase tracking-wide">
                                <span class="flex items-center gap-2">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Prix de vente (DH)
                                </span>
                            </label>
                            <div class="relative">
                                <input type="number" name="prix_vente" step="0.01" value="{{ old('prix_vente') }}" placeholder="Ex: 180000" class="w-full bg-card border-2 border-card text-primary rounded-lg sm:rounded-xl pl-10 sm:pl-12 pr-3 sm:pr-4 py-2 sm:py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 placeholder-gray-500 text-sm sm:text-base">
                                <div class="absolute left-3 sm:left-4 top-2.5 sm:top-3.5 text-red-400 font-semibold text-xs sm:text-base">DH</div>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <label class="block mb-2 font-semibold text-primary text-xs sm:text-sm uppercase tracking-wide">
                            <span class="flex items-center gap-2">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Date d'achat <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <input type="date" name="date_dachat" value="{{ old('date_dachat') }}" class="w-full bg-card border-2 border-card text-primary rounded-lg sm:rounded-xl px-3 sm:px-4 py-2 sm:py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 text-sm sm:text-base" required>
                    </div>
                </div>

                {{-- Section 3: Identification --}}
                <div class="space-y-4 sm:space-y-6">
                    <div class="flex items-center gap-2 sm:gap-3 pb-3 sm:pb-4 border-b-2 border-card">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-red-600 to-red-900 rounded-lg sm:rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-red-900/50 text-sm sm:text-base">3</div>
                        <h2 class="text-xl sm:text-2xl font-bold text-primary">Identification</h2>
                    </div>

                    <div>
                        <label class="block mb-2 sm:mb-3 font-semibold text-primary text-xs sm:text-sm uppercase tracking-wide">
                            <span class="flex items-center gap-2">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Matricule Marocain <span class="text-red-500">*</span>
                            </span>
                        </label>
                        
                        {{-- Version Mobile (Verticale) --}}
                        <div class="md:hidden space-y-3">
                            <div>
                                <label class="block text-xs text-secondary mb-1.5 font-medium">Numéro</label>
                                <input type="text" name="matricule_part1" placeholder="20003" value="{{ old('matricule_part1') }}" 
                                       class="w-full bg-card border-2 border-card text-primary rounded-lg px-4 py-3 text-center text-lg font-bold focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 placeholder-gray-500" required>
                            </div>
                            
                            <div>
                                <label class="block text-xs text-secondary mb-1.5 font-medium">Lettre</label>
                                <input type="text" name="matricule_part2" placeholder="B" value="{{ old('matricule_part2') }}" maxlength="1" 
                                       class="w-full bg-card border-2 border-card text-primary rounded-lg px-4 py-3 text-center text-lg font-bold uppercase focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 placeholder-gray-500" required>
                            </div>
                            
                            <div>
                                <label class="block text-xs text-secondary mb-1.5 font-medium">Code Ville</label>
                                <input type="text" name="matricule_part3" placeholder="33" value="{{ old('matricule_part3') }}" 
                                       class="w-full bg-card border-2 border-card text-primary rounded-lg px-4 py-3 text-center text-lg font-bold focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 placeholder-gray-500" required>
                            </div>
                        </div>
                        
                        {{-- Version Desktop/Tablet (Horizontale) --}}
                        <div class="hidden md:flex gap-3 items-center">
                            <input type="text" placeholder="20003" value="{{ old('matricule_part1') }}" 
                                   class="flex-1 bg-card border-2 border-card text-primary rounded-xl px-4 py-3 text-center text-lg font-bold focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 placeholder-gray-500" 
                                   oninput="document.getElementsByName('matricule_part1')[0].value = this.value">
                            <span class="text-2xl text-red-500 font-bold">-</span>
                            <input type="text" placeholder="B" value="{{ old('matricule_part2') }}" maxlength="1" 
                                   class="w-20 bg-card border-2 border-card text-primary rounded-xl px-4 py-3 text-center text-lg font-bold uppercase focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 placeholder-gray-500" 
                                   oninput="document.getElementsByName('matricule_part2')[0].value = this.value.toUpperCase()">
                            <span class="text-2xl text-red-500 font-bold">-</span>
                            <input type="text" placeholder="33" value="{{ old('matricule_part3') }}" 
                                   class="flex-1 bg-card border-2 border-card text-primary rounded-xl px-4 py-3 text-center text-lg font-bold focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 placeholder-gray-500" 
                                   oninput="document.getElementsByName('matricule_part3')[0].value = this.value">
                        </div>
                        
                        <p class="mt-2 text-xs sm:text-sm text-secondary">Format: XXXXX - Lettre - XX</p>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold text-primary text-xs sm:text-sm uppercase tracking-wide">
                            <span class="flex items-center gap-2">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Statut <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <select name="statut" class="w-full bg-card border-2 border-card text-primary rounded-lg sm:rounded-xl px-3 sm:px-4 py-2 sm:py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 appearance-none text-sm sm:text-base custom-select">
                            @foreach(['Disponible','Réservée','En réparation','En inspection','En négociation','Vendue','Hors stock'] as $status)
                                <option value="{{ $status }}" {{ old('statut', 'Disponible') == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Section 4: Photo --}}
                <div class="space-y-4 sm:space-y-6">
                    <div class="flex items-center gap-2 sm:gap-3 pb-3 sm:pb-4 border-b-2 border-card">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-red-600 to-red-900 rounded-lg sm:rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-red-900/50 text-sm sm:text-base">4</div>
                        <h2 class="text-xl sm:text-2xl font-bold text-primary flex items-center gap-2">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="hidden sm:inline">Photo du Véhicule</span>
                            <span class="sm:hidden">Photo</span>
                        </h2>
                    </div>

                    <div>
                        <label class="block mb-2 sm:mb-3 font-semibold text-primary text-xs sm:text-sm uppercase tracking-wide">
                            <span class="flex items-center gap-2">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Ajouter une image
                            </span>
                        </label>
                        
                        <div class="relative border-2 border-dashed border-card rounded-lg sm:rounded-xl p-4 sm:p-8 text-center hover:border-red-600 transition-all duration-200 bg-card hover:bg-red-900/10 cursor-pointer" onclick="document.getElementById('image-upload').click()">
                            <input type="file" name="image" id="image-upload" accept="image/*" class="hidden" onchange="handleSingleImageUpload(event)">
                            <div class="pointer-events-none">
                                <svg class="w-12 h-12 sm:w-16 sm:h-16 text-secondary mx-auto mb-3 sm:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="text-secondary font-medium mb-1 sm:mb-2 text-sm sm:text-base">Cliquez pour télécharger</p>
                                <p class="text-xs sm:text-sm text-muted">PNG, JPG, JPEG jusqu'à 10MB</p>
                            </div>
                        </div>

                        <div id="image-preview" class="mt-4 sm:mt-6 hidden">
                            <div class="relative max-w-md mx-auto">
                                <div class="aspect-video rounded-lg sm:rounded-xl overflow-hidden border-2 border-card shadow-lg">
                                    <img id="preview-img" src="" alt="Preview" class="w-full h-full object-cover">
                                </div>
                                <button type="button" onclick="removeSingleImage()" class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white p-1.5 sm:p-2 rounded-full transition-all duration-200 transform hover:scale-110 shadow-lg">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-4 sm:pt-6 border-t-2 border-card">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-red-600 to-red-900 text-white font-bold px-6 sm:px-8 py-3 sm:py-4 rounded-lg sm:rounded-xl shadow-lg shadow-red-900/50 hover:from-red-700 hover:to-black transform hover:scale-105 transition-all duration-200 flex items-center justify-center gap-2 sm:gap-3 group text-sm sm:text-base">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="sm:text-lg">Enregistrer</span>
                    </button>
                    <a href="{{ route('cars.index') }}" class="flex-1 bg-gray-700 text-white font-bold px-6 sm:px-8 py-3 sm:py-4 rounded-lg sm:rounded-xl shadow-lg hover:bg-gray-800 transform hover:scale-105 transition-all duration-200 flex items-center justify-center gap-2 sm:gap-3 border border-gray-600 text-sm sm:text-base">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span class="sm:text-lg">Annuler</span>
                    </a>
                </div>

            </form>
        </div>

    </div>
</div>

<script>
const marquesModeles = {"Abarth":["124 Spider","500","595","695","Grande Punto","Punto Evo"],"AC":["Ace","Aceca","Cobra","428","3000ME","Ace 2.0"],"Acura":["CL","CSX","EL","ILX","Integra","Legend","MDX","NSX","RDX","RL","RLX","RSX","SLX","TL","TLX","TSX","Vigor","ZDX"],"Aixam":["City","Crossline","Coupe","GTO","Scouty","Mega"],"Alfa Romeo":["33","75","90","145","146","147","155","156","159","164","166","1750","2000","2300","2600","4C","6C","8C","Alfasud","Alfetta","Arna","Brera","Giulia","Giulietta","GT","GTV","Junior","Mito","Montreal","Spider","Stelvio","Tonale"],"Aston Martin":["DB2","DB3","DB4","DB5","DB6","DB7","DB9","DB10","DB11","DB12","DBS","DBX","Lagonda","Rapide","V8","V12","Vanquish","Vantage","Virage","Vulcan","Valkyrie","Victor"],"Audi":["50","80","90","100","200","A1","A2","A3","A4","A5","A6","A7","A8","Allroad","Cabriolet","Coupe","e-tron","Q2","Q3","Q4","Q5","Q6","Q7","Q8","Quattro","R8","RS2","RS3","RS4","RS5","RS6","RS7","RS Q3","RS Q8","S1","S2","S3","S4","S5","S6","S7","S8","SQ2","SQ5","SQ7","SQ8","TT","TTS","TT RS","V8"],"BMW":["1 Series","2 Series","3 Series","4 Series","5 Series","6 Series","7 Series","8 Series","i3","i4","i5","i7","i8","iX","iX1","iX3","M1","M2","M3","M4","M5","M6","M8","X1","X2","X3","X4","X5","X6","X7","XM","Z1","Z3","Z4","Z8"],"Citroen":["2CV","Acadiane","AX","Axel","Berlingo","BX","C-Crosser","C-Elysee","C-Zero","C1","C2","C3","C3 Aircross","C3 Picasso","C4","C4 Aircross","C4 Cactus","C4 Picasso","C4 SpaceTourer","C5","C5 Aircross","C5 X","C6","C8","CX","DS","DS3","DS4","DS5","Dyane","Evasion","GS","GSA","Jumper","Jumpy","LN","LNA","Mehari","Nemo","Saxo","SM","SpaceTourer","Visa","Xantia","XM","Xsara","Xsara Picasso","ZX"],"Dacia":["Dokker","Duster","Jogger","Logan","Lodgy","Sandero","Solenza","Spring"],"Fiat":["124","126","127","128","130","131","132","500","500L","500X","600","850","Albea","Barchetta","Brava","Bravo","Cinquecento","Coupe","Croma","Doblo","Ducato","Fiorino","Freemont","Grande Punto","Idea","Linea","Marea","Multipla","Palio","Panda","Punto","Qubo","Regata","Ritmo","Scudo","Sedici","Seicento","Stilo","Strada","Talento","Tempra","Tipo","Ulysse","Uno","X1/9"],"Ford":["Aerostar","Aspire","B-MAX","Bronco","C-MAX","Contour","Cougar","Courier","Crown Victoria","EcoSport","Edge","Escape","Escort","Excursion","Expedition","Explorer","F-150","F-250","F-350","Fiesta","Five Hundred","Flex","Focus","Freestar","Freestyle","Fusion","Galaxy","Granada","Grand C-MAX","GT","Ka","Kuga","Maverick","Mondeo","Mustang","Orion","Probe","Puma","Ranger","S-MAX","Scorpio","Sierra","Streetka","Taunus","Taurus","Tempo","Thunderbird","Tourneo","Transit","Windstar"],"Honda":["Accord","Aerodeck","Civic","City","Clarity","Concerto","CR-V","CR-X","CR-Z","e","Element","FR-V","HR-V","Insight","Integra","Jazz","Legend","Logo","NSX","Odyssey","Passport","Pilot","Prelude","Quintet","Ridgeline","S2000","Shuttle","Stream"],"Mercedes-Benz":["190","A-Class","AMG GT","B-Class","C-Class","CLA","CLC","CLK","CLS","E-Class","EQA","EQB","EQC","EQE","EQS","EQV","G-Class","GL","GLA","GLB","GLC","GLE","GLK","GLS","M-Class","Maybach","R-Class","S-Class","SL","SLC","SLK","SLR","SLS","Sprinter","V-Class","Vaneo","Viano","Vito","X-Class"],"Peugeot":["1007","104","106","107","108","2008","204","205","206","207","208","3008","301","304","305","306","307","308","309","4007","4008","404","405","406","407","5008","504","505","508","604","605","607","806","807","Bipper","Boxer","Expert","iOn","Partner","RCZ","Rifter","Traveller"],"Renault":["4","5","6","9","11","12","14","18","19","20","21","25","30","Alaskan","Arkana","Avantime","Austral","Captur","Clio","Espace","Express","Fluence","Fuego","Kadjar","Kangoo","Koleos","Laguna","Latitude","Megane","Modus","Rafale","Rapid","Safrane","Scenic","Talisman","Thalia","Trafic","Twingo","Twizy","Vel Satis","Wind","Zoe"],"Toyota":["4Runner","Auris","Avalon","Avensis","Aygo","Camry","Carina","Celica","C-HR","Corolla","Corona","Cressida","Crown","FJ Cruiser","GR86","Highlander","Hilux","Land Cruiser","Matrix","Mirai","MR2","Paseo","Picnic","Previa","Prius","ProAce","RAV4","Sequoia","Sienna","Starlet","Supra","Tacoma","Tercel","Tundra","Urban Cruiser","Verso","Yaris","Yaris Cross"],"Volkswagen":["Arteon","Atlas","Beetle","Bora","Caddy","Caravelle","CC","Corrado","Crafter","Eos","Fox","Golf","ID.3","ID.4","ID.5","ID.7","ID.Buzz","Jetta","Lupo","Multivan","New Beetle","Passat","Phaeton","Pointer","Polo","Routan","Scirocco","Sharan","T-Cross","T-Roc","Taigo","Taos","Tiguan","Touareg","Touran","Transporter","Up","Vento"]};

let allMarques = Object.keys(marquesModeles).sort();
let currentModeles = [];
let marqueDropdownOpen = false;
let modeleDropdownOpen = false;

function loadMarques(filter = '') {
    const container = document.getElementById('marque-options');
    container.innerHTML = '';
    const filtered = filter ? allMarques.filter(m => m.toLowerCase().includes(filter.toLowerCase())) : allMarques;
    filtered.forEach(marque => {
        const option = document.createElement('div');
        option.className = 'px-3 sm:px-4 py-2 sm:py-3 hover:bg-red-900/30 cursor-pointer transition-colors border-b border-card last:border-0 flex items-center justify-between group text-sm sm:text-base';
        option.innerHTML = `<span class="text-primary">${marque}</span><svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>`;
        option.onclick = () => selectMarque(marque);
        container.appendChild(option);
    });
}

function selectMarque(marque) {
    document.getElementById('marque').value = marque;
    document.getElementById('marque-selected-text').textContent = marque;
    document.getElementById('marque-selected-text').classList.remove('text-secondary');
    document.getElementById('marque-selected-text').classList.add('text-primary');
    toggleMarqueDropdown();
    const modeleDisplay = document.getElementById('modele-display');
    modeleDisplay.classList.remove('cursor-not-allowed', 'opacity-50');
    modeleDisplay.classList.add('cursor-pointer', 'hover:border-red-800');
    modeleDisplay.onclick = toggleModeleDropdown;
    loadModeles(marque);
}

function loadModeles(marque, filter = '') {
    const container = document.getElementById('modele-options');
    container.innerHTML = '';
    if (marque && marquesModeles[marque]) {
        currentModeles = marquesModeles[marque];
        const filtered = filter ? currentModeles.filter(m => m.toLowerCase().includes(filter.toLowerCase())) : currentModeles;
        filtered.forEach(modele => {
            const option = document.createElement('div');
            option.className = 'px-3 sm:px-4 py-2 sm:py-3 hover:bg-red-900/30 cursor-pointer transition-colors border-b border-card last:border-0 flex items-center justify-between group text-sm sm:text-base';
            option.innerHTML = `<span class="text-primary">${modele}</span><svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>`;
            option.onclick = () => selectModele(modele);
            container.appendChild(option);
        });
        document.getElementById('modele-selected-text').textContent = '-- Choisir un Modèle --';
    }
}

function selectModele(modele) {
    document.getElementById('modele').value = modele;
    document.getElementById('modele-selected-text').textContent = modele;
    document.getElementById('modele-selected-text').classList.remove('text-secondary');
    document.getElementById('modele-selected-text').classList.add('text-primary');
    toggleModeleDropdown();
}

function toggleMarqueDropdown() {
    const dropdown = document.getElementById('marque-dropdown');
    const arrow = document.getElementById('marque-arrow');
    marqueDropdownOpen = !marqueDropdownOpen;
    if (marqueDropdownOpen) {
        dropdown.classList.remove('hidden');
        arrow.style.transform = 'rotate(180deg)';
        loadMarques();
        document.getElementById('marque-search').focus();
        if (modeleDropdownOpen) toggleModeleDropdown();
    } else {
        dropdown.classList.add('hidden');
        arrow.style.transform = 'rotate(0deg)';
    }
}

function toggleModeleDropdown() {
    const dropdown = document.getElementById('modele-dropdown');
    modeleDropdownOpen = !modeleDropdownOpen;
    if (modeleDropdownOpen) {
        dropdown.classList.remove('hidden');
        document.getElementById('modele-search').focus();
        if (marqueDropdownOpen) toggleMarqueDropdown();
    } else {
        dropdown.classList.add('hidden');
    }
}

document.getElementById('marque-search').addEventListener('input', (e) => loadMarques(e.target.value));
document.getElementById('modele-search').addEventListener('input', (e) => {
    const selectedMarque = document.getElementById('marque').value;
    if (selectedMarque) loadModeles(selectedMarque, e.target.value);
});

document.addEventListener('click', (e) => {
    if (!e.target.closest('.custom-select-container')) {
        if (marqueDropdownOpen) toggleMarqueDropdown();
        if (modeleDropdownOpen) toggleModeleDropdown();
    }
});

loadMarques();

function handleSingleImageUpload(event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

function removeSingleImage() {
    document.getElementById('image-upload').value = '';
    document.getElementById('image-preview').classList.add('hidden');
    document.getElementById('preview-img').src = '';
}

document.querySelector('input[name="matricule_part2"]')?.addEventListener('input', function(e) {
    this.value = this.value.toUpperCase();
});
</script>

<style>
.custom-scrollbar::-webkit-scrollbar { width: 6px; }
@media (min-width: 640px) { .custom-scrollbar::-webkit-scrollbar { width: 8px; } }
.custom-scrollbar::-webkit-scrollbar-track { background: #1a1a1a; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #dc2626 0%, #7f1d1d 100%); border-radius: 4px; }
.custom-scrollbar::-webkit-scrollbar-thumb:hover { background: linear-gradient(180deg, #ef4444 0%, #dc2626 100%); }
@keyframes slide-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
.animate-slide-in { animation: slide-in 0.5s ease forwards; }
input[type="date"]::-webkit-calendar-picker-indicator { filter: invert(1); cursor: pointer; }
.custom-select {
    background-image: url('data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 20 20\'%3e%3cpath stroke=\'%23dc2626\' stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'1.5\' d=\'M6 8l4 4 4-4\'/%3e%3c/svg%3e');
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
}
</style>
@endsection