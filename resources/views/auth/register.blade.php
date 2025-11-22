@extends('layouts.app')

@section('title','Inscription')

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Créer un compte</h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1 font-semibold">Nom</label>
                <input type="text" name="name" required
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="block mb-1 font-semibold">Email</label>
                <input type="email" name="email" required
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="block mb-1 font-semibold">Mot de passe</label>
                <input type="password" name="password" required
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="block mb-1 font-semibold">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" required
                    class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300">
            </div>

            <button type="submit"
                class="w-full bg-green-600 text-white font-semibold py-2 rounded hover:bg-green-700 transition">
                S’inscrire
            </button>
        </form>

        <p class="mt-4 text-center text-gray-600">
            Déjà un compte ? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Se connecter</a>
        </p>
    </div>
</div>
@endsection