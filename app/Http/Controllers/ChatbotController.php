<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatbotResposta;
use App\Models\ChatLog;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    public function responder(Request $request)
    {
        $mensagem = strtolower($request->mensagem);
        $respostaFinal = "Desculpe, não entendi. Pode reformular?";

        $respostas = ChatbotResposta::all();

        foreach ($respostas as $resposta) {
            foreach ($resposta->gatilhos as $gatilho) {
                if (str_contains($mensagem, $gatilho)) {
                    $respostaFinal = $resposta->resposta;
                    break 2;
                }
            }
        }

        // salva log
        ChatLog::create([
            'user_id' => Auth::id(),
            'mensagem' => $mensagem,
            'resposta' => $respostaFinal,
            'data' => now()
        ]);

        return response()->json([
            'resposta' => $respostaFinal
        ]);
    }
}
