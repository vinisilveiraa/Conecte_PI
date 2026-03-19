<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Specialty extends Model
{
    protected $fillable = [
        "nome",
        "descricao"
    ];

    public function caregivers(): BelongsToMany
    {
        return $this->belongsToMany(
            Caregiver::class
        )->withPivot('preco_minimo')
        ->withTimestamp();
    }
}
