@extends('layouts.app')

@section('title','Ajouter un client')

@section('content')
<div class="min-h-screen main-bg py-4 sm:py-8 px-3 sm:px-4 md:px-6 lg:px-8">
    
    <div class="max-w-3xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-6 sm:mb-8">
            <a href="{{ route('clients.show') }}" class="inline-flex items-center text-secondary hover:text-red-500 transition-colors group mb-4">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                <span class="text-sm sm:text-base">Retour à la liste</span>
            </a>
            
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-red-600 to-red-900 rounded-xl sm:rounded-2xl flex items-center justify-center shadow-lg shadow-red-900/50">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-primary mb-1">Ajouter un Client</h1>
                    <p class="text-xs sm:text-sm text-secondary">Enregistrer un nouveau client</p>
                </div>
            </div>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-900/20 border-l-4 border-green-500 text-green-400 p-3 sm:p-4 mb-4 sm:mb-6 rounded-lg shadow-md animate-slide-in backdrop-blur-sm">
                <div class="flex items-start">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2 sm:mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm sm:text-base">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        {{-- Form Container --}}
        <div class="bg-card rounded-2xl sm:rounded-3xl shadow-2xl overflow-hidden border-2 border-card">
            
            <form action="{{ route('clients.store') }}" method="POST" class="p-4 sm:p-6 md:p-8 space-y-4 sm:space-y-6">
                @csrf

                {{-- Nom --}}
                <div class="space-y-2">
                    <label class="block font-semibold text-primary text-xs sm:text-sm uppercase tracking-wide">
                        <span class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Nom <span class="text-red-500">*</span>
                        </span>
                    </label>
                    <input type="text" 
                           name="nom" 
                           value="{{ old('nom') }}" 
                           placeholder="Ex: Alami"
                           class="w-full bg-card border-2 {{ $errors->has('nom') ? 'border-red-500' : 'border-card' }} text-primary rounded-lg sm:rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 placeholder-gray-500 text-sm sm:text-base">
                    
                    @error('nom')
                        <div class="flex items-center gap-1 text-red-400 text-xs sm:text-sm mt-1 animate-slide-in">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @else
                        <p class="text-xs text-secondary mt-1">Nom de famille du client</p>
                    @enderror
                </div>

                {{-- Prénom --}}
                <div class="space-y-2">
                    <label class="block font-semibold text-primary text-xs sm:text-sm uppercase tracking-wide">
                        <span class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Prénom <span class="text-red-500">*</span>
                        </span>
                    </label>
                    <input type="text" 
                           name="prenom" 
                           value="{{ old('prenom') }}" 
                           placeholder="Ex: Mohammed"
                           class="w-full bg-card border-2 {{ $errors->has('prenom') ? 'border-red-500' : 'border-card' }} text-primary rounded-lg sm:rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 placeholder-gray-500 text-sm sm:text-base">
                    
                    @error('prenom')
                        <div class="flex items-center gap-1 text-red-400 text-xs sm:text-sm mt-1 animate-slide-in">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @else
                        <p class="text-xs text-secondary mt-1">Prénom du client</p>
                    @enderror
                </div>

                {{-- CNI --}}
                <div class="space-y-2">
                    <label class="block font-semibold text-primary text-xs sm:text-sm uppercase tracking-wide">
                        <span class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                            </svg>
                            CNI <span class="text-red-500">*</span>
                        </span>
                    </label>
                    <input type="text" 
                           name="cni" 
                           value="{{ old('cni') }}" 
                           placeholder="Ex: AB123456"
                           class="w-full bg-card border-2 {{ $errors->has('cni') ? 'border-red-500' : 'border-card' }} text-primary rounded-lg sm:rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 placeholder-gray-500 text-sm sm:text-base">
                    
                    @error('cni')
                        <div class="flex items-center gap-1 text-red-400 text-xs sm:text-sm mt-1 animate-slide-in">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @else
                        <p class="text-xs text-secondary mt-1">Numéro de la carte d'identité nationale</p>
                    @enderror
                </div>

                {{-- Téléphone --}}
                <div class="space-y-2">
                    <label class="block font-semibold text-primary text-xs sm:text-sm uppercase tracking-wide">
                        <span class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            Téléphone <span class="text-red-500">*</span>
                        </span>
                    </label>
                    <input type="text" 
                           name="telephone" 
                           value="{{ old('telephone') }}" 
                           placeholder="Ex: 0612345678"
                           class="w-full bg-card border-2 {{ $errors->has('telephone') ? 'border-red-500' : 'border-card' }} text-primary rounded-lg sm:rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 placeholder-gray-500 text-sm sm:text-base">
                    
                    @error('telephone')
                        <div class="flex items-center gap-1 text-red-400 text-xs sm:text-sm mt-1 animate-slide-in">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @else
                        <p class="text-xs text-secondary mt-1">Numéro de téléphone du client</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="space-y-2">
                    <label class="block font-semibold text-primary text-xs sm:text-sm uppercase tracking-wide">
                        <span class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Email <span class="text-muted text-xs">(optionnel)</span>
                        </span>
                    </label>
                    <input type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="Ex: client@email.com"
                           class="w-full bg-card border-2 {{ $errors->has('email') ? 'border-red-500' : 'border-card' }} text-primary rounded-lg sm:rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 placeholder-gray-500 text-sm sm:text-base">
                    
                    @error('email')
                        <div class="flex items-center gap-1 text-red-400 text-xs sm:text-sm mt-1 animate-slide-in">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @else
                        <p class="text-xs text-secondary mt-1">Adresse email du client (facultatif)</p>
                    @enderror
                </div>

                {{-- Info Box --}}
                <div class="bg-blue-900/10 border-l-4 border-blue-500 p-3 sm:p-4 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-500 mr-2 sm:mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h4 class="font-semibold text-primary text-sm sm:text-base mb-1">Informations</h4>
                            <p class="text-xs sm:text-sm text-secondary">Tous les champs marqués d'un astérisque (*) sont obligatoires.</p>
                        </div>
                    </div>
                </div>

                {{-- Submit Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-4 sm:pt-6 border-t-2 border-card">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-red-600 to-red-900 hover:from-red-700 hover:to-black text-white font-bold px-6 sm:px-8 py-3 sm:py-4 rounded-lg sm:rounded-xl shadow-lg shadow-red-900/50 transform hover:scale-105 transition-all duration-200 flex items-center justify-center gap-2 sm:gap-3 group text-sm sm:text-base">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="sm:text-lg">Ajouter le client</span>
                    </button>
                    <a href="{{ route('clients.show') }}" class="flex-1 bg-gray-700 text-white font-bold px-6 sm:px-8 py-3 sm:py-4 rounded-lg sm:rounded-xl shadow-lg hover:bg-gray-800 transform hover:scale-105 transition-all duration-200 flex items-center justify-center gap-2 sm:gap-3 border border-gray-600 text-sm sm:text-base">
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