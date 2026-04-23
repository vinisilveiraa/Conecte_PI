<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'proposal_id',
        'caregiver_id',
        'client_id',
        'rating',
        'comment'

        // 'revisor_id',
        // 'revisado_id',
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
