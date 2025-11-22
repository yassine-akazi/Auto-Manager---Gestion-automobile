<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'numero',
        'date_emission',
        'montant',
        'description'
    ];

    // Transforme date_emission en Carbon automatiquement
    protected $dates = [
        'date_emission',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}