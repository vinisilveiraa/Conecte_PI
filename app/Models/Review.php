<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'proposal_id',
        'revisor_id',
        'revisado_id',
        'avaliacao',
        'comentario'
    ];

    public function proposal(): BelongsTo
    {
        return $this->belongsTo(Proposal::class);
    }

    public function revisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'revisor_id');
    }

    public function revisado(): BelongsTo
    {
        return $this->belongsTo(User::class, 'revisado_id');
    }
}
