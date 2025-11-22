<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Car;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'cni',
        'telephone',
        'email',
    ];

    // Optionnel : historique d'achats si tu veux un relation
    public function achats()
    {
        return $this->hasMany(Achat::class);
    }
    public function purchases()
{
    return $this->hasMany(Purchase::class, 'client_id');
}
public function client()
{
    return $this->belongsTo(Client::class, 'client_id');
}

public function car()
{
    return $this->belongsTo(Car::class, 'car_id');
}

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}