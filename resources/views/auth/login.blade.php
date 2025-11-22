@extends('layouts.app')

@section('title','Connexion')

@section('content')
<div class="min-h-screen  from-gray-900 via-black to-gray-900 flex items-center justify-center p-3 sm:p-4 md:p-6 relative overflow-hidden">
    
    {{-- Animated Background Elements --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-20 sm:-top-40 -right-20 sm:-right-40 w-40 sm:w-80 h-40 sm:h-80 bg-red-600/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-20 sm:-bottom-40 -left-20 sm:-left-40 w-40 sm:w-80 h-40 sm:h-80 bg-red-900/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-48 sm:w-96 h-48 sm:h-96 bg-red-700/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
    </div>

    <div class="w-full max-w-xl relative z-10">
        
        {{-- Logo & Title --}}
        <div class="text-center mb-6 sm:mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-red-600 to-red-900 rounded-xl sm:rounded-2xl shadow-2xl shadow-red-900/50 mb-3 sm:mb-4 transform hover:rotate-12 transition-transform">
                <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                </svg>
            </div>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-1 sm:mb-2">Auto Manager</h1>
            <p class="text-gray-400 text-xs sm:text-sm md:text-base">Connectez-vous à votre compte</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-gradient-to-br from-gray-900 to-black rounded-xl sm:rounded-2xl md:rounded-3xl shadow-2xl border-2 border-red-900/50 overflow-hidden backdrop-blur-sm">
            
            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="bg-red-900/20 border-l-4 border-red-500 text-red-400 p-3 sm:p-4 m-3 sm:m-4 md:m-6 rounded-lg animate-slide-in">
                    <div class="flex items-start">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="text-xs sm:text-sm">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="p-4 sm:p-6 md:p-8 space-y-4 sm:space-y-6">
                @csrf

                {{-- Email --}}
                <div class="space-y-1.5 sm:space-y-2">
                    <label class="block font-semibold text-gray-300 text-xs sm:text-sm uppercase tracking-wide">
                        <span class="flex items-center gap-1.5 sm:gap-2">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                            Email
                        </span>
                    </label>
                    <div class="relative">
                        <input type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="votre@email.com"
                               required
                               autofocus
                               class="w-full bg-gray-800 border-2 border-gray-700 text-white rounded-lg sm:rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 pl-9 sm:pl-11 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 placeholder-gray-500 text-sm sm:text-base">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2.5 sm:pl-3 pointer-events-none">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Password --}}
                <div class="space-y-1.5 sm:space-y-2">
                    <label class="block font-semibold text-gray-300 text-xs sm:text-sm uppercase tracking-wide">
                        <span class="flex items-center gap-1.5 sm:gap-2">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Mot de passe
                        </span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="password" 
                               id="password"
                               placeholder="••••••••"
                               required
                               class="w-full bg-gray-800 border-2 border-gray-700 text-white rounded-lg sm:rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 pl-9 sm:pl-11 pr-9 sm:pr-11 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 hover:border-red-800 placeholder-gray-500 text-sm sm:text-base">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2.5 sm:pl-3 pointer-events-none">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <button type="button" 
                                onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 flex items-center pr-2.5 sm:pr-3 text-gray-400 hover:text-red-500 transition-colors">
                            <svg id="eye-icon" class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Remember Me & Forgot Password --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-0 text-xs sm:text-sm">
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" 
                               name="remember" 
                               id="remember" 
                               class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-red-600 bg-gray-800 border-gray-700 rounded focus:ring-red-500 focus:ring-2">
                        <span class="ml-2 text-gray-400 group-hover:text-white transition-colors">Se souvenir de moi</span>
                    </label>
                  
                </div>

                {{-- Submit Button --}}
                <button type="submit"
                        class="w-full bg-gradient-to-r from-red-600 to-red-900 hover:from-red-700 hover:to-black text-white font-bold py-2.5 sm:py-3 md:py-4 rounded-lg sm:rounded-xl shadow-lg shadow-red-900/50 transform hover:scale-105 transition-all duration-200 flex items-center justify-center gap-2 group text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    <span class="sm:text-lg">Se connecter</span>
                </button>

                {{-- Divider --}}
              

                {{-- Register Link --}}
                
            </form>
        </div>

        {{-- Footer Info --}}
        <div class="mt-6 sm:mt-8 text-center text-gray-500 text-xs sm:text-sm">
            <p>© {{ date('Y') }} Auto Manager. Tous droits réservés.</p>
            <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-4 mt-2">
                <a href="#" class="hover:text-red-500 transition-colors">Confidentialité</a>
                <span class="hidden sm:inline">•</span>
                <a href="#" class="hover:text-red-500 transition-colors">Conditions</a>
                <span class="hidden sm:inline">•</span>
                <a href="#" class="hover:text-red-500 transition-colors">Support</a>
            </div>
        </div>

    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
    } else {
        passwordInput.type = 'password';
        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
    }
}

// Auto-hide keyboard on mobile after submit
document.querySelector('form').addEventListener('submit', function() {
    if (window.innerWidth < 768) {
        document.activeElement.blur();
    }
});
</script>

<style>
@keyframes slide-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-slide-in {
    animation: slide-in 0.5s ease forwards;
}

@keyframes pulse {
    0%, 100% { opacity: 0.3; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(1.05); }
}

input[type="checkbox"] {
    accent-color: #dc2626;
}

/* Prevent zoom on input focus (iOS) */
@media screen and (max-width: 768px) {
    input[type="text"],
    input[type="email"],
    input[type="password"] {
        font-size: 16px !important;
    }
}

/* Smooth scroll for small screens */
@media (max-height: 700px) {
    .min-h-screen {
        min-height: 100vh;
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
}
</style>
@endsection