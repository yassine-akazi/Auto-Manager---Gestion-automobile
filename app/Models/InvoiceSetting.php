<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceSetting extends Model
{
    protected $fillable = [
        'company_name',
        'company_phone',
        'company_address',
        'logo',
        'footer_text'
    ];
}