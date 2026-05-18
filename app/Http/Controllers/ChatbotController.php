<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChatbotService;

class ChatbotController extends Controller
{
    public function enviarMensagem(
        Request $request,
        ChatbotService $chatbot
    ) {

        $resposta = $chatbot->responder(
            $request->mensagem
        );

        return response()->json([
            'resposta' => $resposta
        ]);
    }
}
