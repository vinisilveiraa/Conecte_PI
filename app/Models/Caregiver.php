<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Caregiver extends Model
{
    protected $fillable =
    [
        'user_id',
        'coren',
        'certificado_cuidador',
        'bio',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function specialties(): BelongsToMany
    {
        return $this->belongsToMany(
            Specialty::class,
            'caregiver_specialty',
        )->whitPivot('preco_minimo')
        ->whitTimestamps();
    }

    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class);
    }
}
