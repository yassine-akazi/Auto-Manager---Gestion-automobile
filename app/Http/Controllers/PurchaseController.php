<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Client;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $query = Purchase::query()->with(['client','car','user']);

        if($request->filled('search')){
            $search = $request->search;
            $query->whereHas('client', fn($q)=> $q->where('nom','like',"%$search%")
                                                    ->orWhere('prenom','like',"%$search%"))
                  ->orWhereHas('car', fn($q)=> $q->where('marque','like',"%$search%")
                                                 ->orWhere('modele','like',"%$search%"))
                  ->orWhereHas('user', fn($q)=> $q->where('name','like',"%$search%"));
        }

        if($request->filled('year')){
            $query->whereYear('created_at', $request->year);
        }

        $purchases = $query->orderBy('created_at','desc')->paginate(10)->withQueryString();
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $clients = Client::all();
        $cars = Car::where('statut','Disponible')->get();
        return view('purchases.create', compact('clients','cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'=>'required|exists:clients,id',
            'car_id'=>'required|exists:cars,id',
            'prix_total'=>'required|numeric|min:0',
            'avance'=>'required|numeric|min:0',
            'payment_method'=>'required|in:cash,cheque,virement',
            'cheque_scan'=>'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'date_achat'=>'required|date'
        ]);

        $data = $request->only(['client_id','car_id','prix_total','avance','payment_method','date_achat']);
        $data['reste'] = $data['prix_total'] - $data['avance'];
        $data['user_id'] = auth()->id();

        if($request->hasFile('cheque_scan')){
            $data['cheque_scan'] = $request->file('cheque_scan')->store('cheques','public');
        }

        $purchase = Purchase::create($data);

        Invoice::create([
            'client_id'=>$data['client_id'],
            'numero'=>'F-'.time(),
            'date_emission'=>now(),
            'montant'=>$data['prix_total'],
            'description'=>'Achat véhicule ID: '.$data['car_id']
        ]);

        $car = Car::findOrFail($data['car_id']);
        $car->statut = "Vendue";
        $car->prix_vente = $data['prix_total'];
        $car->save();

        return redirect()->back()->with('success','Achat et facture générée avec succès !');
    }

    public function edit(Purchase $purchase)
    {
        return view('purchases.edit', [
            'purchase'=>$purchase,
            'clients'=>Client::all(),
            'cars'=>Car::all(),
            'users'=>User::all()
        ]);
    }

    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'client_id'=>'required|exists:clients,id',
            'car_id'=>'required|exists:cars,id',
            'prix_total'=>'required|numeric|min:0',
            'avance'=>'required|numeric|min:0',
            'payment_method'=>'required|in:cash,cheque,virement',
            'cheque_scan'=>'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'date_achat'=>'required|date'
        ]);

        $data = $request->only(['client_id','car_id','prix_total','avance','payment_method','date_achat']);
        $data['reste'] = $data['prix_total'] - $data['avance'];
        $data['user_id'] = auth()->id();

        if($request->hasFile('cheque_scan')){
            $data['cheque_scan'] = $request->file('cheque_scan')->store('cheques','public');
        }

        $purchase->update($data);
        return redirect()->route('purchases.index')->with('success','Achat modifié avec succès.');
    }

    public function destroy(Purchase $purchase)
    {
        DB::beginTransaction();
        try {
            if($purchase->car){
                $purchase->car->update([
                    'statut'=>'Disponible',
                    'prix_vente'=>null
                ]);
            }
            $purchase->delete();
            DB::commit();
            return redirect()->route('purchases.index')->with('success','Achat supprimé avec succès.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('purchases.index')->with('error','Erreur lors de la suppression.');
        }
    }

    public function show($id)
    {
        $purchase = Purchase::findOrFail($id);
        return view('purchases.show', compact('purchase'));
    }
}