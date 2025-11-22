<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Car;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class Car extends Model
{
    protected $fillable = [
        'marque','modele','annee','kilometrage','prix_achat','prix_vente','date_dachat',
        'statut','image','matricule_part1','matricule_part2','matricule_part3'
    ];
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

}   