<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;


class CarController extends Controller
{
    public function dashboard() {
        $totalCars = Car::count();
        $soldCars = Car::where('statut','Vendue')->count();
        $availableCars = Car::where('statut','Disponible')->count();
        return view('dashboard', compact('totalCars','soldCars','availableCars'));
    }

    public function index() {
        $cars = Car::latest()->paginate(10);
        return view('cars.index', compact('cars'));
    }

    public function create() { 
        return view('cars.create'); 
    }

    public function store(Request $request) {
        $request->validate([
            'marque'=>'required',
            'modele'=>'required',
            'annee'=>'required|integer',
            'kilometrage'=>'required|integer',
            'prix_achat'=>'required|numeric',
            'prix_vente'=>'nullable|numeric',
            'statut'=>'required',
            'image'=>'nullable|image|max:2048'
        ]);

        $data = $request->all();
        
        // ✅ CORRECTION : Utiliser 'uploads/cars' au lieu de 'cars'
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/cars'), $filename);
            $data['image'] = $filename;
        }

        Car::create($data);
        return redirect()->route('cars.index')->with('success','Voiture ajoutée.');
    }

    public function show(Car $car) { 
        return view('cars.show', compact('car')); 
    }

    public function edit(Car $car) { 
        return view('cars.edit', compact('car')); 
    }

    public function update(Request $request, Car $car){
        $data = $request->all();
        
        // ✅ CORRECTION : Utiliser 'uploads/cars' au lieu de 'cars'
        if($request->hasFile('image')){
            // Supprimer l'ancienne image si elle existe
            if($car->image && file_exists(public_path('uploads/cars/'.$car->image))) {
                unlink(public_path('uploads/cars/'.$car->image));
            }
            
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/cars'), $filename);
            $data['image'] = $filename;
        }
        
        $car->update($data);
        return redirect()->route('cars.index')->with('success','Voiture mise à jour.');
    }

    public function destroy(Car $car){
        // ✅ CORRECTION : Supprimer correctement l'image
        if($car->image && file_exists(public_path('uploads/cars/'.$car->image))) {
            unlink(public_path('uploads/cars/'.$car->image));
        }
        
        $car->delete();
        return redirect()->route('cars.index')->with('success','Voiture supprimée.');
    }

    public function filter(Request $request) {
        $query = Car::query();
        
        if($request->filled('search')){
            $query->where('marque','like','%'.$request->search.'%')
                  ->orWhere('modele','like','%'.$request->search.'%');
        }
        
        if($request->filled('statut')){
            $query->where('statut',$request->statut);
        }
        
        if($request->filled('annee_exacte')){
            $query->where('annee',$request->annee_exacte);
        }
        
        $cars = $query->paginate(12);
        return view('cars.index', compact('cars')); 
    }
}