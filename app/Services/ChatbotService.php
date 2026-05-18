<?php

namespace App\Services;

use App\Helpers\StringHelper;
use App\Models\ChatbotResposta;

class ChatbotService
{
    public function responder(string $mensagem): string
    {
        $mensagem = StringHelper::normalizeString($mensagem);

        $respostas = ChatbotResposta::all();

        $melhorResposta = null;
        $maiorScore = 0;

        foreach ($respostas as $resposta) {

            $score = $this->calcularScore(
                $mensagem,
                $resposta->gatilhos
            );

            if ($score > $maiorScore) {
                $maiorScore = $score;
                $melhorResposta = $resposta;
            }
        }

        // score minimo
        if (!$melhorResposta || $maiorScore < 1) {
            return 'Desculpe, não consegui entender 😅';
        }

        return $melhorResposta->resposta;
    }

    private function calcularScore(
        string $mensagem,
        array $gatilhos
    ): int {

        $score = 0;

        foreach ($gatilhos as $gatilho) {

            $gatilho = StringHelper::normalizeString($gatilho);

            // match exato
            if ($mensagem === $gatilho) {
                $score += 5;
                continue;
            }

            // contem frase
            if (str_contains($mensagem, $gatilho)) {
                $score += 3;
            }

            // palavras individuais
            $palavrasMensagem = explode(' ', $mensagem);

            foreach ($palavrasMensagem as $palavra) {

                if ($palavra === $gatilho) {
                    $score += 1;
                }
            }

            // similaridade
            similar_text($mensagem, $gatilho, $percent);

            if ($percent > 70) {
                $score += 2;
            }
        }

        return $score;
    }
}
