<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }


    public function filter(Request $request)
    {
        $query = Client::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nom', 'like', "%{$search}%")
                ->orWhere('prenom', 'like', "%{$search}%")
                ->orWhere('cni', 'like', "%{$search}%")
                ->orWhere('telephone', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        $clients = $query->orderBy('nom')->paginate(10);

        return view('clients.show', compact('clients'));
    }

    public function create()
    {
        return view('clients.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'cni' => 'required|unique:clients,cni',
            'telephone' => 'required',
            'email' => 'nullable|email',
        ]);

        Client::create($request->only(['nom','prenom','cni','telephone','email']));

        return redirect()->route('clients.show')->with('success', 'Client ajouté');
    }

    // Page pour afficher tous les clients
    public function showClients()
    {
        $clients = Client::all();
        return view('clients.show', compact('clients'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'cni'=>'required|unique:clients,cni,'.$client->id,
            'telephone'=>'required',
            'email'=>'nullable|email',
        ]);

        $client->update($request->all());
        return redirect()->route('clients.show')->with('success','Client modifié');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.show')->with('success','Client supprimé');
    }

    public function history($clientId)
    {
        $client = Client::findOrFail($clientId);
    
        // Récupère les achats ou historiques du client
        // Assure-toi que tu as une relation "purchases" dans ton modèle Client
        $purchases = $client->purchases()->with('car')->get();
    
        return view('clients.history', compact('client', 'purchases'));
    }
}