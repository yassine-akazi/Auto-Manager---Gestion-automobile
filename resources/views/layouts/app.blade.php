<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Auto Manager')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        .nav-link {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .nav-link:hover {
            transform: translateX(5px);
        }
        
        .nav-link.active {
            background: linear-gradient(135deg, #dc2626 0%, #7f1d1d 100%);
            box-shadow: 0 4px 15px 0 rgba(220, 38, 38, 0.4);
            color: white !important;
        }
        
        .menu-icon {
            transition: transform 0.3s ease;
        }
        
        .menu-icon:hover {
            transform: rotate(90deg);
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-slide-in {
            animation: slideIn 0.5s ease forwards;
        }
        
        .backdrop {
            backdrop-filter: blur(10px);
            background: rgba(0, 0, 0, 0.5);
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        
        @media (max-width: 768px) {
            #sidebar { transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        }

        /* ========== DARK THEME ========== */
        body.theme-dark {
            background: linear-gradient(135deg, #1a1a1a 0%, #0a0a0a 50%, #1a1a1a 100%);
            color: #ffffff;
        }
        body.theme-dark .sidebar-gradient {
            background: linear-gradient(180deg, #0a0a0a 0%, #1a1a1a 100%);
            color: #ffffff;
        }
        body.theme-dark .main-bg {
            background: linear-gradient(135deg, #1a1a1a 0%, #0a0a0a 50%, #1a1a1a 100%);
        }
        body.theme-dark .text-primary { color: #ffffff; }
        body.theme-dark .text-secondary { color: #9ca3af; }
        body.theme-dark .text-muted { color: #6b7280; }
        body.theme-dark .bg-card { background: linear-gradient(135deg, #1f2937 0%, #111827 100%); }
        body.theme-dark .border-card { border-color: rgba(220, 38, 38, 0.3); }
        body.theme-dark .nav-link:not(.active) { color: #ffffff; }
        body.theme-dark .nav-link:not(.active):hover { background: rgba(220, 38, 38, 0.2); }
        body.theme-dark ::-webkit-scrollbar-track { background: #1a1a1a; }
        body.theme-dark ::-webkit-scrollbar-thumb { 
            background: linear-gradient(180deg, #dc2626 0%, #7f1d1d 100%);
        }

        /* ========== LIGHT THEME ========== */
        body.theme-light {
            background: linear-gradient(135deg, #f9fafb 0%, #ffffff 50%, #f3f4f6 100%);
            color: #1f2937;
        }
        body.theme-light .sidebar-gradient {
            background: linear-gradient(180deg, #ffffff 0%, #f3f4f6 100%);
            color: #1f2937;
            border-right: 2px solid #e5e7eb;
        }
        body.theme-light .main-bg {
            background: linear-gradient(135deg, #f9fafb 0%, #ffffff 50%, #f3f4f6 100%);
        }
        body.theme-light .text-primary { color: #1f2937; }
        body.theme-light .text-secondary { color: #6b7280; }
        body.theme-light .text-muted { color: #9ca3af; }
        body.theme-light .bg-card { background: #ffffff; }
        body.theme-light .border-card { border-color: rgba(220, 38, 38, 0.2); }
        body.theme-light .nav-link:not(.active) { color: #1f2937; }
        body.theme-light .nav-link:not(.active):hover { background: rgba(220, 38, 38, 0.1); }
        body.theme-light ::-webkit-scrollbar-track { background: #f3f4f6; }
        body.theme-light ::-webkit-scrollbar-thumb { 
            background: linear-gradient(180deg, #dc2626 0%, #991b1b 100%);
        }

        /* ========== GRAY THEME ========== */
        body.theme-gray {
            background: linear-gradient(135deg, #4b5563 0%, #374151 50%, #6b7280 100%);
            color: #f9fafb;
        }
        body.theme-gray .sidebar-gradient {
            background: linear-gradient(180deg, #374151 0%, #4b5563 100%);
            color: #f9fafb;
        }
        body.theme-gray .main-bg {
            background: linear-gradient(135deg, #4b5563 0%, #374151 50%, #6b7280 100%);
        }
        body.theme-gray .text-primary { color: #f9fafb; }
        body.theme-gray .text-secondary { color: #d1d5db; }
        body.theme-gray .text-muted { color: #9ca3af; }
        body.theme-gray .bg-card { background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%); }
        body.theme-gray .border-card { border-color: rgba(220, 38, 38, 0.4); }
        body.theme-gray .nav-link:not(.active) { color: #f9fafb; }
        body.theme-gray .nav-link:not(.active):hover { background: rgba(220, 38, 38, 0.2); }
        body.theme-gray ::-webkit-scrollbar-track { background: #4b5563; }
        body.theme-gray ::-webkit-scrollbar-thumb { 
            background: linear-gradient(180deg, #ef4444 0%, #dc2626 100%);
        }
    </style>
</head>
<body class="theme-dark">

@if(auth()->check())

    {{-- MOBILE TOPBAR --}}
    <div class="md:hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-between sidebar-gradient px-4 py-3 shadow-2xl border-b-2 border-red-600">
        <div class="flex items-center gap-2">
            <div class="w-9 h-9 bg-gradient-to-br from-red-600 to-red-900 rounded-lg flex items-center justify-center shadow-lg">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                </svg>
            </div>
            <span class="text-lg font-bold text-primary">Auto Manager</span>
        </div>

        <button id="menu-btn" class="menu-icon focus:outline-none hover:text-red-500 transition-colors text-primary">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    {{-- BACKDROP OVERLAY --}}
    <div id="backdrop" class="fixed inset-0 z-30 backdrop hidden md:hidden"></div>

    {{-- SIDEBAR --}}
    <aside id="sidebar" class="w-72 sidebar-gradient h-screen fixed top-0 left-0 z-40 p-4 sm:p-6 transform -translate-x-full md:translate-x-0 transition-transform duration-300 shadow-2xl overflow-y-auto border-r-2 border-card">

        {{-- Logo Section Desktop --}}
        <div class="mb-6 sm:mb-8 pb-4 sm:pb-6 border-b border-red-900/30 hidden md:block">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-red-600 to-red-900 rounded-xl flex items-center justify-center shadow-lg transform hover:rotate-12 transition-transform">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-primary">Auto Manager</h2>
                    <p class="text-xs text-secondary">Gestion automobile</p>
                </div>
            </div>
        </div>

        {{-- Close button mobile --}}
        <div class="md:hidden flex items-center justify-between mb-6 pb-4 border-b border-red-900/30">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-red-600 to-red-900 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-primary">Menu</h2>
            </div>
            <button id="close-sidebar-btn" class="text-secondary hover:text-primary transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- User Info --}}
        <div class="mb-4 sm:mb-6 p-3 sm:p-4 bg-gradient-to-br from-red-900/20 to-red-800/10 rounded-xl backdrop-blur-sm border border-red-800/30">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-red-500 to-red-700 rounded-full flex items-center justify-center font-bold text-base sm:text-lg shadow-lg text-white">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-sm sm:text-base truncate text-primary">{{ auth()->user()->name }}</p>
                </div>
            </div>
        </div>

        {{-- Theme Selector --}}
        <div class="mb-4 sm:mb-6 p-3 sm:p-4 bg-gradient-to-br from-red-900/20 to-red-800/10 rounded-xl backdrop-blur-sm border border-red-800/30">
            <p class="text-xs font-semibold uppercase tracking-wider mb-3 flex items-center gap-2 text-primary">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                </svg>
                Thème
            </p>
            <div class="grid grid-cols-3 gap-2">
                <button onclick="setTheme('dark')" class="theme-btn flex flex-col items-center gap-1 p-2 rounded-lg hover:bg-red-900/20 transition-all border-2 border-transparent" data-theme="dark">
                    <div class="w-6 h-6 rounded-full bg-gradient-to-br from-gray-900 to-black border-2 border-gray-700"></div>
                    <span class="text-xs text-primary">Dark</span>
                </button>
                <button onclick="setTheme('light')" class="theme-btn flex flex-col items-center gap-1 p-2 rounded-lg hover:bg-red-900/20 transition-all border-2 border-transparent" data-theme="light">
                    <div class="w-6 h-6 rounded-full bg-gradient-to-br from-white to-gray-100 border-2 border-gray-300"></div>
                    <span class="text-xs text-primary">Light</span>
                </button>
                <button onclick="setTheme('gray')" class="theme-btn flex flex-col items-center gap-1 p-2 rounded-lg hover:bg-red-900/20 transition-all border-2 border-transparent" data-theme="gray">
                    <div class="w-6 h-6 rounded-full bg-gradient-to-br from-gray-600 to-gray-700 border-2 border-gray-500"></div>
                    <span class="text-xs text-primary">Gray</span>
                </button>
            </div>
        </div>

        <nav class="space-y-1 sm:space-y-2">
            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}" class="nav-link flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg sm:rounded-xl text-sm sm:text-base {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>

            {{-- Section Voitures --}}
            <div class="pt-3 sm:pt-4 pb-1 sm:pb-2">
                <p class="text-xs font-semibold text-red-400 uppercase tracking-wider px-3 sm:px-4">Véhicules</p>
            </div>
            <a href="{{ route('cars.index') }}" class="nav-link flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg sm:rounded-xl text-sm sm:text-base {{ request()->routeIs('cars.index') ? 'active' : '' }}">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <span class="font-medium">Liste des voitures</span>
            </a>
            <a href="{{ route('cars.create') }}" class="nav-link flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg sm:rounded-xl text-sm sm:text-base {{ request()->routeIs('cars.create') ? 'active' : '' }}">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="font-medium">Ajouter Voiture</span>
            </a>

            {{-- Section Clients --}}
            <div class="pt-3 sm:pt-4 pb-1 sm:pb-2">
                <p class="text-xs font-semibold text-red-400 uppercase tracking-wider px-3 sm:px-4">Clients</p>
            </div>
            <a href="{{ route('clients.show') }}" class="nav-link flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg sm:rounded-xl text-sm sm:text-base {{ request()->routeIs('clients.show') ? 'active' : '' }}">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="font-medium">Gestion Clients</span>
            </a>
            <a href="{{ route('clients.index') }}" class="nav-link flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg sm:rounded-xl text-sm sm:text-base {{ request()->routeIs('clients.index') ? 'active' : '' }}">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="font-medium">Ajouter Client</span>
            </a>

            {{-- Section Transactions --}}
            <div class="pt-3 sm:pt-4 pb-1 sm:pb-2">
                <p class="text-xs font-semibold text-red-400 uppercase tracking-wider px-3 sm:px-4">Transactions</p>
            </div>
            <a href="{{ route('purchases.index') }}" class="nav-link flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg sm:rounded-xl text-sm sm:text-base {{ request()->routeIs('purchases.index') ? 'active' : '' }}">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span class="font-medium">Gestion Achats</span>
            </a>
            <a href="{{ route('purchases.create')}}" class="nav-link flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg sm:rounded-xl text-sm sm:text-base {{ request()->routeIs('purchases.create') ? 'active' : '' }}">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="font-medium">Nouvel Achat</span>
            </a>
            <a href="{{ route('invoices.index') }}" class="nav-link flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg sm:rounded-xl text-sm sm:text-base {{ request()->routeIs('invoices.index') ? 'active' : '' }}">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="font-medium">Factures</span>
            </a>
            <a href="{{ route('invoices.create') }}" class="nav-link flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg sm:rounded-xl text-sm sm:text-base {{ request()->routeIs('invoices.create') ? 'active' : '' }}">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="font-medium">Créer Facture</span>
            </a>

            {{-- Admin Section --}}
            @if(auth()->user()->role === 'admin')
                <div class="pt-3 sm:pt-4 pb-1 sm:pb-2">
                    <p class="text-xs font-semibold text-red-400 uppercase tracking-wider px-3 sm:px-4">Administration</p>
                </div>
                <a href="{{ route('users.index') }}" class="nav-link flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg sm:rounded-xl text-sm sm:text-base {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span class="font-medium">Gestion Utilisateurs</span>
                </a>
            @endif
        </nav>

        {{-- LOGOUT --}}
        <div class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-red-900/30">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-gradient-to-r from-red-600 to-red-800 rounded-lg sm:rounded-xl hover:from-red-700 hover:to-red-900 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center gap-2 text-sm sm:text-base text-white">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="md:ml-72 min-h-screen pt-16 sm:pt-20 md:pt-6 px-3 sm:px-4 md:px-8 pb-6 sm:pb-8 main-bg">
        <div class="animate-slide-in">
            @yield('content')
        </div>
    </main>

@else
    {{-- Pages login/register --}}
    <main class="w-full min-h-screen flex items-center justify-center p-4 sm:p-6">
        @yield('content')
    </main>
@endif

{{-- SCRIPTS --}}
<script>
    // Theme Management
    function setTheme(theme) {
        document.body.className = 'theme-' + theme;
        localStorage.setItem('theme', theme);
        
        // Update active button
        document.querySelectorAll('.theme-btn').forEach(btn => {
            if (btn.dataset.theme === theme) {
                btn.classList.add('border-red-500', 'bg-red-900/30');
            } else {
                btn.classList.remove('border-red-500', 'bg-red-900/30');
            }
        });
    }

    // Load saved theme
    window.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('theme') || 'dark';
        setTheme(savedTheme);
    });

    // Sidebar Management
    const sidebar = document.getElementById('sidebar');
    const menuBtn = document.getElementById('menu-btn');
    const closeSidebarBtn = document.getElementById('close-sidebar-btn');
    const backdrop = document.getElementById('backdrop');

    menuBtn?.addEventListener('click', () => {
        sidebar.classList.remove('-translate-x-full');
        backdrop?.classList.remove('hidden');
    });

    closeSidebarBtn?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        backdrop?.classList.add('hidden');
    });

    backdrop?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        backdrop.classList.add('hidden');
    });

    const navLinks = sidebar?.querySelectorAll('.nav-link');
    navLinks?.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 768) {
                sidebar.classList.add('-translate-x-full');
                backdrop?.classList.add('hidden');
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>