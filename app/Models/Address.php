<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
     protected $fillable = [
        'numero',
        'logradouro',
        'bairro',
        'cidade',
        'cep',
        'estado',
        'latitude',
        'longitude',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
