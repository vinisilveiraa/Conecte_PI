<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Conversation extends Model
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'proposal_id',
        'client_user_id',
        'caregiver_user_id',
        'last_message',
        'last_message_at'
    ];

    protected $casts = [
        'last_message_at' => 'datetime'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_user_id');
    }

    public function caregiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'caregiver_user_id');
    }

    public function proposal(): BelongsTo
    {
        return $this->belongsTo(Proposal::class);
    }

    public function getOtherUserAttribute()
    {
        $userId = $this->client_user_id == auth()->id()
            ? $this->caregiver_user_id
            : $this->client_user_id;

        return User::find($userId);
    }
}
