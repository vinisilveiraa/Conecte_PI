<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class ChatbotResposta extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'chatbot_respostas';

    protected $fillable = [
        'gatilhos',
        'resposta'
    ];

}
