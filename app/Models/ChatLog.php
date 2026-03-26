<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class ChatLog extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'chat_logs';

    protected $fillable = [
        'user_id',
        'mensagem',
        'resposta',
        'data'
    ];
}
