<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Proposal extends Model
{
     protected $fillable = [
        'valor_servico',
        'data_inicio',
        'data_fim',
        'descricao_servico',
        'endereco_servico',
        'status',
        'estrela',
        'client_id',
        'caregiver_id'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function caregiver(): BelongsTo
    {
        return $this->belongsTo(Caregiver::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
