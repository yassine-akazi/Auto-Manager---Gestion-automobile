<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'client_id',
        'numero',
        'products',
        'logo',
        'total',
        'montant',
        'date_emission',  // Ajoutez cette ligne
        'description'
    ];

    protected $casts = [
        'products' => 'array',
        'date_emission' => 'datetime',
        'tva_rate' => 'float'
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}