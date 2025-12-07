<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Car;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'car_id',
        'prix_total',
        'prix_vente', // Ajouter cette ligne
        'avance',
        'reste',
        'payment_method',
        'date_achat',
        'user_id',
        'cheque_scan'
    ];

    // Relation avec Car
    public function car()
{
    return $this->belongsTo(Car::class);
}

    // Relation avec Client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relation avec User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getEtatPaiementAttribute()
{
    if ($this->reste <= 0) {
        return "Payé";
    }
    return "Restant: " . $this->reste . " DH";
}
    
}