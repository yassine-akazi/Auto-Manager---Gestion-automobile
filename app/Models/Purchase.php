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
        'user_id',
        'prix_vente',
        'prix_total',
        'avance',
        'reste',
        'payment_method',
        'date_achat',
        'cheque_scan',
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
    
}