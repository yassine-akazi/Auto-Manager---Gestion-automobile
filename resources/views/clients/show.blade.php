@extends('layouts.app')

@section('title','Clients')

@section('content')
<div class="min-h-screen main-bg py-4 sm:py-6 px-3 sm:px-4">
    <div class="container mx-auto max-w-7xl">
        
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 sm:gap-4 mb-4 sm:mb-6">
            <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-red-600 to-red-900 rounded-xl flex items-center justify-center shadow-lg shadow-red-900/50">
                <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-primary">Liste des clients</h1>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-900/20 border-l-4 border-green-500 text-green-400 p-3 sm:p-4 rounded-lg mb-4 sm:mb-6 shadow-md animate-slide-in">
                <div class="flex items-start">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2 sm:mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm sm:text-base">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        {{-- Add Button --}}
        <a href="{{ route('clients.index') }}" 
           class="w-full sm:w-auto bg-gradient-to-r from-red-600 to-red-900 hover:from-red-700 hover:to-black text-white font-bold px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl shadow-lg shadow-red-900/50 transform hover:scale-105 transition-all duration-200 inline-flex items-center justify-center gap-2 mb-4 sm:mb-6 text-sm sm:text-base">
            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Ajouter un client
        </a>

        {{-- Search Form --}}
        <form method="GET" action="{{ route('clients.filter') }}" class="mb-4 sm:mb-6 flex flex-col sm:flex-row gap-2 sm:gap-3">
            <div class="relative flex-1">
                <input type="text" 
                       name="search" 
                       placeholder="Recherche..." 
                       value="{{ request('search') }}" 
                       class="w-full bg-card border-2 border-card text-primary rounded-lg sm:rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 pl-10 sm:pl-11 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all hover:border-red-800 placeholder-gray-500 text-sm sm:text-base">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500 absolute left-3 sm:left-3.5 top-3 sm:top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <button type="submit" 
                    class="bg-gradient-to-r from-red-600 to-red-900 hover:from-red-700 hover:to-black text-white font-bold px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg sm:rounded-xl shadow-lg transform hover:scale-105 transition-all text-sm sm:text-base whitespace-nowrap">
                Chercher
            </button>
        </form>

        {{-- Table Desktop --}}
        <div class="hidden lg:block bg-card rounded-xl sm:rounded-2xl shadow-2xl overflow-hidden border-2 border-card">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-red-900/50 to-red-800/30">
                        <tr>
                            <th class="py-3 sm:py-4 px-3 sm:px-6 text-left text-xs sm:text-sm font-bold text-white uppercase tracking-wider">Nom</th>
                            <th class="py-3 sm:py-4 px-3 sm:px-6 text-left text-xs sm:text-sm font-bold text-white uppercase tracking-wider">Prénom</th>
                            <th class="py-3 sm:py-4 px-3 sm:px-6 text-left text-xs sm:text-sm font-bold text-white uppercase tracking-wider">CNI</th>
                            <th class="py-3 sm:py-4 px-3 sm:px-6 text-left text-xs sm:text-sm font-bold text-white uppercase tracking-wider">Téléphone</th>
                            <th class="py-3 sm:py-4 px-3 sm:px-6 text-left text-xs sm:text-sm font-bold text-white uppercase tracking-wider">Email</th>
                            <th class="py-3 sm:py-4 px-3 sm:px-6 text-center text-xs sm:text-sm font-bold text-white uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($clients as $client)
                            <tr class="hover:bg-red-900/10 transition-colors duration-200">
                                <td class="py-3 sm:py-4 px-3 sm:px-6 text-sm text-primary font-medium">{{ $client->nom }}</td>
                                <td class="py-3 sm:py-4 px-3 sm:px-6 text-sm text-secondary">{{ $client->prenom }}</td>
                                <td class="py-3 sm:py-4 px-3 sm:px-6 text-sm text-secondary">{{ $client->cni }}</td>
                                <td class="py-3 sm:py-4 px-3 sm:px-6 text-sm text-secondary">{{ $client->telephone }}</td>
                                <td class="py-3 sm:py-4 px-3 sm:px-6 text-sm text-secondary">{{ $client->email ?? '-' }}</td>
                                <td class="py-3 sm:py-4 px-3 sm:px-6">
                                    <div class="flex items-center justify-center gap-2 sm:gap-3">
                                        <a href="{{ route('clients.history', $client->id) }}" class="text-purple-400 hover:text-purple-300 transition-colors" title="Historique">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('clients.edit', $client) }}" class="text-yellow-400 hover:text-yellow-300 transition-colors" title="Modifier">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline-block" onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 transition-colors" title="Supprimer">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 px-6 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        <p class="text-secondary text-lg">Aucun client trouvé</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Cards Mobile/Tablet --}}
        <div class="lg:hidden space-y-3 sm:space-y-4">
            @forelse($clients as $client)
                <div class="bg-card rounded-lg sm:rounded-xl shadow-xl border-2 border-card p-3 sm:p-4 animate-slide-in">
                    <div class="mb-3">
                        <h3 class="text-base sm:text-lg font-bold text-primary mb-2">{{ $client->nom }} {{ $client->prenom }}</h3>
                        <div class="space-y-1 text-xs sm:text-sm">
                            <p class="text-secondary"><span class="text-red-500 font-semibold">CNI:</span> {{ $client->cni }}</p>
                            <p class="text-secondary"><span class="text-red-500 font-semibold">Tél:</span> {{ $client->telephone }}</p>
                            <p class="text-secondary"><span class="text-red-500 font-semibold">Email:</span> {{ $client->email ?? '-' }}</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-2 pt-3 border-t border-card">
                        <a href="{{ route('clients.history', $client->id) }}" class="bg-purple-600/20 border border-purple-500/50 text-purple-400 px-2 sm:px-3 py-2 rounded-lg text-xs font-semibold hover:bg-purple-600/30 transition-colors flex items-center justify-center gap-1">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="hidden sm:inline">Historique</span>
                        </a>
                        <a href="{{ route('clients.edit', $client) }}" class="bg-yellow-600/20 border border-yellow-500/50 text-yellow-400 px-2 sm:px-3 py-2 rounded-lg text-xs font-semibold hover:bg-yellow-600/30 transition-colors flex items-center justify-center gap-1">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            <span class="hidden sm:inline">Modifier</span>
                        </a>
                        <form action="{{ route('clients.destroy', $client) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-600/20 border border-red-500/50 text-red-400 px-2 sm:px-3 py-2 rounded-lg text-xs font-semibold hover:bg-red-600/30 transition-colors flex items-center justify-center gap-1">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                <span class="hidden sm:inline">Supprimer</span>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-card rounded-lg sm:rounded-xl shadow-xl border-2 border-card p-6 sm:p-8 text-center">
                    <svg class="w-12 h-12 sm:w-16 sm:h-16 text-gray-600 mx-auto mb-3 sm:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <p class="text-secondary text-sm sm:text-base">Aucun client trouvé</p>
                </div>
            @endforelse
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