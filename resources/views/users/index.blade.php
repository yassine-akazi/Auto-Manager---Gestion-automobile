@extends('layouts.app')

@section('title','Gestion Utilisateurs')

@section('content')
<div class="p-8">
    <h1 class="text-3xl font-bold mb-6">Liste des utilisateurs</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <table class="min-w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4">ID</th>
                <th class="py-2 px-4">Nom</th>
                <th class="py-2 px-4">Email</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="border-b">
                <td class="py-2 px-4">{{ $user->id }}</td>
                <td class="py-2 px-4">{{ $user->name }}</td>
                <td class="py-2 px-4">{{ $user->email }}</td>
                <td class="py-2 px-4">
                    <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                        @csrf
                        @method('DELETE')
                        class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection